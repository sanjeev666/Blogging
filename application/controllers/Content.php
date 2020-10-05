<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->allow();
        $this->allowAdmin('Content');
        $this->allowStaff();
        $this->load->model('admin_model');
        $this->load->model('query_model');
        $this->load->model('pdf_model');

    }

//settlementslisting
    public function Content()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'blog';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'Content';
        $this->load->view('admin/basetemplate', $data);
    }

}
