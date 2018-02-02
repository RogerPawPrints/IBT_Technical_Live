<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author http://www.roytuts.com
 */
class UploadFiles extends CI_Controller {

    private $error;
    private $success;

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('file_model', 'file');
        $this->load->model('Technical_User_Model', 'technical_user_model'); /* LOADING MODEL * Technical_User_Model as technical_user_model */
    }

    private function handle_error($err) {
        $this->error .= $err . "\r\n";
    }

    private function handle_success($succ) {
        $this->success .= $succ . "\r\n";
    }

    function index() {
        if ($this->input->post('file_upload')) {

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
            if ($insert_project != '0') {
                //file upload destination
                $dir_path = './uploads/';
                $config['upload_path'] = $dir_path;
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['max_filename'] = '255';
                $config['encrypt_name'] = TRUE;

                //upload file
                $i = 0;
                $files = array();
                $is_file_error = FALSE;

                if ($_FILES['upload_file1']['size'] <= 0) {
                    $this->handle_error('Select at least one file.');
                } else {
                    foreach ($_FILES as $key => $value) {
                        if (!empty($value['name'])) {
                            $this->load->library('upload', $config);
                            if (!$this->upload->do_upload($key)) {
                                $this->handle_error($this->upload->display_errors());
                                $is_file_error = TRUE;
                            } else {
                                $files[$i] = $this->upload->data();
                                ++$i;
                            }
                        }
                    }
                }

                // There were errors, we have to delete the uploaded files
                if ($is_file_error && $files) {
                    for ($i = 0; $i < count($files); $i++) {
                        $file = $dir_path . $files[$i]['file_name'];
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                }

                if (!$is_file_error && $files) {
                    $resp = $this->file->save_files_info($files,$insert_project);
                    if ($resp === TRUE) {
                        $this->handle_success('File(s) was/were successfully uploaded.');
                    } else {
                        for ($i = 0; $i < count($files); $i++) {
                            $file = $dir_path . $files[$i]['file_name'];
                            if (file_exists($file)) {
                                unlink($file);
                            }
                        }
                        $this->handle_error('Error while saving file info to Database.');
                    }
                }
            }
        }
        else{

        }
        $data['errors'] = $this->error;
        $data['success'] = $this->success;
       // $this->load->view('uploadfiles', $data);
    }

}