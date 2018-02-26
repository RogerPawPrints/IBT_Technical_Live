<?php
/**Vibu */
?>
<style>
    .padding_class {
        padding: 10px 0;
    }
    h2{
        padding: 3px;
        background:#3c8dbc;
        color: white;
        font-family: initial;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php if($this->session->flashdata('message')){?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('message')?>
            </div>
        <?php } ?>
        <h1 style="margin-bottom: 20px;">
            Task Entry
            <small></small>
        </h1>

            <ul  class="nav nav-pills" id="myTab">
                <li class="active"><a  href="#1a" data-toggle="tab">Assigned Task</a></li>
                <li><a href="#2a" data-toggle="tab">Other</a></li>
            </ul>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row padding_class">
                            <div class="col-md-12">
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="1a">
                                        <h3>Assigned Tasks</h3>

                                        <table id="assigned_tasks" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <th>Client</th>
                                                <th>Project</th>
                                                <th>Lead</th>
                                                <th>Task Description</th>
                                                <th>Start date</th>
                                                <th>End Date</th>
                                                <th>Estimated Hours</th>
                                                <th>Logged Hours</th>
                                                <th>Attachments</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php
                                            $i=1;
                                            foreach($task_details as $r)
                                            {
                                                ?>
                                                <tr>

                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $r['Client_Company_Name']; ?></td>
                                                    <td><?php echo $r['Project_Name']; ?></td>
                                                    <td><?php echo $r['User_Name']; ?></td>
                                                    <td><?php echo $r['Task_Description']; ?></td>
                                                    <td><?php echo $r['Task_Start_Date']; ?></td>
                                                    <?php
                                                    $current_date = date('m/d/Y');
                                                    if ($r['Task_End_Date'] < $current_date){ ?>
                                                        <td style="background: #ff0e0eba"><?php echo $r['Task_End_Date']; ?></td>
                                                    <?php } else {?>

                                                        <td><?php echo $r['Task_End_Date']; ?></td>
                                                    <?php } ?>


                                                    <td><?php echo $r['Task_Estimated_Hours']; ?></td>
                                                    <?php
                                                    if ($r['logged_hours'] > $r['Task_Estimated_Hours']){ ?>
                                                        <td style="background: #ff0e0eba"><?php echo $r['logged_hours']; ?></td>
                                                    <?php } else {?>

                                                        <td><?php echo $r['logged_hours']; ?></td>
                                                    <?php } ?>

                                                    <td><button type="button" id="mymodal1" class="btn btn-success"  data-toggle="modal" onclick="get_attachments('<?php echo $r['Task_Icode']; ?>')" value="<?php echo $r['Task_Icode']; ?>" data-target="#myModal1">Attachments</button></td>
                                                    <!--<td><a href='<?php /*echo site_url('User_Controller/Single_Assigned_Task'); */?>'>VIEW</a> </td>-->
                                                    <td><button type="button" id="mymodal" class="btn btn-primary"  data-toggle="modal" onclick="task_entry('<?php echo $r['Task_Icode']; ?>', '<?php echo $r['Task_Project_Icode']; ?>')" value="<?php echo $r['Task_Icode']; ?>" data-target="#myModal">Enter Progress</button></td>

                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Task Attachments</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <ul class="list-group" id="attachment_list">


                                                        </ul>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->


                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form name="create_task_form" action="<?php echo site_url('User_Controller/Save_Task_Entry'); ?>" enctype="multipart/form-data" method="post">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Today's Task</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="create_task_form" action="<?php echo site_url('User_Controller/Save_Task_Entry'); ?>" enctype="multipart/form-data" method="post">
                                                            <input type="hidden" id="task_id" name="task_id">
                                                            <input type="hidden" id="project_id" name="project_id">
                                                            <div class="form-group">
                                                                <label>Select Phase</label>
                                                                <select name="Phase_Select" class="form-control" required="required" id="Phase_Select"  required >
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Select Module</label>
                                                                <select name="Module_Select" class="form-control" id="Module_Select"  required >
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="work_progress" class="form-control-label">Work Progress:</label>
                                                                <textarea class="form-control" required="required" id="work_progress" name="work_progress" ></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="work_hours" class="form-control-label">Hours:</label>
                                                                <input class="form-control" required="required" id="work_hours" name="work_hours" type="number" min="0" step="1">
                                                            </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" >Save changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->


                                    </div>
                                    <div class="tab-pane" id="2a">
                                        <h3>Other Task.</h3>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        /*stay in same tab after form submit*/
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){

            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
        /*stay in same tab after form submit*/
        $('#assigned_tasks').DataTable();

    }    );

    function task_entry(id,project) {

       document.getElementById('task_id').value = id;
       //alert(id);
       document.getElementById('project_id').value = project;

        $.ajax({
            url: "<?php echo site_url('User_Controller/get_phase_modules'); ?>",
            data: {
                id: project
            },
            type: "POST",
            success: function (data) {
                var phase_modules = $.parseJSON(data);
                //alert(phase_modules.phase_Details);
                $("#Phase_Select").html(phase_modules.phase_Details);
                $("#Module_Select").html(phase_modules.Modules);
            }


        });

    }


    function get_attachments(id) {
        document.getElementById('task_id').value = id;
        $.ajax({
            url: "<?php echo site_url('User_Controller/get_task_attachments'); ?>",
            data: {
                id: id
            },
            type: "POST",
            success: function (data) {
//                var attachments = $.parseJSON(data);
//                var count = Object.keys(attachments).length;
//               alert(count);
//                for(var i = 0; i < count; i++)
//                {
//                   var  file = attachments[i];
//                   var folder =file.Project_Name;
//                    $('#attachment_list').append("<li><a href='<?php //echo base_url(); ?>//index.php/User_Controller/download/"+file.Project_Name+"/"+file.Attachment_Path+"/ '>" + file.Attachment_Path +  "</a></li>" );
//                }
                $('#attachment_list').html(data);
            }
        });
    }


</script>

?>