<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'assets/razorpay-php/Razorpay.php';

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->allow('registration', 'subscription', 'checkUserUsername', 'checkUserEmail', 'view', 'viewInDetail', 'login', 'changePass', 'forgotPass', 'resetPassword', 'razorPaySuccess', 'RazorThankYou');
        $this->allowAdmin('addNotification','notification','referralList','checkUserEditUsername','checkUserEditEmail','edituserprofile','category','unPublish', 'publish','blogList', 'addBlog','blogDelete', 'blogEdit','unblockusers', 'blockusers', 'curl', 'get', 'users');
        $this->allowStaff('notificationHeader','category','EditAcDetails','blogDelete', 'blogEdit', 'unPublish', 'publish', 'update', 'changeUserPassword', 'checkUserEditUsername', 'checkUserEditEmail', 'edituserprofile', 'acDetailsInsert', 'userAcDetails', 'blogList', 'addBlog', 'acDetails');
        $this->load->model('admin_model');
        $this->load->model('query_model');
        $this->load->model('pdf_model');
        $this->load->model('blog_model');
        $this->load->model('user_model');

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
             if($id > 0)
             {
                 redirect("users/subscription/$id");
                
             }
           
        } 
           
        $this->load->view("admin/register");
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
        $data['userlisting'] = $this->admin_model->get_select_arr('users', '*', array("user_type" => 'USER'), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    public function subscription($id)
    {
        if(empty($id))
        {
            if($this->session->userdata('id'))
            {
                redirect(base_url() . 'users/blogList');
            }
            else
            {
                redirect(base_url() . 'login');
            }
        }
            $data['header'] = true;
            $data['_view'] = 'subscription';
            // $data['sidebar'] = true;
            $data['footer'] = true;
            $data['active_tab'] = 'users';
            $data['order_id'] = getOrderId(1000, 2345);
            $data['id'] = $this->user_model->userDetail($id);
            $this->load->view('admin/basetemplate', $data);
        
    }

    public function razorPaySuccess()
    {
        $result =$this->user_model->razorPaySuccess($this->input->post());
        echo json_encode($result);
    }
    
    public function RazorThankYou()
    {
        redirect(base_url() . 'users/blogList');
    }

//update users profile.
    public function edituserprofile()
    {  
        
        if (isset($_POST['image']) && isset($_POST['username']) && !empty($_POST['username'])) {
            $this->form_validation->set_rules('username', 'Name', 'required');
            $this->form_validation->set_rules('first_name', 'Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last_Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone_no', 'phone_no', 'required');
            $data = $this->input->post();
            if ($this->form_validation->run() == true) {
                $this->user_model->edituserprofile($data);
                $this->session->set_flashdata('success', 'Profile Updated successfully');
                if($this->session->user_type == 'USER'){
                    redirect(base_url() . 'users/blogList');
                }
                else{
                redirect(base_url() . 'admin/dashboard');
                }
            }
        }
        $data = $this->data;
        $data['id'] = $_GET['id'];
        $data['header'] = true;
        $data['_view'] = 'edituserprofile';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'users';
        $data['member_details'] = $this->query_model->get_single_row('users', '*', array('id' => $data['id']));
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
                redirect(base_url() . 'users/blogList');
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

//users AC Details
    public function acDetails()
    {
        $checkPaid = $this->db->get_where('accountDetails', array('user_id' => $this->session->id))->row_array();
        if (count($checkPaid) > 0) {
            $data = $this->data;
            $data['id'] = $_GET['id'];
            $data['header'] = true;
            $data['_view'] = 'EditAcDetails';
            $data['sidebar'] = true;
            $data['footer'] = true;
            $data['active_tab'] = 'users';
            $data['ac_details'] = $this->query_model->get_single_row('accountDetails', '*', array('user_id' => $data['id']));
            $this->load->view('admin/basetemplate', $data);
        } else {
            $data = $this->data;
            $data['header'] = true;
            $data['_view'] = 'userAcDetails';
            $data['sidebar'] = true;
            $data['footer'] = true;
            $data['active_tab'] = 'users';
            $this->load->view('admin/basetemplate', $data);
        }
    }

// insert users bank Details insert
    public function acDetailsInsert()
    {
        $this->form_validation->set_rules('holdername', 'AC_NUMBER', 'required');
        $this->form_validation->set_rules('acnumber', 'AC_NUMBER', 'required');
        $this->form_validation->set_rules('ifsc', 'IFSC_CODE', 'required');
        if ($this->form_validation->run() == true) {
            $this->user_model->acDetailsInsert($this->input->post());
            $this->session->set_flashdata('success', 'Bank Details Added successfully');
            redirect(base_url() . 'users/blogList');
        }
    }

// edit users bank Details
    public function EditAcDetails()
    {
        if (isset($_POST['holdername']) && !empty($_POST['holdername'])) {
            $this->form_validation->set_rules('holdername', 'AC_NUMBER', 'required');
            $this->form_validation->set_rules('acnumber', 'AC_NUMBER', 'required');
            $this->form_validation->set_rules('ifsc', 'IFSC_CODE', 'required');
            if ($this->form_validation->run() == true) {
                $this->user_model->EditAcDetails($this->input->post());
                $this->session->set_flashdata('success', 'Bank Details Updated successfully');
                redirect(base_url() . 'users/blogList');
            }
        }
    }

    public function blogList()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'blogList';
        $data['title'] = 'blogList';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'blogList';
        $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("user_id" => $this->session->userdata("id")), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);

    }

    
    public function addBlog()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('blog_type', 'blog type', 'required');
        $this->form_validation->set_rules('detail', 'details', 'required');
        $this->form_validation->set_rules('crole', 'category type', 'required');
        if ($this->form_validation->run()) {
            if ($this->user_model->addBlog($this->input->post())) {
                $this->session->set_flashdata('success', 'Blog Added successfully');
                redirect('users/blogList');
            } //not insert
        } else {
            $data['header'] = true;
            $data['_view'] = 'addBlog';
            $data['title'] = 'add Blog';
            $data['sidebar'] = true;
            $data['footer'] = true;
            $data['active_tab'] = 'addBlog';
            $data['categoryDrop'] = $this->db->get('categories')->result_array();
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
            if ($this->user_model->update($this->input->post())) {
                $this->session->set_flashdata('success', 'Blog Updated successfully');
                redirect('users/blogList');
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
                redirect('users/blogList');
            }
        }
    }

    public function publish()
    {
        $data['header'] = true;
        $data['_view'] = 'publish';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("is_publish" => 'PUBLISH','user_id'=>$this->session->id), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    public function unPublish()
    {
        $data['header'] = true;
        $data['_view'] = 'unPublish';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['blogList'] = $this->user_model->get_select_arr('blog', '*', array("is_publish" => 'UNPUBLISH','user_id'=>$this->session->id), 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
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
        if ($this->form_validation->run() == TRUE) {
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
        curl_setopt($ch, CURLOPT_URL, base_url()."users/get");
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
    public function notification(){
        $data['header'] = true;
        $data['_view'] = 'notification';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['notification'] = $this->user_model->get_select_arr('notification', '*','','id', 'DESC');
        $data['notificationList'] = $this->user_model->notification();
        // pr($data['notificationList']);exit;
        $this->load->view('admin/basetemplate', $data);
    }

    // for add new notification by admin 
    public function addNotification(){
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
