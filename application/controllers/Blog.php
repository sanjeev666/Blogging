<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('blog_model');
        $this->load->model('user_model');
        $this->load->model('query_model');
        $this->load->model('core_model');
        $this->allow('landingPageAjax','scrollerRedirect','landingPage','testing','index', 'FAQ', 'reg', 'learnMore', 'username', 'trademark', 'terms', 'privacy', 'scrollerForUserBlog', 'detail', 'scroller', 'blogComments');
        $this->allowAdmin('deltecomment', 'commentReportajax', 'commentReportListusers', 'commentReportTable', 'reportComment', 'blogReportListusers', 'blockblogList', 'blockblogListajax', 'rejectblogList', 'rejectblogListajax', 'unpublishblogListajax', 'unpublishblogList', 'blogListAdminajax', 'blogReportajax', 'viewAdmin', 'like', 'report', 'detailLike', 'blogComments', 'addComment', 'reject', 'publish', 'unpublish', 'viewAdmin', 'blogReportListAdmin', 'viewInDetailReport', 'block', 'blogListAdmin');
        $this->allowStaff('reportComment', 'index', 'blogComments', 'report', 'comments', 'likes', 'addComment', 'detailLike', 'like');
    }

    public function blogReportListusers()
    {
        $this->form_validation->set_rules('blog_id', 'blog id', 'trim|required');
        if ($this->form_validation->run()) {
            $this->db->select('users.username,users.profile_img,blog_report.user_id,blog_report.description');
            $this->db->from('blog_report');
            $this->db->join('users', 'users.id=blog_report.user_id');
            $this->db->where('blog_report.blog_id', $this->input->post('blog_id'));
            $query = $this->db->get();
            $av = $this->db->last_query();
            $result = $query->result_array();
        }

        echo json_encode($result);
    }

    public function commentReportListusers()
    {
        $this->form_validation->set_rules('comment_id', 'comment id', 'trim|required');
        if ($this->form_validation->run()) {
            $this->db->select('users.username,users.profile_img,comment_report.user_id,comment_report.description');
            $this->db->from('comment_report');
            $this->db->join('users', 'users.id=comment_report.user_id');
            $this->db->where('comment_report.comment_id', $this->input->post('comment_id'));
            $query = $this->db->get();
            $av = $this->db->last_query();
            $result = $query->result_array();
        }

        echo json_encode($result);
    }

    public function FAQ()
    {
        $data['header'] = true;
        $data['_view'] = 'FAQ';
        $data['sidebar'] = ($this->session->id) ? true : false;
        $data['footer'] = true;
        $this->load->view('admin/basetemplate', $data);

    }

    public function home()
    {
        if ($this->session->userdata('id')) {
            $data['header'] = true;
            $data['_view'] = 'landing';
            $data['sidebar'] = ($this->session->id) ? true : false;
            $data['footer'] = true;
            $this->load->view('admin/basetemplate', $data);

        } else {
            redirect('blog/index');
        }

    }

    public function learnMore()
    {
        // if (!$this->session->userdata('id')) {
        //     $this->load->view('admin/landing');
        // }
        // else
        // {
        //     redirect('blog/index');
        // }
        $data['header'] = true;
        $data['_view'] = 'learnMore';
        $data['sidebar'] = ($this->session->id) ? true : false;
        $data['footer'] = true;
        $this->load->view('admin/basetemplate', $data);
    }

    public function index($category = 0)
    {
        $visitor = array();
        $visitor['visitorsIP'] = $this->input->ip_address();
        $visitor['visited_date'] = date('y-m-d H:i:s');
        $visitor = $this->core_model->insertVisitor($visitor);
        $data['header'] = true;
        $data['_view'] = 'view';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['category'] = $category;
        $this->load->view('admin/basetemplate', $data);
    }

    public function landingPage()
    {
       
        $data['header'] = true;
        $data['_view'] = 'indexPage';
        $visitor['visitorsIP'] = $this->input->ip_address();
        $visitor['visited_date'] = date('y-m-d H:i:s');
        $visitor = $this->core_model->insertVisitor($visitor);
        $data['sidebar'] = true;
        $data['category'] = 0;
        $data['footer'] = true;
        $data['result'] = $this->blog_model->landingPageAjax(0,24,0,'');
        $this->load->view('admin/basetemplate', $data);
        
           
    }

    //  After clicking any cards in blog page (the page which show in detail about that card)
    public function detail($id)
    {
        $like = array(
            'blog_id' => $id,
            'user_id' => $this->session->userdata('id'),
        );
        $data['header'] = true;
        $data['_view'] = 'viewInDetail';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['result'] = $this->blog_model->blogDetail($id);
        $data['likecount'] = $this->blog_model->likeCheck('likes', array('blog_id' => $id));
        $data['like'] = $this->blog_model->likeCheck('likes', $like);
        $data['report'] = $this->blog_model->likeCheck('blog_report', $like);
        $data['commentCount'] = $this->blog_model->commentCount(array('blog_id' => $id));
        $data['comments'] = $this->blog_model->comments(array('comment.blog_id' => $id));
        $is_follow = $this->db->get_where('followers', array('following_id' => $this->session->id,'follower_id' => $data['result']['user_id']))->row_array();
        $data['is_follow']  = $is_follow;
        $this->load->view('admin/basetemplate', $data);


    }

    public function comments()
    {
        $this->blog_model->comments1($this->input->post());
        echo "success";
    }

    public function likes()
    {
        $count = $this->blog_model->likeCount();
        pr($count);
    }

    public function like()
    {
        $check = $this->session->userdata('id');
        if (empty($check)) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {

            $this->blog_model->like($this->input->post());
        }
    }

    public function detailLike()
    {
        $check = $this->session->userdata('id');
        if (empty($check)) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {

            $result = $this->blog_model->detailLike($this->input->post());
            echo json_encode($result);
        }
    }

    // page loading
    public function scroller()
    {
        $data = $this->input->post();
        $result = $this->blog_model->scroller($data['offset'], $data['limit'], $data['category'], $data['search']);
        echo json_encode($result);
    }
    public function scrollerRedirect()
    {
        $data = $this->input->post();
        $result = $this->blog_model->scroller1($data['offset'], $data['limit'], $data['category'], $data['search']);
        echo json_encode($result);
    }

    public function landingPageAjax()
    {
        $data = $this->input->post();
        $result = $this->blog_model->landingPageAjax($data['offset'], $data['limit'], $data['category'], $data['search']);
        echo json_encode($result);
    }


    











    // page loading
    public function scrollerForUserBlog()
    {
        $data = $this->input->post();
        $result = $this->blog_model->scrollerForUserBlog($data['offset'], $data['limit'], $data['category'], $data['search'], $data['user_id']);
        echo json_encode($result);
    }

    //  Add report
    public function report()
    {
        $this->form_validation->set_rules('blog_id', 'blog id', 'required');
        $this->form_validation->set_rules('detail', 'Reason', 'trim|required');
        if ($this->form_validation->run() == true) {
            $report = $this->blog_model->report($this->input->post());
        }
        echo json_encode($report);
    }

    public function addComment()
    {
        $this->form_validation->set_rules('blog_id', 'blog id', 'required');
        $this->form_validation->set_rules('comment', 'comment', 'trim|required');
        if ($this->form_validation->run()) {
            $report = $this->blog_model->addComment($this->input->post());
        }
        echo json_encode($report);
    }

    // publish blog by admin
    public function blogListAdmin()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'blogApproval';
        $data['title'] = 'blogApproval';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['count'] = $this->blog_model->getAllblogAjaxCount($searchVal, $id);
        $data['countUnpublish'] = $this->blog_model->getAllUnpublishblogAjaxCount($searchVal, $id);
        $data['rejectblogListCount'] = $this->blog_model->getAllRejectblogAjaxCount($searchVal, $id);
        $data['BlockblogListCount'] = $this->blog_model->getAllBlockblogAjaxCount($searchVal, $id);
        $data['active_tab'] = 'blogList';
        // $data['blogList'] = $this->user_model->get_select_arr('blog', '*','', 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // publish blog by admin
    public function blogListAdminajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        //echo $sortBy;exit;
        $totalBloglist = $this->blog_model->getAllblogAjaxCount($searchVal, $id);
        if ($totalBloglist) {
            $BlogList = $this->blog_model->getAllblogAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($BlogList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                array_push($row, date_format(date_create($item['date']), table_date));

                // array_push($row, $item['update_date']);
                // array_push($row, $item['is_publish']);

                $action = "";
                $action .= '<a href="viewAdmin?id=' . $item['id'] . '"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="View">
                <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Unpublish">
                <i class="material-icons">cancel</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-red gradient-shadow modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Rejected">
                <i class="material-icons">clear</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light #d50000 red accent-4 gradient-shadow modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Blocked">
                <i class="material-icons">block</i></a>';

                array_push($row, $action);
                $columns[] = $row;
            }
        }
        $response = [
            'draw' => $page,
            'data' => $columns,
            'recordsTotal' => $totalBloglist,
            'recordsFiltered' => $totalBloglist,
            '$limit' => $limit,
            '$offset' => $offset,
        ];
        echo json_encode($response);
    }

    public function unpublishblogList()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'unpublishblogList';
        $data['title'] = 'blogList';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['count'] = $this->blog_model->getAllblogAjaxCount($searchVal, $id);
        $data['countUnpublish'] = $this->blog_model->getAllUnpublishblogAjaxCount($searchVal, $id);
        $data['rejectblogListCount'] = $this->blog_model->getAllRejectblogAjaxCount($searchVal, $id);
        $data['BlockblogListCount'] = $this->blog_model->getAllBlockblogAjaxCount($searchVal, $id);
        $data['active_tab'] = 'blogList';
        // $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("user_id" => $this->session->userdata("id")), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    //  unpublish blog by admin
    public function unpublishblogListajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalBloglist = $this->blog_model->getAllUnpublishblogAjaxCount($searchVal, $id);
        if ($totalBloglist) {
            $BlogList = $this->blog_model->getAllUnpublishblogAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($BlogList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                array_push($row, date_format(date_create($item['date']), table_date));
                array_push($row, empty($item['update_date']) ? date_format(date_create($item['date']), table_date) : date_format(date_create($item['update_date']), table_date));
                // array_push($row, $item['is_publish']);
                // $condition ? 'foo' : 'bar';

                $action = "";
                $action .= '<a href="viewAdmin?id=' . $item['id'] . '"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="View">
                <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow  modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Publish">
                <i class="material-icons">check</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-red gradient-shadow modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Rejected">
                <i class="material-icons">clear</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light #d50000 red accent-4 gradient-shadow modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Blocked">
                <i class="material-icons">block</i></a>';

                array_push($row, $action);
                $columns[] = $row;
            }
        }
        $response = [
            'draw' => $page,
            'data' => $columns,
            'recordsTotal' => $totalBloglist,
            'recordsFiltered' => $totalBloglist,
            '$limit' => $limit,
            '$offset' => $offset,
        ];
        echo json_encode($response);
    }

    //reject blogList
    public function rejectblogList()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'rejectblogList';
        $data['title'] = 'blogList';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['count'] = $this->blog_model->getAllblogAjaxCount($searchVal, $id);
        $data['countUnpublish'] = $this->blog_model->getAllUnpublishblogAjaxCount($searchVal, $id);
        $data['rejectblogListCount'] = $this->blog_model->getAllRejectblogAjaxCount($searchVal, $id);
        $data['BlockblogListCount'] = $this->blog_model->getAllBlockblogAjaxCount($searchVal, $id);
        $data['active_tab'] = 'blogList';
        // $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("user_id" => $this->session->userdata("id")), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // reject blog by admin
    public function rejectblogListajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalBloglist = $this->blog_model->getAllRejectblogAjaxCount($searchVal, $id);
        if ($totalBloglist) {
            $BlogList = $this->blog_model->getAllRejectblogAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($BlogList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                array_push($row, date_format(date_create($item['date']), table_date));
                // array_push($row, $item['update_date']);
                // array_push($row, $item['is_publish']);

                $action = "";
                $action .= '<a href="viewAdmin?id=' . $item['id'] . '"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="View">
                <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow  modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Publish">
                <i class="material-icons">check</i></a>&nbsp&nbsp';

                // $action .='<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="'.$item['id'].'"  data-tooltip="Unpublish">
                // <i class="material-icons">cancel</i></a>&nbsp&nbsp';

                array_push($row, $action);
                $columns[] = $row;
            }
        }
        $response = [
            'draw' => $page,
            'data' => $columns,
            'recordsTotal' => $totalBloglist,
            'recordsFiltered' => $totalBloglist,
            '$limit' => $limit,
            '$offset' => $offset,
        ];
        echo json_encode($response);
    }

    //block blogList
    public function blockblogList()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'blockblogList';
        $data['title'] = 'blogList';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['count'] = $this->blog_model->getAllblogAjaxCount($searchVal, $id);
        $data['countUnpublish'] = $this->blog_model->getAllUnpublishblogAjaxCount($searchVal, $id);
        $data['rejectblogListCount'] = $this->blog_model->getAllRejectblogAjaxCount($searchVal, $id);
        $data['BlockblogListCount'] = $this->blog_model->getAllBlockblogAjaxCount($searchVal, $id);
        $data['active_tab'] = 'blogList';
        // $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("user_id" => $this->session->userdata("id")), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // reject blog by admin
    public function blockblogListajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalBloglist = $this->blog_model->getAllBlockblogAjaxCount($searchVal, $id);
        if ($totalBloglist) {
            $BlogList = $this->blog_model->getAllBlockblogAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($BlogList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                array_push($row, date_format(date_create($item['date']), table_date));

                // array_push($row, $item['update_date']);
                // array_push($row, $item['is_publish']);

                $action = "";
                $action .= '<a href="viewAdmin?id=' . $item['id'] . '"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="View">
                <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow  modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Publish">
                <i class="material-icons">check</i></a>&nbsp&nbsp';

                // $action .='<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deletecustBtn" style="margin-top: 4px;" data-id="'.$item['id'].'"  data-tooltip="Unpublish">
                // <i class="material-icons">cancel</i></a>&nbsp&nbsp';

                array_push($row, $action);
                $columns[] = $row;
            }
        }
        $response = [
            'draw' => $page,
            'data' => $columns,
            'recordsTotal' => $totalBloglist,
            'recordsFiltered' => $totalBloglist,
            '$limit' => $limit,
            '$offset' => $offset,
        ];
        echo json_encode($response);
    }

    // Publish blog
    public function publish()
    {
        $id = $_GET['id'];
        $this->query_model->updateData('blog', array('is_publish' => 'PUBLISH'), 'id', $id);
        $this->admin_model->BlogNotifyEmail($id,"PUBLISH");

        $follower_id = $this->admin_model->get_single_row('blog','id,user_id',array('id'=>$id,'blog_type' => 'PUBLIC','is_publish' => 'PUBLISH'));
        if(!empty($follower_id))
        {
            $follower_name = $this->admin_model->get_single_row('users','CONCAT(first_name," ",last_name) AS full_name',array('id'=>$follower_id['user_id']));


            // $follower = $this->admin_model->get_where_in_arr('followers','*',array('follower_id'=>$follower_id['user_id']));
            $follower = $this->db->select('*')->from('followers')->join('users','users.id = followers.following_id')->get()->result_array();
            
            // pr($follower);exit;
            $title = 'This is to inform you that '.$follower_name['full_name'].' recently added a New blog';
                if(!empty($follower))
                {   
                    foreach ($follower as $key => $value) {
                        $notifData['user_id']  = $value['following_id'];
                        $sub = $follower_name['full_name'].' recently added a New blog';
                        $msg = 'Hello '.ucfirst($value['username']).',<br/><br/>
                        This is to inform you that '.$follower_name['full_name'].' recently added a New blog. Please go through it in order to stay updated. ,<br/><br/>
                            To stay signed-in,<br/>
                            Team Blogging!';
                            $to_email = $value['email'];
                         $msg1 = array('subject' => $sub, 'message' => $msg);
                         email($to_email,'sanjeev.m@infiny.in', $msg1);
                        
                        $notifData['description']  = $title;
                        $notifData['title']  = $title;
                        $notifData['url']      = 'blog/detail/'.$follower_id['id'];
                        $notifyId = $this->admin_model->insertData('notification', $notifData);
                        if($notifyId > 1)
                        {
                            $status['notification_id'] = $notifyId;
                            $status['user_id'] = $value['following_id'];
                            $status['status'] = 0;
                            $this->admin_model->insertData('notification_status', $status);

                        }
                        
                }
            }
        }
        
        $this->session->set_flashdata('success', 'Record Publish successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Unpublish blog
    public function unpublish()
    {
        $id = $_GET['id'];
        $this->query_model->updateData('blog', array('is_publish' => 'UNPUBLISH'), 'id', $id);
        $this->admin_model->BlogNotifyEmail($id,"UNPUBLISH");
        $this->session->set_flashdata('success', 'Record Unpublished successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Block blog by admin
    public function block()
    {
        $id = $_GET['id'];
        $this->query_model->updateData('blog', array('is_publish' => 'BLOCK'), 'id', $id);
        $this->admin_model->BlogNotifyEmail($id,"BLOCK");
        $this->session->set_flashdata('success', 'Record Blocked successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Rejected blog
    public function reject()
    {
        $id = $_GET['id'];
        $this->query_model->updateData('blog', array('is_publish' => 'Reject'), 'id', $id);
        $this->admin_model->BlogNotifyEmail($id,"REJECT");
        $this->session->set_flashdata('success', 'Record Rejected successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Blog in details for admin
    public function viewAdmin()
    {
        $data = $this->data;
        $data['id'] = $_GET['id'];
        $data['header'] = true;
        $data['_view'] = 'viewInDetailAdmin';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['memberName'] = $this->blog_model->membername($data['id']);
        $data['blogListDetails'] = $this->query_model->get_single_row('blog', '*', array('id' => $data['id']));
        $this->load->view('admin/basetemplate', $data);
    }

    // aproved or reject blog report by admin
    public function blogReportListAdmin()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'reportListing';
        $data['title'] = 'reportListing';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'blogList';
        // $data['reportListing'] = $this->user_model->get_select_arr('blog_report', '*','', 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // report ajax for  aproved or reject blog report by admin
    public function blogReportajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalUserlist = $this->blog_model->getAllblogReportAjaxCount($searchVal, $id);
        if ($totalUserlist) {
            $userList = $this->blog_model->getAllblogReportAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($userList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                // array_push($row, date_format(date_create($item['report_date']),table_date));
                $userView = '';
                $userView .= '<a href="javascript:void(0)"  class="ml-2 btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow  tooltipped valign-wrapper center-align usersListing" style="margin-top: 4px;" data-id="' . $item['id'] . '" data-tooltip="users">
                ' . $item['usersCount'] . '</a>&nbsp&nbsp&nbsp';
                array_push($row, $userView);

                $action = "";
                $action .= '<a href="viewInDetailReport?id=' . $item['blog_id'] . '"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="' . $item['id'] . '" data-tooltip="View">
                <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp&nbsp';

                // $action .='<a href="#modal2"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="'.$item['id'].'" data-tooltip="View">
                // <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp&nbsp';
                if ($item['is_publish'] == 'BLOCK') {

                } else {
                    $action .= '<a href="#modal1"  data-toggle="modal" type="button" class="btn-floating printmeasurementbtn waves-effect waves-light gradient-45deg-green-teal gradient-shadow  modal-trigger tooltipped  modal-trigger deletecustBtn" style="margin-top: 4px;"data-id="' . $item['blog_id'] . '" data-tooltip="Approve">
                <i class="material-icons">check</i></a>';
                }

                array_push($row, $action);
                $columns[] = $row;
            }
        }
        $response = [
            'draw' => $page,
            'data' => $columns,
            'recordsTotal' => $totalUserlist,
            'recordsFiltered' => $totalUserlist,
            '$limit' => $limit,
            '$offset' => $offset,
        ];
        echo json_encode($response);
    }

    public function commentReportajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalUserlist = $this->blog_model->getAllCommentReportAjaxCount($searchVal, $id);
        if ($totalUserlist) {
            $userList = $this->blog_model->getAllCommentReportAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($userList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['detail']);

                $userView = '';
                $userView .= '<a href="javascript:void(0)"  class="ml-2 btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow  tooltipped valign-wrapper center-align usersListing" style="margin-top: 4px;" data-id="' . $item['id'] . '" data-tooltip="users">
                ' . $item['usersCount'] . '</a>&nbsp&nbsp&nbsp';
                    array_push($row, $userView);
                   $action = "";
                    $action .= '<a href="#modal1"  data-toggle="modal" type="button" class="btn-floating printmeasurementbtn waves-effect waves-light gradient-45deg-red-pink gradient-shadow  modal-trigger tooltipped  modal-trigger deletecustBtn" style="margin-top: 4px;"data-id="' . $item['id'] . '" data-tooltip="delete comment">
                <i class="material-icons">delete</i></a>';
                array_push($row, $action);
                $columns[] = $row;
            }
        }
        $response = [
            'draw' => $page,
            'data' => $columns,
            'recordsTotal' => $totalUserlist,
            'recordsFiltered' => $totalUserlist,
            '$limit' => $limit,
            '$offset' => $offset,
        ];
        echo json_encode($response);
    }

    public function commentReportTable()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'commentReportTable';
        $data['title'] = 'commentReportTable';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'commentReportTable';
        $this->load->view('admin/basetemplate', $data);
    }

    public function deltecomment($id)
    {
        if ($id != '') {
            if ($this->blog_model->deltecomment($id)) {
                $this->session->set_flashdata('success', 'Comment Deleted Successfully');
               
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong');
            }
            redirect('blog/commentReportTable');
        }
     
    }

    // Blog in details view of users
    public function viewInDetailReport()
    {
        $data = $this->data;
        $data['id'] = $_GET['id'];
        $data['header'] = true;
        $data['_view'] = 'viewInDetailAdmin';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['memberName'] = $this->blog_model->membernameReport($_GET['id']);
        $data['blogListDetails'] = $this->blog_model->blogdetailReport($_GET['id']);
        $this->load->view('admin/basetemplate', $data);

    }

    //more comments button ajax
    public function blogComments()
    {
        $this->form_validation->set_rules('blog_id', 'blog id', 'required');
        $this->form_validation->set_rules('limit', 'limit', 'trim|required');
        $this->form_validation->set_rules('offset', 'offset', 'trim|required');
        if ($this->form_validation->run() == true) {
            $result = $this->blog_model->blogComments($this->input->post());
        } else {
            $result['error'] = "something went wrong";
        }
        echo json_encode($result);
    }

    public function reportComment()
    {

        $this->form_validation->set_rules('blog_id', 'blog id', 'required');
        $this->form_validation->set_rules('comment_id', 'comment_id', 'required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        if ($this->form_validation->run()) {
            if ($this->blog_model->reportComment($this->input->post())) {
                $msg = array('errcode' => 0, 'message' => 'Report Added Successfully');

            } else {
                $msg = array('errcode' => 0, 'message' => 'Something Went Wrong');
            }

        } else {

            $msg = array('errcode' => 0, 'message' => 'Please Fill All Field');
        }
        echo json_encode($msg);
    }
}
