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

    /*Show on Select Project*/

}