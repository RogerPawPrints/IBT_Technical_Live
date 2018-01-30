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

}