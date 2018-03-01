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
                                                                <input type="hidden" name="Contract_Id[]" id="Contract_Id">

                                                            </div>
                                                        </td>

                                                        <td class="Project1">
                                                            <div class="form-group">
                                                                <select name="Phase_Select[]" class="form-control" id="Phase_Select"  >
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

                                                        <td id="project_leader" style="display: none">
                                                            <div class="input-group">
                                                                <input type="hidden" name="Project_Leader_Id[]" id="Project_Leader_Id">
                                                                <input type="text" name="Project_Leader_Name" id="Project_Leader_Name" readonly>

                                                            </div>
                                                        </td>
                                                        <td id="User_leader">
                                                            <div class="form-group">
                                                                <select name="User_Name[]" class="form-control" id="User_Name" required >
                                                                    <option value="" >Select Incharge</option>
                                                                    <?php foreach ($Incharge as $row):
                                                                    {
                                                                        echo "<option value= " .$row['User_Icode'].">" . $row['User_Name'] . "</option>";
                                                                    }
                                                                    endforeach; ?>
                                                                </select>

                                                            </div>
                                                        </td>

                                                        <td class="Project">
                                                            <div class="input-group">
                                                                <select name="Task_Category[]" class="form-control" id="Task_Category" required >
                                                                    <option value="" >Task Category</option>
                                                                    <?php foreach ($task_category as $row):
                                                                    {
                                                                        echo "<option value= " .$row['Task_Category_Icode'].">" . $row['Task_Category_Name'] . "</option>";
                                                                    }
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="Project1" style="display: none;" >
                                                            <div class="form-group">
                                                                <select  class="form-control"  required  readonly="">

                                                                </select>

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <textarea name="task_desc[]" id="task_desc" class="form-control"></textarea>
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
                                                            <div class="form-group">
                                                                <input  class="form-control" name="Hours[]" id="Hours" placeholder="Logged Hours" type="number" min="0" step="1" required />
                                                            </div>
                                                        </td>

                                                        <td><input type="button" onclick="Add()" value="Add" /></td>
                                                    </tr>

                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right" onclick="Save_Task()" >Save</button>
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

        $("#Contract_date_start").datepicker({
            todayBtn:  1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Contract_date_end').datepicker('setStartDate', minDate);
        });

        $("#Task_Type").change(function(){
            var value = $("#Task_Type option:selected").val();

            if(value == 'Project')
            {
                //alert("show");
                $('.Project').hide();
                $('.Project1').show();
            }
            else
            {
                //alert("hide");
                $('.Project').show();
                $('.Project1').hide();
                $('#User_leader').show();
                $('#project_leader').hide();
            }


        });

        $("#Project_Name").change(function () {         /*Selecting Project Phase Detais */
            var result = $(this).val();
            var str_array = result.split('_');
            var id = str_array[0];
            var type = str_array[1];
            document.getElementById('Contract_Id').value = type;
            $.ajax({
                url: "<?php echo site_url('User_Controller/Show_On_Project_Phase'); ?>",
                data: {
                    id: id,
                    Type: type
                },
                type: "POST",
                success: function (data) {

                    if(data == '0')
                    {
                        $("#Phase_Select").hide();
                        $(".Phase").show();
                    }
                    else
                    {
                        $("#Phase_Select").show();
                        $(".Phase").hide();
                        $("#Phase_Select").html(data);
                    }

                }

            });
        });
        $("#Project_Name").change(function () {         /*Selecting Project Phase Detais */
            var result = $(this).val();
            var str_array = result.split('_');
            var id = str_array[0];
            var type = str_array[1];
            $.ajax({
                url: "<?php echo site_url('User_Controller/Get_Project_Incharge'); ?>",
                data: {
                    id: id,
                    Type: type
                },
                type: "POST",
                success: function (data) {
                    $('#project_leader').show();
                    $('#User_leader').hide();
                    var task_details = $.parseJSON(data);
                    var leader_name = task_details[0]['User_Name'];
                    document.getElementById('Project_Leader_Name').value = leader_name;
                    var leader_id = task_details[0]['User_Icode'];
                    document.getElementById('Project_Leader_Id').value = leader_id;
                }

            });
        });

    }    );

    function Add() {

        if($('#Task_Type').val() == "" || $('#task_desc').val() == "" || $('#Contract_date_start').val() == "" || $('#Hours').val() == "" )
        {
            alert("Please Fill All Fields...");
        }
        else
        {

            var Task_Type = $("#Task_Type option:selected").text();
            var Project_Name = $("#Project_Name option:selected").text();
            var Phase_Select = $("#Phase_Select option:selected").text();
            var task_category = $("#Task_Category option:selected").text();
            var user_name = $("#User_Name option:selected").text();
            AddRow($('#Task_Type').val(), $("#Phase_Select").val(),$("#Project_Name option:selected").val(),$("#Project_Leader_Id").val(),$("#User_Name").val(),$("#task_desc").val(),
                $("#Contract_date_start").val(),$("#Hours").val(),$("#Task_Category").val(),$("#Project_Leader_Name").val(),Task_Type,Project_Name,Phase_Select,task_category,user_name);
            $("#Task_Type").val("");
            $("#Phase_Select").val("");
            $("#Project_Name").val("");
            $("#Contract_date_start").val("");
            $("#Project_Leader_Id").val("");
            $("#Hours").val("");
            $("#User_Name").val("");
            $("#task_desc").val("");
            $("#Task_Category").val("");
            $("#Project_Leader_Name").val("");
        }

    }
    function AddRow(Task_Type,Phase_Select,Project_Name,Project_Leader_Id,User_Name,task_desc,Contract_date_start,Hours,Task_Category,project_leader_name,Task_Type1,Project_Name1,Phase_Select1,task_category1,user_name1) {
        //Get the reference of the Table's TBODY element.
        // alert(Project_Name);

        var str_array = Project_Name.split('_');
        var Project_id = str_array[0];
        var Contract_id = str_array[1];


        if(Task_Type == 'Project')
        {
            var tBody = $("#tblCustomers5 > TBODY")[0];
            //Add Row.
            row = tBody.insertRow(-1);
            //Add Task Type
            var cell = $(row.insertCell(-1));
            var tech = $("<input />");
            tech.attr("type", "text");
            tech.attr("name", "Task_Type[]");
            tech.val(Task_Type);
            cell.append(tech);

            // Project name
            var cell = $(row.insertCell(-1));
            var term = $("<input />");
            term.attr("type", "hidden");
            term.attr("name", "Project_Name[]");
            term.val(Project_id);
            cell.append(term);

            var contract = $("<input />");
            contract.attr("type", "hidden");
            contract.attr("name", "Contract_Id[]");
            contract.attr('readonly', true);
            contract.val(Contract_id);
            cell.append(contract);


            var term1 = $("<input />");
            term1.attr("type", "text");
            term1.attr("name", "test1");
            term1.attr('readonly', true);
            term1.val(Project_Name1);
            cell.append(term1);

            //phase name
            var cell = $(row.insertCell(-1));
            var membe = $("<input />");
            membe.attr("type", "hidden");
            membe.attr("name", "Phase_Select[]");
            membe.val(Phase_Select);
            cell.append(membe);

            var membe1 = $("<input />");
            membe1.attr("type", "text");
            membe1.attr("name", "test2");
            membe1.attr('readonly', true);
            membe1.val(Phase_Select1);
            cell.append(membe1);

            // project leader
            var cell = $(row.insertCell(-1));
            var expr = $("<input />");
            expr.attr("type", "hidden");
            expr.attr("name", "Project_Leader_Id[]");
            expr.attr('readonly', true);
            expr.val(Project_Leader_Id);
            cell.append(expr);
            var membe2 = $("<input />");
            membe2.attr("type", "text");
            membe2.attr("name", "test2");
            membe2.attr('readonly', true);
            membe2.val(project_leader_name);
            cell.append(membe2);

            // task category
            var cell = $(row.insertCell(-1));
            var task = $("<input />");
            task.attr("type", "hidden");
            task.attr("name", "Task_Category[]");
            task.val(0);
            cell.append(task);

            // work progress
            cell = $(row.insertCell(-1));
            var desc = $("<input />");
            desc.attr("type", "text");
            desc.attr("name", "task_desc[]");
            desc.attr('readonly', true);
            desc.val(task_desc);
            cell.append(desc);

            //task date
            cell = $(row.insertCell(-1));
            var Area = $("<input />");
            Area.attr("type", "text");
            Area.attr("name", "Contract_date_start[]");
            Area.attr('readonly', true);
            Area.val(Contract_date_start);
            cell.append(Area);

            //hours
            cell = $(row.insertCell(-1));
            var time = $("<input />");
            time.attr("type", "text");
            time.attr("name", "Hours[]");
            time.attr('readonly', true);
            time.val(Hours);
            cell.append(time);
        }
        else
        {
            var tBody = $("#tblCustomers5 > TBODY")[0];
            row = tBody.insertRow(-1);
            //Add Task Type
            var cell = $(row.insertCell(-1));
            var tech = $("<input />");
            tech.attr("type", "text");
            tech.attr("name", "Task_Type[]");
            tech.val(Task_Type);
            cell.append(tech);

            // Project name
            var cell = $(row.insertCell(-1));
            var term = $("<input />");
            term.attr("type", "hidden");
            term.attr("name", "Project_Name[]");
            term.val(Project_id);
            cell.append(term);
            var contract = $("<input />");
            contract.attr("type", "text");
            contract.attr("name", "Contract_Id[]");
            contract.attr('readonly', true);
            contract.val(0);
            cell.append(contract);



            //phase name
            var cell = $(row.insertCell(-1));
            var membe = $("<input />");
            membe.attr("type", "hidden");
            membe.attr("name", "Phase_Select[]");
            membe.val(Phase_Select);
            cell.append(membe);

            //user select leader
            var cell = $(row.insertCell(-1));
            var leader = $("<input />");
            leader.attr("type", "hidden");
            leader.attr("name", "Project_Leader_Id[]");
            leader.val(User_Name);
            cell.append(leader);
            var leader1 = $("<input />");
            leader1.attr("type", "text");
            leader1.attr("name", "test2");
            leader1.attr('readonly', true);
            leader1.val(user_name1  );
            cell.append(leader1);

            //Task Category
            var cell = $(row.insertCell(-1));
            var task = $("<input />");
            task.attr("type", "hidden");
            task.attr("name", "Task_Category[]");
            task.val(Task_Category);
            cell.append(task);
            var task1 = $("<input />");
            task1.attr("type", "text");
            task1.attr("name", "test2");
            task1.attr('readonly', true);
            task1.val(task_category1);
            cell.append(task1);

            //task description
            cell = $(row.insertCell(-1));
            var desc = $("<input />");
            desc.attr("type", "text");
            desc.attr("name", "task_desc[]");
            desc.attr('readonly', true);
            desc.val(task_desc);
            cell.append(desc);

            //task date
            cell = $(row.insertCell(-1));
            var Area = $("<input />");
            Area.attr("type", "text");
            Area.attr("name", "Contract_date_start[]");
            Area.attr('readonly', true);
            Area.val(Contract_date_start);
            cell.append(Area);

            //hours
            cell = $(row.insertCell(-1));
            var time = $("<input />");
            time.attr("type", "text");
            time.attr("name", "Hours[]");
            time.attr('readonly', true);
            time.val(Hours);
            cell.append(time);

        }

        //Add Button cell.
        cell = $(row.insertCell(-1));
        var btnRemove = $("<input />");
        btnRemove.attr("type", "button");
        btnRemove.attr("onclick", "Remove(this);");
        btnRemove.val("Remove");
        cell.append(btnRemove);
    }

    //** Save Fixed Cost **//
    function Save_Task()
    {
        var type =document.getElementsByName("Task_Type[]");
        var task_type = [];
        for (var j = 0, iLen = type.length; j < iLen; j++) {
            task_type.push(type[j].value);
        }

        if(task_type == 'Non_Project')
        {
            //alert("first");

            var leader = document.getElementsByName("User_Name[]");
            var project_leader = [];
            for (var i = 0, iLen = leader.length; i < iLen; i++) {
                project_leader.push(leader[i].value);
            }

        }
        else
        {
            //alert("multiple");
            var leader = document.getElementsByName("Project_Leader_Id[]");
            var project_leader = [];
            for (var i = 0, iLen = leader.length; i < iLen; i++) {
                project_leader.push(leader[i].value);
            }
        }




        var project = document.getElementsByName('Project_Name[]');
        var project_icode = [];
        for (var i = 0, iLen = project.length; i < iLen; i++) {
            project_icode.push(project[i].value);
        }

        var contract = document.getElementsByName('Contract_Id[]');
        var contract_icode = [];
        for (var i = 0, iLen = contract.length; i < iLen; i++) {
            contract_icode.push(contract[i].value);
        }



        var phase = document.getElementsByName("Phase_Select[]");
        var phase_icode = [];
        for (var i = 0, iLen = phase.length; i < iLen; i++) {
            phase_icode.push(phase[i].value);
        }




        var category = document.getElementsByName("Task_Category[]");
        var task_category = [];
        for (var i = 0, iLen = category.length; i < iLen; i++) {
            task_category.push(category[i].value);
        }

        var desc = document.getElementsByName("task_desc[]");
        var description = [];
        for (var i = 0, iLen = desc.length; i < iLen; i++) {
            description.push(desc[i].value);
        }

        var start_date = document.getElementsByName("Contract_date_start[]");
        var task_start_date = [];
        for (var i = 0, iLen = start_date.length; i < iLen; i++) {
            task_start_date.push(start_date[i].value);
        }
        var Hour_P = document.getElementsByName("Hours[]");
        var Min_Hour = [];
        var total = 0;
        for (var i = 0, iLen = Hour_P.length; i < iLen; i++) {
            Min_Hour.push(Hour_P[i].value);

        }

        if(task_type == "")
        {
            alert("Please Fill All Fields...");
        }
        else {

            $.ajax({
                url: "<?php echo site_url('User_Controller/Save_Other_Task_Entry'); ?>",
                data: {
                    Task_Type: task_type, Project_Id: project_icode,Contract_Id: contract_icode,
                    Phase_Id: phase_icode, Project_Leader: project_leader,
                    Task_Category: task_category, Task_Description: description,
                    Task_Date: task_start_date, Logged_Hours: Min_Hour
                },
                type: "POST",
                cache: false,
                success: function (data) {
                    if (data == '1') {
                        swal({
                                title: "Good job!",
                                text: "You clicked the button!",
                                type: "success"
                            },
                            function () {
                                location.reload();
                            });
                    }
                    else {
                        alert("Failed..");
                    }

                }
            })
        }

    }
    function Remove(button) {
        //Determine the reference of the Row using the Button.
        var row = $(button).closest("TR");
        var name = $("TD", row).eq(0).html();
        if (confirm("Do you want to delete: ")) {

            //Get the reference of the Table.
            var table = $("#tblCustomers5")[0];

            //Delete the Table row using it's Index.
            table.deleteRow(row[0].rowIndex);
        }
    };


    function task_entry(id,project,phase_id) {
        document.getElementById('task_id').value = id;
        //alert(id);
        document.getElementById('project_id').value = project;

        $.ajax({
            url: "<?php echo site_url('User_Controller/get_phase_modules'); ?>",
            data: {
                id: project,
                Phase: phase_id

            },
            type: "POST",
            success: function (data) {
                var phase_modules = $.parseJSON(data);

                var phasename = phase_modules.phase_Details[0]['Phase_Name'];
                document.getElementById('phase_name').value = phasename;
                var phaseid = phase_modules.phase_Details[0]['Project_Phase_Icode'];
                document.getElementById('phase_id').value = phaseid;
                $("#Module_Select").html(phase_modules.Modules);
            }


        });

    }

    function task_entry_resource(id,wo) {
        alert(id);
        alert(wo);
        document.getElementById('wo_task_id').value = id;
        //alert(id);
        document.getElementById('wo_id').value = wo;
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