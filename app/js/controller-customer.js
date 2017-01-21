var app = angular.module('starter', []);

var componentsURL = 'view/components/';
var ajax = "http://localhost/phpWebsite/api/ajax/get_data/";

var productField = function(item) {
  return [
    item.ProductID,
    item.ProductName,
    item.CategoryName,
    item.Price,
    item.Quantity
  ];
}

var billField = function(item) {
  var employeeName = item.EmployeeName;

  if (employeeName === null)
    employeeName = "Chưa có";

  return [
    item.BillID,
    employeeName,
    item.BillValue,
  ];
}

var userField = function(item) {
  return [
    item.Name,
    item.Address,
    item.Email,
    item.TelNumber,
    item.TypeUser
  ];
}

app.controller('AdminCtrl', function($scope, $http, $location) {

  console.log('hello world');

  $scope.selectedItems = [];
  $scope.test = 100;

  $scope.initUserID = function(userID) {
    console.log('init user id this ');
    console.log(JSON.stringify(userID));
    $scope.userID = userID;

    $http({
      method: 'GET',
      url: ajax + 'bills.php?action=getAllCustomerBills&page-index=1&number-items=500&userid=' + $scope.userID
    }).then(function (res) {
      console.log('this is bill data');
      console.log(res.data);

      var arr = $.map(res.data, function(item) {      
        return {
          info: billField(item),
          status: item.Status,
          linkID: 'customer_details-of-bill.php?billID=' + item.BillID,
          selected: false
        };
      });

      $scope.billList.records = arr;
      $scope.billList.userID = $scope.userID;
      $scope.billList.duplicateRecords = arr;

      // get all category
      $http({
        method: 'GET',          
        url: ajax + 'statusbills.php?action=getAllStatus'
      }).then(function (res) {
        console.log('get success status bill category');
        $scope.billList.category = res.data;
        console.log($scope.billList.category);
      }, function(err) {
        console.log("error");
        console.log(JSON.stringify(err));
      })


    }, function(err) {
      console.log('error');
      console.log(err);
    });

  };

  // $scope.checkboxStatus = function(index) {
  //   console.log('hello world');
  //   console.log(index);
  // }

  $scope.title = "product";

  $scope.billList = {
    title: 'DANH SÁCH ĐƠN HÀNG',
    header: ['Chọn', 'Mã đơn hàng', 'Nhân Viên', 'Giá trị hóa đơn', 'Xem chi tiết', 'Hiện trạng'],
    records: [],
  };

  $scope.productList = {
    title: 'DANH SÁCH SẢN PHẨM',
    header: ['Chọn', 'Mã sản phẩm', 'Tên sản phẩm', 'Loại', 'Giá tiền', 'Số lượng', 'Chi tiết', 'Hiện trạng'],
    records: [],
  };

  $scope.categoryList = {
    title: 'DANH SÁCH NHÓM SẢN PHẨM',
    header: ['Mã nhóm', 'Tên nhóm', 'Độ ưu tiên'],
    records: [
      {
        info: ['01', 'mrwen', '1'],
        link: './01',
      },
      {
        info: ['02', 'mrwen', '2'],
        link: './02',
      },
    ],
  };

  $scope.memberList = {
    title: 'DANH SÁCH KHÁCH HÀNG',
    header: ['Chọn', 'Họ tên', 'Địa chỉ', 'Email', 'Điện thoại', 'Loại', 'Chi tiết' , 'Hiệu lực'],
    records: [],
  };

  $scope.agentList = {
    title: 'DANH SÁCH NHÂN VIÊN',
    header: ['Chọn', 'Họ tên', 'Địa chỉ', 'Email', 'Điện thoại', 'Loại', 'Chi tiết' , 'Hiệu lực'],
    records: [],
  };

  $scope.chooseTitle = function(value) {
    console.log('this is your value');
    console.log(value);
    $scope.title = value;
  };



});

app.directive("bill", ['$http', function($http) {
  return {
    restrict: 'E',
    transclude: true,
    scope: {
      options: '=',
    },
//    scope: false,
    templateUrl: componentsURL + 'bill-records-customer.html',
    link: function(scope, element, attrs) {
      scope.indexList = []
      scope.checkboxStatus = function(index) {
        var foundIndex = scope.indexList.indexOf(index);

        if (foundIndex > -1)   // found value in array
          scope.indexList.splice(foundIndex, 1);
        else          
          scope.indexList.push(index);  // push value in array

        console.log(JSON.stringify(scope.indexList));
      }

      scope.filterBy = function(categoryName) {
        console.log('filter by what');
        console.log(categoryName);
        var indexToFilter = 5;  // filter status bill
        var filterWhat = categoryName;
//        var list = scope.options.records;
        var list = scope.options.duplicateRecords;
        console.log('what list in bill');
        console.log(JSON.stringify(list));

        var filterData = [];
        var selectItem;

        if (filterWhat == "all") {
          scope.options.records = list;
          return;
        }

        // console.log('what bill status item');
        // console.log(JSON.stringify(scope.options.category));


        for(var i = 0; i < list.length; i++) {
          selectItem = scope.options.category[list[i].status - 1].StatusName
          if (selectItem == filterWhat)
            filterData.push(list[i])
        }

        // console.log('what select item');
        // console.log(selectItem);

        // console.log(JSON.stringify(filterData));

        scope.options.records = filterData;
      }

      scope.verifyItems = function() {
        var billRecords = scope.options.records;
        var indexList = scope.indexList;

        var activeItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          activeItems.push(billRecords[indexList[i]].info[0])
        }

        var listBill = {
          listBillIDs: activeItems,
          userID: scope.options.userID
        };

        $http({
          method: 'POST',          
          data: listBill,
          url: ajax + 'bills.php?action=Verify'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
          scope.indexList = []   // clear all 
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
          scope.indexList = []   // clear all 
        })

        console.log(JSON.stringify(activeItems));

        for(var i = 0; i < indexList.length; i++) {
          scope.options.records[indexList[i]].status = 2;
        }
      }
// TODO: refractor duplicate code
      scope.packItems = function() {
        var billRecords = scope.options.records;
        var indexList = scope.indexList;

        var activeItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          activeItems.push(billRecords[indexList[i]].info[0])
        }

        var listBill = {
          listBillIDs: activeItems,
          userID: scope.options.userID
        };

        $http({
          method: 'POST',          
          data: listBill,
          url: ajax + 'bills.php?action=Pack'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
          scope.indexList = []   // clear all 
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
          scope.indexList = []   // clear all 
        })

        console.log(JSON.stringify(activeItems));

        for(var i = 0; i < indexList.length; i++) {
          scope.options.records[indexList[i]].status = 3;
        }
      }

      scope.deliverItems = function() {
        var billRecords = scope.options.records;
        var indexList = scope.indexList;

        var activeItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          activeItems.push(billRecords[indexList[i]].info[0])
        }

        var listBill = {
          listBillIDs: activeItems,
          userID: scope.options.userID
        };

        $http({
          method: 'POST',          
          data: listBill,
          url: ajax + 'bills.php?action=Deliver'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
          scope.indexList = []   // clear all 
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
          scope.indexList = []   // clear all 
        })

        console.log(JSON.stringify(activeItems));

        for(var i = 0; i < indexList.length; i++) {
          scope.options.records[indexList[i]].status = 6;
        }
      }

      scope.cancelItems = function() {
        var billRecords = scope.options.records;
        var indexList = scope.indexList;

        var activeItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          activeItems.push(billRecords[indexList[i]].info[0])
        }

        var listBill = {
          listBillIDs: activeItems,
          userID: scope.options.userID
        };

        $http({
          method: 'POST',          
          data: listBill,
          url: ajax + 'bills.php?action=Cancel'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
          scope.indexList = []   // clear all 
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
          scope.indexList = []   // clear all 
        })

        console.log(JSON.stringify(activeItems));

        for(var i = 0; i < indexList.length; i++) {
          scope.options.records[indexList[i]].status = 7;
        }
      }


  }
  }}]);
