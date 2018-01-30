<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
	      parent::__construct();
	      
	      $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
	      $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
	      $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
	      $this->output->set_header('Pragma: no-cache');
	      $this->load->helper('url');   /***** LOADING HELPER TO AVOID PHP ERROR ****/
	      $this->load->model('Technical_Login_Model','technical_login_model'); /* LOADING MODEL * Welcome_model as welcome */
	      $this->load->library('session');   

	} 
	public function index()
	{	
		  $this->load->view('header');
         $this->load->view('login');
	}

	//** login **//
	public function login()
	{
		$data = array('user_name'   => $this->input->post('Username'),
		              'password'    => $this->input->post('Password') );
		$uname =  $this->input->post('Username');
		$insert = $this->technical_login_model->login($data);
		if($insert == 1)
		{
		     redirect('Admin_Controller/dashboard');    // goto Admin Controller : Admin
		}        
		else if($insert == 2)
		{
		     redirect('User_Controller/dashboard');   // User Controller: USER
		}
		else
		{
			$this->session->set_flashdata('message', 'Username or Password Wrong..');
			redirect('welcome/index');
		}
	}
	//**LOGOUT**/

	public function logout()
	{
	        $user_data = $this->session->all_userdata();
	        foreach ($user_data as $key => $value) 
	        {
	              if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') 
	              {
	                 $this->session->unset_userdata($key);
	              }
	        }
	       $this->session->sess_destroy();
	      redirect('welcome/index');
	}
}
