<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->allow('facebooklogin','login','logout','changePass','forgotPass','resetPassword');
        $this->allowAdmin();
        $this->allowStaff();
        $this->load->model('admin_model');
        $this->load->model('query_model');
        $this->load->model('pdf_model');
    }

    public function facebooklogin()
    {
        $this->load->view('admin/facebooklogin');
    }
    
//login
    public function login()
    {
        if (!$this->session->userdata('id')) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
            if (!$this->form_validation->run()) {
                $data['_view'] = 'login';
                $this->load->view('admin/basetemplate', $data);
            } else {
                $remember = 0;
                if ($this->input->post('remember_me')) {
                    $remember = 1;
                }
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $result = $this->admin_model->login($username, $password, $remember);
                if ($result['status'] == 'BLOCKED') {
                    $this->session->set_flashdata('error','Please contact to admin');
                    redirect('Login/login');
                }
                if (empty($result)) {
                    $this->session->set_flashdata('error', 'Invalid User');
                    redirect('Login/login');
                }
                if ($result['status'] == 'ACTIVE') {
                    if ($this->session->userdata['user_type'] == 'ADMIN') {
                        $this->session->set_flashdata('success', 'Welcome, you have logged in successfully.');
                        redirect('admin/dashboard');
                    } else {
                        $this->session->set_flashdata('success', 'Welcome, you have logged in successfully.');
                        redirect('blog/index');
                    }
                }
            }
        }else {
            if ($this->session->userdata['user_type'] == 'ADMIN') {
                redirect('admin/dashboard');
            }else {
                redirect('blog/index');
            }
        }
    }

//logout
    public function logout()
    {
        delete_cookie('remember_me', '', '/');
        $this->session->sess_destroy();
        redirect("Login/login");
    }
// changePassword
    public function changePassword()
    {
        $this->form_validation->set_rules('current_password', 'Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
        if ($this->form_validation->run()) {
            if ($this->admin_model->changePassword($this->input->post())) {
                $this->session->set_flashdata('success', 'Password changed successfully!');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong, please try again later!');
            }
            redirect('Login/changePassword');
        } else {
            $data = $this->data;
            $data['header'] = true;
            $data['_view'] = 'changePassword';
            $data['title'] = 'Change Password';
            $data['sidebar'] = true;
            $data['footer'] = true;
            $data['active_tab'] = 'change_password';
            $this->load->view('admin/basetemplate', $data);
        }
    }
// Check Password for change password
    public function checkPassword()
    {
        if ($this->admin_model->checkPassword($this->input->post())) {
            $return = true;
        } else {
            $return = false;
        }
        echo json_encode($return);
    }
// Forgot password()
    public function forgotPass()
    {
        if (!$this->session->userdata('id')) {
            if (!$this->input->post('email')) {
                $this->form_validation->set_rules('username', 'Username', 'required');
            } elseif (!$this->input->post('username')) {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            } else {
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            }
            if (!$this->form_validation->run()) {
                $data['_view'] = 'forgotPass';
                $this->load->view('admin/basetemplate', $data);
            } else {
                $data = $this->data;
                if ($this->admin_model->forgotPass($this->input->post(), $data)) {
                    $this->session->set_flashdata('success', 'Password Recovery Email sent successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Invalid User!');
                }
                redirect('Login/login');
            }
        } else {
            redirect('Login/login');
        }
    }
// Reset Password after forgot password
    public function resetPassword($token = '')
    {
        $data = $this->data;
        $userdata = $this->admin_model->getUserByToken($token);
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
        if ($this->form_validation->run()) {
            if ($this->admin_model->resetPassword($this->input->post())) {
                $this->session->set_flashdata('success', 'Password changed successfully!');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong, please try again later.');
            }
            redirect('Login/login');
        } else {
            $data['header'] = true;
            $data['_view'] = "resetPassword";
            $data['footer'] = true;
            $data['activeTab'] = 'admin';
            $data['userdata'] = $userdata;
            $data['token'] = $token;
            if (empty($data['userdata'])) {
                show_error('Link has been expired!');
            }
            $this->load->view('admin/basetemplate', $data);
        }
    }
}
