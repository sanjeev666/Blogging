<?php
class MY_Controller extends CI_Controller
{
	public $allowedActions = array();
	public $allowedAdmin = array();
	public $allowedStaff = array();
	
	public $assertion = TRUE;
	
    function __construct()
    {
        parent::__construct();
       
		 $this->data['userdata'] = $this->core_model->getUserData($this->session->userdata('id'));
	
    }
	
	function allow(){
		$this->allowedActions = array_merge($this->allowedActions, func_get_args());
	}
	
	function allowAdmin(){
		$this->allowedAdmin = array_merge($this->allowedAdmin, func_get_args());
	}
	
	function allowStaff(){
		$this->allowedStaff = array_merge($this->allowedStaff, func_get_args());
	}
	
	function assert($msg){
		if($this->assertion){
			echo '<pre>';
			throw new Exception($msg);
			echo '</pre>';
			exit;
		}
	}

}