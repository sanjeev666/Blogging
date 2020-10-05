<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->allow();
        $this->allowAdmin('categoriesajax','checkCategoryEditname','addCategories', 'editCategories', 'deletecategories', 'createCategories', 'categories','categoryName');
        $this->allowStaff();
        $this->load->model('admin_model');
        $this->load->model('query_model');
        $this->load->model('user_model');
        $this->load->model('pdf_model');

    }

// add new category
    public function createCategories()
    {
        $this->form_validation->set_rules('Categoryname', 'Name', 'required');
        $this->form_validation->set_rules('isPublic', 'isPublic', 'required');
        if ($this->form_validation->run() == true) {
            $this->user_model->createCategories($this->input->post());
            $this->session->set_flashdata('success', 'Record Added successfully');
            redirect(base_url() . 'Category/categories');
        } else {
            $this->load->view('Category/addCategories');
        }
    }

//update category.
    public function editCategories()
    {
        if (isset($_POST['Categoryname']) && !empty($_POST['Categoryname'])) {
            $this->form_validation->set_rules('Categoryname', 'Name', 'required');
            $this->form_validation->set_rules('isPublic', 'isPublic', 'required');
            if ($this->form_validation->run() == true) {
                $this->user_model->editCategories($this->input->post());
                $this->session->set_flashdata('success', 'Record Updated successfully');
                redirect(base_url() . 'Category/categories');
            }
        }
        $data = $this->data;
        $data['id'] = $_GET['id'];
        $data['header'] = true;
        $data['_view'] = 'editCategories';
        $data['title'] = 'editCategories';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'Categories';
        $data['catagory_details'] = $this->query_model->get_single_row('categories', '*', array('id' => $data['id']));
        $this->load->view('admin/basetemplate', $data);
    }

    
// Deleting Categories
    public function deletecategories()
    {
        $id = $_GET['id'];
        $this->query_model->delete('categories', 'id', $id);
        $this->session->set_flashdata('success', 'Record Deleted successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

//categories Listing
    public function categories()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'categories';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'categories';
        // $data['categories'] = $this->admin_model->get_select_arr('categories', '*', '', 'id', 'DESC');
        $this->load->view('admin/basetemplate', $data);
    }

    // categoryListing ajax 
    public function categoriesajax($id=0){
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalUserlist = $this->blog_model->getAllblogCategoryAjaxCount($searchVal,$id);
        if($totalUserlist){
            $userList = $this->blog_model->getAllblogCategoryAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset,$id);
            $i = $offset;
            foreach ($userList as $key => $item){
                $offset++;
                $row = [];
                array_push($row, $key+1);
                array_push($row, $item['name']);
               
                $action ="";
                $action .='<a href="editCategories?id='.$item['id'].'" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped modal-trigger editproductBtn" style="margin-top: 4px;" data-id="'.$item['id'].'"  data-name="'.$item['name'].'" data-tooltip="Edit"><i class="material-icons" style="margin-top: 4px;">edit</i></a>&nbsp&nbsp&nbsp';
                
                $action .='<a href="#modal1"  data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deletecustBtn modal-trigger " style="margin-top: 4px;" data-id="'.$item['id'].'"  data-name="'.$item['name'].'" data-tooltip="Delete"><i class="material-icons" style="margin-top: 4px;">delete</i></a>';
                
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
            '$offset' => $offset
        ];
        echo json_encode($response);
    }


//categories add page
    public function addCategories()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'addCategories';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'categories';
        $this->load->view('admin/basetemplate', $data);
    }

    // check existing category name
    public function categoryName()
    {
        $user = $this->input->post('Categoryname');
        if ($this->db->get_where('categories', array('name' => $user))->num_rows() === 0) {
            $return = true;
        } else {
            $return = false;
        }

        echo json_encode($return);
    }


    // check existing category name excluding self  category name
    public function checkCategoryEditname()
    {
        $user = $this->input->post('Categoryname');
        $id = $this->input->post('id');
        if ($this->db->get_where('categories', array('name' => $user, 'id!=' => $id))->num_rows() === 0) {
            $return = true;
        } else {
            $return = false;
        }

        echo json_encode($return);
    }

}
