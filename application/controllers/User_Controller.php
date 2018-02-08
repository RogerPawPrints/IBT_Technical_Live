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
        $project_name = $this->input->post('Project_Name');
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

            mkdir('Repository/'.$project_name. '/Task Docs', 0777, TRUE);
            $config ['upload_path'] = './Repository/'.$project_name. '/Task Docs/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc|zip|xlsx';
            $this->load->library('upload', $config);
            // Cache the real $_FILES array, because the original
            // will be overwritten soon :)
            $files = $_FILES;
            $file_count = count($_FILES['user_files']['name']);

            print_r($file_count);

            // Iterate over the $files array
            for ($i = 0; $i < $file_count; $i++) {
                // Overwrite the default $_FILES array with a single file's data
                // to make the $_FILES array consumable by the upload library
                $_FILES['user_files']['name'] = $files['user_files']['name'][$i];
                $_FILES['user_files']['type'] = $files['user_files']['type'][$i];
                $_FILES['user_files']['tmp_name'] = $files['user_files']['tmp_name'][$i];
                $_FILES['user_files']['error'] = $files['user_files']['error'][$i];
                $_FILES['user_files']['size'] = $files['user_files']['size'][$i];

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('user_files')) {
                    // Handle upload errors

                    // If an error occurs jump to the next file
                    break;
                } else {
                    //$name = $this->upload->data();
                    $name = $data['uploads'][$i] = $this->upload->data();
                    //$data = array('file_name' =>$name['file_name']);
                    $attachment = array('Attachment_Task_Icode' => $insert_project,
                        'Attachment_Path' =>$name['file_name'],
                        'Attachment_Created_By' => $this->session->userdata['userid']);

                    $insert_attachment = $this->technical_user_model->Insert_Task_Attachment($attachment); /*Insert Task Attachments*/

                }
            }

            $this->session->set_flashdata('message', 'Task Created Successfully..');
            redirect('/User_Controller/Create_Task');

        }

    }
    /*Insert Task in Database*/


    /*Task Entry*/
    public function Task_Entry()
    {
        $this->data['task_details'] = $this->technical_user_model->Assigned_Task_Entry();
        //$this->data['Select_Project']= $this->technical_user_model->Show_On_Select_Project();
        $this->load->view('User/header');
        $this->load->view('User/left');
        $this->load->view('User/top');
        $this->load->view('User/task_entry', $this->data, FALSE);
        $this->load->view('User/footer');
    }
    /*Task Entry*/

    /*Single Assigned Task*/
    public function Single_Assigned_Task()
    {
        $this->load->view('User/header');
        $this->load->view('User/left');
        $this->load->view('User/top');
        //$this->load->view('User/task_entry');
        $this->load->view('User/footer');
    }
    //** Save task Entry details */
    public function  Save_Task_Entry()
    {

        $data = array('Task_Master_Icode' =>$this->input->post('task_id'),
            'Work_Progress'=> $this->input->post('work_progress'),
            'Logged_Hours' =>$this->input->post('work_hours'),
            'Created_By ' => $this->session->userdata['userid']);
        $insert_entry = $this->technical_user_model->save_task_entry($data);
        if($insert_entry == '1')
        {
            $this->session->set_flashdata('message', 'Task Updated Successfully..');
            redirect('/User_Controller/Task_Entry');
        }
        else{
            $this->session->set_flashdata('message', 'Failed..');
            redirect('/User_Controller/Task_Entry');
        }

    }

    public function multipleadd_data()
    {
        $stock_item_val = $this->input->post('user_files');
        foreach($stock_item_val as $key => $st_val)
        {
            if(!empty($_FILES['return']['name'][$key]))
            {
                foreach ($_FILES['return']['name'][$key] as $name => $value)
                {
                    $sourcePath = $_FILES['return']['tmp_name'][$key]['result_file'][0];//[$name]['result_file'][0]
                    if(!empty($sourcePath))
                    {
                        $image_name=date('ymdHis').$_FILES['return']['name'][$key]['result_file'][0];
                        $targetPath = "img/".$image_name;
                        move_uploaded_file($sourcePath,$targetPath);
                    }
                    else
                    {
                        $image_name='';
                    }
                }
            }
            else
            {
                $image_name='';
            }

            $data = array(
                'img_path' => $image_name,
                'name' => $st_val['name'],
                'address' => $st_val['address']
            );
            $this->db->insert('multiple_image', $data);
        }

        echo "success";
    }



}
?>