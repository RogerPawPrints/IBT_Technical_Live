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
        $this->load->helper('form');
        $this->load->helper('download');
        $this->load->helper('file');
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
        $data1 = $this->technical_user_model->Select_Project();
        $data2= $this->technical_user_model->Select_Resource_project();
        $this->data['Select_Project'] = array_merge($data1,$data2);
        //print_r($this->data['Select_Project']);
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

        $type_icode = $this->input->post('Type', true);

        if($type_icode == '1')
        {
            $data = $this->technical_user_model->Show_On_Select_Project($project_code);
        }
        else
            {
                $data = $this->technical_user_model->Show_On_Select_Resource($project_code);
        }


        //print_r($data);

//        $resource_name = $this->technical_user_model->Select_Resource($project_code);
        // print_r($resource_name);

        $full_data = array('Client_Details' => $data );

        echo json_encode($full_data);

    }
    /*select Resource and project details*/
    public function Show_On_Project_Resource()
    {
        $project_code = $this->input->post('id', true);
        $type_icode = $this->input->post('Type', true);

        if($type_icode == '1')
        {
            $resource_name = $this->technical_user_model->Select_Project_Resource($project_code);
            $output = null;
            foreach ( $resource_name as $row)
            {
                //here we build a dropdown item line for each
                // query result
                $output .= "<option value='".$row['User_Icode']."'>".$row['User_Name']."</option>";
            }
        }
        else
        {
            $resource_name = $this->technical_user_model->Select_Work_Order_Resource($project_code);
            $output = null;
            foreach ( $resource_name as $row)
            {
                //here we build a dropdown item line for each
                // query result
                $output .= "<option value='".$row['User_Icode']."'>".$row['User_Name']."</option>";
            }
        }


        echo $output;
    }

    //** show on project phase details */
    public function  Show_On_Project_Phase()
    {
        $project_code = $this->input->post('id', true);
        $type_icode = $this->input->post('Type', true);
        if($type_icode == '1')
        {
            $resource_name = $this->technical_user_model->Select_Project_Phase($project_code);
            $output = null;
            $output .= "<option>Select Phase</option>";
            foreach ( $resource_name as $row)
            {
                $output .= "<option value='".$row['Project_Phase_Icode']."'>".$row['Phase_Name']."</option>";
            }
            echo $output;
        }
        else
        {
            $output = "0";
            echo $output;
        }
    }
    /*Insert Task in Database*/
    public function Insert_Task()
    {
        $project_name = $this->input->post('Project_Name');
        $project = $this->input->post('Project_Select');
        $vall = explode("_",$project);
        $project_icode = $vall[0];
        $contract_type = $vall[1];
        if($contract_type == '1')
        {
            $task_data = array(
                'Task_Project_Icode' => $project_icode,
                'Task_Client_Icode' => $this->input->post('Client_Name_icode'),
                'Task_WO_Icode' => '0',
                'Task_Resource_Icode' => $this->input->post('Resource_Select'),
                'Task_Contract_Type' => $this->input->post('Contract_Type_icode'),
                'Task_Project_Phase_Icode' => $this->input->post('Phase_Select'),
                'Task_Start_Date' => $this->input->post('task_date_start'),
                'Task_End_Date' => $this->input->post('task_date_end'),
                'Task_Estimated_Hours' => $this->input->post('Task_E_Hour'),
                'Task_Description' => $this->input->post('task_desc'),
                'Task_Created_By' => $this->session->userdata['userid']);
            $insert_project = $this->technical_user_model->Insert_Task($task_data); /*Insert Task Details*/
            $data = array();
        }
        else{
            $task_data = array(
                'Task_Project_Icode' => '0',
                'Task_WO_Icode' => $project_icode,
                'Task_Client_Icode ' => $this->input->post('Client_Name_icode'),
                'Task_Resource_Icode' => $this->input->post('Resource_Select'),
                'Task_Contract_Type' => $this->input->post('Contract_Type_icode'),
                'Task_Project_Phase_Icode' => '0',
                'Task_Start_Date' => $this->input->post('task_date_start'),
                'Task_End_Date' => $this->input->post('task_date_end'),
                'Task_Estimated_Hours' => $this->input->post('Task_E_Hour'),
                'Task_Description' => $this->input->post('task_desc'),
                'Task_Created_By' => $this->session->userdata['userid']);
            $insert_project = $this->technical_user_model->Insert_Task($task_data); /*Insert Task Details*/
            $data = array();
        }
        /*Insert Task Attachments.*/
        if ($insert_project != '0') {
            //print_r($project_name);
            mkdir('Repository/'.$project_name. '/Task Docs', 0777, TRUE);
            $config ['upload_path'] = './Repository/'.$project_name. '/Task Docs/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc|zip|xlsx';
            $this->load->library('upload', $config);
            // Cache the real $_FILES array, because the original
            // will be overwritten soon :)
            $files = $_FILES;
            $file_count = count($_FILES['user_files']['name']);

            //print_r($file_count);

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
                        'Attachment_Project_Icode' =>$this->input->post('Project_Select'),
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
        $data1 = $this->technical_user_model->Assigned_Task_Entry();
        $data2= $this->technical_user_model->Assigned_Task_Entry_WO();
        $this->data['task_details'] = array_merge($data1,$data2);

        $this->load->view('User/header');
        $this->load->view('User/left');
        $this->load->view('User/top');
        $this->load->view('User/task_entry', $this->data, FALSE);
        $this->load->view('User/footer');
    }
    /*Task Entry*/



    //** Save task Entry details */
    public function  Save_Task_Entry()
    {
        $master_id = $this->input->post('task_id');
        $user_id=$this->session->userdata['userid'];

        $get_data = $this->technical_user_model->get_total_logged_hours($master_id,$user_id);
        //print_r($get_data[0]['Logged_Hours']);

        if($get_data[0]['Logged_Hours'] == "")
        {
           // print_r("empty");
            $Total_logged = $this->input->post('work_hours');
        }
        else{
            //print_r("not empty");
            $hours = $this->input->post('work_hours');
            $Lhours = $get_data[0]['Logged_Hours'];
            $Total_logged = $Lhours + $hours;

        }

        $data = array('Task_Master_Icode' =>$this->input->post('task_id'),
            'Task_Entry_Project_Icode' =>$this->input->post('project_id'),
            'Task_Phase_Icode' =>$this->input->post('phase_id'),
            'Task_Module_Icode' =>$this->input->post('Module_Select'),
            'Work_Progress'=> $this->input->post('work_progress'),
            'Logged_Hours' =>$this->input->post('work_hours'),
            'Total_Logged_Hours' =>$Total_logged,
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
    //** Save task Entry details */


    /*Selecting Phases & Modules*/
    public function get_phase_modules()
    {
        $project_id = $this->input->post('id',true);
        $phase_id=$this->input->post('Phase',true);
        $phase =  $this->technical_user_model->get_project_phase($project_id,$phase_id);


        $modules =  $this->technical_user_model->get_project_modules($project_id);
        $output1 = null;
        $output1 .= "<option>Select Module</option>";

        foreach ( $modules as $row)
        {
            //here we build a dropdown item line for each
            // query result
            $output1 .= "<option value='".$row['Project_Module_Icode']."'>".$row['Module_Name']."</option>";
        }

       // echo $output1;
        $full_data = array('phase_Details' => $phase,
                           'Modules' => $output1 );
        echo json_encode($full_data);
    }
    /*Selecting Phases & Modules*/

    /*Task Attachment List*/
    public function get_task_attachments()
    {
        $task_id = $this->input->post('id',true);
        $attachment =  $this->technical_user_model->get_task_attachments($task_id);
      // echo json_encode($attachment);
        $output = null;

        foreach ( $attachment as $row)
       {
           //   here we build a dropdown item line for each
           // query result
          $path = $row['Attachment_Path'];
          $folder=$row['Project_Name'];
          $output .= "<li class='list-group-item'> <a target='_blank' href='download/$folder/$path' >".$row['Attachment_Path']."</a></li>";
       }
       echo $output;

    }
    /*Task Attachment List*/
    /**
     * @param $folder
     * @param $path
     * Download Task Attachments
     */

    public function download($folder, $path) {
        // read file contents
        $folder =  $this->uri->segment(3);
        $path =  $this->uri->segment(4);
        $file_path =base_url('/Repository/'.$folder. '/Task Docs/' .$path);
//        fopen("/Repository/$folder/Task Docs/$path", "r");
        $url = str_replace(" ", "%20", $file_path);
        $data = file_get_contents($url);
         force_download($path.".",$data);
    }


    /*View Manage Tasks*/
    public function View_Manage_Task()
    {
        $this->data['manage_tasks'] = $this->technical_user_model->View_Manage_Task();
        //$this->data['Select_Project']= $this->technical_user_model->Show_On_Select_Project();
        $this->load->view('User/header');
        $this->load->view('User/left');
        $this->load->view('User/top');
        $this->load->view('User/view_manage_tasks', $this->data, FALSE);
        $this->load->view('User/footer');
    }
    /*View Manage Tasks*/

    /** Save manage Task */
    public function Save_Manage_Task()
    {
        $task_id= $this->input->post('Task_id',true);
        $billable = $this->input->post('Billable',true);
        //print_r($billable);
        $Task_Entry = $this->input->post('Task_Entry',true);
        $old_value =$this->technical_user_model->Get_Task_Billable_Hours($task_id);
        $new_billable = $old_value[0]['Task_Billable_Hours'] + $billable ;
        //print_r($new_billable);
        $data = array(
            'Task_Billable_Hours' => $new_billable,
            'Modified_By' =>$this->session->userdata['userid'],
            'Modified_On' =>date('Y-m-d'));
        $this->db->where('Task_Icode',$task_id);
        $this->db->update('ibt_task_master', $data);
        $task = array(
        'Leader_Reviewed' => 'Yes');
        $this->db->where('Task_Entry_Icode',$Task_Entry);
        $this->db->update('ibt_task_entry', $task);
        echo 1;
    }

    //** Get Task Description */
    public function Get_Task_Desc()
    {
        $task_id = $this->input->post('id',true);
        $attachment =  $this->technical_user_model->get_task_desc($task_id);
        // echo json_encode($attachment);
        $output = null;
        $output .="<h3>Project Name:</h3><h4>" .$attachment[0]['Project_Name']. "</h4>";
        $output .="<h3>Client:</h3><h4>" .$attachment[0]['Client_Company_Name']."</h4>";
        $output .="<h3>Task Description</h3>";
        $output .="<h4 style='line-height: 30px;'>" .$attachment[0]['Task_Description']. "</h4>";
        foreach ($attachment as $row)
        {
            $path = $row['Attachment_Path'];
            $folder=$row['Project_Name'];
            $output .= "<li class='list-group-item'> <a target='_blank' href='download/$folder/$path' >".$row['Attachment_Path']."</a></li>";
        }
        echo $output;
    }
    //** Close Task */
    public function  Close_Task()
    {
        $task_id = $this->input->post('id',true);
        $billable = $this->input->post('Billable',true);
        //print_r($billable);
        $Task_Entry = $this->input->post('Task_Entry',true);
        $old_value =$this->technical_user_model->Get_Task_Billable_Hours($task_id);
        $new_billable = $old_value[0]['Task_Billable_Hours'] + $billable ;
        $data = array(
            'Task_Billable_Hours' => $new_billable,
            'Task_Status' => '0',
            'Modified_By' =>$this->session->userdata['userid'],
            'Modified_On' =>date('Y-m-d'));
        $this->db->where('Task_Icode',$task_id);
        $this->db->update('ibt_task_master', $data);
        $task = array(
            'Leader_Reviewed' => 'Yes');
        $this->db->where('Task_Entry_Icode',$Task_Entry);
        $this->db->update('ibt_task_entry', $task);
        echo 1;
    }
    //** Show project phase details */
    public function Show_Project_Phase_Details()
    {
        $project_phase_id = $this->input->post('id',true);
        $data = $this->technical_user_model->Show_Project_Phase_Details($project_phase_id);

        $full_data = array('Phase_Details' => $data );

        echo json_encode($full_data);

    }
}
?>