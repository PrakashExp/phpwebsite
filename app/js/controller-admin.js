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
    item.CustomerName,
    employeeName,
    item.BillValue,
  ];
}

var userField = function(item) {
  return [
    item.UserID,
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
  };

  // $scope.checkboxStatus = function(index) {
  //   console.log('hello world');
  //   console.log(index);
  // }

  $http({
    method: 'GET',
    url: ajax + 'bills.php?action=getAllBills&page-index=1&number-items=500'
  }).then(function (res) {
    console.log('this is bill data');
    console.log(res.data);

    var arr = $.map(res.data, function(item) {      
      return {
        info: billField(item),
        status: item.Status,
        linkID: 'admin_detail_of_bill.php?billID=' + item.BillID + '&userID=' + item.CustomerID,
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


  $http({
    method: 'GET',
    url: ajax + 'products.php?action=getActiveProducts&page-index=1&number-items=500'
  }).then(function (res) {
    console.log('get success');
//    console.log(JSON.stringify(res.data));

    var arr = [];

    $.map(res.data, function(item) {      
      var json = {
        info: productField(item),
        active: item.Active,
        hide: item.Hide,
        linkID: item.ProductID,
        selected: false
      }

      arr.push(json);
    });

//    console.log(JSON.stringify(arr));
    $scope.productList.records = arr;
    $scope.productList.userID = $scope.userID;
    $scope.productList.duplicateRecords = arr;

    // get all category
    $http({
      method: 'GET',          
      url: ajax + 'category.php?action=getAllCategory'
    }).then(function (res) {
      console.log('get success');
      $scope.productList.category = res.data;
//      console.log($scope.productList.category);
    }, function(err) {
      console.log("error");
      console.log(JSON.stringify(err));
    })


  }, function(err) {
    console.log('error');
    console.log(err);
  });

  $http({
    method: 'GET',
    url: ajax + 'users.php?action=getAllUsers&page-index=1&number-items=100'
  }).then(function (res) {

    var arr = [];

    $.map(res.data, function(item) {      
      var json = {
        info: userField(item),
        active: item.Active,
        hide: item.Hide,
        linkID: item.UserID,
      }

      arr.push(json);
    });

    console.log('this is user data');
//    console.log(JSON.stringify(arr));

    $scope.memberList.records = arr;
    $scope.memberList.userID = $scope.userID;
    $scope.memberList.duplicateRecords = arr;

    // get all type user in group
    $http({
      method: 'GET',          
      url: ajax + 'group.php?action=getAllGroup'
    }).then(function (res) {
      console.log('get success group');
      $scope.memberList.category = res.data.slice(0,4);
      console.log($scope.memberList.category);
    }, function(err) {
      console.log("error group");
      console.log(JSON.stringify(err));
    })

  }, function(err) {
    console.log('error');
    console.log(err);
  });

  $http({
    method: 'GET',
    url: ajax + 'users.php?action=getAllAgent&page-index=1&number-items=100'
  }).then(function (res) {
    console.log('this is agent data');
    var arr = [];
    $.map(res.data, function(item) {      
      var json = {
        info: userField(item),
        active: item.Active,
        linkID: item.UserID,
      }

      arr.push(json);
    });

    console.log('this is agent');
//    console.log(JSON.stringify(arr));

    $scope.agentList.records = arr;
    $scope.agentList.userID = $scope.userID;
    $scope.agentList.duplicateRecords = arr;

  }, function(err) {
    console.log('error');
    console.log(err);
  });

  $scope.title = "product";

  $scope.billList = {
    title: 'DANH SÁCH ĐƠN HÀNG',
    header: ['Chọn', 'Mã đơn hàng', 'Khách Hàng', 'Nhân Viên', 'Giá trị hóa đơn', 'Xem chi tiết', 'Hiện trạng'],
    records: [],
  };

  $scope.productList = {
    title: 'DANH SÁCH SẢN PHẨM',
    header: ['Chọn', 'Mã sản phẩm', 'Tên sản phẩm', 'Loại', 'Giá tiền', 'Số lượng', 'Chi tiết', 'Hiển thị'],
    records: [],
  };

  $scope.categoryList = {
    title: 'DANH SÁCH NHÓM SẢN PHẨM',
    header: ['Mã nhóm', 'Tên nhóm', 'Độ ưu tiên'],
    records: []
  };

  $scope.memberList = {
    title: 'DANH SÁCH KHÁCH HÀNG',
    header: ['Chọn', 'Mã KH' ,'Họ tên', 'Địa chỉ', 'Email', 'Điện thoại', 'Loại', 'Chi tiết' , 'Hiệu lực'],
    records: [],
  };

  $scope.agentList = {
    title: 'DANH SÁCH NHÂN VIÊN',
    header: ['Chọn', 'Mã nhân viên', 'Họ tên', 'Địa chỉ', 'Email', 'Điện thoại', 'Loại', 'Chi tiết' , 'Hiệu lực'],
    records: [],
  };

  $scope.chooseTitle = function(value) {
    console.log('this is your value');
    console.log(value);
    $scope.title = value;
  };



});

app.directive('category', function() {
  return {
    restrict: 'E',
    scope: {
      options: '=',
    },
    templateUrl: componentsURL + 'category-records.html'
  };
});

app.directive("member", ['$http', function($http) {
  return {
    restrict: 'E',
    transclude: true,
    scope: {
      options: '=',
    },
//    scope: false,
    templateUrl: componentsURL + 'member-records.html',
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
        var indexToFilter = 5;  // filter loai khach hang
        var filterWhat = categoryName;
//        var list = scope.options.records;
        var list = scope.options.duplicateRecords;
        console.log('what list member');
        console.log(JSON.stringify(list));

        var filterData = [];
        var selectItem;

        if (filterWhat == "all") {
          scope.options.records = list;
          return;
        }

        for(var i = 0; i < list.length; i++) {
          selectItem = list[i].info[indexToFilter]
          if (selectItem == filterWhat)
            filterData.push(list[i])
        }

        scope.options.records = filterData;
      }

      scope.activeItems = function() {
        var memberRecords = scope.options.records;
        var indexList = scope.indexList;

        var activeItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          activeItems.push(memberRecords[indexList[i]].linkID)
        }

        // console.log('this is active items');
        // console.log(JSON.stringify(activeItems));

        var listUser = {
          listUserIDs: activeItems
        };

        $http({
          method: 'POST',          
          data: listUser,
          url: ajax + 'users.php?action=Active'
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
          scope.options.records[indexList[i]].active = 1;
        }
      }

      scope.hideItems = function() {
        var memberRecords = scope.options.records;
        var indexList = scope.indexList;

        var hideItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          hideItems.push(memberRecords[indexList[i]].linkID)
        }

        var listUser = {
          listUserIDs: hideItems
        };

        $http({
          method: 'POST',          
          data: listUser,
          url: ajax + 'users.php?action=Block'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
          scope.indexList = []   // clear all 
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
          scope.indexList = []   // clear all 
        })

        console.log(JSON.stringify(hideItems));

        for(var i = 0; i < indexList.length; i++) {
          scope.options.records[indexList[i]].active = 0;
        }
      }

    }
  }
}]);

app.directive("agent", ['$http', function($http) {
  return {
    restrict: 'E',
    transclude: true,
    scope: {
      options: '=',
    },
//    scope: false,
    templateUrl: componentsURL + 'agent-records.html',
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
     
      scope.activeItems = function() {
        var agentRecords = scope.options.records;
        var indexList = scope.indexList;

        var activeItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          activeItems.push(agentRecords[indexList[i]].linkID)
        }

        // console.log('this is active items');
        // console.log(JSON.stringify(activeItems));

        var listUser = {
          listUserIDs: activeItems
        };

        $http({
          method: 'POST',          
          data: listUser,
          url: ajax + 'users.php?action=Active'
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
          scope.options.records[indexList[i]].active = 1;
        }
      }

      scope.hideItems = function() {
        var agentRecords = scope.options.records;
        var indexList = scope.indexList;

        var hideItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          hideItems.push(agentRecords[indexList[i]].linkID)
        }

        var listUser = {
          listUserIDs: hideItems
        };

        $http({
          method: 'POST',          
          data: listUser,
          url: ajax + 'users.php?action=Block'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
          scope.indexList = []   // clear all 
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
          scope.indexList = []   // clear all 
        })

        console.log(JSON.stringify(hideItems));

        for(var i = 0; i < indexList.length; i++) {
          scope.options.records[indexList[i]].active = 0;
        }
      }

    }
  }
}]);

app.directive("bill", ['$http', function($http) {
  return {
    restrict: 'E',
    transclude: true,
    scope: {
      options: '=',
    },
//    scope: false,
    templateUrl: componentsURL + 'bill-records.html',
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

      scope.shipItems = function() {
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
          url: ajax + 'bills.php?action=Shipping'
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
          scope.options.records[indexList[i]].status = 4;
        }
      }

      scope.shippedItems = function() {
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
          url: ajax + 'bills.php?action=Shipped'
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
          scope.options.records[indexList[i]].status = 5;
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

app.directive("product", ['$http', function($http) {
  return {
    restrict: 'E',
    transclude: true,
    scope: {
      options: '=',
    },
//    scope: false,
    templateUrl: componentsURL + 'product-records.html',
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
      
      scope.getActiveProduct = function() {
          $http({
            method: 'GET',
            url: ajax + 'products.php?action=getActiveProducts&page-index=1&number-items=500'
          }).then(function (res) {
            console.log('get success');
            //    console.log(JSON.stringify(res.data));

            var arr = [];

            $.map(res.data, function(item) {      
              var json = {
                info: productField(item),
                active: item.Active,
                hide: item.Hide,
                linkID: item.ProductID,
                selected: false
              }

              arr.push(json);
            });
            scope.options.records = arr;
          });
        }

      scope.getDeletedProduct = function() {
        $http({
          method: 'GET',
          url: ajax + 'products.php?action=getDeletedProducts&page-index=1&number-items=500'
        }).then(function (res) {
          console.log('get success');
          //    console.log(JSON.stringify(res.data));

          var arr = [];

          $.map(res.data, function(item) {      
            var json = {
              info: productField(item),
              active: item.Active,
              hide: item.Hide,
              linkID: item.ProductID,
              selected: false
            }

            arr.push(json);
          });
          scope.options.records = arr;
        });
      }

      scope.filterBy = function(categoryName) {
        console.log('filter by what');
        console.log(categoryName);
        var indexToFilter = 2;  // filter loai hoa
        var filterWhat = categoryName;
//        var list = scope.options.records;
        var list = scope.options.duplicateRecords;
        console.log('what list in product');
        console.log(JSON.stringify(list));

        var filterData = [];
        var selectItem;

        if (filterWhat == "all") {
          scope.options.records = list;
          return;
        }

        for(var i = 0; i < list.length; i++) {
          selectItem = list[i].info[indexToFilter]
          if (selectItem == filterWhat)
            filterData.push(list[i])
        }

        scope.options.records = filterData;
      }

      scope.activeItems = function() {
        var productRecords = scope.options.records;
        var indexList = scope.indexList;

        var activeItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          activeItems.push(productRecords[indexList[i]].info[0])
        }

        var listProduct = {
          listProductIDs: activeItems
        };

        $http({
          method: 'POST',          
          data: listProduct,
          url: ajax + 'products.php?action=Active'
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

        var sum = 0;
        for(var i = 0; i < indexList.length; i++) {
          scope.options.records.splice(indexList[i] - sum, 1);          
          sum = sum + 1;
//          scope.options.records[indexList[i]].hide = 0;
        }
      }

      scope.hideItems = function() {
        var productRecords = scope.options.records;
        var indexList = scope.indexList;

        var hideItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          hideItems.push(productRecords[indexList[i]].info[0])
        }

        var listProduct = {
          listProductIDs: hideItems
        };

        $http({
          method: 'POST',          
          data: listProduct,
          url: ajax + 'products.php?action=Hide'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
//          scope.indexList = []   // clear all 
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
//          scope.indexList = []   // clear all 
        })

        console.log(JSON.stringify(hideItems));

        for(var i = 0; i < indexList.length; i++) {
          scope.options.records[indexList[i]].hide = 1;
        }
      }
     
      scope.showItems = function() {
          var productRecords = scope.options.records;
          var indexList = scope.indexList;

          var hideItems = []
          for(var i = scope.indexList.length - 1; i >= 0; i--) {
            hideItems.push(productRecords[indexList[i]].info[0])
          }

          var listProduct = {
            listProductIDs: hideItems
          };

          $http({
            method: 'POST',          
            data: listProduct,
            url: ajax + 'products.php?action=Show'
          }).then(function (res) {
            console.log('get success');
            console.log(JSON.stringify(res.data));
//            scope.indexList = []   // clear all 
          }, function(err) {
            console.log("error");
            console.log(JSON.stringify(err));
//            scope.indexList = []   // clear all 
          })

          console.log(JSON.stringify(hideItems));

          for(var i = 0; i < indexList.length; i++) {
            scope.options.records[indexList[i]].hide = 0;
          }
        }

      scope.deleteItems = function() {
        var productRecords = scope.options.records;
        var indexList = scope.indexList;

        var removeItems = []
        for(var i = scope.indexList.length - 1; i >= 0; i--) {
          removeItems.push(productRecords[indexList[i]].info[0])
        }

        var listProduct = {
          listProductIDs: removeItems
        };

        $http({
          method: 'POST',          
          data: listProduct,
          url: ajax + 'products.php?action=Delete'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
          scope.indexList = []   // clear all 
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
          scope.indexList = []   // clear all 
        })

        console.log(JSON.stringify(removeItems));

        for(var i = indexList.length - 1; i >= 0; i--) {
          productRecords.splice(indexList[i], 1)
          console.log('remove ' + indexList[i]);
        }
      }
      
      scope.testBy = function() {

        $http({
          method: 'GET',          
          url: ajax + 'category.php?action=getAllCategory'
        }).then(function (res) {
          console.log('get success');
          console.log(JSON.stringify(res.data));
        }, function(err) {
          console.log("error");
          console.log(JSON.stringify(err));
        })
      }

    }
  };
}]);
