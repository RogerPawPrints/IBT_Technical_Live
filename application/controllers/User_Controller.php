<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('Welcome');
        }
        //$this->load->model('LoginModel','LoginModel');
        $this->load->helper('url');
        /***** LOADING HELPER TO AVOID PHP ERROR ****/
        $this->load->model('Technical_User_Model', 'technical_user_model'); /* LOADING MODEL * Technical_User_Model as technical_user_model */
        $this->load->library('session');
    }

    //** Admin Dashboard**//
    public function dashboard()
    {
        $this->load->view('User/header');
        $this->load->view('User/left');
        $this->load->view('User/top');
        $this->load->view('User/dashboard');
        $this->load->view('User/footer');
    }

    /*Create Task*/
    public function Create_Task()
    {
        $this->data['Select_Project'] = $this->technical_user_model->Select_Project();
        //$this->data['Select_Project']= $this->technical_user_model->Show_On_Select_Project();
        $this->load->view('User/header');
        $this->load->view('User/left');
        $this->load->view('User/top');
        $this->load->view('User/create_task', $this->data, FALSE);
        $this->load->view('User/footer');
    }
    /*Create Task*/

    /*select Resource and project details*/
    public function Show_On_Project_Select()
    {
        $project_code = $this->input->post('id', true);

        $data = $this->technical_user_model->Show_On_Select_Project($project_code);

        $resource_name = $this->technical_user_model->Select_Resource($project_code);
       // print_r($resource_name);

        $full_data = array('Client_Details' => $data );

        echo json_encode($full_data);

    }
    /*select Resource and project details*/
    public function Show_On_Project_Resource()
    {
        $project_code = $this->input->post('id', true);

        $resource_name = $this->technical_user_model->Select_Resource($project_code);
        $output = null;
        foreach ( $resource_name as $row)
        {
            //here we build a dropdown item line for each
            // query result
            $output .= "<option value='".$row['User_Icode']."'>".$row['User_Name']."</option>";
        }
        echo $output;
    }



    /*Insert Task in Database*/
    public function Insert_Task()
    {
        $task_data = array(
            'Task_Project_Icode' => $this->input->post('Project_Select'),
            'Task_Client_Icode ' => $this->input->post('Client_Name_icode'),
            'Task_Resource_Icode' => $this->input->post('Resource_Select'),
            'Task_Start_Date' => $this->input->post('task_date_start'),
            'Task_End_Date' => $this->input->post('task_date_end'),
            'Task_Estimated_Hours' => $this->input->post('Task_E_Hour'),
            'Task_Description' => $this->input->post('task_desc'),
            'Task_Created_By' => $this->session->userdata['userid']);
        $insert_project = $this->technical_user_model->Insert_Task($task_data); /*Insert Task Details*/
        $data = array();

        /*Insert Task Attachments*/
        if ($insert_project != '0') {
            if (count($_FILES["user_files"]) > 0) {
                $folderName = "./uploads/";
                $counter = 0;
                for ($i = 0; $i < count($_FILES["user_files"]["name"]); $i++) {
                    if ($_FILES["user_files"]["name"][$i] <> "") {

                        $ext = strtolower(end(explode(".", $_FILES["user_files"]["name"][$i])));
                        $filePath = $folderName . rand(10000, 990000) . '_' . time() . '.' . $ext;

                        if (!move_uploaded_file($_FILES["user_files"]["tmp_name"][$i], $filePath)) {
                            $msg .= "Failed to upload" . $_FILES["user_files"]["name"][$i] . ". <br>";
                            $counter++;
                        }
                    }
                    $msg = ($counter == 0) ? "Files uploaded Successfully" : "Erros : " . $msg;
                }
            }


        }

            $this->session->set_flashdata('message', 'Task Created Successfully..');
            redirect('/User_Controller/Create_Task');




    }
    /*Insert Tssk in Database*/
}
?>