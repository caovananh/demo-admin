<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    public $data = [];
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library("pagination");
    }
	public function index()
	{      
        $query = $this->db->select()->from('product'); 
        //filter                                                   
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        if($id){
            $query->where('id', $id);
        }
        if($name){
            $query->like('name', $name, false);
        }
        //pagination
        $clause = clone($query);

        $total_rows =  $query->count_all_results();     
        $offset = isset($_GET['per_page']) ? $_GET['per_page'] : 0;
        $itemPerPage = 10;
        //get data
        $data = $clause->limit($itemPerPage, $offset)->get()->result();

        //-----------config pagination----------------//
        $config = array();
        $config["base_url"] = base_url() . "index.php/product/index?id=$id&name=$name";
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $itemPerPage;
        $config['page_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';

        $config['attributes'] = array('class' => 'page-link');
        $id = isset($id)?$id:'' ;
        $name = isset($name)? $name:'';
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);

        $this->data['list'] = $data;
        $this->data['content'] = 'product/index';
        $this->load->view('layout',$this->data);
    }
    public function changeStatus(){
        $id =isset($_GET['id']) ? $_GET['id'] : '';
        $status =isset($_GET['status']) ? $_GET['status'] : '';
        echo $status;
        if($id>0 && $status != ''){
            $status = ($status == 1 ) ? 0 : 1 ;
            $this->db->where('id', $id);
            $data = array(
                'status' => $status
        );
            $this->db->update('product', $data);
            header('location:'.base_url());
           // print_r($this->db->last_query());die();
        }
    }
    public function add(){      
        if(isset($_POST['submit'])){
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]',
                                                array(
                                                        'required' => '%s không được rỗng.',
                                                        'min_length' => '%s tối thiểu %s kí tự.',
                                                    ) 
                                            );
            $this->form_validation->set_rules('price', 'Price', 'required|numeric',
                                                array(
                                                        'required' => '%s không được rỗng.',
                                                        'numeric' => '%s phải là số.',
                                                    ) 
                                            );
            if ($this->form_validation->run()){
                $data =[
                    'status'=>$_POST['status'],
                    'name' =>$_POST['name'],
                    'price'=>$_POST['price'],
                    'detail'=>$_POST['detail'],
                    'description'=>$_POST['description'],
                    'created' =>time(),
                ];
               $this->db->insert('product',$data);
               redirect(base_url(), 'location');
              
            }        
        }

        $this->data['content'] = 'product/add';     
        $this->load->view('layout',$this->data);
        
    }
    public function edit(){
        $id =isset($_GET['id']) ? $_GET['id'] : 3;
        if(isset($_POST['submit'])){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]',
                                                array(
                                                        'required' => '%s không được rỗng.',
                                                        'min_length' => '%s tối thiểu %s kí tự.',
                                                    ) 
                                            );
            $this->form_validation->set_rules('price', 'Price', 'required|numeric',
                                                array(
                                                        'required' => '%s không được rỗng.',
                                                        'numeric' => '%s phải là số.',
                                                    ) 
                                            );
            if ($this->form_validation->run()){
                $data =[
                    'status'=>$_POST['status'],
                    'name' =>$_POST['name'],
                    'price'=>$_POST['price'],
                    'detail'=>$_POST['detail'],
                    'description'=>$_POST['description'],
                    'created' =>time(),
                ];
                $this->db->where('id', $id);
                $this->db->update('product', $data);
               header('location:'.base_url());
            }        
        }
        
        $query = $this->db->get_where('product', array('id' => $id))->result();
        $this->data['update'] = $query;
        $this->data['content'] = 'product/edit';     
        $this->load->view('layout',$this->data);
    }
    public function delete(){
        $id =isset($_GET['id']) ? $_GET['id'] : '';
        $this->db->where('id', $id);
        $this->db->delete('product');
      //  print_r($this->db->last_query());die();
        header('location:'.base_url());
        
    }
}
