<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'assets/razorpay-php/Razorpay.php';
include 'libraries/API/vendor/autoload.php';
class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->allow('clearNotification','followers','testing','signUpWithFacebook', 'signUpWithGoogle', 'checkEmailAjax', 'checkEmail', 'googles', 'userBlogProfile', 'registration', 'subscription', 'checkUserUsername', 'checkUserEmail', 'view', 'viewInDetail', 'login', 'changePass', 'forgotPass', 'resetPassword', 'razorPaySuccess', 'RazorThankYou');
        $this->allowAdmin('allNotificationSeen','allNotification', 'UserNotificationSeen', 'unpublishblogListajax', 'unpublishblogList', 'unpublishajax', 'publishajax', 'draftListajax', 'notificationajax', 'usersajax', 'addNotification', 'notification', 'referralList', 'checkUserEditUsername', 'checkUserEditEmail', 'edituserprofile', 'category', 'unPublish', 'publish', 'draftList', 'addBlog', 'blogDelete', 'blogEdit', 'unblockusers', 'blockusers', 'curl', 'get', 'users');
        $this->allowStaff('allNotificationSeen','allNotification', 'login', 'UserNotificationSeen', 'unpublishajax', 'publishajax', 'draftListajax', 'notificationHeader', 'category', 'blogDelete', 'blogEdit', 'unPublish', 'publish', 'update', 'changeUserPassword', 'checkUserEditUsername', 'checkUserEditEmail', 'edituserprofile',  'draftList', 'addBlog');
        $this->load->model('admin_model');
        $this->load->model('query_model');
        $this->load->model('pdf_model');
        $this->load->model('blog_model');
        $this->load->model('user_model');
    }

    public function testing($name)
    {
        $numbers=array(1,2,3,4);
        $user = $this->db->select('*')->from('users')->where_in('id', array(1,2,3,4))->get()->result_array();
        echo $this->db->last_query();
        pr($user);
    }

    public function followers()
    {
        
        // $this->db->insert('mytable', $data);
        $this->form_validation->set_rules('follower_id', 'follower_id', 'required');
        $this->form_validation->set_rules('following_id', 'following_id', 'required');
        
        if ($this->form_validation->run()) {
            $data['follower_id'] = $_POST['follower_id'];
            $data['following_id'] = $_POST['following_id'];
            $unique =  $this->db->get_where('followers', array('following_id' => $_POST['following_id'],'follower_id' => $_POST['follower_id']))->row_array();

            if(empty($unique))
            {
                   if($this->db->insert('followers',$data))

                    {
                       $countFollow =  $this->db->where('follower_id',$_POST['follower_id'])->count_all_results('followers'); 
                        $msg = array('error' => '0' ,'msg'=>"following", 'result' => $countFollow);
                    }
            }
            else
            {
                if($this->db->delete('followers', array('following_id' =>  $_POST['following_id'])))
                {
                    $countFollow =  $this->db->where('follower_id',$_POST['follower_id'])->count_all_results('followers');
                    $msg = array('error' => '0' ,'msg'=>"follow", 'result' => $countFollow);
                }  
            }

            } else {
                $msg = array('error' => '1002' ,'msg'=>"invalid details");
            }

        echo json_encode($msg);
    }

    public function checkEmail()
    {
        $email = $this->input->post('email');
        if ($result = $this->db->get_where('users', array('email' => $email, 'status' => 'ACTIVE'))->row_array()) {
            $msg = array('err' => '200', 'msg' => 'successfull');
            $this->admin_model->set_user_login_session($result);
        } else {
            $msg = array('err' => '400', 'msg' => 'failed');
            $this->session->set_flashdata('error', 'Please Sign Up');
        }
        echo json_encode($msg);
    }

    public function checkEmailAjax()
    {

        $this->form_validation->set_rules('email', 'email', 'required');
        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $resultEmail = $this->db->get_where('users', array('email' => $email,'user_type' => 'USER'))->row_array();
            if (!empty($resultEmail)) {
                $remember = 0;
                $result = $this->admin_model->loginFacebookGoogle($resultEmail['username'], $resultEmail['password'], $remember);

                if ($result['status'] == 'BLOCKED') {
                    $this->session->set_flashdata('error', 'Please contact to admin');
                    // redirect('Login/login');
                    $msg = array('err' => '400', 'url' => base_url() . "login");
                }
                if ($result['status'] == 'ACTIVE') {
                    if ($result['user_type'] == 'ADMIN') {
                        $this->session->set_flashdata('success', 'Welcome, you have logged in successfully.');
                        // redirect('admin/dashboard');
                        $msg = array('err' => '400', 'url' => base_url() . "admin/dashboard");
                    } else {
                        $this->session->set_flashdata('success', 'Welcome, you have logged in successfully.');
                        // redirect('blog/index');
                        $msg = array('err' => '400', 'url' => base_url());
                    }
                }

            }else{
                $this->session->set_flashdata('error', 'Invalid User');
                $msg = array('err' => '400', 'url' => base_url() . "login");
            }

        } else {
            $msg = array('err' => '400', 'url' => base_url() . "Login/login");
        }

        echo json_encode($msg);
    }

    public function googles()
    {
        // google();
        $this->load->view("admin/google");

    }

    //user registration
    public function registration()
    {
        $this->form_validation->set_rules('username', 'Name', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('first_name', 'Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last_Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('passwordAgain', 'password Again', 'required|matches[password]|xss_clean|trim');
        $this->form_validation->set_rules('phone_no', 'phone_no', 'required');
        if ($this->form_validation->run() == true) {
            $id = $this->user_model->registration($this->input->post());
            if ($id > 0) {
                redirect("users/draftList");
            }

        }
        $this->load->view("admin/register");
    }

    public function signUpWithGoogle()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        if ($this->form_validation->run()) {
            $result = $this->user_model->signUpWithGoogle($this->input->post());
            echo json_encode($result);
        }

    }

    public function signUpWithFacebook()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        if ($this->form_validation->run()) {
            $result = $this->user_model->signUpWithFacebook($this->input->post());
        } else {
            $result = array('error' => 0, 'msg' => 'Please verify your email ', 'url' => base_url() . "users/registration");
            $this->session->set_flashdata('error', 'Please verify your email ');
        }
        echo json_encode($result);
    }

    // check existing username
    public function checkUserUsername()
    {
        $user = $this->input->post('username');
        if ($this->db->get_where('users', array('username' => $user))->num_rows() === 0) {
            $return = true;
        } else {
            $return = false;
        }
        echo json_encode($return);
    }
    // check existing Email
    public function checkUserEmail()
    {
        $email = $this->input->post('email');
        if ($this->db->get_where('users', array('email' => $email))->num_rows() === 0) {
            $return = true;
        } else {
            $return = false;
        }
        echo json_encode($return);
    }
    // check existing username excluding self username
    public function checkUserEditUsername()
    {
        $user = $this->input->post('username');
        $id = $this->input->post('id');
        if ($this->db->get_where('users', array('username' => $user, 'id!=' => $id))->num_rows() === 0) {
            $return = true;
        } else {
            $return = false;
        }
        echo json_encode($return);
    }
    // check existing username excluding self email
    public function checkUserEditEmail()
    {
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        if ($this->db->get_where('users', array('email' => $email, 'id!=' => $id))->num_rows() === 0) {
            $return = true;
        } else {
            $return = false;
        }
        echo json_encode($return);
    }
    // Block users
    public function unblockusers()
    {
        $id = $_GET['id'];
        $this->query_model->updateData('users', array('status' => 'ACTIVE'), 'id', $id);
        $this->session->set_flashdata('success', 'Record Updated successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // Unlock users
    public function blockusers()
    {
        $id = $_GET['id'];
        $this->query_model->updateData('users', array('status' => 'BLOCKED'), 'id', $id);
        $this->session->set_flashdata('success', 'Record Updated successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // users referrals list
    public function referralList()
    {
        $id = $this->input->post('id');

        $data = $this->user_model->referralList($id);
        echo json_encode($data);
    }
//userslisting
    public function users()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'users';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'users';
        $this->load->view('admin/basetemplate', $data);
    }

    // user ajax for user data Listing
    public function usersajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalUserlist = $this->user_model->getAllusersAjaxCount($searchVal, $id);
        if ($totalUserlist) {
            $userList = $this->user_model->getAllusersAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($userList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['username']);
                array_push($row, $item['email']);
                array_push($row, $item['phone_no']);
                array_push($row, date_format(date_create($item['added_on']), table_date));

                array_push($row, $item['status']);

                $referrals = "";
                $referrals .= ' <a  href="#modal2" id="btnshow" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow modal-trigger tooltipped modal-trigger " style="margin-top: 4px;" data-id="' . $item['id'] . '" data-tooltip="Referrals">
                <i class="material-icons" >remove_red_eye</i></a>';

                $action = "";
                if ($item['status'] == 'BLOCKED') {
                    $action .= '<a  href="#modal1" id="btn" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-green-teal gradient-shadow modal-trigger tooltipped deletecustBtn modal-trigger " style="margin-top: 4px;" data-id="' . $item['id'] . '" data-tooltip="Active">
                    <i class="material-icons" >check</i></a>';
                } elseif ($item['status'] == 'ACTIVE') {
                    $action .= '<a href="#modal1" id="btn" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deletecustBtn modal-trigger " style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Block">
                            <i class="material-icons" >block</i></a>';
                } else {

                }
                array_push($row, $referrals);
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

    public function subscription($id)
    {
        if (empty($id)) {
            if ($this->session->userdata('id')) {
                redirect(base_url() . 'users/draftList');
            } else {
                redirect(base_url() . 'login');
            }
        }
        $data['header'] = true;
        $data['_view'] = 'subscription';
        $data['footer'] = true;
        $data['active_tab'] = 'users';
        $data['order_id'] = getOrderId(1000, 2345);
        $data['id'] = $this->user_model->userDetail($id);
        $this->load->view('admin/basetemplate', $data);

    }
    public function razorPaySuccess()
    {
        $result = $this->user_model->razorPaySuccess($this->input->post());
        echo json_encode($result);
    }

    public function RazorThankYou()
    {
        redirect(base_url() . 'users/draftList');
    }

//update users profile.
    public function edituserprofile()
    {

        if (isset($_POST['image']) && isset($_POST['username']) && !empty($_POST['username'])) {
            $this->form_validation->set_rules('about_me', 'about_me', 'required');
            $this->form_validation->set_rules('username', 'Name', 'required');
            $this->form_validation->set_rules('first_name', 'Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last_Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone_no', 'phone_no', 'required');
            // $this->form_validation->set_rules('unlinkprofile_image', 'unlink_image', 'required');
            $data = $this->input->post();
            if ($this->form_validation->run() == true) {
                $this->user_model->edituserprofile($data);
                $this->session->set_flashdata('success', 'Profile Updated successfully');
                if ($this->session->user_type == 'USER') {
                    redirect(base_url() . 'users/edituserprofile');
                } else {
                    redirect(base_url() . 'users/edituserprofile');
                }
            }
        }
        $data = $this->data;
        // $data['id'] = $_GET['id'];
        $data['header'] = true;
        $data['_view'] = 'edituserprofile';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'users';
        $data['member_details'] = $this->query_model->get_single_row('users', '*', array('id' => $this->session->id));
        $this->load->view('admin/basetemplate', $data);
    }
    //changeUserPassword.
    public function changeUserPassword()
    {
        if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
            $this->form_validation->set_rules('new_password', 'new_password', 'required|xss_clean|trim');
            $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|xss_clean|trim|matches[new_password]');
            if ($this->form_validation->run() == true) {
                $this->user_model->changeUserPassword($this->input->post());
                $this->session->set_flashdata('success', 'Password Updated successfully');
                redirect(base_url() . 'users/draftList');
            }
        }
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'changeUserPassword';
        $data['title'] = 'changeUserPassword';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'users';
        $this->load->view('admin/basetemplate', $data);
    }

    public function userBlogProfile($id)
    {
        $full_name = str_replace('@','',$id);
    
        $name =  explode(".",$full_name);
       
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'usersBlogProfile';
        $data['title'] = 'blogList';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'blogList';
        $data['usersBlogProfile'] = $this->query_model->get_single_row('users', '*', array('first_name' => $name[0],'last_name' => $name[1]));
        // echo $this->db->last_query();exit;
        // $data['categories'] = $category;
        $is_follow = $this->db->get_where('followers', array('following_id' => $this->session->id,'follower_id' => $data['usersBlogProfile']['id']))->row_array();
        $data['is_follow']  = $is_follow;  
        $data['count']['count_follower'] =  $this->db->where('follower_id',$data['usersBlogProfile']['id'])->count_all_results('followers');        
        $data['count']['count_following'] =  $this->db->where('following_id',$data['usersBlogProfile']['id'])->count_all_results('followers');        

        $this->load->view('admin/basetemplate', $data);
    }

    public function draftList()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'blogList';
        $data['title'] = 'blogList';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'blogList';
        // $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("user_id" => $this->session->userdata("id")), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // blogList ajax
    public function draftListajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalBloglist = $this->user_model->getAllblogListajaxCount($searchVal, $id);
        if ($totalBloglist) {
            $blogList = $this->user_model->getAllblogListAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($blogList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                array_push($row, date_format(date_create($item['date']), table_date));
                // array_push($row, $item['update_date']);

                $action = "";

                $action .= '<a href="' . base_url() . 'blog/detail/' . $item['id'] . '"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="View">
                <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp';

                $action .= '<a href="' . base_url() . 'users/blogEdit/' . $item['id'] . '" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped modal-trigger " style="margin: 2px;" data-id="' . $item['id'] . '"   data-tooltip="Edit">
                <i class="material-icons">edit</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1" id="btn" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deleteBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Delete">
                <i class="material-icons" >delete</i></a>';

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

    
    public function addBlog()
    {
        // pr($this->input->post());exit;
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('blog_type', 'blog type', 'required');
        $this->form_validation->set_rules('detail', 'details', 'required');
        $this->form_validation->set_rules('crole', 'category type', 'required');
        if ($this->form_validation->run()) {
            if ($this->user_model->addBlog($this->input->post())) {
                $this->session->set_flashdata('success', 'Blog Added successfully');
                // email($userArray['email'], 'sanjeev.m@infiny.in', $emailContent);
                redirect('users/draftList');
            } //not insert
        } else {
            $data['header'] = true;
            $data['_view'] = 'addBlog';
            $data['title'] = 'add Blog';
            $data['sidebar'] = true;
            $data['footer'] = true;
            $data['active_tab'] = 'addBlog';
            if($this->session->userdata("user_type")=='ADMIN'){
                $data['categoryDrop'] = $this->db->get_where('categories', array('isPublic' => 'FALSE'))->result_array();
            }else{
                $data['categoryDrop'] = $data['categoryDrop'] = $this->db->get_where('categories', array('isPublic' => 'TRUE'))->result_array();
            }
            $data['blogList'] = $this->user_model->Categories();
            $this->load->view('admin/basetemplate', $data);
        }
    }

    public function blogEdit($id)
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('blog_type', 'blog type', 'required');
        $this->form_validation->set_rules('detail', 'details', 'required');
        $this->form_validation->set_rules('crole', 'category type', 'required');
        $this->form_validation->set_rules('id', ' id ', 'required');
        if ($this->form_validation->run()) {
            if ($this->user_model->updateBlog($this->input->post())) {
                $this->session->set_flashdata('success', 'Blog Updated successfully');
                redirect('users/draftList');
            }
        }
        $data['header'] = true;
        $data['_view'] = 'editBlog';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['categoryDrop'] = $this->db->get('categories')->result_array();
        $data['row'] = $this->user_model->get_where($id);
        $data['selected'] = $this->query_model->get_single_row('categories', 'name', array('id' => 1));
        $data['id'] = $id;
        $this->load->view('admin/basetemplate', $data);
    }
    public function blogDelete($id)
    {
        $this->db->where('id', $id)->delete('blog');
        $this->session->set_flashdata('success', 'Blog Deleted successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function update()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('detail', 'details', 'required');
        if (!$this->form_validation->run()) {
            $data['_view'] = 'edit';
            $this->load->view('admin/basetemplate', $data);
        } else {
            if ($this->user_model->update($this->input->post())) {
                redirect('users/draftList');
            }
        }
    }
    public function publish()
    {
        $data['header'] = true;
        $data['_view'] = 'publish';
        $data['sidebar'] = true;
        $data['footer'] = true;
        // $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("is_publish" => 'PUBLISH','user_id'=>$this->session->id), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // blogList ajax
    public function publishajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalBloglist = $this->user_model->getAllpublishajaxCount($searchVal, $id);
        if ($totalBloglist) {
            $blogList = $this->user_model->getAllpublishAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($blogList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                array_push($row, date_format(date_create($item['date']), table_date));

                $action = "";

                $action .= '<a href="' . base_url() . 'blog/detail/' . $item['id'] . '"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="View">
                <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp';

                $action .= '<a href="' . base_url() . 'users/blogEdit/' . $item['id'] . '" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped modal-trigger " style="margin: 2px;" data-id="' . $item['id'] . '"   data-tooltip="Edit">
                <i class="material-icons">edit</i></a>&nbsp&nbsp';

                $action .= '<a href="#modal1" id="btn" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deleteBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Delete">
                <i class="material-icons" >delete</i></a>';

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

    public function unPublish()
    {
        $data['header'] = true;
        $data['_view'] = 'unPublish';
        $data['sidebar'] = true;
        $data['footer'] = true;
        // $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("is_publish" => 'UNPUBLISH','user_id'=>$this->session->id), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // unpublishList ajax
    public function unpublishajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalBloglist = $this->user_model->getAllunpublishajaxCount($searchVal, $id);
        if ($totalBloglist) {
            $blogList = $this->user_model->getAllunpublishAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($blogList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                array_push($row, date_format(date_create($item['date']), table_date));

                $action = "";

                $action .= '<a href="' . base_url() . 'blog/detail/' . $item['id'] . '"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow modal-trigger tooltipped" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="View">
                <i class="material-icons">remove_red_eye</i></a>&nbsp&nbsp&nbsp';

                $action .= '<a href="#modal1" id="btn" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deleteBtn" style="margin-top: 4px;" data-id="' . $item['id'] . '"  data-tooltip="Delete">
                <i class="material-icons" >delete</i></a>';

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

    public function viewInDetail($id, $user_id)
    {
        $data['header'] = true;
        $data['_view'] = 'viewInDetail';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['blogList'] = $this->user_model->get_where($id);
        $this->load->view('admin/basetemplate', $data);
    }
    public function category()
    {
        $this->form_validation->set_rules('category', 'category', 'numeric|required');
        if ($this->form_validation->run() == true) {
            $a = $this->user_model->category($this->input->post());

        } else {
            echo "something went wrong";
        }
        echo json_encode($a);
    }
    public function get()
    {
        $data['pending'] = $this->query_model->curl();
        // pr($data['pending']);exit;
    }
    public function curl()
    {
        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, base_url() . "users/get");
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $output contains the output string
        $output = curl_exec($ch);
        pr($output);
        // close curl resource to free up system resources
        curl_close($ch);
    }

    // for notification List
    public function notification()
    {
        $data['header'] = true;
        $data['_view'] = 'notification';
        $data['sidebar'] = true;
        $data['footer'] = true;
        // $data['notification'] = $this->user_model->get_select_arr('notification', '*','','id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // notification ajax
    public function notificationajax($id = 0)
    {
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalUserlist = $this->user_model->getAllnotificationajaxCount($searchVal, $id);
        if ($totalUserlist) {
            $userList = $this->user_model->getAllnotificationAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset, $id);
            $i = $offset;
            foreach ($userList as $key => $item) {
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $item['title']);
                array_push($row, date_format(date_create($item['added_on']),table_date));
                $action = "";
                $action .= '<span  id="" data-toggle="modal1" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deleteBtn" style="margin-top: 4px;" data-Notification-id="' . $item['id'] . '"  data-tooltip="Delete">
                <i class="material-icons" >delete</i></span>';
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

    // if user seen notification then count will be decrease
    public function UserNotificationSeen()
    {
        $userNotification = array();
        if ($_POST) {
            $notyfyId = $this->input->post('id');
            if ($notyfyId == 0) {

                $userNotification = $this->user_model->userNotificationCount();

            } else {
                $this->db->set('status', 0)->where(array('user_id' => $this->session->id, 'notification_id' => $notyfyId))->update('notification_status');
                //   $userNotification = $this->user_model->userNotification();
                $userNotification = $this->user_model->userNotificationCount();

            }
            echo json_encode($userNotification);
        }
    }

    public function allNotification()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        if ($this->form_validation->run()) {
            $template = '';
            $notifyid = $this->input->post('id');
            $id = $this->session->id;
            $this->db->select('*');
            $this->db->from('notification');
            // $this->db->join('notification_status', 'notification_status.notification_id = notification.id');
            $where = ($this->session->user_type == 'ADMIN') ? array("$id") : array("ALL", "$id");
            $query = $this->db->where_in('user_id', $where)->where("id < ", $notifyid)->order_by('id', 'desc')->limit(4)->get()->result_array();
            // echo json_encode($query);
            
           
            foreach ($query as $key => $value) {
                $template .= '
                <li class="mainList" data-notificationsid='.$value['id'].'>
                <a href='.base_url().$value['url'].'  rel="noopener noreferrer">
                        <div class="grey-text text-darken-2 valign-wrapper">
                        <span class="material-icons icon-bg-circle cyan small ">message</span>
                        <span class="pl-2 ">
                      '.$value['title'].'
              </span>
            </div>
              <time class="media-meta">'.date_format(date_create($value['added_on']), table_date).'
             </time>  
             </a>           
            </li>';
            }
            $template .='<li class="center-align waves-effect btn-flat" id="moreNotification">
                         More Notification</li>';
             $msg = array('err' => 0,'msg' => $template );

        } else {
            $msg = array('err' => 400, 'msg' => 'something went wrong');
        }
        echo json_encode($msg);
    }


    public function clearNotification()
    {  
        $data = array('status' => 1);
        $this->db->where('user_id',$this->session->id);
        $this->db->update('notification_status', $data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function allNotificationSeen()
    {
        $this->form_validation->set_rules('status', 'status', 'required');
        if ($this->form_validation->run()) {
            $data = array(
                'status' => 1,
        );
        $this->db->where('user_id', $this->session->id);
        $this->db->where('status', 0);
        $msg =  ($this->db->update('notification_status', $data))? array('error' => 0 , 'msg' => 'record           updated'):array('error' => 400 , 'msg' => 'something went wrong');
        // echo $this->db->last_query();
        // exit;
       }
        echo json_encode($msg);
    }

    // for add new notification by admin
    public function addNotification()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        if ($this->form_validation->run()) {
            if ($this->user_model->addNotification($this->input->post())) {
                $this->session->set_flashdata('success', 'Notification Added Successfully');
                redirect('users/notification');
            } //not insert
        } else {
            $data['header'] = true;
            $data['_view'] = 'addNotification';
            $data['sidebar'] = true;
            $data['footer'] = true;
            $this->load->view('admin/basetemplate', $data);
        }
    }
}
