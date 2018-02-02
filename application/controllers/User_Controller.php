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

             $fileee = $this->input->post('user_files');
            $count_Phase = count($fileee);

            print_r($count_Phase);

//            $config ['upload_path'] = './uploads/task';
//            $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc|zip|xlsx';
//            $this->load->library('upload', $config);
//            // Cache the real $_FILES array, because the original
//            // will be overwritten soon :)
//            $files = $_FILES;
//            $file_count = sizeof($_FILES['user_files']['name']);
//
//            // Iterate over the $files array
//            for ($i = 0; $i < $file_count; $i++) {
//                // Overwrite the default $_FILES array with a single file's data
//                // to make the $_FILES array consumable by the upload library
//
//                $_FILES['user_files']['name'] = $files['user_files']['name'][$i];
//                $_FILES['user_files']['type'] = $files['user_files']['type'][$i];
//                $_FILES['user_files']['tmp_name'] = $files['user_files']['tmp_name'][$i];
//                $_FILES['user_files']['error'] = $files['user_files']['error'][$i];
//                $_FILES['user_files']['size'] = $files['user_files']['size'][$i];
//
//                if (!$this->upload->do_upload('user_files')) {
//                    // Handle upload errors
//
//                    // If an error occurs jump to the next file
//                    break;
//                } else {
//                    $name = $this->upload->data();
//                    //$data = array('file_name' =>$name['file_name']);
//                    $attachment = array('Attachment_Task_Icode' => $insert_project,
//                        'Attachment_Path' =>$name['file_name'],
//                        'Attachment_Created_By' => $this->session->userdata['userid']);
//                    $insert_attachment = $this->technical_user_model->Insert_Task_Attachment($attachment); /*Insert Task Attachments*/
//
//
//                }
//            }
//            $this->session->set_flashdata('message', 'Task Created Successfully..');
//            redirect('/User_Controller/Create_Task');

        }


    }
    /*Insert Tssk in Database*/


    public function Save_Upload()
    {
        $phase_Hour = $this->input->post('id',true);
        $count_Phase = sizeof($phase_Hour);
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';

        if (empty($phase_Hour))
        {
            $status = "error";
            $msg = "Please enter a title";
        }

        if ($status != "error")
        {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            for ($i = 0; $i < $count_Phase; $i++)
            {

            if (!$this->upload->do_upload($phase_Hour[$i]))
            {
                print_r("error");
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                print_r("success");

                    $data = $this->upload->data();
                   // $file_id = $this->files_model->insert_file($data['file_name'], $phase_Hour[$i]);
                    if($file_id)
                    {
                        $status = "success";
                        $msg = "File successfully uploaded";
                    }
                    else
                    {
                        unlink($data['full_path']);
                        $status = "error";
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
                }
                }

            }
            @unlink($_FILES[$file_element_name]);

        echo json_encode(array('status' => $status, 'msg' => $msg));


    }
}
?>