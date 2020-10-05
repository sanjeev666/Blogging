<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('query_model');
        $this->load->model('pdf_model');
        $this->load->model('blog_model');
        $this->load->model('user_model');

    }

    public function login()
    {

    }

    public function view()
    {
        $this->db->select('*');
        $this->db->from('blog');
        return $this->db->get()->result_array();

    }

    //  one particular selected blog

    public function blogDetail($id)
    {
        $array = array('blog.id'=> $id);
        $this->db->select('blog.id as blog_id,blog.detail,blog.content,blog.title,blog.date,blog.url,users.username as name,users.profile_img,users.id as user_id,CONCAT("@",users.first_name,".",users.last_name) AS full_name');
        $this->db->from('blog');
        $this->db->join('users', 'blog.user_id = users.id')->where($array);
        $re = $this->db->get()->row_array();
       return $re; 
    }

    // SELECT blog.id,count(likes.id) as likes FROM blog
    //  LEFT join likes on likes.blog_id = blog.id group BY blog.id
    public function likeCount()
    {
        $this->db->select('blog.*,likes.blog_id as blog_id,count(likes.id) AS likes');
        $this->db->from('blog');
        $this->db->join('likes', 'blog.id = likes.blog_id', 'left');
        $this->db->order_by('blog.id', 'desc');
        $query = $this->db->group_by("blog.id")->get();
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $likeCheck = $this->likeCheck('likes', array('blog_id' => $value['blog_id'], 'user_id' => $_SESSION['id']));
            $result[$key]['count'] = $likeCheck['count'];
        }
        return $result;

    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function likeCheck($table, $data)
    {
        $this->db->select("count(*) AS count");
        $this->db->from($table);
        return $this->db->where($data)->get()->row_array();

    }

    public function delete($table, $data)
    {
        $this->db->delete("$table", $data);
    }

    public function likeBlog($data)
    {
        $result = array();
        $likeCheck = $this->likeCheck('likes', $data);
        if ($likeCheck['count'] <= 0) {
            $this->blog_model->insertData('likes', $data);
            $result['like'] = '1';
        } else {
            $this->blog_model->delete('likes', $data);
            $result['like'] = '0';
        }
        $likeCheck = $this->likeCheck('likes', array('blog_id' => $data['blog_id']));
        $result['count'] = $likeCheck['count'];
        return $result;

    }

    public function commentCount($data)
    {
        $this->db->select("count(*) AS count");
        $this->db->from("comment");
        return $this->db->where($data)->get()->row_array();
    }

    public function comments($id)
    {
        $this->db->select('comment.*,users.username as name');
        $this->db->from('comment');
        $this->db->join('users', 'comment.user_id = users.id');
        return $result = $this->db->where($id)->get()->result_array();

    }

    // for loading the blog page and search any blog
    public function scroller($offset, $limit, $category,$search,$blogerId='')
    {
        $this->db->select('blog.id,blog.user_id,blog.title,blog.detail, blog.date,blog.url,likes.blog_id as blog_id,count(likes.id) AS likes,categories.name AS cat_name,blog.category_id');
        // $this->db->select('blog.*,likes.blog_id as blog_id,count(likes.id) AS likes,categories.name AS cat_name');
        $this->db->from('blog');
        $this->db->where('blog.is_publish', 'PUBLISH');
        if($this->session->userdata('id'))
        {
            $blog_type = array('PRIVATE','PUBLIC');
            $this->db->where_in('blog.blog_type', $blog_type);
        }
        else
        {
           
            $this->db->where('blog.blog_type', 'PUBLIC');
        }
        $this->db->join('likes', 'blog.id = likes.blog_id', 'left');
        $this->db->join('categories', 'blog.category_id = categories.id', 'left');
        $this->db->order_by('blog.id', 'DESC');

        if ($category > 0) {
            $this->db->where('categories.id', $category);
        }
        if ($blogerId != '') {
            $this->db->where('blog.user_id', $blogerId);
        }
        if ($search != '') {
            $this->db->where("blog.title LIKE '%$search%'");
        }
        
        $query = $this->db->group_by("blog.id")->limit($limit, $offset)->get();
        $result = $query->result_array();
        //echo $this->db->last_query(); exit;
        foreach ($result as $key => $value) {
            $result[$key]['count'] = 0;
            if(isset($_SESSION['id'])){
                $likeCheck = $this->likeCheck('likes', array('blog_id' => $value['blog_id'], 'user_id' => $_SESSION['id']));
                $result[$key]['count'] = $likeCheck['count'];
            }
            $comment['blog_id'] = $value['id'];
            $commetCount = $this->blog_model->commentCount($comment);
            $result[$key]['comment_count'] = $commetCount['count'];
            $membername = $this->db->select('CONCAT("@",first_name,".",last_name) AS full_name,username AS name,profile_img')->from('users')->where(array('id'=> $value['user_id']))->get()->row_array();
            $result[$key]['name'] = $membername['name'];
            $result[$key]['profile_img'] = $membername['profile_img'];
            $result[$key]['full_name'] = $membername['full_name'];
        }
        return $result;
    }


    public function scroller1($offset, $limit, $category,$search,$blogerId='')
    {
        $this->db->select('categories.isPublic,blog.redirect_url,blog.id,blog.user_id,blog.title,blog.detail, blog.date,blog.url,likes.blog_id as blog_id,count(likes.id) AS likes,categories.name AS cat_name,blog.category_id');
        // $this->db->select('blog.*,likes.blog_id as blog_id,count(likes.id) AS likes,categories.name AS cat_name');
        $this->db->from('blog');
        $this->db->where('blog.is_publish', 'PUBLISH');
        
        if($this->session->userdata('id'))
        {
            $blog_type = array('PRIVATE','PUBLIC');
            $this->db->where_in('blog.blog_type', $blog_type);
        }
        else
        {
           
            $this->db->where('blog.blog_type', 'PUBLIC');
        }
        $this->db->join('likes', 'blog.id = likes.blog_id', 'left');
        $this->db->join('categories', 'blog.category_id = categories.id', 'left');
        $this->db->where('categories.isPublic', 'TRUE');
        $this->db->order_by('blog.id', 'DESC');

        if ($category > 0) {
            $this->db->where('categories.id', $category);
        }
        if ($blogerId != '') {
            $this->db->where('blog.user_id', $blogerId);
        }
        if ($search != '') {
            $this->db->where("blog.title LIKE '%$search%'");
        }
        
        $query = $this->db->group_by("blog.id")->limit($limit, $offset)->get();
        $result = $query->result_array();
        //echo $this->db->last_query(); exit;
        foreach ($result as $key => $value) {
            $result[$key]['count'] = 0;
            if(isset($_SESSION['id'])){
                $likeCheck = $this->likeCheck('likes', array('blog_id' => $value['blog_id'], 'user_id' => $_SESSION['id']));
                $result[$key]['count'] = $likeCheck['count'];
            }
            $comment['blog_id'] = $value['id'];
            $commetCount = $this->blog_model->commentCount($comment);
            $result[$key]['comment_count'] = $commetCount['count'];
            $membername = $this->db->select('CONCAT("@",first_name,".",last_name) AS full_name,username AS name,profile_img')->from('users')->where(array('id'=> $value['user_id']))->get()->row_array();
            $result[$key]['name'] = $membername['name'];
            $result[$key]['profile_img'] = $membername['profile_img'];
            $result[$key]['full_name'] = $membername['full_name'];
        }
        return $result;
    }
    public function landingPageAjax($offset, $limit, $category,$search,$blogerId='')
    {
        $this->db->select('categories.isPublic,blog.redirect_url,blog.id,blog.user_id,blog.title,blog.detail, blog.date,blog.url,likes.blog_id as blog_id,count(likes.id) AS likes,categories.name AS cat_name,blog.category_id');
        // $this->db->select('blog.*,likes.blog_id as blog_id,count(likes.id) AS likes,categories.name AS cat_name');
        $this->db->from('blog');
        $this->db->where('blog.is_publish', 'PUBLISH');
        
        if($this->session->userdata('id'))
        {
            $blog_type = array('PRIVATE','PUBLIC');
            $this->db->where_in('blog.blog_type', $blog_type);
        }
        else
        {
           
            $this->db->where('blog.blog_type', 'PUBLIC');
        }
        $this->db->join('likes', 'blog.id = likes.blog_id', 'left');
        $this->db->join('categories', 'blog.category_id = categories.id', 'left');
        $this->db->where('categories.isPublic', 'FALSE');
        $this->db->order_by('blog.id', 'DESC');

        if ($category > 0) {
            $this->db->where('categories.id', $category);
        }
        if ($blogerId != '') {
            $this->db->where('blog.user_id', $blogerId);
        }
        if ($search != '') {
            $this->db->where("blog.title LIKE '%$search%'");
        }
        
        $query = $this->db->group_by("blog.id")->limit(8,0)->get();
        $result = $query->result_array();
        //echo $this->db->last_query(); exit;
        foreach ($result as $key => $value) {
            $result[$key]['count'] = 0;
            if(isset($_SESSION['id'])){
                $likeCheck = $this->likeCheck('likes', array('blog_id' => $value['blog_id'], 'user_id' => $_SESSION['id']));
                $result[$key]['count'] = $likeCheck['count'];
            }
            $comment['blog_id'] = $value['id'];
            $commetCount = $this->blog_model->commentCount($comment);
            $result[$key]['comment_count'] = $commetCount['count'];
            $membername = $this->db->select('CONCAT("@",first_name,".",last_name) AS full_name,username AS name,profile_img')->from('users')->where(array('id'=> $value['user_id']))->get()->row_array();
            $result[$key]['name'] = $membername['name'];
            $result[$key]['profile_img'] = $membername['profile_img'];
            $result[$key]['full_name'] = $membername['full_name'];
        }
        $secondArray = $this->scroller1(0,16,0,'',$blogerId='');
        $all = array_merge($result,$secondArray);
        // pr($all);exit; =
        // shuffle($all);
        return $all;
    }

    
        // for loading the blog page and search any blog for UserBlog only
        public function scrollerForUserBlog($offset, $limit, $category,$blogerId='',$user_id)
        {   
            $this->db->select('blog.id,blog.user_id,blog.title,blog.detail, blog.date,blog.url,likes.blog_id as blog_id,count(likes.id) AS likes,categories.name AS cat_name');
            // $this->db->select('blog.*,likes.blog_id as blog_id,count(likes.id) AS likes,categories.name AS cat_name');
            $this->db->from('blog');
            $this->db->where('blog.is_publish', 'PUBLISH');
            $this->db->where('blog.user_id',$user_id);
            if($this->session->userdata('id'))
            {
                $blog_type = array('PRIVATE','PUBLIC');
                $this->db->where_in('blog.blog_type', $blog_type);
            }
            else
            {
               
                $this->db->where('blog.blog_type', 'PUBLIC');
            }
            $this->db->join('likes', 'blog.id = likes.blog_id', 'left');
            $this->db->join('categories', 'blog.category_id = categories.id', 'left');
            $this->db->order_by('blog.id', 'desc');
            if ($category > 0) {
                $this->db->where('categories.id', $category);
            }
            if ($blogerId != '') {
                $this->db->where('blog.user_id', $blogerId);
            }
            // if ($search != '') {
            //     $this->db->where("blog.title LIKE '%$search%'");
            // }
            
            $query = $this->db->group_by("blog.id")->limit($limit, $offset)->get();
            $result = $query->result_array();
            //echo $this->db->last_query(); exit;
            foreach ($result as $key => $value) {
                $result[$key]['count'] = 0;
                if(isset($_SESSION['id'])){
                    $likeCheck = $this->likeCheck('likes', array('blog_id' => $value['blog_id'], 'user_id' => $_SESSION['id']));
                    $result[$key]['count'] = $likeCheck['count'];
                }
                $comment['blog_id'] = $value['id'];
                $commetCount = $this->blog_model->commentCount($comment);
                $result[$key]['comment_count'] = $commetCount['count'];
                $membername = $this->db->select('CONCAT("@",first_name,".",last_name) AS full_name,username AS name,profile_img')->from('users')->where(array('id'=> $value['user_id']))->get()->row_array();
                $result[$key]['name'] = $membername['name'];
                $result[$key]['profile_img'] = $membername['profile_img'];
                $result[$key]['full_name'] = $membername['full_name'];
            }
            return $result;
        }

    //to select the blog data for view page
    public function get_where_in_arr($table, $select, $wheres = array(), $limit, $offset)
    {
        $this->db->select($select);
        $this->db->from($table);
        if (!empty($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where_in($key, $where);
            }
        }
        $this->db->join('users', 'users.id = comment.user_id');
        $query = $this->db->order_by("id", "desc")->limit($limit, $offset)->get();

        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $likeCheck = $this->likeCheck('comment', array('blog_id' => $wheres['blog_id'], 'user_id' => $_SESSION['id']));
            if ($result[$key]['user_id'] == $_SESSION['id']) {
                $result[$key]['count'] = $likeCheck['count'];
            } else {
                $result[$key]['count'] = 0;
            }
        }
        return $result;
    }

    public function membername($id)
    {
        $this->db->select('users.username,users.profile_img');
        $this->db->from('blog');
        $this->db->join('users', 'blog.user_id = users.id');
        return $this->db->where(array('blog.id' => $id))->get()->row_array();
      

    }

    public function membernameReport($id)
    {
        $this->db->select('users.*');
        $this->db->from('blog_report');
        $this->db->join('users', 'blog_report.user_id = users.id');
        return $this->db->where(array('blog_report.blog_id' => $id))->get()->row_array();
      

    }

    public function blogdetailReport($id)
    {
        $this->db->select('blog.*');
        $this->db->from('blog_report');
        $this->db->join('blog', 'blog_report.blog_id = blog.id');
        return $this->db->where(array('blog_report.blog_id' => $id))->get()->row_array();
       
      

    }

    public function comments1($data)
    {   
        $data = array(
            'blog_id' => $data['blog_id'],
            'limit' => $data['limit'],
        );
    }

    public function like($data)
    {   
        $data = array(
            'blog_id' => $data['blog_id'],
            'user_id' => $this->session->userdata('id'),
        );

        if ($result = $this->blog_model->likeBlog($data)) {
            $msg = array('errcode' => 0, 'message' => 'Records Found', 'result' => $result);
        } else {
            $msg = array('errcode' => 1, 'message' => 'Something went wrong', 'result' => $measurements);
        }
        echo json_encode($msg);
    
    }
    
    public function detailLike($data)
    {
         $likeButtonStatus = $this->db->get_where('likes', array('blog_id' => $data['blog_id'],'user_id'                          => $this->session->userdata('id') ))->row_array();

         $beforeChangeCount =  $this->db->where('blog_id',$data['blog_id'])->from("likes")->count_all_results();
         $status = '';
         

         if(!empty($likeButtonStatus))
         {
            $status = 'unlike';
            $addClass  = '';
            $this->db->delete('likes', array('blog_id'=>$data['blog_id'],'user_id' => $this->session->userdata('id'))); 
         }
         else
         {
            $status = 'like';
            $this->db->insert('likes', array('blog_id'=>$data['blog_id'],'user_id' => $this->session->userdata('id')));
         }

         $afterChangeCount =  $this->db->where('blog_id',$data['blog_id'])->from("likes")->count_all_results();

         $msg = array('status' => $status,'count' => $afterChangeCount);
        
        return $msg;
        
    }

    // public function scroller1($data)
    // {   
    //     $offset   = $data['offset'];
    //     $limit    = $data['limit'];
    //     $category = $data['category'];
    //     // $blogerId = $data['blogerId'];
    //     $result   = $this->blog_model->scroller($offset, $limit, $category);
    //     echo json_encode($result);
    // }

    public function report($data)
    {       
            $datas = array();
            $datas['blog_id'] = $data['blog_id'];
            $datas['user_id']  = $this->session->userdata('id');
            $datas['description'] = $data['detail'];
            $result = $this->blog_model->insertData('blog_report', $datas);
            if ($result) {
                $report['error'] = "Report Added";
                $report['status'] = 1;
                $this->admin_model->BlogReportNotifyEmail($result);
            } else {
                $report['error'] = "Something Went Wrong";
                $report['status'] = 0;
            }  
            return $report;
    }

    // // delete report
    // public function deleteReport($data)
    // {   
    //     $datas['blog_id'] = $data['blog_id'];
    //     $datas['user_id'] = $this->session->userdata('id');
    //     $result = $this->blog_model->delete('blog_report', $datas);
    //     if ($result) {
    //         echo "report deleted";
    //     }
    // }

    public function addComment($data)
    {
            $datas['blog_id']    = $data['blog_id'];
            $datas['user_id']    = $this->session->userdata('id');
            $datas['detail']     = $data['comment'];
            $result              = $this->blog_model->insertData('comment', $datas);
            $singledata          = $this->db->where('id',$result)->get('comment')->row_array();
            $singledata['date']          = date_format(date_create($singledata['date']),table_date);
            $comment['blog_id']  = $data['blog_id'];
            $count               = $this->blog_model->commentCount($comment);
            if ($result) {
                $report['error']        = "Comment Added";
                $report['status']       = 1;
                $report['commentadd']   = $singledata;
                $img = $this->db->get_where('users', array('id' => $this->session->userdata('id')))->row_array();
                $report['commentadd']['profile_img'] = $img['profile_img'];
                $this->admin_model->commentNotifyEmail($result);
            } else {
                $report['error']    = "Something Went Wrong";
                $report['status']   = 0;
            }
            $report['count'] = $this->db->where('blog_id',$data['blog_id'])->from("comment")->count_all_results();
            return $report;
    }

    public function deltecomment($id)
    {
       $commentTable = $this->db->delete('comment', array('id' => $id)) ? true:false;
       $commentReportTable = $this->db->delete('comment_report', array('comment_id' => $id)) ? true:false;
       return (($commentTable && $commentReportTable)) ? true:false;
    }

     //more comments button ajax
     public function blogComments($data)
     {
         $datas['blog_id']   = $data['blog_id'];
         $limit              = $data['limit'];
         $offset             = $data['offset'];
        //  $data['blog_id']    = $data['blog_id'];
        if(isset($this->session->id))
        {
            $result = $this->blog_model->get_where_in_arr("comment", 'comment.*,users.profile_img,users.username', $datas, $limit, $offset);
            foreach ($result as $key => $value) {
                # code...
                $report = '';
                if($this->session->userdata('id') != $value['user_id'])
                {
                    $report = '<b style="display:flex;" class="commentReportBtn blue-text" data-blogId="'.$value['blog_id'].'" data-commentId="'.$value['id'].'"><span class="material-icons">report</span>Report</b>';
                    $result["$key"]['commentReportbtn'] = $report;
                }
                else
                {
                    $result["$key"]['commentReportbtn'] = $report;
                }
            }
        
        }
        else
        {
            $result = $this->blog_model->commentsWithNoLogin("comment", 'comment.*,users.profile_img,users.username', $datas, $limit, $offset);
        }
         return $result;
     }
     public function commentsWithNoLogin($table, $select, $wheres = array(), $limit, $offset)
    {
        $this->db->select($select);
        $this->db->from($table);
        if (!empty($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where_in($key, $where);
            }
        }
        $this->db->join('users', 'users.id = comment.user_id');
        $query = $this->db->order_by("comment.id", "desc")->limit($limit, $offset)->get();
        $result = $query->result_array();
        // $user = $this->db->select("username,profile_img,id")->from("users")->get()->result_array();
        return $result;
    }

    public function reportComment($data)
    {
        // comment_report,blog_id,user_id,description,comment_id
        $InsertData['blog_id'] = $data['blog_id'];
        $InsertData['user_id'] = $this->session->userdata('id');
        $InsertData['comment_id'] = $data['comment_id'];
        $InsertData['description'] = $data['description'];
        return ($this->db->insert('comment_report', $InsertData))? true:false;
    }

    // function  getAllblogReportAjaxCount ($searchVal = '',$id)
    // {
    
    //     $this->db->select('count(blog_report.id) as CountRows');
    //     $this->db->from('blog_report');
    //     $this->db->join('blog','blog.id=blog_report.blog_id');
    //     if(strlen($searchVal)){
    //             $searchCondition = "(
    //                 blog_report.description like '%$searchVal%' or
    //                 blog_report.report_date like '%$searchVal%' 
    //             )";
    //         $this->db->where($searchCondition);
    //     }
    //     $query = $this->db->get()->row_array();
    //     //echo $this->db->last_query();exit;
    //     return $query['CountRows'];
    // }

    function  getAllblogReportAjaxCount ($searchVal = '',$id)
    {
           $this->db->select('blog_report.blog_id,blog.*,count(*) AS usersCount');
          $this->db->from('blog_report');
          $this->db->join('blog','blog.id=blog_report.blog_id');
        if(strlen($searchVal)){
                $searchCondition = "(
                    blog.title like '%$searchVal%'
                   
                )";
            $this->db->where($searchCondition);
        }
        $this->db->group_by('blog_report.blog_id');
        // $query = $this->db->get()->row_array();
        // echo $this->db->last_query();exit;
        return $this->db->get()->num_rows();
        // $query['usersCount'];
    }

    function  getAllCommentReportAjaxCount ($searchVal = '',$id)
    {
    
           $this->db->select('blog_report.blog_id,blog.*,count(blog_report.user_id) AS usersCount');
        $this->db->from('blog_report');
        $this->db->join('blog','blog.id=blog_report.blog_id');
        if(strlen($searchVal)){
                $searchCondition = "(
                    blog.title like '%$searchVal%'
                   
                )";
            $this->db->where($searchCondition);
        }
        $this->db->group_by('blog_report.blog_id');
        // $query = $this->db->get()->row_array();
        //echo $this->db->last_query();exit;
        // pr($query);exit;
        return $this->db->get()->num_rows();
        // $query['usersCount'];
    }

    //   protected $blogReportDT_column = array(

    //     'blog_report.id',
    //     'blog_report.description',
    //     'blog_report.report_date',
    //     '',
    //   );

      protected $blogReportDT_column = array(

        'blog.id',
        'blog.title',
        'usersCount',
        '',
      );

    //   function getAllblogReportAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0,$id){
    //      $this->db->select('blog_report.*,blog.*,users.phone_no');
    //      $this->db->from('blog_report');
    //      $this->db->join('blog','blog.id=blog_report.blog_id');
    //      $this->db->join('users','users.id=blog_report.user_id');
    //     if(strlen($searchVal)){
    //         $searchCondition = "(
    //             blog_report.description like '%$searchVal%' or
    //             blog_report.report_date like '%$searchVal%' 
                
    //         )";
    //         $this->db->where($searchCondition);
    //     }
    //     $this->db->limit($limit, $offset);
    //     $this->db->order_by($this->blogReportDT_column[$sortColIndex], $sortBy);
    //     $query = $this->db->get();
    //     $av = $this->db->last_query();
    //     return $query->result_array();
    //   }

      function getAllblogReportAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0,$id){
        $this->db->select('blog_report.blog_id,blog.*,count(blog_report.user_id) AS usersCount');
        $this->db->from('blog_report');
        $this->db->join('blog','blog.id=blog_report.blog_id');
        
       if(strlen($searchVal)){
           $searchCondition = "(
               blog.title like '%$searchVal%' 
               
           )";
           $this->db->where($searchCondition);
       }
       $this->db->limit($limit, $offset);
       $this->db->order_by($this->blogReportDT_column[$sortColIndex], $sortBy);
       $this->db->group_by('blog_report.blog_id');
       $query = $this->db->get();
       $av = $this->db->last_query();
       return $query->result_array();
      }

      
      function getAllCommentReportAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0,$id){
        $this->db->select('comment_report.comment_id,comment.*,count(comment_report.user_id) AS usersCount');
        $this->db->from('comment_report');
        $this->db->join('comment','comment.id=comment_report.comment_id');
       if(strlen($searchVal)){
           $searchCondition = "(
            comment.detail like '%$searchVal%' 
           )";
           $this->db->where($searchCondition);
       }
       $this->db->limit($limit, $offset);
    //    $this->db->order_by($this->blogReportDT_column[$sortColIndex], $sortBy);
       $this->db->group_by('comment_report.comment_id');
       $query = $this->db->get();
       $av = $this->db->last_query();
       return $query->result_array();
      }

    // publish blogList ajax
    function getAllblogAjaxCount ($searchVal = '',$id)
    {
    
        $this->db->select('count(blog.id) as CountRows');
        $this->db->from('blog');
        $this->db->where('is_publish','PUBLISH');
        if(strlen($searchVal)){
                $searchCondition = "(
                    title like '%$searchVal%' or
                    date like '%$searchVal%' or
                    update_date like '%$searchVal%' or
                    is_publish like '$searchVal%'  
                )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        return $query['CountRows'];
    }

    protected $PublishblogDT_column = array(
        'id',
        'title',
        'date',
        'update_date',
        'is_publish',
        '',
      );

    function getAllblogAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0,$id)
      {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->where('is_publish','PUBLISH');
        if(strlen($searchVal)){
            $searchCondition = "(
                title like '%$searchVal%' or
                date like '%$searchVal%' or
                update_date like '%$searchVal%' or
                is_publish like '$searchVal%'  
                
            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->PublishblogDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
       
        $av = $this->db->last_query();
        return $query->result_array();
      }

    // for unpublish blogList
    function getAllUnpublishblogAjaxCount ($searchVal = '',$id)
    {
    
        $this->db->select('count(blog.id) as CountRows');
        $this->db->from('blog');
        $this->db->where('is_publish','UNPUBLISH');
        if(strlen($searchVal)){
                $searchCondition = "(
                    title like '%$searchVal%' or
                    date like '%$searchVal%' or
                    update_date like '%$searchVal%' or
                    is_publish like '$searchVal%'  
                )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        return $query['CountRows'];
    }

      protected $UnpublishblogDT_column = array(
        'id',
        'title',
        'date',
        'update_date',
        'is_publish',
        '',
      );

      function getAllUnpublishblogAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0,$id)
      {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->where('is_publish','UNPUBLISH');
        if(strlen($searchVal)){
            $searchCondition = "(
                title like '%$searchVal%' or
                date like '%$searchVal%' or
                update_date like '%$searchVal%' or
                is_publish like '$searchVal%'  
                
            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->UnpublishblogDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
      }

    // for Reject blogList ajax
    function getAllRejectblogAjaxCount ($searchVal = '',$id)
    {
    
        $this->db->select('count(blog.id) as CountRows');
        $this->db->from('blog');
        $this->db->where('is_publish','REJECT');
        if(strlen($searchVal)){
                $searchCondition = "(
                    title like '%$searchVal%' or
                    date like '%$searchVal%' or
                    update_date like '%$searchVal%' or
                    is_publish like '$searchVal%'  
                )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        return $query['CountRows'];
    }

      protected $rejectblogDT_column = array(
        'id',
        'title',
        'date',
        'update_date',
        'is_publish',
        '',
      );

      function getAllRejectblogAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0,$id)
      {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->where('is_publish','REJECT');
        if(strlen($searchVal)){
            $searchCondition = "(
                title like '%$searchVal%' or
                date like '%$searchVal%' or
                update_date like '%$searchVal%' or
                is_publish like '$searchVal%'  
                
            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->rejectblogDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
      }

    // for block blogList ajax
    function getAllBlockblogAjaxCount ($searchVal = '',$id)
    {
    
        $this->db->select('count(blog.id) as CountRows');
        $this->db->from('blog');
        $this->db->where('is_publish','BLOCK');
        if(strlen($searchVal)){
                $searchCondition = "(
                    title like '%$searchVal%' or
                    date like '%$searchVal%' or
                    update_date like '%$searchVal%' or
                    is_publish like '$searchVal%'  
                )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        return $query['CountRows'];
    }

      protected $blockblogDT_column = array(
        'id',
        'title',
        'date',
        'update_date',
        'is_publish',
        '',
      );

      function getAllBlockblogAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0,$id)
      {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->where('is_publish','BLOCK');
        if(strlen($searchVal)){
            $searchCondition = "(
                title like '%$searchVal%' or
                date like '%$searchVal%' or
                update_date like '%$searchVal%' or
                is_publish like '$searchVal%'  
                
            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->blockblogDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
      }


    function getAllblogCategoryAjaxCount ($searchVal = '',$id)
    {
    
        $this->db->select('count(categories.id) as CountRows');
        $this->db->from('categories');
        if(strlen($searchVal)){
                $searchCondition = "(
                    categories.name like '%$searchVal%' 
                )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        return $query['CountRows'];
    }

      protected $blogCategotyDT_column = array(
        'categories.id',
        'categories.name',
        '',
      );

      function getAllblogCategoryAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0,$id)
      {
         $this->db->select('categories.*');
         $this->db->from('categories');
        if(strlen($searchVal)){
            $searchCondition = "(
                categories.name like '%$searchVal%'
                
            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->blogCategotyDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
      }

      protected $orderDT_column = array(
        'transaction.id',
        'users.username',
        'transaction.amount',
        'transaction.settle_date'
      );

    function getAllsettlementAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'desc', $limit = 0, $offset = 0,$id,$status){
        $this->db->select('transaction.*,users.username');
        $this->db->from('transaction');
         $this->db->join('users','users.id=transaction.user_id');
         $this->db->where('transaction.status',$status);
       if(strlen($searchVal)){
           $searchCondition = "(
            transaction.settle_date like '%$searchVal%' or
            transaction.user_id like '%$searchVal%' 
               
           )";
           $this->db->where($searchCondition);
       }
       $this->db->limit($limit, $offset);
       $this->db->order_by($this->orderDT_column[$sortColIndex], $sortBy);
       $this->db->order_by('transaction.settle_date', 'DESC');
       $query = $this->db->get();
       $av = $this->db->last_query();
       return $query->result_array();
     }

    function getAllsettlementAjaxCount($searchVal = '',$id,$status){
        $this->db->select('count(transaction.id) as CountRows');
        $this->db->from('transaction');
        $this->db->join('users','users.id=transaction.user_id');
        $this->db->where('transaction.status',$status);
        if(strlen($searchVal)){
           $searchCondition = "(
            transaction.settle_date like '%$searchVal%' or
            transaction.user_id like '%$searchVal%' 
           )";
           $this->db->where($searchCondition);
        }
       $query = $this->db->get()->row_array();
 
       return $query['CountRows'];
    }



 
}