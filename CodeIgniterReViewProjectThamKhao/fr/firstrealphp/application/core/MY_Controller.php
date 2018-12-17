<?php
defined('BASEPATH') OR exit('No direct script access aloowed');
Class MY_Controller extends CI_Controller
{    
	function __construct()
	{
		parent::__construct();
		$this->languages = $this->config->item('language');
		$this->controller = strtolower($this->uri->segment(1));
		$this->load->database();
        $this->menu =  $this->menu();
       
        $this->metaAll= $this->metaALL();
        $this->urllinkImg = "upload/thumb/";
	}
	public function getdata()
	{
		$data = json_decode($this->input->raw_input_stream , TRUE);
		$res = array('status' => 0,'message' => '' ,'data' => $data);
		$res['status'] = ($data!=null && count($data) > 0) ? 1 : 0;
		return $res;
	}
	public function menu()
	{
		$this->load->model('Home_model');
		$menuparent = $this->Home_model->getMenuParent();
		return $menuparent;
	
    }
    public function metaALL()
	{
		$this->load->model('Home_model');
		$meta = $this->Home_model->getMetaHome();
		return $meta;
	
    }
	public function dataPagition($data,$sort,$field,$page, $perpage , $total)
    {
        //$total = count($data);
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
        ? $datatable['query']['generalSearch'] : '';
        if (!empty($filter)) {
            $data = array_filter($data, function ($a) use ($filter) {
                return (boolean) preg_grep("/$filter/i", (array) $a);
            });
            unset($datatable['query']['generalSearch']);
        }
    
        $meta = [];
        $pages = 1;
        //sort
        usort($data, function ($a, $b) use ($sort, $field) {
            if (!isset($a[$field]) || !isset($b[$field])) {
                return false;
            }
            if ($sort === 'asc') {
                return $a[$field] > $b[$field] ? true : false;
            }
            return $a[$field] < $b[$field] ? true : false;
        });
        // $perpage 0; get all data
        if ($perpage > 0) {
            $pages = ceil(count($data) / $perpage); // calculate total pages
            $pages1 = ceil($total / $perpage); // calculate total pages
            $page = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
            $page = min($page, $pages1); // get last page when $_REQUEST['page'] > $totalPages
            $offset = ($page - 1) * $perpage;
            if ($offset < 0) {
                $offset = 0;
            }
            $data = array_slice($data, $offset, $perpage, true);
        }
        $meta = [
            'page' => $page,
            'pages' => $pages,
            'perpage' => $perpage,
            'total' => $total,
        ];
        // if selected all records enabled, provide all the ids
        if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
            $meta['rowIds'] = array_map(function ($row) {
                return $row->RecordID;
            }, $alldata);
        }
    
       
        $result = [
            'meta' => $meta + [
                'sort' => $sort,
                'field' => $field,
            ],
            'datas' => $data,
        ];
        return $result;
        
    }
}