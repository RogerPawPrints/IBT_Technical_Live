<?php
class Technical_Login_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //** Login **//
    public function login($data)
    {
		$uname = $data['user_name'];
	    $pwd = $data['password'];
	    $result=$this->db->query("SELECT * FROM ibt_technical_admin WHERE Technical_Admin = '".$uname."' AND Technical_Password = '".$pwd."' ");
	    if($result->num_rows() == 1)
	    {
	    	$row =  $result->row();
            $data = array( 'userid' => $row->ibt_technical_Icode,
                           'username' => $row->Technical_Admin,
                           'validated' => true );
            $this->session->set_userdata($data);
            return 1;
	    }
	    else
	    {
	    	$query= $this->db->query("SELECT * FROM ibt_technical_user  WHERE User_Login = '".$uname."'  AND User_Password = '".$pwd."' ");
	    	if($query->num_rows() == 1)
	    	{
	    		$row = $query->row();
	            $data = array(
	            'userid' => $row->User_Icode,
	            'fname' => $row->User_Name,
	            'username' => $row->User_Login,
	            'active' =>$row->User_Leave_Approval_Rights,
	            'gender' =>$row->User_Gender,
	            'validated' => true
	            );
	            $this->session->set_userdata($data);
	            return 2;
	    	}
	    	else
	    	{
	    		return 0;
	    	}
	    }
    }
}