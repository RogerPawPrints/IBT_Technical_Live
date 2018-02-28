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
                                                <th>Contract Type</th>
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
                                                    <td><?php echo $r['Contracttype_Name']; ?></td>
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

                                                    <?php
                                                    if($r['Task_Project_Icode'] == 0)
                                                    {
                                                        ?>
                                                        <td><button type="button" id="mymodal1" class="btn btn-success"  data-toggle="modal" onclick="get_attachments('<?php echo $r['Task_Icode']; ?>')" value="<?php echo $r['Task_Icode']; ?>" data-target="#myModal1">Attachments</button></td>
                                                        <!--<td><a href='<?php /*echo site_url('User_Controller/Single_Assigned_Task'); */?>'>VIEW</a> </td>-->
                                                        <td><button type="button" id="mymodal" class="btn btn-primary"  data-toggle="modal" onclick="task_entry_resource('<?php echo $r['Task_Icode']; ?>', '<?php echo $r['Task_WO_Icode']; ?>')" value="<?php echo $r['Task_Icode']; ?>" data-target="#myModal_Resource">Enter Progress</button></td>

                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <td><button type="button" id="mymodal1" class="btn btn-success"  data-toggle="modal" onclick="get_attachments('<?php echo $r['Task_Icode']; ?>')" value="<?php echo $r['Task_Icode']; ?>" data-target="#myModal1">Attachments</button></td>
                                                        <!--<td><a href='<?php /*echo site_url('User_Controller/Single_Assigned_Task'); */?>'>VIEW</a> </td>-->
                                                        <td><button type="button" id="mymodal" class="btn btn-primary"  data-toggle="modal" onclick="task_entry('<?php echo $r['Task_Icode']; ?>','<?php echo $r['Task_Project_Icode']; ?>','<?php echo $r['Task_Project_Phase_Icode']; ?>')" value="<?php echo $r['Task_Icode']; ?>" data-target="#myModal">Enter Progress</button></td>

                                                        <?php
                                                    }
                                                    ?>


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
<!--                                                    <form name="create_task_form" action="--><?php //echo site_url('User_Controller/Save_Task_Entry'); ?><!--" enctype="multipart/form-data" method="post">-->
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Today's Task</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="create_task_form" action="<?php echo site_url('User_Controller/Save_Task_Entry'); ?>" enctype="multipart/form-data" method="post">
                                                            <input type="hidden" id="task_id" name="task_id">
                                                            <input type="hidden" id="project_id" name="project_id">
                                                            <div class="form-group">
                                                                <label>Phase</label>
                                                               <input type="hidden" class="form-control" name="phase_id" id="phase_id">
                                                                <input type="text" class="form-control" name="phase_name" id="phase_name" readonly>
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

                                        <div class="modal fade" id="myModal_Resource" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form name="create_task_form" action="<?php echo site_url('User_Controller/Save_Resource_Task_Entry'); ?>" enctype="multipart/form-data" method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Today's Task</h4>
                                                        </div>
                                                        <div class="modal-body">
<!--                                                            <form name="create_task_form" action="--><?php //echo site_url('User_Controller/Save_Task_Entry'); ?><!--" enctype="multipart/form-data" method="post">-->
                                                                <input type="text" id="wo_task_id" name="wo_task_id">
                                                                <input type="text" id="wo_id" name="wo_id">
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
                                        <div class="row padding_class">
                                            <div class="col-md-12" >
                                                <h2>Other Task</h2>
                                                <table id="tblCustomers5"  data-page-length='25' class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Task Type</th>
                                                        <th>Project</th>
                                                        <th>Phase</th>
                                                        <th>Project Incharge</th>
                                                        <th>Task Category</th>
                                                        <th>Description</th>
                                                        <th>Task Date</th>
                                                        <th>Logged Hours</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <select name="Task_Type[]" class="form-control" id="Task_Type" required >
                                                                    <option value="" >Select Task Type</option>
                                                                    <option value="Project" >Project</option>
                                                                    <option value="Non_Project" >Non_Project</option>
                                                                </select>

                                                            </div>
                                                        </td>

                                                        <td class="Project1" >
                                                            <div class="form-group">
                                                                <select name="Project_Name[]" class="form-control" id="Project_Name" required >
                                                                    <option value="" >Select Project</option>
                                                                    <?php foreach ($Project_details as $row):
                                                                    {
                                                                        if($row['Project_Contract_Icode'] == '1')
                                                                        {
                                                                            echo "<option value= " .$row['Project_Icode']._.$row['Project_Contract_Icode']. ">" . $row['Project_Name'] . "</option>";
                                                                        }
                                                                        else{
                                                                            echo "<option value= " .$row['Work_Order_Icode']._.$row['Resource_Contract_Type'].">" . $row['Project_Name'] . "</option>";
                                                                        }

                                                                    }
                                                                    endforeach; ?>
                                                                </select>

                                                            </div>
                                                        </td>

                                                        <td class="Project1">
                                                            <div class="form-group">
                                                                <select name="Phase[]" class="form-control" id="Phase" required >
                                                                    <option value="" >Select Phase</option>
                                                                    <?php foreach ($Contract_Term as $row):
                                                                    {
                                                                        echo '<option value= "'.$row['Contract_Term_Icode'].'">' . $row['Contract_Term_Name'] . '</option>';
                                                                    }
                                                                    endforeach; ?>
                                                                </select>

                                                            </div>
                                                        </td>

                                                        <td class="Project" style="display: none;" >
                                                            <div class="form-group">
                                                                <select  class="form-control"  required  readonly="">

                                                                </select>

                                                            </div>
                                                        </td>

                                                        <td class="Project" style="display: none;">
                                                            <div class="form-group">
                                                                <select  class="form-control"  required readonly="">

                                                                </select>

                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar">
                                                                    </i>
                                                                </div>
                                                                <input class="form-control" id="Contract_date_start" name="Contract_date_start[]" placeholder="YYYY/MM/DD" type="text"/>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar">
                                                                    </i>
                                                                </div>
                                                                <input class="form-control" id="Contract_date_end" name="Contract_date_end[]" placeholder="YYYY/MM/DD" type="text"/>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input  class="form-control" name="Hours[]" id="Hours" placeholder="Min Billable Hours" type="number" min="0" step="1" required />
                                                            </div>
                                                        </td>

                                                        <td><input type="button" onclick="Add()" value="Add" /></td>
                                                    </tr>

                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right" onclick="Save_Fixed()" >Save</button>
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

        $("#Task_Type").change(function(){
            var value = $("#Task_Type option:selected").val();

            if(value == 'Project')
            {
                alert("show");
                $('.Project').hide();
                $('.Project1').show();
            }
            else
            {
                alert("hide");
                $('.Project').show();
                $('.Project1').hide();
            }


        });

    }    );







</script>

?>