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
        $this->data['Select_Project']= $this->technical_user_model->Select_Project();
        //$this->data['Select_Project']= $this->technical_user_model->Show_On_Select_Project();
        $this->load->view('User/header');
        $this->load->view('User/left');
        $this->load->view('User/top');
        $this->load->view('User/create_task',$this->data, FALSE);
        $this->load->view('User/footer');
    }

    public function Show_On_Project_Select()
    {
        $project_code=$this->input->post('id', true);

        $data= $this->technical_user_model->Show_On_Select_Project($project_code);

        $resource_name= $this->technical_user_model->Select_Resource($project_code);

        $full_data = array('Client_Details' => $data,
                            'Resource_Select' => $resource_name
            );

        echo  json_encode($full_data);

    }

    public function Insert_Task()
    {
        $task_data = array(
            'Task_Project_Icode' => $this->input->post('Project_Select'),
            'Task_Client_Icode ' => $this->input->post('Client_Name_icode'),
            'Task_Resource_Icode'  => $this->input->post('Resource_Select'),
            'Task_Start_Date'  => $this->input->post('task_date_start'),
            'Task_End_Date'  => $this->input->post('task_date_end'),
            'Task_Estimated_Hours'  => $this->input->post('Task_E_Hour'),
            'Task_Description'  => $this->input->post('task_desc'),
            'Task_Created_By'  => $this->session->userdata['userid']);
        $insert_project = $this->technical_user_model->Insert_Task($task_data);
        $data = array();
        if($insert_project != '0')
        {
            $filesCount = count($_FILES['Task_Attachment']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['Task_Attachment']['name'] = $_FILES['Task_Attachment']['name'][$i];
                $_FILES['Task_Attachment']['type'] = $_FILES['Task_Attachment']['type'][$i];
                $_FILES['Task_Attachment']['tmp_name'] = $_FILES['Task_Attachment']['tmp_name'][$i];
                $_FILES['Task_Attachment']['error'] = $_FILES['Task_Attachment']['error'][$i];
                $_FILES['Task_Attachment']['size'] = $_FILES['Task_Attachment']['size'][$i];

                $uploadPath = 'uploads/files/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }
                if(!empty($uploadData)){
                    $attachment = array('Attachment_Task_Icode' =>  $insert_project,
                        'Attachment_Path' =>$uploadData,
                        'Attachment_Created_By'=>$this->session->userdata['userid']);
                    $insert_attachment = $this->technical_user_model->Insert_Task_Attachment($attachment);
                }



        }


        }

    }

}
?>