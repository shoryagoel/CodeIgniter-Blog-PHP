<?php

class Login extends MY_Controller {

    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect(base_url("admin/dashboard"));
        }
        if (!empty($this->session->userdata('error'))) {
//            print_r($this->session->userdata('error'));
//            die;
            $error = $this->session->userdata('error');
//            print_r($error); die;
            $this->session->unset_userdata('error');
        }else{
            $error='';
        }
        $data['error']=$error;
        $this->load->view('public/admin_login', $data);
    }

    public function admin_login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'User Name', 'required|max_length[30]|trim|alpha');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");
        if ($this->form_validation->run() === FALSE) {
            $error = $this->form_validation->error_array();
            $this->session->set_userdata('error', $error);
            redirect(base_url('login'));
        } else {
             $username = $this->input->post('username');
            $password = $this->input->post('password');
            // echo "Username: $username <br> Password: $password";
            $this->load->model('loginmodel');
            $login_id = $this->loginmodel->login_valid($username, $password);
            if ($login_id) {
                //verified user...
                $this->session->set_userdata('user_id', $login_id);
                return redirect('admin/dashboard');
            } else {
                //authentication failed...
                $this->session->set_flashdata('login_failed', 'Invalid Username/Password.');
                return redirect('login');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        return redirect('login');
    }
    public function sign_up(){
        if(!empty($this->session->userdata('error'))){
            $error = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }
        else{
            $error="";
        }
        $this->load->view('public/sign_up',['error'=>$error]);
    }
        public function do_sign_up(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'User Name', 'required|max_length[30]|trim|alpha|is_unique[users.uname]');
        $this->form_validation->set_rules('fname', 'First Name', 'required|max_length[30]|trim|alpha');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|max_length[30]|trim|alpha');
        $this->form_validation->set_rules('pword', 'Password', 'required');
        if($this->form_validation->run() === FALSE){
        $error = $this->form_validation->error_array();
            $this->session->set_userdata('error', $error);
            redirect(base_url('login/sign_up'));
        }
        else{
        $this->load->model('articlesmodel');
        $q = $this->articlesmodel->sign_up();
        
            if($q){
                redirect('login/index');
            }
            else{
                redirect('login/sign_up');
            }
        }
        
        
    }

}

?>