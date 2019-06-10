<?php

class Articlesmodel extends CI_Model {

    public function article_list($limit,$offset) {
        $user_id = $this->session->userdata('user_id');
        $query = $this->db->select('title')
                ->select('id')
                ->limit($limit,$offset)
                ->where('user_id', $user_id)
                ->get('articles');
        return $query->result();
    }
    
    public function all_articles_list($limit,$offset) {
        $query = $this->db->select('title')
                ->select('id')
                ->select('created_at')
                ->limit($limit,$offset)
                ->order_by('created_at','Desc')
                ->get('articles');
        return $query->result();
    }
    
    public function num_rows(){
        $user_id = $this->session->userdata('user_id');
        $query = $this->db->select('title')
                ->select('id')
                ->where('user_id', $user_id)
                ->get('articles');
        return $query->num_rows();
    }
    
    public function count_all_articles() {
      $query = $this->db->select('title')
                ->select('id')
                ->get('articles');
        return $query->num_rows();   
    }

    public function do_add_article($image_path) {
        $data = array(
            'title'=> $this->input->post('title'),
            'body'=>  $this->input->post('body'),
            'user_id'=>$this->input->post('user_id'),
            'created_at' => $this->input->post('created_at'),
            'image_path' => $image_path
        );
        $this->db->insert('articles', $data);
        return $this->db->insert_id();
    }
    public function find_article($article_id){
        $q = $this->db->select(['id','title','body','image_path'])
                      ->where('id',$article_id)
                      ->get('articles');
        return $q->row();
    }
    public function update_article($article_id,$fnn){
        if(!empty($fnn)){
        $data = array(
            'title' => $this->input->post('title'),
            'body'=>  $this->input->post('body'),
            'image_path' => $fnn
        );
        }else{
        $data = array(
            'title' => $this->input->post('title'),
            'body'=>  $this->input->post('body')
        ); 
        }
        
        $q = $this->db->where('id',$article_id)
                  ->update('articles',$data);
          return $q;
    }
    
    public function delete_article(){
        $article_id = $this->input->post('article_id');
        $del = $this->db->query("select image_path from articles where id=$article_id");
        $path = $del->row();
        
        
        
        $file = "uploads/".$path->image_path;
        
        
        $q = $this->db->where('id',$article_id)
                     ->delete('articles');
        unlink($file);
        if (is_readable($file) && unlink($file)){}
        
             return $q;
             ;
             
    }
    
    public function search( $query,$limit,$offset ) {
        $q = $this->db->like('title',$query)
                      ->limit($limit,$offset)
                 ->get('articles');
                 
         return $q->result();
    }
    
    public function count_search_results($query) {
        $q = $this->db->like('title',$query)
                      ->get('articles');
        return $q->num_rows();
    }
    public function find($id){
        $q = $this->db->where('id',$id)
                 ->get('articles');
        if($q->num_rows()){
            return $q->row();
        }
        return FALSE;
        
    }
    public function sign_up(){
        $data = [
        'uname' => $this->input->post('username'),
        'lname' => $this->input->post('fname'),
        'fname' => $this->input->post('lname'),
        'pword' => $this->input->post('pword')
        ];
        
        $q = $this->db->insert('users',$data);
        return $this->db->insert_id();
        
    }
}
?>