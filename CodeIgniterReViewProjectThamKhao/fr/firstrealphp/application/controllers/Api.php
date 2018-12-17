<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->SelectProduct = "p.id , p.groups , p.name , p.views ,CONCAT('".base_url()."data/product/',p.images) AS images , p.price_buy , p.price_sale , p.percent , p.link , p.type , p.number";
	}
	// type = 0 => Slides | type = 1 => Banner;
	public function slides(){
		$link  = base_url().'data/slides/';
		$sql ="SELECT id , name , link , CONCAT('".$link."',images) AS images , type FROM smy_slides WHERE status='1' ";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	//search product home pages
	
	public function searchproduct(){
		$data = json_decode($this->input->raw_input_stream , TRUE);
		
		$keywords = $data['keywords'];
		$link  = base_url().'data/product/';
		$sql ="SELECT id , groups , name , views , CONCAT('".$link."',images) AS images , price_sale AS price_s , CONCAT(FORMAT(price_sale,0),' ₫') AS price_sale , number_buy , CONCAT(FORMAT(price_buy,0),' ₫') AS price_buy , link , type , CONCAT(percent,' %') AS percent 
		FROM smy_product WHERE status='1' AND ( name LIKE '%".$keywords."%' OR link LIKE '%".$keywords."%' OR price_sale LIKE '%".$keywords."%' ) ORDER BY orders DESC LIMIT 20";
		$query = $this->db->query($sql);
		$data = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$data);
		echo json_encode($res);
	}
	
	// process api language
	
	public function language($lsitkey){
		$lsitkey = explode("-", $lsitkey);
		$lang_array = array();
		foreach ($lsitkey as $val) {
			switch ($val) {
            case '1':
                $lang = $this->lang->load('front_homepages', $this->languages,true);
				$lang_array = array_unique(array_merge($lang_array,$lang));
                break;
            case '2':
				$lang = $this->lang->load('front_product', $this->languages,true);
				$lang_array = array_unique(array_merge($lang_array,$lang));
                break;
			case '3':
				$lang = $this->lang->load('front_content', $this->languages,true);
				$lang_array = array_unique(array_merge($lang_array,$lang));
                break;
			case '4':
				$lang = $this->lang->load('front_contact', $this->languages,true);
				$lang_array = array_unique(array_merge($lang_array,$lang));
                break;
            default:
				$lang = $this->lang->load('front_general', $this->languages,true);
				$lang_array = array_unique(array_merge($lang_array,$lang));
                break;
			}
		}
		$fieldslang = array();
		foreach ($lang_array as $k=>$v) { $fieldslang[$k] = $v; }
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$fieldslang);
		echo json_encode($res,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}
	public function imagesdefault(){
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$this->config->item('imageslist'));
		echo json_encode($res);
	}
	//
	public function pagesall(){
		$sql1="SELECT id , orders , container , name FROM smy_pagesgroup WHERE status='1'";
		$query1 = $this->db->query($sql1);
		$group = $query1->result_object();
		//
		$sql2 = "SELECT id , orders , link , images , type , description , keywords , parent , name FROM smy_pages WHERE status='1'";
		$query2 = $this->db->query($sql2);
		$list = $query2->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>array('group'=>$group,'pages'=>$list));
		echo json_encode($res);
	}
	//
	public function product_group(){
		$link  = base_url().'data/product/icon/';
		$sql="SELECT id , orders , link , name , parent , CONCAT('".$link."',icon) AS icon , slides FROM smy_productgroups WHERE status='1' ";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	// process api product
	public function product(){
		$link  = base_url().'data/product/';
		$sql ="SELECT ".$this->SelectProduct." FROM smy_product AS p WHERE p.status='1'";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		
		$sqlgr="SELECT id,name,parent FROM smy_productgroups WHERE status='1'";
		$querygr = $this->db->query($sqlgr);
		$listgr = $querygr->result_object();//lấy tất cả product group
		$arr=array();
		foreach($listgr as $key =>$value){
				array_push($arr, $value->id);
		}//tạo một mảng các chứa Id product group
		$idgroup=implode(",",$arr); //chuyển thành chuỗi
		
		$sqlgrc="SELECT id,name,parent FROM smy_productgroups WHERE parent IN(".$idgroup.")";
		$querygrc = $this->db->query($sqlgrc);
		$listgrc= $querygrc->result_object();// lay tat ca productgroup con - cấp 2
			
		$arrgrc=array(); // tao 1 mảng
		foreach($listgrc as $keygrc =>$valuegrc){
				array_push($arrgrc, $valuegrc->id); // gán các ID productgroup con vào trong mảng
		}
		
		$idgroupcon=implode(",",$arrgrc); //chuyển thành chuỗi
		$sqllpr="SELECT id,name,groups FROM smy_product WHERE groups IN(".$idgroupcon.") "; // lấy các sản phẩm có group thuộc productgroup con
		$querylpr = $this->db->query($sqllpr);
		$listlpr= $querylpr->result_object();	

		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	
	// process api 
	
	public function producthome($id){
		$listid = str_replace('-',',',$id);		
		$sql1 ="SELECT ".$this->SelectProduct." FROM smy_product AS p WHERE p.status='1' AND p.groups IN (".$listid.") ORDER BY p.orders DESC LIMIT 12";
		$sql2 ="SELECT ".$this->SelectProduct." FROM smy_product AS p WHERE p.status='1' AND p.groups IN (".$listid.") ORDER BY p.number_buy DESC LIMIT 12";
		$sql3 ="SELECT ".$this->SelectProduct." FROM smy_product AS p WHERE p.status='1' AND p.type LIKE '%0%' AND p.groups IN (".$listid.") ORDER BY p.id DESC LIMIT 4";
		$sql = array('moidang' => $sql1,'banchay'=>$sql2,'goiy'=>$sql3);
		$data = array();
		foreach($sql as $key=>$value){
			$query = $this->db->query($value);
			$list = $query->result_object();
			$data[$key] = $list;
		}
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$data);
		echo json_encode($res);
	}
	public function productgoiy(){
		$link  = base_url().'data/product/';
		$sql ="SELECT ".$this->SelectProduct." FROM smy_product AS p WHERE p.status='1' AND p.type LIKE '%1%' ORDER BY p.id DESC LIMIT 12";

		$query = $this->db->query($sql);
		$list = $query->result_object();
		
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function getdetail($link){

		$sql="SELECT p.* , CONCAT('".base_url()."data/product/',p.images) AS images, tr.name AS tradename FROM smy_product AS p LEFT OUTER JOIN smy_trade AS tr ON p.trade = tr.id WHERE p.link='".$link."' AND p.status=1";
		$query = $this->db->query($sql);
		$list = $query->row_object();
		$views = intval($list->views)+1;
		$list->views = $views;
		$sql ="UPDATE smy_product set views='".$views."' WHERE id='".$list->id."'";
		$this->db->query($sql);
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	
	}
	public function getinvolve($link){
		$sql="SELECT ".$this->SelectProduct." FROM smy_product AS p WHERE p.groups IN (SELECT id FROM smy_productgroups WHERE link='".$link."') ORDER BY p.orders DESC LIMIT 18";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function getsuggest($link){
		$sql="SELECT ".$this->SelectProduct." FROM smy_product AS p WHERE p.groups IN (SELECT id FROM smy_productgroups WHERE parent IN (SELECT id FROM smy_productgroups WHERE link='".$link."')) ORDER BY p.orders DESC LIMIT 10";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function productcatalog($link){
		$sql ="SELECT ".$this->SelectProduct.", p.trade AS idtrade, tr.name AS trade		
		FROM smy_product AS p LEFT OUTER JOIN smy_trade AS tr ON p.trade = tr.id
		WHERE p.status='1' AND groups IN (SELECT id FROM smy_productgroups WHERE parent IN (SELECT id FROM smy_productgroups WHERE link='".$link."')) ORDER BY orders DESC";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
		
	}
	public function productcatalogry($link){
		$sql ="SELECT ".$this->SelectProduct.", p.trade AS idtrade, tr.name AS trade		
		FROM smy_product AS p LEFT OUTER JOIN smy_trade AS tr ON p.trade = tr.id
		WHERE p.status='1' AND p.groups IN (SELECT id FROM smy_productgroups WHERE link='".$link."') ORDER BY orders DESC";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function productnews(){
		$sql ="SELECT ".$this->SelectProduct.", p.trade AS idtrade,
		tr.name AS trade		
		FROM smy_product AS p 
		LEFT OUTER JOIN smy_trade AS tr ON p.trade = tr.id
		WHERE p.status='1' ORDER BY orders DESC";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function productbest(){
		$sql ="SELECT ".$this->SelectProduct.", p.trade AS idtrade,
		tr.name AS trade		
		FROM smy_product AS p 
		LEFT OUTER JOIN smy_trade AS tr ON p.trade = tr.id
		WHERE p.status='1' ORDER BY number_buy DESC";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function productsale(){
		$sql ="SELECT ".$this->SelectProduct.", p.trade AS idtrade,
		tr.name AS trade		
		FROM smy_product AS p 
		LEFT OUTER JOIN smy_trade AS tr ON p.trade = tr.id
		WHERE p.status='1' AND p.percent > 0 AND p.price_buy > p.price_sale ORDER BY p.percent DESC";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function trade($link){
		$listid = str_replace('-',',',$link);	
		$sql ="SELECT t.id , t.name , COUNT(t.id) AS count FROM smy_trade AS t LEFT OUTER JOIN smy_product AS p ON t.id = p.trade WHERE p.id IN (".$listid.") AND t.status=1 GROUP BY t.name";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
		
	}
	public function attribute ($linkid){
		$linkid = str_replace('-',',',$linkid);
		$sql ="SELECT al.* , at.name AS attributename FROM smy_attlist AS al LEFT OUTER JOIN smy_attribute  AS  at ON al.attribute=at.id WHERE al.product IN(".$linkid.")";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function attlist(){
		$sql="SELECT atl.id,atl.value,
		pr.name AS productname,
		pr.id AS product,
		ab.name AS attributename,
		ab.id AS attribute
		FROM smy_attlist AS atl
		LEFT OUTER JOIN smy_product AS pr ON atl.product = pr.id
		LEFT OUTER JOIN smy_attribute AS ab ON atl.attribute = ab.id";
		$query = $this->db->query($sql);
		$list = $query->result_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function pages($href){
		$sql="SELECT * FROM smy_pages WHERE link='".$href."'";
		$query = $this->db->query($sql);
		$list = $query->row_object();
		$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$list);
		echo json_encode($res);
	}
	public function supportlist($href){
		$sql = "SELECT department FROM smy_productgroups WHERE link = '".$href."'";
		$query = $this->db->query($sql);
		$list = $query->row_object();
		$a = ($list->department=='') ? [] : json_decode($list->department);
		$idgroupcon=implode(",",$a);
		if($idgroupcon==null){
			$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>[]);
		}else{
			$sql2 = "
			SELECT per.fullname,per.phone, de.name AS departmentname, per.department  FROM smy_personnel AS per
			LEFT OUTER JOIN smy_department AS de ON de.id = per.department	WHERE per.department IN (".$idgroupcon.")";
			$query2 = $this->db->query($sql2);
			$list2 = $query2->result_object();
			$data=$list2;
			$res = array('status'=>1,'message'=>'Lấy dữ liệu thành công.','data'=>$data);
		}
		echo json_encode($res);
	}
}
