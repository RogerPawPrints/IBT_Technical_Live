<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller
{

	public function __construct()
	{
	      parent::__construct();
        if($this->session->username == "")
        {
            redirect('Welcome');
        }
        //$this->load->model('LoginModel','LoginModel');
	      $this->load->helper('url');   /***** LOADING HELPER TO AVOID PHP ERROR ****/
	      $this->load->model('Technical_Admin_Model','technical_admin_model'); /* LOADING MODEL * Technical_Admin_Model as technical_admin_model */
	      $this->load->library('session');
	}

    //** Admin Dashboard**//
	public function dashboard()
	{
		$this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/dashboard');
        $this->load->view('Admin/footer');
	}

	//** Add Client **/
	public function Add_Client()
	{
		$this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Add_Client');
        $this->load->view('Admin/footer');
	}

	//** get project won client **//
	public function get_client()
	{
		$value = $this->input->get('query',true);
		$get_client = $this->technical_admin_model->get_client($value);

		$json = [];

		foreach ($get_client as $key ) {
			 $json[] = $key['Company_Name'];
		}
		echo  json_encode($json);

	}

	//** get Perticular Client Details **/
	public function get_client_Details()
	{
		$Company_Name = $this->input->POST('company',true);
		$get_client = $this->technical_admin_model->get_client_details($Company_Name);

		if($get_client == '1')
		{
            echo 1; // client exit
		}
		else
		{
			echo  json_encode($get_client);
		}

	}

	//** Insert Client **//
	public function insert_client()
	{
		$data = array(  'Client_Company_Name'                => $this->input->post('client_name'),
						'Client_WebURL'                      => $this->input->post('client_web'),
						'Client_Address'                     => $this->input->post('client_Address'),
						'Client_Country'                     => $this->input->post('Country'),
						'Client_State'                       => $this->input->post('State'),
						'Client_City'                        => $this->input->post('City'),
						'Client_Phone_Number'                => $this->input->post('phone'),
						'Client_Company_Email_ID'            => $this->input->post('Email'),
						'Client_Created_By'                  => $this->session->userdata['username'],
						);
		$insert = $this->technical_admin_model->insert_client($data);

		redirect('Admin_Controller/Add_Client');
	}

	//** View Client **//
	public function View_Client()
	{
		$this->data['contacts_details']= $this->technical_admin_model->get_contacts();
		$this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/View_Client',$this->data, FALSE);
        $this->load->view('Admin/footer');
	}
    public function View_Client_Details()
    {
        $this->data['contacts_details']= $this->technical_admin_model->get_All_client();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/View_Client_Details',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }


	//** Ecit Contact Details **//
	public function Edit_Contact()
	{
		$Contact_id = $this->input->POST('id',true);
		$contact = $this->technical_admin_model->get_perticular_contacts($Contact_id);
		$output = null;
		foreach ($contact as $row)
	      {
	      	$output .="<div class='row'>";
	      	 $output .="<div class='col-md-12'>";
	      	 $output .="<div class='form-group'>";
	      	 $output .= "<input type='hidden' id='contact_id'  class='form-control' name='contact_id' value='".$row['Contact_ID']."'> </br>";
	      	 $output .= "<input type='hidden' id='client_contact_id'  class='form-control' name='client_contact_id' value='".$row['Contact_Client_Icode']."'> </br>";
	      	 $output .= "Contact Name:<input type='text' id='contact_name'  class='form-control' name='contact_name' value='".$row['Contact_Name']."'> </br>";
	      	 $output .="</div>";
	      	 $output .="<div class='form-group'>";
	      	 $output .= "Designation:<input type='text' id='contact_desig'  class='form-control' name='contact_desig' value='".$row['Contact_Designation']."'> </br>";
	      	 $output .="</div>";
	      	 $output .="<div class='form-group'>";
	      	 $output .= "Contact Number:<input type='text' id='contact_phone1'  class='form-control' name='contact_phone1' value='".$row['Contact_Number']."'> </br>";
	      	 $output .="</div>";
	      	 $output .="<div class='form-group'>";
	      	 $output .= "Contact Email:<input type='text' id='contact_email'  class='form-control' name='contact_email' value='".$row['Contact_Email']."'> </br>";
	      	 $output .="</div>";
	      	 $output .="<div class='form-group'>";
	      	 $output .= "Contact IM:<input type='text' id='contact_im'  class='form-control' name='contact_im' value='".$row['Contact_IM']."'> </br>";
	      	 $output .="</div>";
	      	 $output .="</div>";
	      	  $output .="</div>";
	      }
	       echo $output;
	}

	//** Update Conatct Details **//
	public function Update_Contact()
	{
		$id= $this->input->post('id',true);
		$contact =array('Contact_Client_Icode'               => $this->input->post('client_id',true),
						'Contact_Name'                       => $this->input->post('contact_Name',true),
						'Contact_Designation'                => $this->input->post('Desig',true),
						'Contact_Number'                     => $this->input->post('Phone',true),
						'Contact_Email'                      => $this->input->post('Email',true),
						'Contact_IM'                         => $this->input->post('IM',true),
						'Contact_Modified_By'                 => $this->session->userdata['username'],
						'Contact_Modified_On'                 =>date('Y-m-d'));

		$this->db->where('Contact_ID',$id);
        $this->db->update('ibt_client_contacts',$contact);
        echo 1;

	}

	//** Delete Contact **//
	public function Delete_Contact()
	{
		$id= $this->input->post('id',true);
		$checkval = $this->technical_admin_model->delete_contacts($id);
		if($checkval == '1')
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	//** Contract **//
	public function Contract()
	{
		$this->data['contract_details']= $this->technical_admin_model->get_contract();
		$this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Contract',$this->data, FALSE);
        $this->load->view('Admin/footer');
	}

	//** Insert Contract **//
	public function insert_contract()
	{
		 $data = array('Contracttype_Name'                   => $this->input->post('contract_name'),
                       'Contracttype_Created_By'             => $this->session->userdata['username'] );
	     $insert = $this->technical_admin_model->insert_contract($data);
	     redirect('Admin_Controller/Contract');
	}
	//** Delete Contract **//
	public function delete_contract()
	{
		 $id= $this->input->post('id',true);
		$checkval = $this->technical_admin_model->delete_contract($id);
		if($checkval == '1')
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	//** Work **//
	public function Work()
	{
		$this->data['work_details']= $this->technical_admin_model->get_work_category();
		$this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Work_Category',$this->data, FALSE);
        $this->load->view('Admin/footer');
	}
	public function insert_work_category()
	{
	   $data = array('WorkCategory_Name'                   => $this->input->post('category_name'),
	                 'WorkCategory_Created_By'             => $this->session->userdata['username'] );
	    $insert = $this->technical_admin_model->insert_work_category($data);
	    redirect('Admin_Controller/Work');
	}
	//** Delete Contract **//
	public function delete_work()
	{
		 $id= $this->input->post('id',true);
		$checkval = $this->technical_admin_model->delete_work($id);
		if($checkval == '1')
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	//** Add Contact */
    public  function  Add_Contact()
    {
        $this->data['Client']= $this->technical_admin_model->get_All_client();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Add_Contact',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** Get Company Details */
    public  function  get_Company_Details()
    {
        $id= $this->input->post('id',true);
        $data= $this->technical_admin_model->Select_Company_Details($id);
        echo  json_encode($data);
    }

    //** Insert Contact */
    public  function  insert_contact()
    {
        $contact =  $this->input->post('contact_name');
        $count = sizeof($contact);
        $desig = $this->input->post('contact_desig');
        $phone = $this->input->post('contact_phone1');
        $email = $this->input->post('contact_email');
        $im = $this->input->post('contact_im');
        for($i=0; $i<$count; $i++)
        {
            $contacts = array('Contact_Client_Icode' =>  $this->input->post('Company_code'),
                            'Contact_Name' => $contact[$i],
                            'Contact_Designation' =>$desig[$i] ,
                            'Contact_Number' => $phone[$i],
                            'Contact_Email' => $email[$i],
                            'Contact_IM' => $im[$i],
                            'Contact_Created_By' => $this->session->userdata['username']);
            $insert = $this->technical_admin_model->insert_client_contact($contacts);
        }
        redirect('Admin_Controller/View_Client');

    }

    //** Work Type **//
    public function Work_Type()
    {
        $this->data['Work_Type']= $this->technical_admin_model->get_Work_Type();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Work_Type',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** Inserty insert_Work_Type */
    public  function insert_Work_Type()
    {
        $data = array('Work_Name'                   => $this->input->post('Work_Type_name'),
                      'Work_Type_Created_By'             => $this->session->userdata['username'] );
        $insert = $this->technical_admin_model->insert_Work_Type($data);
        redirect('Admin_Controller/Work_Type');
    }
    //** Delete Work Type  **//

    public function Delete_Work_Type()
    {
        $id= $this->input->post('id',true);
        $checkval = $this->technical_admin_model->delete_work_Type($id);
        if($checkval == '1')
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    //** Phase_Master */
    public function Phase_Master()
    {
        $this->data['Phase_Master']= $this->technical_admin_model->get_Phase_Master();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Phase_Master',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** insert_Phase_Master */
    public  function  insert_Phase_Master()
    {
        $data = array('Phase_Name'                   => $this->input->post('Phase_master_name'),
                      'Phase_Created_By'             => $this->session->userdata['username'] );
        $insert = $this->technical_admin_model->insert_Phase_Master($data);
        redirect('Admin_Controller/Phase_Master');
    }
    //** Delete Delete_Phase_Master**//
    public function Delete_Phase_Master()
    {
        $id= $this->input->post('id',true);
        $checkval = $this->technical_admin_model->Delete_Phase_Master($id);
        if($checkval == '1')
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    //** Role_Master */
    public function Role_Master()
    {
        $this->data['Role_Master']= $this->technical_admin_model->get_Role_Master();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Role_Master',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** insert_Phase_Master */
    public  function  insert_Role_Master()
    {
        $data = array('Role_Name'                   => $this->input->post('Role_master_name'),
                     'Role_Created_By'             => $this->session->userdata['username'] );
        $insert = $this->technical_admin_model->insert_Role_Master($data);
        redirect('Admin_Controller/Role_Master');
    }

    //** Start: PROJECT  */

    //** Create Project */
    public function Create_Project()
    {
        $this->data['Work_Type']= $this->technical_admin_model->get_Work_Type();
        $this->data['Role_Master']= $this->technical_admin_model->get_Role_Master();
        $this->data['Phase_Master']= $this->technical_admin_model->get_Phase_Master();
        $this->data['Client']= $this->technical_admin_model->get_All_client();
        $this->data['work_details']= $this->technical_admin_model->get_work_category();
        $this->data['contract_details']= $this->technical_admin_model->get_contract();
        $this->data['Member']= $this->technical_admin_model->get_technical_member();
        $this->data['technical']= $this->technical_admin_model->get_technical_platform();
        $this->data['industries']= $this->technical_admin_model->get_Industries();
        $this->data['domain']= $this->technical_admin_model->get_Domain();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Create_Project',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }

    //** Get Client Based Contact */
    public function get_Client_Contact()
    {
        $client_id= $this->input->post('id',true);
        $data['Client_Contact']= $this->technical_admin_model->get_Client_Contact($client_id);
        $output = null;
        $i = 1;
        foreach ($data['Client_Contact'] as $key )
        {
            $output .="<tr>";
            $output .="<td><input type='checkbox' class='case' name='case' value=".$key['Contact_ID']."></td>";
            $output .="<td>" .$i . "</td>";
            $output .="<td>" .$key['Contact_Name'] . "</td>";
            $output .="<td>" .$key['Contact_Designation'] . "</td>";
            $output .="<td>" .$key['Contact_Number'] . "</td>";
            $output .="<td>" .$key['Contact_Email'] . "</td>";
            $output .="<td>" .$key['Contact_IM'] . "</td>";
            $output .="</tr>";
            $i++;

        }
        echo $output;

    }
    //** Get Member Designation */
    public function get_Member_Details()
    {
        $member_id = $this->input->post('id',true);
        $data= $this->technical_admin_model->get_Member_Details($member_id);
        echo  json_encode($data);
    }

    //** Insert Fixed Cost Project */
    public function Save_Fixed()
    {

        $project = $this->input->post('Project_Name',true);                       //project_name
        $Client_Id = $this->input->post('Client_Id',true);                        //Client
        $Work_Category = $this->input->post('Work_Category',true);                //Work Category
        $Work_type = $this->input->post('Work_type',true);                        //Work Type
        $client_con = $this->input->post('Client_Contact',true);                 // Client Contact Checkbox

        $client_c= trim($client_con,",");
        $Lost = explode(',', $client_c);
        $client_contact = count($Lost);// Trim Comma

        $client_contract = $this->input->post('Contract',true);                 // Contract Type
        $project_Wo = $this->input->post('project_WO',true);
        $project_Start = $this->input->post('Project_Start',true);
        $project_End = $this->input->post('Project_End',true);
        $project_Hour = $this->input->post('Est_Hour',true);

        $phase = $this->input->post('Phase',true);
        $phase_start = $this->input->post('Phase_Start',true);
        $phase_end = $this->input->post('Phase_End',true);
        $phase_Hour = $this->input->post('Phase_Hour',true);
        $count_Phase = sizeof($phase);



        $Modules = $this->input->post('Module',true);
        $count_Modules = sizeof($Modules);

        $Member = $this->input->post('Members',true);
        $Desig = $this->input->post('Designation',true);
        $Role = $this->input->post('Role_master',true);
        $Member_Start = $this->input->post('Member_Start',true);
        $count_Member = sizeof($Member);

        //** Save Project Data */

        $project_data = array('Project_Name' => $this->input->post('Project_Name',true),
            'Project_Client_Icode ' => $this->input->post('Client_Id',true),
            'Project_Work_Category_Icode'  => $this->input->post('Work_Category',true),
            'Project_Work_Type_Icode'  => $this->input->post('Work_type',true),
            'Project_Contract_Icode'  => $this->input->post('Contract',true),
            'Project_WO_Date'  => $this->input->post('Proj_WO',true),
            'Project_Start_Date'  => $this->input->post('Proj_start',true),
            'Planned_End_Date'  => $this->input->post('Proj_End',true),
            'Actual_End_Date'  => 'Not Specified',
            'Estimation_Hours '  => $this->input->post('Est_Hour',true),
            'Technical_Platform'=> $this->input->post('Technical',true),
            'Technical_Skill'=> $this->input->post('Skill',true),
            'Project_Industries_Icode'=> $this->input->post('Industries',true),
            'Project_Domain_Icode'=> $this->input->post('Domain',true),
            'Project_Status' => '1',
            'Project_Created_By '  => $this->session->userdata['userid']);
        $insert_project = $this->technical_admin_model->Insert_Fixed_Cost($project_data);
        if($insert_project != '0')
        {

            mkdir('Repository/'.$project, 0777, TRUE);
            //** Save Project Client Contact Data */
            for($i=0; $i<$client_contact; $i++)
            {
                $project_Contact = array('Proj_Project_Icode ' => $insert_project,
                    'Project_Client_Icode' =>$this->input->post('Client_Id',true),
                    'Client_Contact_Icode' => $Lost[$i],
                    'Project_Contact_Created_By' =>$this->session->userdata['userid']);
                $insert_project_contact = $this->technical_admin_model->insert_project_contact($project_Contact);
                if($insert_project_contact == 1)
                {
                   // print_r("Success");
                }
                else{
                   // print_r("Faild");
                }
            }

            //** Save Project Phase Data */
            for($i=0; $i<$count_Phase; $i++)
            {
                $project_phase = array('Proj_Project_Icode ' => $insert_project,
                    'Phase_Master_Icode' => $phase[$i],
                    'Phase_Start_Date' => $phase_start[$i],
                    'Phase_End_Date' => $phase_end[$i],
                    'Estimate_Hour' => $phase_Hour[$i],
                    'Created_By' =>$this->session->userdata['userid']);
                $insert_project_phase = $this->technical_admin_model->insert_project_phase($project_phase);
                if($insert_project_phase == 1)
                {
                   // print_r("Success");
                }
                else{
                   // print_r("Faild");
                }
            }

//            //** Save Project Modules Data */
            for($i=0; $i<$count_Modules; $i++)
            {
                $project_modules = array('Proj_Project_Icode' => $insert_project,
                    'Module_Name' => $Modules[$i],
                    'Created_By' =>$this->session->userdata['userid']);
                $insert_project_modules = $this->technical_admin_model->insert_project_modules($project_modules);
                if($insert_project_modules == 1)
                {
                   // print_r("Success");
                }
                else{
                   /// print_r("Faild");
                }
            }
            //** Save Project Member */
            for($i=0; $i<$count_Member; $i++)
            {
                $project_member = array('Proj_Project_Icode ' => $insert_project,
                    'User_Icode' => $Member[$i],
                    'User_Designation' => $Desig[$i],
                    'Role_Master_Icode' => $Role[$i],
                    'Work_Start_Date' => $Member_Start[$i],
                    'Created_By' =>$this->session->userdata['userid']);
                $insert_project_member = $this->technical_admin_model->insert_project_member($project_member);
                if($insert_project_member == 1)
                {
                  //  print_r("Success");
                }
                else{
                   // print_r("Faild");
                }
            }
            echo 1;
        }
        else{
            echo 0;
        }
    }


    //** End: PROJECT  */

    //** Strart:  RESOURCE */
    //** Create Resource */
    public function  Create_Resource()
    {
        $this->data['work_details']= $this->technical_admin_model->get_work_category();
        $this->data['contract_details']= $this->technical_admin_model->get_contract();
        $this->data['Work_Type']= $this->technical_admin_model->get_Work_Type();
        $this->data['Client']= $this->technical_admin_model->get_All_client();
        $this->data['Member']= $this->technical_admin_model->get_technical_member();
        $this->data['Role_Master']= $this->technical_admin_model->get_Role_Master();
        $this->data['Contract_Term']= $this->technical_admin_model->get_Contract_terms();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Create_Resource',$this->data, FALSE);
        $this->load->view('Admin/footer');

    }

    //** Save Resource */
    public function  Save_Resource()
    {

        $Role_Master =  $this->input->post('Role_master',true);

        $Member =  $this->input->post('Members',true);
        $count = sizeof($Member);


        $client_con = $this->input->post('Client_Contact',true);                 // Client Contact Checkbox

        $client_c= trim($client_con,",");
        $Lost = explode(',', $client_c);
        $client_contact = count($Lost);// Trim Comma

        $Terms =  $this->input->post('Resource_Terms',true);
        $sdate =  $this->input->post('Contract_Start',true);
        $edate =  $this->input->post('Contract_End',true);
        $Hours =  $this->input->post('Min_Hours',true);

        $data = array('Project_Name' => $this->input->post('Project_Name',true),
            'Resource_Client_Icode' => $this->input->post('Client_Id',true),
            'Resource_Category_Icode' => $this->input->post('Work_Category',true),
            'Resource_Work_Type_Icode' => $this->input->post('Work_type',true),
            'Contract_Signed_Date' => $this->input->post('Proj_WO',true),
            'Work_Order_Title' => $this->input->post('Work_Order',true),
            'Resource_Contract_Type' => $this->input->post('Contract',true),
            'Created_By' =>$this->session->userdata['userid']);
        $insert_resource =  $this->technical_admin_model->insert_Resource($data);
        if($insert_resource != '0')
        {

            for($i=0; $i<$count; $i++)
            {
                $resource_contact = array('WO_Icode' => $insert_resource,
                    'Role_Icode' => $Role_Master[$i],
                    'Member_Icode' => $Member[$i],
                    'Term_Icode' => $Terms[$i],
                    'Start_Date' => $sdate[$i],
                    'End_Date' => $edate[$i],
                    'Min_Hour' => $Hours[$i],
                    'Created_By' => $this->session->userdata['userid']);
                $insert_Req = $this->technical_admin_model->Save_Contract_Resource($resource_contact);
            }

            for($i=0; $i<$client_contact; $i++)
            {
                $project_Contact = array('WO_Icode' => $insert_resource,
                    'WO_Client_Icode' =>$this->input->post('Client_Id',true),
                    'Client_Contact_Icode' => $Lost[$i],
                    'Created_By' =>$this->session->userdata['userid']);
                $insert_WO_contact = $this->technical_admin_model->insert_WO_contact($project_Contact);
                if($insert_WO_contact == 1)
                {
                    // print_r("Success");
                }
                else{
                    // print_r("Faild");
                }
            }
            echo 1;

        }
        else{
            echo 0;
        }
    }

    //** LIST PROJECT */
    public function List_Project()
    {
        $icode = $this->session->userdata['userid'];
        $this->data['Status']= $this->technical_admin_model->Get_Project_Status($icode);
        $this->data['List']= $this->technical_admin_model->Get_All_Projects($icode);
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/List_Project',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** Search Project */
    public function Search_Project()
    {
        $status = $this->input->post('Status', true);
        $User_Icode = $this->session->userdata['userid'];
        $data = $this->technical_admin_model->Search_Project($status, $User_Icode);
        //print_r($data);
        $output = null;
        $i = 1;
        foreach ($data as $row) {
              $Project = $row['Project_Icode'];
              $client = $row['Project_Client_Icode'];
//            $req_Status = $row['Requirement_Status'];
//            $rtype = $row['Requirement_Type'];
            $output .= "<tr >";
            $output .= "<td>" . $i . "</td>";
            $output .= "<td><a href='select_project/$Project/$client'>" . $row['Client_Company_Name'] . "</a></td>";
            $output .= "<td>" . $row['Client_Country'] . "</td>";
            $output .= "<td>" . $row['Project_Name'] . "</td>";
            $output .= "<td>" . $row['Project_Start_Date'] . "</td>";
            $output .= "<td>" . $row['Planned_End_Date'] . "</td>";
            $output .= "<td>" . $row['Actual_End_Date'] . "</td>";
            $output .= "<td>" . $row['Estimation_Hours'] . "</td>";
            $output .= "<td>" . $row['Status_Name'] . "</td>";
            $output .=  "</tr>";
            $i++;
        }
        echo $output;
    }

    //** Select Perticular Project */
    public function select_project($project_id,$client_id)
    {
        $project_id =  $this->uri->segment(3);
        $client_id =  $this->uri->segment(4);
        //$icode = $this->session->userdata['userid'];
        $this->data['project']= $this->technical_admin_model->Get_Project_Details($project_id);
        $this->data['phase']= $this->technical_admin_model->Get_Project_Phase_Details($project_id);
        $this->data['Phase_master']=$this->technical_admin_model->Get_Project_Phase_Master_Details($project_id);
        $this->data['Resource']=$this->technical_admin_model->Get_Project_Resource_Details($project_id);
        $this->data['Member']=$this->technical_admin_model->Get_Project_Member_Details($project_id);
        $this->data['Role_Master']= $this->technical_admin_model->get_Role_Master();
        $this->data['Status']= $this->technical_admin_model->get_Project_Status();
        $this->data['Status_History']= $this->technical_admin_model->get_Project_Status_History($project_id);
        $this->data['client_contact']= $this->technical_admin_model->get_Project_Client_Contacts($project_id);
        $this->data['client_inactive']= $this->technical_admin_model->get_Project_Inactive_Client_Contacts($project_id,$client_id);

        //$this->data['Phase_master']= $this->technical_admin_model->get_Phase_Master();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/View_Manage_Project',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }

    //** Save Dynamic Phase Values */
    public function Save_Phase()
    {
        $project_Phase_code = $this->input->post('project', true);
        $old_phase =$this->technical_admin_model->Get_Project_Phase_Old_Details($project_Phase_code);
        $insert_phase = array('History_Phase_Icode' => $this->input->post('project', true),
            'Phase_History_Master_Icode' =>$old_phase[0]['Phase_Master_Icode'],
            'Phase_Old_Start_Date' => $old_phase[0]['Phase_Start_Date'],
            'Phase_Old_End_Date' => $old_phase[0]['Phase_End_Date'],
            'Phase_Old_Hours' => $old_phase[0]['Estimate_Hour'],
            'Phase_New_Start_Date' => $this->input->post('Start_date', true),
            'Phase_New_End_Date' => $this->input->post('End_date', true),
            'Phase_New_Hours' => $this->input->post('Hours', true),
            'Created_By' => $this->session->userdata['userid']);
        $insert_phase_history = $this->technical_admin_model->insert_phase_history($insert_phase);
        if($insert_phase_history == '1')
        {
            $project_phase = array(
                'Phase_Start_Date' => $this->input->post('Start_date', true),
                'Phase_End_Date' => $this->input->post('End_date', true),
                'Estimate_Hour' => $this->input->post('Hours', true),
                'Modified_By' =>$this->session->userdata['userid'],
                'Modified_On' =>date('Y-m-d'));
            $this->db->where('Project_Phase_Icode',$project_Phase_code);
            $this->db->update('project_phase', $project_phase);
            echo 1;
        }
        else
        {
            echo 0;
        }

    }
    //** Save Project HISTORy */
    public function Save_History()
    {
        $project_id = $this->input->post('Project_id', true);
        $project_History = array(
            'History_Project_Icode' => $this->input->post('Project_id', true),
            'History_Project_Old_Date' => $this->input->post('Project_old', true),
            'History_Project_New_Date' => $this->input->post('Project_New', true),
            'History_Estimate_Old_Hour' => $this->input->post('Old_Hours', true),
            'History_Estimate_New_Hour' => $this->input->post('New_Hours', true),
            'History_Project_Comments' =>$this->input->post('Comments', true),
            'Created_By' =>$this->session->userdata['userid']);
        $insert_History = $this->technical_admin_model->Save_Project_History($project_History);
        if($insert_History == '1')
        {
            $upload_project = array(
                'Planned_End_Date' => $this->input->post('Project_New', true),
                'Estimation_Hours' =>$this->input->post('New_Hours', true),
                'Modified_By' =>$this->session->userdata['userid'],
                'Modified_On' =>date('Y-m-d'));
            $this->db->where('Project_Icode',$project_id);
            $this->db->update('ibt_project_table', $upload_project);
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function Save_New_Phase()
    {
        $project_Phase_code = $this->input->post('project', true);
        $project_phase = array('Phase_Master_Icode' => $this->input->post('phase_code', true),
            'Proj_Project_Icode' => $this->input->post('project_icode', true),
            'Phase_Start_Date' => $this->input->post('Start_date', true),
            'Phase_End_Date' => $this->input->post('End_date', true),
            'Estimate_Hour' => $this->input->post('Hours', true),
            'Created_By' =>$this->session->userdata['userid']);
        $insert_project_phase = $this->technical_admin_model->insert_project_phase($project_phase);
        echo $insert_project_phase;

    }
    public function Delete_Phase()
    {
        $Phase_id = $this->input->post('Phase_id', true);
        //print_r($Phase_id);
        $old_phase =$this->technical_admin_model->Get_Project_Phase_Old_Details($Phase_id);
        $insert_phase = array('History_Phase_Icode' => $this->input->post('Phase_id', true),
            'Phase_History_Master_Icode' =>$old_phase[0]['Phase_Master_Icode'],
            'Phase_Old_Start_Date' => $old_phase[0]['Phase_Start_Date'],
            'Phase_Old_End_Date' => $old_phase[0]['Phase_End_Date'],
            'Phase_Old_Hours' => $old_phase[0]['Estimate_Hour'],
            'Phase_Delete' =>'1',
            'Created_By' => $this->session->userdata['userid']);
        $insert_phase_history = $this->technical_admin_model->insert_phase_history($insert_phase);
        if($insert_phase_history == '1')
        {
            $Delete_project_phase = $this->technical_admin_model->Delete_project_phase($Phase_id);
            echo 1;
        }
        else{
            echo 0;
        }

    }
    //** Save new Resource */
    public function Save_New_Resource()
    {
        $project_member = array('Proj_Project_Icode ' => $this->input->post('project_icode', true),
            'User_Icode' => $this->input->post('Member', true),
            'User_Designation' => $this->input->post('Desig', true),
            'Role_Master_Icode' => $this->input->post('Role', true),
            'Work_Start_Date' => $this->input->post('Work', true),
            'Created_By' =>$this->session->userdata['userid']);
        $insert_project_member = $this->technical_admin_model->insert_project_member_Details($project_member);
        echo $insert_project_member;
    }
    //** Insert Resource Changed Reason */
    public function Insert_Resource_Changed_Reason()
    {
        $Team_id = $this->input->post('Team_id', true);
        $old_team =$this->technical_admin_model->Get_Project_Team_Old_Details($Team_id);
       // print_r($old_team[0]['Work_Start_Date']);
        $insert_team = array('Resource_Project_Team_Icode' => $this->input->post('Team_id', true),
            'Eariler_Date' =>$old_team[0]['Work_Start_Date'],
            'Changed_Date' => date('m/d/Y'),
            'Changed_Type' => $this->input->post('Type', true),
            'Changed_Reason' =>$this->input->post('Comments', true),
            'Changed_By' => $this->session->userdata['userid']);
        $insert_team_history = $this->technical_admin_model->insert_Resource_history($insert_team);
        if($insert_team_history == '1')
        {
            $project_team = array(
                'Work_Start_Date' => date('m/d/Y'),
                'Active' => $this->input->post('Status', true),
                'Modified_By' =>$this->session->userdata['userid'],
                'Modified_On' =>date('Y-m-d'));
            $this->db->where('Project_Team_Icode',$Team_id);
            $this->db->update('project_team', $project_team);
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    //** Save Project Status */
    public function Save_Project_Status()
    {
        $project_icode =$this->input->post('Project', true);
        $data = array('History_Project_Icode' => $project_icode,
        'History_Status_Icode' =>$this->input->post('Status', true),
        'History_Comments' =>$this->input->post('Comments', true),
        'Created_By' => $this->session->userdata['userid']);
        $insert_team_history = $this->technical_admin_model->insert_Project_Status_history($data);
        if($insert_team_history == '1')
        {
            $project_status = array(
                'Project_Status' => $this->input->post('Status', true),
                'Modified_By' =>$this->session->userdata['userid'],
                'Modified_On' =>date('Y-m-d'));
            $this->db->where('Project_Icode',$project_icode);
            $this->db->update('ibt_project_table', $project_status);
            echo 1;
        }
        else
        {
            echo 0;
        }

    }
    //** Contact Inactive */
    public function Inactive_contact()
    {
        $client_code =$this->input->post('id', true);
        $inactive = $this->technical_admin_model->client_change_inactive($client_code);
        echo $inactive;
    }
    //** Active Contact */
    public function Active_contact()
    {
        $project_Contact = array('Proj_Project_Icode ' => $this->input->post('Project',true),
            'Project_Client_Icode' =>$this->input->post('Client',true),
            'Client_Contact_Icode' => $this->input->post('Contact',true),
            'Project_Contact_Created_By' =>$this->session->userdata['userid']);
        $insert_project_contact = $this->technical_admin_model->insert_project_contact($project_Contact);
        echo $insert_project_contact;
    }
    //** List of All Work Orderes */
    public function List_Work_Order()
    {
        $icode = $this->session->userdata['userid'];
      //  $this->data['Status']= $this->technical_admin_model->Get_Project_Status($icode);
        $this->data['WO_List']= $this->technical_admin_model->Get_All_Work_Order($icode);
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Work_Order_List',$this->data, FALSE);
        $this->load->view('Admin/footer');

    }
    //** Select Perticular Project */
    public function select_Work_Order($wo_id,$client_id)
    {
        $project_id =  $this->uri->segment(3);
        $client_id =  $this->uri->segment(4);
        //$icode = $this->session->userdata['userid'];
         $this->data['WO']= $this->technical_admin_model->Get_Work_Order_Details($project_id);
//        $this->data['phase']= $this->technical_admin_model->Get_Project_Phase_Details($project_id);
//        $this->data['Phase_master']=$this->technical_admin_model->Get_Project_Phase_Master_Details($project_id);
         $this->data['Resource']=$this->technical_admin_model->Get_Work_Order_Resource_Details($project_id);
        $this->data['Member']=$this->technical_admin_model->Get_Resource_Member_Details($project_id);
        $this->data['Role_Master']= $this->technical_admin_model->get_Role_Master();
        $this->data['Contract_Term']= $this->technical_admin_model->get_Contract_terms();
//        $this->data['Status']= $this->technical_admin_model->get_Project_Status();
//        $this->data['Status_History']= $this->technical_admin_model->get_Project_Status_History($project_id);
        $this->data['client_contact']= $this->technical_admin_model->get_WO_Client_Contacts($project_id);
        $this->data['client_inactive']= $this->technical_admin_model->get_WO_Inactive_Client_Contacts($project_id,$client_id);

        //$this->data['Phase_master']= $this->technical_admin_model->get_Phase_Master();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/View_Manage_Work_Order',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }

    //** Save extended Resource Date */
    public function Save_Extended_Date()
    {
        $WO_Icode = $this->input->post('Resource', true);
        $old_phase =$this->technical_admin_model->Get_Work_order_Old_Details($WO_Icode);
        $insert_WO = array('WO_Resource_Icode' => $this->input->post('Resource', true),
            'Old_Start_Date' => $old_phase[0]['Start_Date'],
            'Old_End_Date' => $old_phase[0]['End_Date'],
            'Old_Hours' => $old_phase[0]['Min_Hour'],
            'Old_Terms_Icode' => $old_phase[0]['Term_Icode'],
            'New_Start_Date' => $this->input->post('Start_date', true),
            'New_End_Date' => $this->input->post('End_date', true),
            'New_Hours' => $this->input->post('Hours', true),
            'New_Terms_Icode' => $this->input->post('Terms', true),
            'Created_By' => $this->session->userdata['userid']);
        $insert_phase_history = $this->technical_admin_model->insert_WO_Extension_history($insert_WO);
        if($insert_phase_history == '1')
        {
            $project_phase = array(
                'Start_Date' => $this->input->post('Start_date', true),
                'End_Date' => $this->input->post('End_date', true),
                'Min_Hour' => $this->input->post('Hours', true),
                'Term_Icode' => $this->input->post('Terms', true),
                'Modified_By' =>$this->session->userdata['userid'],
                'Modified_On' =>date('Y-m-d'));
            $this->db->where('WO_Resource_Icode',$WO_Icode);
            $this->db->update('work_order_resource', $project_phase);
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    //** Save Work Order Resouce Added */
    public function Save_New_WO_Resource()
    {
        $resource_contact = array('WO_Icode' => $this->input->post('WO_Icode', true),
            'Role_Icode' => $this->input->post('Role', true),
            'Member_Icode' => $this->input->post('Member', true),
            'Term_Icode' => $this->input->post('Term', true),
            'Start_Date' => $this->input->post('Start', true),
            'End_Date' => $this->input->post('End', true),
            'Min_Hour' => $this->input->post('Hours', true),
            'Created_By' => $this->session->userdata['userid']);
        $insert_Req = $this->technical_admin_model->Save_Contract_Resource($resource_contact);
        echo 1;
    }
    //** Work Order Resource Stop */
    public function WO_Resource_Cancel()
    {
        $resource_id = $this->input->post('Team_id', true);
        $wo_cancel = array(
            'Active' => 'No',
            'WO_Cancel_Comments' => $this->input->post('Comments', true),
            'Modified_By' =>$this->session->userdata['userid'],
            'Modified_On' =>date('Y-m-d'));
        $this->db->where('WO_Resource_Icode',$resource_id);
        $this->db->update('work_order_resource', $wo_cancel);
        echo 1;
    }

    //** Work Order Resource Switch */
    public function WO_Resource_Switch()
    {
        $WO_Resource_Icode = $this->input->post('Team_id', true);
        $old_resource =$this->technical_admin_model->Get_Work_order_Old_Details($WO_Resource_Icode);
        $insert_WO = array(
            'WO_Icode' => $old_resource[0]['WO_Icode'],
            'WO_Role_Icode' => $old_resource[0]['Role_Icode'],
            'Old_Member_Icode' => $old_resource[0]['Member_Icode'],
            'Old_Start_Date' => $old_resource[0]['Start_Date'],
            'Old_End_Date' => $old_resource[0]['End_Date'],
            'New_Start_Date' => $this->input->post('New_Start', true),
            'New_End_Date' => $this->input->post('New_End', true),
            'New_Member_Icode' => $this->input->post('New_Resource_Id', true),
            'Change_Comments ' => $this->input->post('Comments', true),
            'Created_By' => $this->session->userdata['userid']);
        $insert_resource_history = $this->technical_admin_model->Insert_WO_Resource_Change_history($insert_WO);
        if($insert_resource_history == '1')
        {
            $project_resource = array(
                'Member_Icode' => $this->input->post('New_Resource_Id', true),
                'Start_Date' => $this->input->post('New_Start', true),
                'End_Date' => $this->input->post('New_End', true),
                'Modified_By' =>$this->session->userdata['userid'],
                'Modified_On' =>date('Y-m-d'));
            $this->db->where('WO_Resource_Icode',$WO_Resource_Icode);
            $this->db->update('work_order_resource', $project_resource);
            echo 1;
        }
        else
        {
            echo 0;
        }
    }


    //** WO Contact Inactive */
    public function WO_Inactive_contact()
    {
        $client_code =$this->input->post('id', true);
        $inactive = $this->technical_admin_model->wo_client_change_inactive($client_code);
        echo $inactive;
    }
    //** WO Active Contact */
    public function WO_Active_contact()
    {
        $project_Contact = array('WO_Icode ' => $this->input->post('Project',true),
            'WO_Client_Icode' =>$this->input->post('Client',true),
            'Client_Contact_Icode' => $this->input->post('Contact',true),
            'Created_By' =>$this->session->userdata['userid']);
        $insert_project_contact = $this->technical_admin_model->insert_WO_contact($project_Contact);
        echo $insert_project_contact;
    }

    //** Task_Category_Master */
    public function Task_Category_Master()
    {
        $this->data['Task_Category']= $this->technical_admin_model->get_Task_Category_Master();
        $this->load->view('Admin/header');
        $this->load->view('Admin/left');
        $this->load->view('Admin/top');
        $this->load->view('Admin/Task_Category',$this->data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** insert_Phase_Master */
    public  function  insert_Task_Category_Master()
    {
        $data = array('Task_Category_Name'     => $this->input->post('Task_Category_name'),
                      'Created_By'             => $this->session->userdata['userid']);
        $insert = $this->technical_admin_model->insert_Task_Category_Master($data);
        redirect('Admin_Controller/Task_Category_Master');
    }




}