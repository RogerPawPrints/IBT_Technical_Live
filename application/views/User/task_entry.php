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

            <ul  class="nav nav-pills">
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
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
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
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
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
                                                    <td><?php echo $r['Task_End_Date']; ?></td>
                                                    <td><?php echo $r['Task_Estimated_Hours']; ?></td>
                                                    <td><?php echo $r['logged_hours']; ?></td>
                                                    <!--<td><a href='<?php /*echo site_url('User_Controller/Single_Assigned_Task'); */?>'>VIEW</a> </td>-->
                                                    <td><button type="button" id="mymodal" class="btn btn-primary"  data-toggle="modal" onclick="task_entry('<?php echo $r['Task_Icode']; ?>')" value="<?php echo $r['Task_Icode']; ?>" data-target="#myModal">Enter Progress</button></td>


                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Today's Task</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="create_task_form" action="<?php echo site_url('User_Controller/Save_Task_Entry'); ?>" enctype="multipart/form-data" method="post">
                                                            <input type="hidden" id="task_id" name="task_id">
                                                            <div class="form-group">
                                                                <label for="work_progress" class="form-control-label">Work Progress:</label>
                                                                <textarea class="form-control" id="work_progress" name="work_progress"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="work_hours" class="form-control-label">Hours:</label>
                                                                <input type="text" class="form-control" id="work_hours" name="work_hours">
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
                                        <h3>Other Task</h3>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function() {
        $('#assigned_tasks').DataTable();
    } );

    function task_entry(id) {
       document.getElementById('task_id').value = id;

    }


</script>

?>