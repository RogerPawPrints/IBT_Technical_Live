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

        /*Insert Task Attachments.*/
        if ($insert_project != '0') {

                $upload_dir = 'uploads';
                $config = array();
                $files = array();

                if(empty($config))
                {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|txt|jpg|png|jpeg|bmp|gif|avi|flv|mpg|wmv|mp3|wma|wav|zip|rar';
                    $config['max_size']      = '800000000';
                }

                $this->load->library('upload', $config);

                $errors = FALSE;

                foreach($_FILES['user_files'] as $key => $value)
                {
                    if( ! empty($value['name']))
                    {
                        if( ! $this->upload->do_upload($key))
                        {
                            $data['upload_message'] = $this->upload->display_errors(ERR_OPEN, ERR_CLOSE); // ERR_OPEN and ERR_CLOSE are error delimiters defined in a config file
                            $this->load->vars($data);

                            $errors = TRUE;
                        }
                        else
                        {
                            // Build a file array from all uploaded files
                            $files[] = $this->upload->data();
                        }
                    }
                }

                // There was errors, we have to delete the uploaded files
                if($errors)
                {
                    foreach($files as $key => $file)
                    {
                        @unlink($file['full_path']);
                    }
                }
                elseif(empty($files) AND empty($data['upload_message']))
                {
                    $this->lang->load('upload');
                    $data['upload_message'] = ERR_OPEN.$this->lang->line('upload_no_file_selected').ERR_CLOSE;
                    $this->load->vars($data);
                }
                else
                {
                    return $files;
                }

            $this->session->set_flashdata('message', 'Task Created Successfully..');
            redirect('/User_Controller/Create_Task');

        }


    }
    /*Insert Tssk in Database*/
}
?>