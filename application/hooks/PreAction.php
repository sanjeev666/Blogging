<?php
class PreAction{
	function validate_user(){
		$this->CI =& get_instance();
		if(!$this->CI->session->userdata('id') && !in_array($this->CI->router->method, $this->CI->allowedActions)){
			redirect('Login/login');
		}
		elseif($this->CI->session->userdata('id')){
			switch($this->CI->session->userdata('user_type')){
			case 'ADMIN':
				if(!in_array($this->CI->router->method, $this->CI->allowedAdmin) && !in_array($this->CI->router->method, $this->CI->allowedActions))
					redirect('admin/dashboard');
				break;
			case 'USER':
				if(!in_array($this->CI->router->method, $this->CI->allowedStaff) && !in_array($this->CI->router->method, $this->CI->allowedActions))
					redirect('users/blogList');
				break;
			}
		}
		
	}
}
?>