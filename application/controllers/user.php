<?php 
    class User extends MY_Controller{
            public function index(){
                 $this->load->model('articlesmodel');
                $this->load->library('pagination');
        $config = [
            'base_url' => base_url('user/index'),
            'per_page' => 5,
            'total_rows' => $this->articlesmodel->count_all_articles(),
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
        $articles = $this->articlesmodel->all_articles_list($config['per_page'],$this->uri->segment(3));
        $this->load->view('public/article_list',['articles'=>$articles]);
            }
            
            public function search() {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('query','Search','required');
                if(!$this->form_validation->run()){
                   redirect(user/index);
                }
                else{
                $query = $this->input->post('query');
                redirect('user/search_result/'.$query);
//                $this->load->model('articlesmodel');
//                $articles = $this->articlesmodel->search($query);
//                $this->load->view('public/search_results',['articles'=>$articles]);
                }
            }
                               
        public function search_result($query) {
                    $this->load->model('articlesmodel');
                $this->load->library('pagination');
            $config = [
            'base_url' => base_url('user/search_result/$query'),
            'per_page' => 5,
            'total_rows' =>  $this->articlesmodel->count_search_results($query),
            'full_tag_open' => "<ul class='pagination'>",
            'full_tag_close' => '</ul>',
            'first_tag_open' => '<li>',
            'uri_segment'=> 4,
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
           $articles = $this->articlesmodel->search($query,$config['per_page'], $this->uri->segment(4));
           $this->load->view('public/search_results',['articles'=>$articles]);
        }
        
        public function article($id) {
            $this->load->model('articlesmodel');
            $article = $this->articlesmodel->find($id);
            $this->load->view('public/article_detail',['article'=>$article]);
            
        }
    }
?>