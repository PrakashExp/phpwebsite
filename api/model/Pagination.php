<?php
    class Pagination{
        private $totalItems;            //Tổng mục cần phân trang.
        private $numberItemsPerPage;    //Số mục trên một phân trang.
        private $currentPage;           //Phân trang hiện tại.
        private $pageRange;             //Số phân trang hiển thị ở thanh điều hướng.
        private $lastPage;              //Tổng số phân trang (= phân trang cuối cùng).
        
        public function __construct($totalItems, $numberItemsPerPage = 10, $currentPage = 1, $pageRange = 5){
            $this->totalItems          = $totalItems;
            $this->numberItemsPerPage  = $numberItemsPerPage;
            $this->currentPage         = $currentPage;
            $this->pageRange           = $pageRange;
            $this->lastPage            = ceil($totalItems / $numberItemsPerPage);
        }
        
        public function show($category=null){
            $categoryGET    = (!checkEmpty($category)) ? ("category=" . $category) : '';
            $htmlPagination = '';
            
            if ($this->lastPage > 1){
                $this->currentPage    = (isset($this->currentPage) && ($this->currentPage <= $this->lastPage) && ($this->currentPage >= 1)) ? intval($this->currentPage) : 1;
            
                //Các giá trị Trang đầu, Trước, Sau, Trang cuối ở thanh điều hướng phân trang.
                $start      = '<li><a>Trang đầu</a></li>';
                $previous   = '<li><a>Trước</a></li>';
                $next       = '<li><a>Sau</a></li>';
                $end        = '<li><a>Trang cuối</a></li>';
            
                if($this->currentPage > 1){
                    $start      = '<li><a href="?' . $categoryGET . '&page=1">Trang đầu</a></li>';
                    $previous   = '<li><a href="?' . $categoryGET . '&page=' .  ($this->currentPage - 1) . '">Trước</a></li>';
                }
            
                if(($this->currentPage < $this->lastPage)){
                    $next       = '<li><a href="?' . $categoryGET . '&page=' . ($this->currentPage + 1) . '">Sau</a></li>';
                    $end       = '<li><a href="?' . $categoryGET . '&page=' . $this->lastPage . '">Trang cuối</a></li>';
                }
            
                //Số trang hiển thị ở thanh điều hướng phân trang (số lẻ).
                if($this->pageRange % 2 == 0){
                    ++$this->pageRange;
                }
            
                //Điều chỉnh tính hợp lệ cho giá trị các trang ở thanh điều hướng phân trang.
                if ($this->pageRange > $this->lastPage){
                    $startPageRange = 1;
                    $endPageRange   = $this->lastPage;
                } else {
                    $startPageRange = $this->currentPage - ($this->pageRange - 1)/2;
                    $endPageRange   = $this->currentPage + ($this->pageRange - 1)/2;
            
                    if ($startPageRange < 1){
                        $startPageRange = 1;
                        $endPageRange   = $this->pageRange;
                    }
            
                    if ($endPageRange > $this->lastPage){
                        $endPageRange   = $this->lastPage;
                        $startPageRange = $endPageRange - $this->pageRange + 1;
                    }
                }
            
                $listPages      = '';
                for ($i = $startPageRange; $i <= $endPageRange; $i++){
                    if ($i == $this->currentPage){
                        $listPages  .= '<li class="active"><a>' . $i . '</a></li>';
                    } else {
                        $listPages  .= '<li><a href="?' . $categoryGET . '&page=' . $i .  '">' . $i . '</a></li>';
                    }
                }
                
                //Mã nguồn HTML hiển thị thanh điều hướng phân trang.
                echo $htmlPagination = '<ul class="pagination">' . $start . $previous . $listPages . $next . $end . '</ul>';
            }
        }  
    }
?>