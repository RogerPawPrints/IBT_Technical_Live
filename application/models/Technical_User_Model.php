<?php
class Technical_User_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /*Select Project/ resource project*/

    public function Select_Project()
    {
        $user_icode = $this->session->userdata['userid'];

        $query = $this->db->query("SELECT * FROM ibt_project_table A INNER JOIN project_team B on A.Project_Icode=B.Proj_Project_Icode WHERE B.User_Icode ='$user_icode' and B.Role_Master_Icode ='1'");
        return $query->result_array();
    }
    public function Select_Resource_project()
    {
        $user_icode = $this->session->userdata['userid'];

        $query = $this->db->query("SELECT * FROM work_order A INNER JOIN work_order_resource B on A.Work_Order_Icode=B.WO_Icode  WHERE B.Member_Icode='$user_icode' and B.Role_Icode='1'");
        return $query->result_array();
    }


    /*Select Project*/


    /*Show on Select Project*/

    public function Show_On_Select_Project($id)
    {
        $query = $this->db->query("SELECT * FROM ibt_project_table A INNER JOIN ibt_client B ON A.Project_Client_Icode=B.Client_Icode INNER JOIN ibt_workcategory C ON C.WorkCategory_Icode=A.Project_Work_Category_Icode INNER JOIN ibt_work_type D ON D.Work_Icode=A.Project_Work_Type_Icode 
                                  INNER JOIN ibt_contractcategory E on A.Project_Contract_Icode=E.Contracttype_Icode  WHERE A.Project_Icode='$id'");
        return $query->result_array();
    }
    public function Show_On_Select_Resource($id)
    {
        $query = $this->db->query("SELECT * FROM work_order A INNER JOIN ibt_client B ON A.Resource_Client_Icode=B.Client_Icode INNER JOIN ibt_workcategory C ON C.WorkCategory_Icode=A.Resource_Category_Icode INNER JOIN ibt_work_type D ON D.Work_Icode=A.Resource_Work_Type_Icode
                                   INNER JOIN ibt_contractcategory E on A.Resource_Contract_Type=E.Contracttype_Icode  WHERE A.Work_Order_Icode='$id'");
        return $query->result_array();
    }


    /*Show on Select Resource*/

    public function Select_Project_Resource($id)
    {
        $query = $this->db->query("SELECT * FROM project_team A INNER JOIN ibt_technical_users B ON A.User_Icode=B.User_Icode WHERE A.Proj_Project_Icode = '$id'");
       // echo $this->db->last_query();
        return $query->result_array();
    }
    public function Select_Work_Order_Resource($id)
    {
        $query = $this->db->query("SELECT * FROM work_order_resource A INNER JOIN ibt_technical_users B ON A.Member_Icode=B.User_Icode WHERE A.WO_Icode = '$id'");
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
        $query = $this->db->query("SELECT *,sum(E.Logged_Hours) as logged_hours FROM ibt_task_master A INNER JOIN ibt_client B ON A.Task_Client_Icode=B.Client_Icode 
                                  INNER JOIN ibt_project_table C on A.Task_Project_Icode=C.Project_Icode INNER JOIN ibt_technical_users D on A.Task_Created_By=D.User_Icode 
                                  INNER JOIN ibt_contractcategory F on A.Task_Contract_Type=F.Contracttype_Icode 
                                  LEFT JOIN ibt_task_entry E on A.Task_Icode = E.Task_Master_Icode WHERE A.Task_Resource_Icode ='$user_icode' AND A.Task_Status='1' 
                                  GROUP BY A.Task_Icode ");
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function Assigned_Task_Entry_WO()
    {
        $user_icode = $this->session->userdata['userid'];
        //print_r($user_icode);
        $query = $this->db->query("SELECT *,sum(E.Logged_Hours) as logged_hours FROM ibt_task_master A INNER JOIN ibt_client B ON A.Task_Client_Icode=B.Client_Icode 
                                  INNER JOIN work_order C on A.Task_WO_Icode=C.Work_Order_Icode INNER JOIN ibt_technical_users D on A.Task_Created_By=D.User_Icode INNER JOIN ibt_contractcategory F on A.Task_Contract_Type=F.Contracttype_Icode 
                                  LEFT JOIN ibt_task_entry E on A.Task_Icode = E.Task_Master_Icode WHERE A.Task_Resource_Icode ='$user_icode' AND A.Task_Status='1' 
                                  GROUP BY A.Task_Icode ");
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
        $query = $this->db->query("SELECT * FROM project_phase A INNER JOIN project_phase_master B on A.Phase_Master_Icode=B.Project_Phase_Master_Icode WHERE A.Proj_Project_Icode='$project_id'");
        //echo $this->db->last_query();
        return $query->result_array();

    }
    public  function  get_project_modules($project_id)
    {
        $query = $this->db->query("SELECT * FROM project_modules WHERE Proj_Project_Icode='$project_id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }


    public function get_task_attachments($task_id)
    {
        $query = $this->db->query("SELECT * FROM ibt_task_attachments A INNER JOIN ibt_project_table B on A.Attachment_Project_Icode=B.Project_Icode WHERE Attachment_Task_Icode ='$task_id'");
       // echo $this->db->last_query();
        return $query->result_array();
    }

    public  function  View_Manage_Task()
    {
        $user_icode = $this->session->userdata['userid'];
        $query = $this->db->query("SELECT B.Task_Entry_Icode, B.Task_Master_Icode, B.Logged_Hours,A.Task_Estimated_Hours,B.Task_Entry_Icode,A.Task_Start_Date,A.Task_End_Date,(SELECT Work_Progress FROM ibt_task_entry WHERE Task_Master_Icode=B.Task_Master_Icode ORDER BY B.Created_On DESC LIMIT 1 OFFSET 0) as task_status,(SELECT Task_Entry_Icode FROM ibt_task_entry WHERE Task_Master_Icode = B.Task_Master_Icode ORDER BY Created_On DESC LIMIT 1 OFFSET 0) as New_Task_Entry_Icode,
                        SUM(B.Logged_Hours) as Total_logged_Hours, C.Client_Company_Name,C.Client_Icode,D.Project_Icode,D.Project_Name,E.User_Icode,E.User_Name,B.Leader_Reviewed FROM ibt_task_master A INNER JOIN ibt_task_entry B ON A.Task_Icode=B.Task_Master_Icode INNER JOIN ibt_client C on A.Task_Client_Icode=C.Client_Icode INNER JOIN ibt_project_table D on A.Task_Project_Icode=D.Project_Icode
                                INNER JOIN ibt_technical_users E on B.Created_By=E.User_Icode WHERE A.Task_Created_By='$user_icode' and B.Leader_Reviewed='No' and A.Task_Status='1  '
                                GROUP BY B.task_master_icode");
        return $query->result_array();


    }
//    public  function  View_Manage_Task()
//    {
//        $user_icode = $this->session->userdata['userid'];
//        $query = $this->db->query("SELECT *  FROM ibt_task_master A INNER JOIN ibt_task_entry B ON A.Task_Icode=B.Task_Master_Icode INNER JOIN ibt_client C on A.Task_Client_Icode=C.Client_Icode INNER JOIN ibt_project_table D on A.Task_Project_Icode=D.Project_Icode
//                                INNER JOIN ibt_technical_users E on B.Created_By=E.User_Icode WHERE A.Task_Created_By='7' and B.Leader_Reviewed='No' ");
//        return $query->result_array();
//
//
//    }
    //** Get Task Description */
    public function get_task_desc($id)
    {
        $query = $this->db->query(" SELECT * FROM ibt_task_master A LEFT JOIN ibt_task_attachments B on A.Task_Icode=B.Attachment_Task_Icode INNER JOIN ibt_project_table C on A.Task_Project_Icode=C.Project_Icode   WHERE A.Task_Icode='$id'");
        return $query->result_array();
    }
    //** Get Task Billable Hour */
    public  function  Get_Task_Billable_Hours($id)
    {
        $query = $this->db->query("SELECT Task_Billable_Hours FROM ibt_task_master WHERE Task_Icode='$id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }

    //** Select project phase details */
    public function Select_Project_Phase($id)
    {
        $query = $this->db->query("SELECT * FROM project_phase A INNER JOIN project_phase_master B on A.Phase_Master_Icode=B.Project_Phase_Master_Icode WHERE A.Proj_Project_Icode='$id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }
    //** Get project phase details */
    public function Show_Project_Phase_Details($id)
    {
        $query = $this->db->query("SELECT * FROM project_phase WHERE Project_Phase_Icode='$id'");
        //echo $this->db->last_query();
        return $query->result_array();
    }


}