<?php
class Technical_User_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /*Select Project*/

    public function Select_Project()
    {
        $user_icode = $this->session->userdata['userid'];

        $query = $this->db->query("SELECT * FROM ibt_project_table A INNER JOIN project_team B on A.Project_Icode=B.Proj_Project_Icode WHERE B.User_Icode ='$user_icode' and B.Role_Master_Icode ='1'");
        return $query->result_array();
    }

    /*Select Project*/


    /*Show on Select Project*/

    public function Show_On_Select_Project($id)
    {
        $query = $this->db->query("SELECT * FROM ibt_project_table A INNER JOIN ibt_client B ON A.Project_Client_Icode=B.Client_Icode INNER JOIN ibt_workcategory C ON C.WorkCategory_Icode=A.Project_Work_Category_Icode INNER JOIN ibt_work_type D ON D.Work_Icode=A.Project_Work_Type_Icode  WHERE A.Project_Icode='$id'");
        return $query->result_array();
    }

    /*Show on Select Resource*/

    public function Select_Resource($id)
    {
        $query = $this->db->query("SELECT * FROM project_team A INNER JOIN ibt_technical_users B ON A.User_Icode=B.User_Icode WHERE A.Proj_Project_Icode = '$id'");
       // echo $this->db->last_query();
        return $query->result_array();
    }

    /*Select Resource*/

    /*Insert Task & Attachments*/
    public function Insert_Task($task_data)
    {
        $this->db->insert('ibt_task_master', $task_data);
        return $this->db->insert_id();
    }

    public function Insert_Task_Attachment($data)
    {
        $this->db->insert('ibt_task_attachments', $data);
        return 1;
    }
    /*Insert Task & Attachments*/

    /*Assigned Tasks*/

    public function Assigned_Task_Entry()
    {
        $user_icode = $this->session->userdata['userid'];
        //print_r($user_icode);
        $query = $this->db->query("SELECT *,sum(E.Logged_Hours) as logged_hours FROM ibt_task_master A INNER JOIN ibt_client B ON A.Task_Client_Icode=B.Client_Icode INNER JOIN ibt_project_table C on A.Task_Project_Icode=C.Project_Icode INNER JOIN ibt_technical_users D on A.Task_Created_By=D.User_Icode LEFT JOIN ibt_task_entry E on A.Task_Icode = E.Task_Master_Icode WHERE A.Task_Resource_Icode ='$user_icode' GROUP BY A.Task_Icode ");
        //echo $this->db->last_query();
        return $query->result_array();
    }

    /*Assigned Tasks*/


    /*insert task entry*/

    public function save_task_entry($data)
    {
        $this->db->insert('ibt_task_entry', $data);
        return 1;
    }

    /*insert task entry*/

    public function get_project_phase($project_id)
    {
        $query = $this->db->query("SELECT * FROM project_phase A INNER JOIN projct_phase_master B on A.Phase_Master_Icode=B.Project_Phase_Master_Icode WHERE A.Proj_Project_Icode='$project_id'");
        //echo $this->db->last_query();
        return $query->result_array();

    }
    public  function  get_project_modules($project_id)
    {
        $query = $this->db->query("SELECT * FROM project_modules WHERE Proj_Project_Icode='$project_id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }


}