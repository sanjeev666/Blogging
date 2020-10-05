<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->allow('resetPassword','login','logout');
        $this->allowAdmin('deleteNotification','dashboard','logout');
        $this->allowStaff();
        $this->load->model('admin_model');
        $this->load->model('blog_model');
        $this->load->model('query_model');
        $this->load->model('pdf_model');
    }
    // login 
    function login()
    {
        if(!$this->session->userdata('id')){
            
            $this->form_validation->set_rules('username', 'username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
            
            if(!$this->form_validation->run())
            {
                $data['_view'] = 'admin_login';
                $this->load->view('admin/basetemplate', $data);
            }
            else
            {
                // $remember = 0;
                // if($this->input->post('remember_me'))
                //  $remember = 1;
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    if($this->admin_model->login($username,$password)){
                        $this->session->set_flashdata('success', 'Welcome, you have logged in successfully.');
                        redirect('admin/dashboard');
                    }else{
                        $this->session->set_flashdata('success', 'Incorrect Password');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
            }
        }
        else{
            redirect('admin/dashboard');
        }
    }
    public function logout()
    {
        delete_cookie('remember_me', '', '/');
        $this->session->sess_destroy();
        redirect("admin/login");
    }
    
// Dashboard for admin
    public function dashboard()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['_view'] = 'dashboard';
        $data['title'] = 'dashboard ';
        $data['active_tab'] = 'dashboard';
        $data['total'] = $this->admin_model->get_table_count('users');
        $data['total_visitor'] = $this->admin_model->get_table_count('visitors');
        $data['totalContent'] = $this->admin_model->get_table_count('categories');
        $this->load->view('admin/basetemplate', $data);
    }
    public function deleteNotification()
    {
        if($_POST)
        {
            $notifyId =   $this->input->post('id');
           $deleteNotification  = $this->db->delete('notification',array('id' => $notifyId)); 
           $deleteNotificationStatus  = $this->db->delete('notification_status',array('notification_id' => $notifyId)) ; 
          if($deleteNotification &&  $deleteNotificationStatus)
            {
                $result['error'] = "deleted-successfully";
            }
            else
            {
                $result['error'] = "something went wrong";
            }
        }
        echo json_encode($result);
        // echo  $this->db->last_query();
        
    }
}