<?php

class paging_ajax
{
    public $data; // DATA
    public $per_page = 9; // SỐ RECORD TRÊN 1 TRANG
    public $page; // SỐ PAGE 
	public $id_list; // SỐ id_list 
    public $text_sql; // CÂU TRUY VẤN
    
    //	THÔNG SỐ SHOW HAY HIDE 
    public $show_pagination = true;
    public $show_goto = false;
    public $show_total = true;
    
    // TÊN CÁC CLASS
    public $class_pagination; 
    public $class_active;
    public $class_inactive;
    public $class_go_button;
    public $class_text_total;
    public $class_txt_goto;    
    
    private $cur_page;	// PAGE HIỆN TẠI
	private $cur_table;	// TABLE HIỆN TẠI
    private $num_row; // SỐ RECORD
	
    
    // PHƯƠNG THỨC LẤY KẾT QUẢ CỦA TRANG 
    public function GetResult()
   {
		global $d; // BIỀN $db TOÀN CỤC

		// TÌNH TOÁN THÔNG SỐ LẤY KẾT QUẢ
		$this->cur_page = $this->page;
		$this->page -= 1;
		$this->per_page = $this->per_page;
		$start = $this->page * $this->per_page;

		// TÍNH TỔNG RECORD TRONG BẢNG
		$d->query($this->text_sql);
		$result = $d->result_array();
		$this->num_row = count($result);

		// LẤY KẾT QUẢ TRANG HIỆN TẠI

		$d->query($this->text_sql." LIMIT $start, $this->per_page");
		$result1=$d->result_array();
		return $result1;
   }
    
    // PHƯƠNG THỨC XỬ LÝ KẾT QUẢ VÀ HIỂN THỊ PHÂN TRANG
    public function Load()
    {
        // KHÔNG PHÂN TRANG THÌ TRẢ KẾT QUẢ VỀ
        if(!$this->show_pagination)
            return $this->data;
        
        // SHOW CÁC NÚT NEXT, PREVIOUS, FIRST & LAST
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;    
        
        // GÁN DATA CHO CHUỖI KẾT QUẢ TRẢ VỀ 
        $msg = $this->data;
        
        // TÍNH SỐ TRANG
        $count = $this->num_row;
        $no_of_paginations = ceil($count / $this->per_page);
			
		if($no_of_paginations>1){	
			
			// TÍNH TOÁN GIÁ TRỊ BẮT ĐẦU & KẾT THÚC VÒNG LẶP
			if ($this->cur_page >= 7) {
				$start_loop = $this->cur_page - 3;
				if ($no_of_paginations > $this->cur_page + 3)
					$end_loop = $this->cur_page + 3;
				else if ($this->cur_page <= $no_of_paginations && $this->cur_page > $no_of_paginations - 6) {
					$start_loop = $no_of_paginations - 6;
					$end_loop = $no_of_paginations;
				} else {
					$end_loop = $no_of_paginations;
				}
			} else {
				$start_loop = 1;
				if ($no_of_paginations > 7)
					$end_loop = 7;
				else
					$end_loop = $no_of_paginations;
			}
			
			// NỐI THÊM VÀO CHUỖI KẾT QUẢ & HIỂN THỊ NÚT FIRST 
			$msg .= "<div class='$this->class_pagination'>";
			$id_list=$this->id_list;
			if ($first_btn && $this->cur_page > 1) {
				
				$msg .= "<a p='1' data-id='$id_list' class='first paginate_button'>Trang đầu</a>";
			} else if ($first_btn) {
				$msg .= "<a p='1' data-id='$id_list' class='first paginate_button paginate_button_disabled'>Trang đầu</a>";
			}
		
			// HIỂN THỊ NÚT PREVIOUS
			if ($previous_btn && $this->cur_page > 1) {
				$pre = $this->cur_page - 1;
				$msg .= "<a p='$pre' data-id='$id_list' class='previous paginate_button'>Trang trước</a>";
			} else if ($previous_btn) {
				$msg .= "<a p='$pre' data-id='$id_list' class='first paginate_button paginate_button_disabled'>Trang trước</a>";
			}
			
			
			//HIỂN THỊ CÁC TRANG
			for ($i = $start_loop; $i <= $end_loop; $i++) {
			
				if ($this->cur_page == $i)
					$msg .= "<a p='$i' data-id='$id_list' class='paginate_active'>{$i}</a>";
				else
					$msg .= "<a p='$i' data-id='$id_list' class='paginate_button'>{$i}</a>";
			}
			
			
			
			// HIỂN THỊ NÚT NEXT
			if ($next_btn && $this->cur_page < $no_of_paginations) {
				$nex = $this->cur_page + 1;
				$msg .= "<a p='$nex' data-id='$id_list' class='next paginate_button'>Trang sau</a>";
			} else if ($next_btn) {
				$msg .= "<a p='$nex' data-id='$id_list' class='next paginate_button paginate_button_disabled'>Trang sau</a>";
			}
			
			// HIỂN THỊ NÚT LAST
			if ($last_btn && $this->cur_page < $no_of_paginations) {
				$msg .= "<a p='$no_of_paginations' data-id='$id_list' class='$this->class_active'>Trang cuối</a>";
			} else if ($last_btn) {
				$msg .= "<a p='$no_of_paginations' data-id='$id_list' class='$this->class_active'>Trang cuối</a>";
			}
			
			// SHOW TEXTBOX ĐỂ NHẬP PAGE KO ? 
			if($this->show_goto)
				$goto = "<input type='text' id='goto' class='$this->class_txt_goto' size='1' style='margin-top:-1px;margin-left:40px;margin-right:10px'/><input type='button' id='go_btn' class='$this->class_go_button' value='Đến'/>";
			if($this->show_total)
				$total_string = "<span id='total' class='$this->class_text_total' a='$no_of_paginations'>Trang <b>" . $this->cur_page . "</b>/<b>$no_of_paginations</b></span>";
			$stradd =  $goto . $total_string;
			
			// TRẢ KẾT QUẢ TRỞ VỀ
			return $msg .  "</div>";  // Content for pagination
		}else{
			return $msg;  // null thì không hiển thị phân trang
		}
    }     
            
}

?>