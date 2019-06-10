<?php

class Admin extends MY_Controller {

    public function dashboard() {
        $this->load->library('pagination');
        $config = [
            'base_url' => base_url('admin/dashboard'),
            'per_page' => 5,
            'total_rows' => $this->articlesmodel->num_rows(),
            'full_tag_open' => "<ul class='pagination'>",
            'full_tag_close' => '</ul>',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => "<li class='active'><a>",
            'cur_tag_close' => '</a></li>'
        ];
        $this->pagination->initialize($config);
        if(empty($this->session->userdata('success'))){
           $success="";
        }
        else{
           $success = $this->session->userdata('success'); 
           $this->session->unset_userdata('success'); 
           
        }
        $this->load->model('articlesmodel', 'article');
        $articles = $this->article->article_list($config['per_page'],$this->uri->segment(3));
        $this->load->view('admin/dashboard', ['articles' => $articles,'success'=>$success]);
        
    }

    public function add_article() {
        if (!empty($this->session->userdata('error'))) {
            $error = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        } else {
            $error = '';
        }
        if(!empty($this->session->userdata('upload_error'))){
        
            $upload_error = $this->session->userdata('upload_error');
            $this->session->unset_userdata('upload_error');
        }
        else{$upload_error="";}
        
        $data['error'] = $error;
        $data['upload_error'] = $upload_error;
        $this->load->view('admin/add_article', $data);
    }
    
//    public function test(){
//       
//        $config['upload_path'] = './uploads/session/';
//        $config['allowed_types'] = 'gif|jpg|png';
//        $config['file_name'] = $fnn;
//        $this->upload->initialize($config);
//
//        if ($this->upload->do_upload('abc'))
//        {
//           $result = $this->Admin_model->insert_session($session,$fnn);
//           
//        }else{
//            echo "Failed To Upload"; 
//       }
//    }

    public function do_add_article() {
         
        $config = [
            'upload_path' => './uploads',
            'allowed_types' => 'jpg|png|gif|jpeg'  
        ];
        $this->load->library('upload',$config);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');
        if ($this->form_validation->run() == FALSE && !$this->upload->do_upload()) {
            $error = $this->form_validation->error_array();
//            print_r($error);die;
            $upload_error = $this->upload->display_errors(); 
            $this->session->set_userdata('error', $error);
            $this->session->set_userdata('upload_error',$upload_error);
            redirect(base_url('admin/add_article'));
        } else {
        $file = $_FILES['userfile']['name'];
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $fnn = $file;
        $this->upload->do_upload('userfile');
            //$image_path = base_url("uploads/".$dat['raw_name'].$dat['file_ext']);
//            print_r($image_path);die;
          
            $result = $this->articlesmodel->do_add_article($fnn);
            if ($result) {
                $success = 'Article Added Successfully...';
                $this->session->set_userdata('success',$success);
                redirect(base_url('admin/dashboard'));
            } else {
                $success =  'Failed To Add Article, Please Try Again.';
                $this->session->set_userdata('success',$success);
                redirect(base_url('admin/dashboard'));
            }
        }
    }

    
    public function edit_article($article_id) {
        
        $result = $this->articlesmodel->find_article($article_id);
        $this->load->view('admin/edit_article',['result'=>$result]);
    }
    
    public function do_edit_article($article_id){
        $file = $_FILES['userfile']['name'];
        $this->load->library('upload',$config);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');
//        print_r($file);die;
        
        
        
        if ($this->form_validation->run() == FALSE) {
            $error = $this->form_validation->error_array();
            $this->session->set_userdata('error', $error);
            $upload_error = $this->upload->display_errors(); 
            $this->session->set_userdata('error', $error);
            $this->session->set_userdata('upload_error',$upload_error);
            redirect(base_url('admin/edit_article'));
        } else {
        if(!empty($file)){
                $config = [
                'upload_path' => './uploads',
                'allowed_types' => 'jpg|png|gif|jpeg'  
                ];
                $file = $_FILES['userfile']['name'];
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $fnn = $file;
                $this->upload->do_upload('userfile');
                $result = $this->articlesmodel->update_article($article_id,$fnn);
            }
        else{
            $fnn="";
            $result = $this->articlesmodel->update_article($article_id,$fnn);
        }
         
        $file = $_FILES['userfile']['name'];
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $fnn = $file;
        $this->upload->do_upload('userfile');
            $result = $this->articlesmodel->update_article($article_id);
           
            if (count($result)) {
                $success = 'Article Edited Successfully...';
                $this->session->set_userdata('success',$success);
                redirect(base_url('admin/dashboard'));
            } else {
                $success =  'Failed To Edit Article, Please Try Again.';
                $this->session->set_userdata('success',$success);
                redirect(base_url('admin/dashboard'));
            }
        }
    }

    public function delete_article() {
        
        $result = $this->articlesmodel->delete_article();
           
            if (count($result)) {
                $success = 'Article Deleted Successfully...';
                $this->session->set_userdata('success',$success);
                redirect(base_url('admin/dashboard'));
            } else {
                $success = 'Failed To Delete Article, Please Try Again.';
                $this->session->set_userdata('success',$success);
                redirect(base_url('admin/dashboard'));
            }
    }

    public function __construct() {
        parent::__construct();
        $this->load->model('articlesmodel');
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

}

?>