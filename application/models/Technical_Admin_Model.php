<?php
class Technical_Admin_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //** get auto search client **//
    public function get_client($data)
    {
    	$query = $this->db->query("SELECT * FROM ibt_client_details WHERE Company_Name LIKE '%".$data."%' LIMIT 10"); 
    	return $query->result_array();
    }

    //** get perticular client details **//
    public function get_client_details($data)
    {
    	$sql = $this->db->query("SELECT * FROM ibt_client WHERE Client_Company_Name = '$data' ");  // Client check
    	 if($sql->num_rows() == 1)
    	 {
    	 	return 1;
    	 }
    	 else
    	 {
    	 	$query = $this->db->query("SELECT * FROM ibt_client_details WHERE Company_Name = '$data' "); 
	    	//echo $this->db->last_query();
	    	return $query->result_array();
    	 }
    	
    }
    //** Get All Client */
    public function get_All_client()
    {
        $query = $this->db->query("SELECT * FROM ibt_client ");
        return $query->result_array();
    }

    //** Insert Client **//
    public function insert_client($data)
    {
    	$this->db->insert('ibt_client', $data); 
        return $this->db->insert_id();
    }

    //** Insert Client Contact **//
    public function insert_client_contact($data)
    {
    	 $this->db->insert('ibt_client_contacts', $data); 
         return TRUE;
    }
    //** Get All Contacts **//
    public function get_contacts()
    {
    	$query=$this->db->query("SELECT A.*,B.Client_Company_Name FROM ibt_client_contacts A INNER JOIN ibt_client B on A.Contact_Client_Icode = B.Client_Icode "); 
        return $query->result_array();
    }
    //** get perticular contadct**//
    public function get_perticular_contacts($id)
    {
    	$query=$this->db->query("SELECT * FROM ibt_client_contacts WHERE Contact_ID = '$id' "); 
        return $query->result_array();
    }
    /** DELETE CLIENT CONTACT **/
	public function delete_contacts($id)
	{
	     $query = $this->db->query("DELETE from ibt_client_contacts where Contact_ID = $id");
	     return 1;
	}

	/** GET ALL CONTRACT */
	public function get_contract()
	{
		$query=$this->db->query("SELECT * FROM ibt_contractcategory "); 
		return $query->result_array();
	}

	/** INSERT COntract */
	public function insert_contract($data)
	{
	      $this->db->insert('ibt_contractcategory', $data); 
	      return TRUE;
	}
	/** Delete Contract **/
	public function delete_contract($id)
	{
        $sql = $this->db->query("SELECT * FROM ibt_contract_work WHERE Contract_Type = '$id' ");  // Contract check
        if($sql->num_rows() == 1)
        {
            return 0;
        }
        else {
            $query = $this->db->query("DELETE from ibt_contractcategory where Contracttype_Icode = $id");
            return 1;
        }
	}
	/** WORk Category **/
	public function insert_work_category($data)
	{
	    $this->db->insert('ibt_workcategory', $data); 
	     return TRUE;
	}

	/** get work category **/
	public function get_work_category()
	{
	    $query=$this->db->query("SELECT * FROM ibt_workcategory "); 
	    return $query->result_array();
	}
	/** Delete Contract **/
	public function delete_work($id)
	{
        $sql = $this->db->query("SELECT * FROM ibt_contract_work WHERE Project_Type = '$id' ");  // Contract check
        if($sql->num_rows() == 1)
        {
            return 0;
        }
        else {
            $query = $this->db->query("DELETE from ibt_workcategory where WorkCategory_Icode = $id");
            return 1;
        }

	}
	/** Select Company Details */
	public  function  Select_Company_Details($id)
    {
        $query=$this->db->query("SELECT * FROM `ibt_client` WHERE  Client_Icode ='$id' ");
        return $query->result_array();
    }

    /** Get get_Work_Type */
    public  function  get_Work_Type()
    {
        $query=$this->db->query("SELECT * FROM ibt_work_type ");
        return $query->result_array();
    }
    //** Insert Work Type */
    public function insert_Work_Type($data)
    {
        $this->db->insert('ibt_work_type', $data);
        return TRUE;
    }
    //** Delete delete_work_Type */
    public function  delete_work_Type($id)
    {
        //$sql = $this->db->query("SELECT * FROM ibt_contract_work WHERE Project_Type = '$id' ");  // Contract check
        if($sql->num_rows() == 1)
        {
            return 0;
        }
        else {
            $query = $this->db->query("DELETE from ibt_work_type where Work_Icode = $id");
            return 1;
        }
    }
    //** phase Master Get */
    public function get_Phase_Master()
    {
        $query=$this->db->query("SELECT * FROM projct_phase_master ");
        return $query->result_array();

    }
    //** Insert phase Master */
    public function insert_Phase_Master($data)
    {
        $this->db->insert('projct_phase_master', $data);
        return TRUE;
    }
    //** Delete delete_work_Type */
    public function  Delete_Phase_Master($id)
    {
        //$sql = $this->db->query("SELECT * FROM ibt_contract_work WHERE Project_Type = '$id' ");  // Contract check
        if($sql->num_rows() == 1)
        {
            return 0;
        }
        else {
            $query = $this->db->query("DELETE from projct_phase_master where Project_Phase_Icode = $id");
            return 1;
        }
    }
    //** Get get_Role_Master */
    public function get_Role_Master()
    {
        $query=$this->db->query("SELECT * FROM role_master ");
        return $query->result_array();
    }
    //** insert_Role_Master */
    public function insert_Role_Master($data)
    {
        $this->db->insert('role_master', $data);
        return TRUE;
    }

    //** START: PROJECT */
    //** Get Client Based Contact */
    public function get_Client_Contact($client_id)
    {
        $query=$this->db->query("SELECT * FROM ibt_client_contacts WHERE Contact_Client_Icode = '$client_id'");
        return $query->result_array();
    }
    public function get_technical_member()
    {
        $query=$this->db->query("SELECT * FROM ibt_technical_users ");
        return $query->result_array();
    }

    //** member designation */
    public function  get_Member_Details($member_id)
    {
        $query=$this->db->query("SELECT * FROM ibt_technical_users WHERE  User_Icode = '$member_id'");
        return $query->result_array();
    }
    //** Get Technical Platform */
    public function get_technical_platform()
    {
        $query=$this->db->query("SELECT * FROM technical_platform ");
        return $query->result_array();
    }

    //** Fixed Cost Data Inserted */
    public function Insert_Fixed_Cost($data)
    {
        $this->db->insert('ibt_project_table', $data);
        return $this->db->insert_id();
    }
    //** Insert Project Client COntact */
    public function insert_project_contact($data)
    {
        $this->db->insert('project_client_contacts', $data);
        return 1;
    }

    //** Insert Project Phase */
    public function insert_project_phase($data)
    {
        $this->db->insert('project_phase', $data);
        return 1;
    }
    //** Insert Project Modules */
    public function insert_project_modules($data)
    {
        $this->db->insert('project_modules', $data);
        return 1;
    }
    //** Insert Project Modules */
    public function insert_project_member($data)
    {
        $this->db->insert('project_team', $data);
        return 1;
    }
    //** get Contract terms */
    public function get_Contract_terms()
    {
        $query=$this->db->query("SELECT * FROM ibt_contract_terms ");
        return $query->result_array();
    }
    //** END: PROJECT */

    //** Insert Resource */
    public function insert_Resource($data)
    {
        $this->db->insert('ibt_resource_table', $data);
        return $this->db->insert_id();
    }
    public function Save_Contract_Resource($data)
    {
        $this->db->insert('ibt_resource_contract', $data);
        return 1;
    }

    //** Get All Projects */
    public function Get_All_Projects($id)
    {
        $query=$this->db->query("SELECT * FROM ibt_project_table A INNER JOIN ibt_client B on A.Project_Client_Icode = B.Client_Icode
                                 INNER  JOIN  project_status_master C on A.Project_Status = C.project_status_Icode WHERE A.Project_Created_By = '$id' ");
        return $query->result_array();
    }

}