<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Image extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->allow();
        $this->allowAdmin('uploadajax','pic', 'cropper', 'upload', 'createUpload', 'deleteUpload', 'addupload');
        $this->allowStaff('uploadajax','pic', 'cropper', 'upload', 'createUpload', 'deleteUpload', 'addupload');
        $this->load->model('admin_model');
        $this->load->model('query_model');
        $this->load->model('pdf_model');
        $this->load->database();
    }
    public function cropper()
    {
        $data = $this->data;
        $data['_view'] = 'cropper';
        $data['active_tab'] = 'cropper';
        $data['dropList'] = $this->admin_model->get_select_arr('categories', '*', '', 'id', 'desc');
        $this->load->view('admin/basetemplate', $data);
    }
// add new Images
    public function createUpload()
    {
        if (isset($_POST["image"])) {
            $this->form_validation->set_rules('image', 'image', 'required');
            $this->form_validation->set_rules('img_category', 'img_category', 'required');
            if ($this->form_validation->run() == true) {
                $data = $_POST["image"];
                $image_array_1 = explode(";", $data);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
                $imageName = uniqid().date('y-m-d-H:s') . '.png';
                if(file_put_contents('./assets/upload/' . $imageName, $data))
                {
                    $createimage = array();
                    $createimage['path'] = $imageName;
                    // $createimage['path'] = "./assets/upload/" . $imageName;
                    $createimage['img_category'] = $this->input->post('img_category');
                    $createimage['created_date'] = date('y-m-d H:i:s');
                    $createimage['user_id'] = $this->session->id;
                    $createimage = $this->core_model->insertImages($createimage);
                    $error = array('status' => "image added successfully", 'errors' => "0" );
                    $this->session->set_flashdata('success', 'Image Added Successfully');
                }
                else
                {
                    $error = array('status' => "Something went wrong" ,'errors' => "1" );
                    $this->session->set_flashdata('error', 'something Went Wrong');
                }
             echo json_encode($error);
            } 
        }
    }

// Deleting images
    public function deleteUpload()
    {
        $id = $_GET['id'];
        $a = $this->db->select('path')->get_where('images',array('id' => $id))->row_array();
        if(!empty($a['path']))
        {
            unlink("assets/upload/".$a['path']);
        }
        $this->query_model->delete('images', 'id', $id);
        $this->session->set_flashdata('success', 'Image Deleted successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

//uploadlisting
    public function upload() 
    {  
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'upload';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'users';
        $this->load->view('admin/basetemplate', $data);
    }

     // image listing using ajax 
     public function uploadajax($id=0){
        $data = $_POST;
        $columns = [];
        $page = $data['draw'];
        $limit = $data['length'];
        $offset = $data['start'];
        $searchVal = $data['search']['value'];
        $sortColIndex = $data['order'][0]['column'];
        $sortBy = $data['order'][0]['dir'];
        $totalUploadlist = $this->user_model->getAlluploadAjaxCount($searchVal,$id);
        if($totalUploadlist){
            $uploadList = $this->user_model->getAlluploadAjax($searchVal, $sortColIndex, $sortBy, $limit, $offset,$id);
            $i = $offset;
            foreach ($uploadList as $key => $item){
                $images ="";
                $images .='<img src="'.base_url().'assets/upload/'.$item['path'].'"; style="width:80px; height:auto;">';
               
                $offset++;
                $row = [];
                array_push($row, $offset);
                array_push($row, $images);
                array_push($row, $item['name']);
                array_push($row, date_format(date_create($item['created_date']),table_date));
                
        
                $action ="";
                $action .='<a href="#modal1" data-toggle="modal" type="button" class="btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow modal-trigger tooltipped deletecustBtn modal-trigger " style="margin: 2px;" data-id="'.$item['id']. '" data-tooltip="Delete">
                        <i class="material-icons">delete</i></a>';
                array_push($row, $action);
                $columns[] = $row;
            }
        }
        $response = [
            'draw' => $page,
            'data' => $columns,
            'recordsTotal' => $totalUploadlist,
            'recordsFiltered' => $totalUploadlist,
            '$limit' => $limit,
            '$offset' => $offset
        ];
        echo json_encode($response);
    }

    //image adding page
    public function addupload()
    {
        $data = $this->data;
        $data['header'] = true;
        $data['_view'] = 'addupload';
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['active_tab'] = 'addupload';
        $this->load->view('admin/basetemplate', $data);
    }
}