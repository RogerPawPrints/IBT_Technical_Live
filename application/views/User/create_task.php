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
        <h1>
            Create Task
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Task Management</a></li>
            <li class="active">Create Task</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row padding_class">
                            <div class="col-md-12">
                                <form name="create_task_form" action="<?php echo site_url('User_Controller/Insert_Task'); ?>" enctype="multipart/form-data" method="post">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Select Project</label>
                                        <select name="Project_Select" class="form-control" id="Project_Select"  required >
                                            <option value="" >Select Project</option>
                                            <?php foreach ($Select_Project as $row):
                                            {
                                                echo "<option value= " .$row['Project_Icode'].">" . $row['Project_Name'] . "</option>";
                                            }
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div id="show_on_project" style="display: none">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Client Name</label>
                                            <input class="form-control" type="text"  name="Client_Name" id="Client_Name" readonly  />
                                            <input class="form-control" type="hidden"  name="Client_Name_icode" id="Client_Name_icode" readonly  />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Work Category</label>
                                            <input class="form-control" type="text" name="Work_Category" id="Work_Category" readonly  />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Work Type</label>
                                            <input class="form-control" type="text" name="Work_Type" id="Work_Type" readonly  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="Fixed" >
                            <div class="row padding_class" >
                                <div class="col-md-12" >
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Resource</label>
                                            <select name="Resource_Select" class="form-control" id="Resource_Select"  required >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Task Start Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"> </i>
                                            </div>
                                            <input class="form-control" type="text" placehoder="Task Start Date" name="task_date_start" id="startdate"/>
                                            <!--<input class="form-control" id="date_start" name="date_start" placeholder="YYYY/MM/DD" type="text"/>-->
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Task End Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <!--<input class="form-control" id="date_end" name="date_end" placeholder="YYYY/MM/DD" type="text"/>-->
                                            <input class="form-control" type="text" placehoder="Task End Date" name="task_date_end" id="enddate"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Estiamtion Hour</label>
                                        <div class="form-group">
                                            <input class="form-control" id="Task_E_Hour" name="Task_E_Hour" placeholder="Estimtion Hours" type="number" min="0" step="1"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Task Description</label>
                                            <textarea name="task_desc" id="task_desc" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <legend>Upload Multiple File(s).</legend>
                                            <label>Task Attachments</label>
                                            <input type="file" class="form-control-file" name="Task_Attachment[]" multiple id="Task_Attachment" required />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" name="insert_task" class="btn btn-success pull-right" >Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script type="text/javascript">

    $(document).ready(function() {

        $("#startdate").datepicker({
            todayBtn: 1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#enddate').datepicker('setStartDate', minDate);
        });


        $("#enddate").datepicker()
            .on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
            });


        $("#Project_Select").change(function () {         /*Selecting Project Detais And Resource*/
             //alert("hiiii");
            /*dropdown post *///
            //document.getElementById('Resource_Select').value = '';
            $.ajax({
                url: "<?php echo site_url('User_Controller/Show_On_Project_Select'); ?>",
                data: {
                    id:
                        $(this).val()
                },
                type: "POST",
                success: function (data) {
                    // alert(data);
                    $("#show_on_project").show();
                    var task_details = $.parseJSON(data);
                    //alert(task_details);
                    var client_name = task_details.Client_Details[0]['Client_Company_Name'];
                    //alert(client_name);
                    document.getElementById('Client_Name').value = client_name;

                    var Client_Name_icode = task_details.Client_Details[0]['Client_Icode'];
                    //alert(client_name);
                    document.getElementById('Client_Name_icode').value = Client_Name_icode;

                    var work_cat = task_details.Client_Details[0]['WorkCategory_Name'];
                    document.getElementById('Work_Category').value = work_cat;

                    var work_type = task_details.Client_Details[0]['Work_Name'];
                    document.getElementById('Work_Type').value = work_type;

                }


            });
        });


        $("#Project_Select").change(function () {         /*Selecting Project Detais And Resource*/
            //alert("hiiii");
            /*dropdown post *///
            //document.getElementById('Resource_Select').value = '';
            $.ajax({
                url: "<?php echo site_url('User_Controller/Show_On_Project_Resource'); ?>",
                data: {
                    id:
                        $(this).val()
                },
                type: "POST",
                success: function (data) {
                    $("#Resource_Select").html(data);
                }


            });
        });
    });


</script>
