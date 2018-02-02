<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author http://www.roytuts.com
 */
class File_Model extends CI_Model {

    //table name
    private $file = 'ibt_task_attachments';   // files

    function save_files_info($files,$id) {
        //start db traction
        $this->db->trans_start();
        //file data
        $file_data = array();
        foreach ($files as $file) {
            $file_data[] = array(
                'Attachment_Task_Icode' => $file['file_name'],
                'Attachment_Path' => $id,
                'Attachment_Created_By' => $this->session->userdata['userid']);

        }
        //insert file data
        $this->db->insert_batch($this->file, $file_data);
        //complete the transaction
        $this->db->trans_complete();
        //check transaction status
        if ($this->db->trans_status() === FALSE) {
            foreach ($files as $file) {
                $file_path = $file['full_path'];
                //delete the file from destination
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            //rollback transaction
            $this->db->trans_rollback();
            return FALSE;
        } else {
            //commit the transaction
            $this->db->trans_commit();
            return TRUE;
        }
    }

}