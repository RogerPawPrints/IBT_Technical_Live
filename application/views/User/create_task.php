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
                                        <label>Project Start Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            <input class="form-control" type="text" placehoder="Start Date" name="date_start" id="startdate"/>

                                            <!--                                        <input class="form-control" id="date_start" name="date_start" placeholder="YYYY/MM/DD" type="text"/>-->
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Planned end date </label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            <!--                                        <input class="form-control" id="date_end" name="date_end" placeholder="YYYY/MM/DD" type="text"/>-->
                                            <input class="form-control" type="text" placehoder="End Date" name="date_end" id="enddate"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Estiamtion Hour</label>
                                        <div class="input-group">
                                            <input class="form-control" id="E_Hour" name="E_Hour" placeholder="Estimtion Hours" type="number" min="0" step="1"/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Technical Platform</label>
                                <div class="form-group">
                                    <select name="technical" class="form-control" id="technical" required >
                                        <option value="" >Select platform</option>
                                        <?php foreach ($technical as $row):
                                        {
                                            echo '<option value= "'.$row['Tech_Icode'].'">' . $row['Tech_Name'] . '</option>';
                                        }
                                        endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Technical Skills</label>
                                    <textarea name="skill" id="skill" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row padding_class">
                                <div class="col-md-12" >
                                    <h2>Phases</h2>
                                    <table id="tblCustomers5"  data-page-length='25' class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Phases</th>
                                            <th>Start Date</th>
                                            <th>Planned end_date </th>
                                            <th>Estiamtion Hour</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <select name="Phase_Master[]" class="form-control" id="Phase_Master" required >
                                                        <option value="" >Select Phase</option>
                                                        <?php foreach ($Phase_Master as $row):
                                                        {
                                                            echo '<option value= "'.$row['Project_Phase_Icode'].'">' . $row['Phase_Name'] . '</option>';
                                                        }
                                                        endforeach; ?>
                                                    </select>

                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar">
                                                        </i>
                                                    </div>
                                                    <input class="form-control" id="Phase_date_start" name="Phase_date_start[]" placeholder="YYYY/MM/DD" type="text"/>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar">
                                                        </i>
                                                    </div>
                                                    <input class="form-control" id="Phase_date_end" name="Phase_date_end[]" placeholder="YYYY/MM/DD" type="text"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input  class="form-control" name="Hours[]" id="Hours" placeholder="Estimation Hours" type="number" min="0" step="1" required />
                                                </div>
                                            </td>

                                            <td><input type="button" onclick="Add()" value="Add" /></td>
                                        </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row padding_class">
                                <div class="col-md-6">
                                    <h2>Modules</h2>
                                    <table id="tblCustomers6"  data-page-length='25' class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Modules</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Modules[]" id="Modules" placeholder="Enter Modules" required />
                                                </div>
                                            </td>

                                            <td><input type="button" onclick="Add_modules()" value="Add Modules" /></td>
                                        </tr>

                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                            <div class="row padding_class">
                                <div class="col-md-12" >
                                    <h2>Team</h2>
                                    <table id="tblCustomers7"  data-page-length='25' class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Team Member</th>
                                            <th>Actual Designation</th>
                                            <th>Project Role </th>
                                            <th>Work Start Date</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <select name="Member[]" class="form-control" id="Member" required >
                                                        <option value="" >Select Member</option>
                                                        <?php foreach ($Member as $row):
                                                        {
                                                            echo '<option value= "'.$row['User_Icode'].'">' . $row['User_Name'] . '</option>';
                                                        }
                                                        endforeach; ?>
                                                    </select>

                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="designation" name="designation[]"  type="text"/>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <select name="Role_Master[]" class="form-control" id="Role_Master" required >
                                                        <option value="" >Select Role</option>
                                                        <?php foreach ($Role_Master as $row):
                                                        {
                                                            echo '<option value= "'.$row['Role_Icode'].'">' . $row['Role_Name'] . '</option>';
                                                        }
                                                        endforeach; ?>
                                                    </select>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar">
                                                        </i>
                                                    </div>
                                                    <input class="form-control" id="Member_start_working_date" name="Member_start_working_date[]" placeholder="YYYY/MM/DD" type="text"/>
                                                </div>
                                            </td>
                                            <td><input type="button" onclick="Add_member()" value="Add" /></td>
                                        </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info pull-right" onclick="Save_Fixed()" >Save</button>
                            <button type="submit" class="btn btn-danger pull-right" onclick="cancel()" >Cancel</button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css" rel="stylesheet">

<script type="text/javascript">

    $(document).ready(function() {

        $("#startdate").datepicker({
            todayBtn:  1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#enddate').datepicker('setStartDate', minDate);
        });

        $("#startdate").datepicker({
            todayBtn:  1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Member_start_working_date').datepicker('setStartDate', minDate);
        });

        $("#enddate").datepicker()
            .on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
            });

        $("#startdate").datepicker({
            todayBtn:  1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Phase_date_start').datepicker('setStartDate', minDate);
        });

        $("#Phase_date_start").datepicker({
            todayBtn:  1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Phase_date_end').datepicker('setStartDate', minDate);
        });



        $("#Phase_Master").change(function(){
            var value = $("#Phase_Master option:selected").val();
            var theDiv = $(".is" + value);

            theDiv.slideDown().removeClass("hidden");
            $("#Phase_Master option:selected").attr('disabled','disabled');
        });
        $("#Member").change(function(){
            var value = $("#Member option:selected").val();
            var theDiv = $(".is" + value);

            theDiv.slideDown().removeClass("hidden");
            $("#Member option:selected").attr('disabled','disabled');
        });
        $("#Project_Select").change(function(){
            // alert("hiiii");
            /*dropdown post *///
            $.ajax({
                url:"<?php echo site_url('User_Controller/Show_On_Project_Select'); ?>",
                data: {id:
                    $(this).val()},
                type: "POST",
                success:function(data){
                   // alert(data);
                    $("#show_on_project").show();
                    var task_details = $.parseJSON(data);
                   //alert(task_details);
                    var client_name = task_details.Client_Details[0]['Client_Company_Name'];
                    //alert(client_name);
                    document.getElementById('Client_Name').value=client_name;

                    var work_cat = task_details.Client_Details[0]['WorkCategory_Name'];
                    document.getElementById('Work_Category').value=work_cat;

                    var work_type = task_details.Client_Details[0]['Work_Name'];
                    document.getElementById('Work_Type').value=work_type;

                    var count = Object.keys(task_details.Resource_Select).length;
                    //alert(count_tot);


                    for(var i = 0; i < count; i++)
                    {
                        Resource = task_details.Resource_Select[i];
                        $("#Resource_Select").append("<option value='" + Resource.User_Icode + "' >" + Resource.User_Name + "</option>");
                    }

                }


            });
        });

        var date_input_WO=$('input[name="date_Wo"]');
        var date_input_Start=$('input[name="date_start"]');
        var date_input_End=$('input[name="date_end"]');

        //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input_WO.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
        date_input_Start.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            startDate: new Date(),
            todayHighlight: true,
            autoclose: true,
        })
        date_input_End.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            startDate: new Date(),
            todayHighlight: true,
            autoclose: true,
        })
//        $('#Phase_date_start').datepicker({
//            format: 'yyyy-mm-dd',
//            container: container,
//            startDate: new Date(),
//            todayHighlight: true,
//            autoclose: true,
//        })
//        $('#Phase_date_end').datepicker({
//            format: 'yyyy-mm-dd',
//            container: container,
//            startDate: new Date(),
//            todayHighlight: true,
//            autoclose: true,
//        });
        $('#check-all').checkAll();

    });

    $("#Member").change(function(){
        //  alert("hiiii");
        /*dropdown post *///
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/get_Member_Details'); ?>",
            data: {id:
                $(this).val()},
            type: "POST",
            success:function(server_response){
                var data = $.parseJSON(server_response);
                var Desig = data[0]['Designation_Name'];
                document.getElementById('designation').value = Desig;
            }
        });
    });

    //$(function(){
    //        // add multiple select / deselect functionality
    //        $("#selectall").click(function () {
    //            $('.case').attr('checked', this.checked);
    //        });
    //        // if all checkbox are selected, check the selectall checkbox
    //        // and viceversa
    //        $(".case").click(function(){
    //
    //            if($(".case").length == $(".case:checked").length) {
    //                $("#selectall").attr("checked", "checked");
    //            } else {
    //                $("#selectall").removeAttr("checked");
    //            }
    //
    //        });
    // $('#check-all').checkAll();

    //});

    function Add() {

        if($('#Phase_Master').val() == "")
        {
            alert("Please Select Phase...");
        }
        else if($("#Phase_date_start").val() == "")
        {
            alert("Please Select Start Date...");
        }
        else if($("#Phase_date_end").val() == "")
        {
            alert("Please End Date...");
        }
        else if($("#Hours").val() == "")
        {
            alert("Please Type of Hours..");
        }

        else
        {
            var text_t = $("#Phase_Master option:selected").text();
            AddRow($("#Phase_Master option:selected").val(), $("#Phase_date_start").val(),$("#Phase_date_end").val(),$("#Hours").val(),text_t);
            $("#Phase_Master").val("");
            $("#Phase_date_start").val("");
            $("#Phase_date_end").val("");
            $("#Hours").val("");
        }

    };
    function AddRow(Phase_Master, Phase_date_start,Phase_date_end,Hours,text_t) {
        //Get the reference of the Table's TBODY element.
        //alert(text_t);
        var tBody = $("#tblCustomers5 > TBODY")[0];
        //Add Row.
        row = tBody.insertRow(-1);

        //Add Name cell.
        var cell = $(row.insertCell(-1));

        var tech = $("<input />");
        tech.attr("type", "hidden");
        tech.attr("name", "Phase_Master[]");
        tech.val(Phase_Master);
        cell.append(tech);

        var tech1 = $("<input />");
        tech1.attr("type", "text");
        tech1.attr("name", "test2");
        tech1.attr('readonly', true);
        tech1.val(text_t);
        cell.append(tech1);



        //Add Country cell.
        cell = $(row.insertCell(-1));

        var Area = $("<input />");
        Area.attr("type", "text");
        Area.attr("name", "Phase_date_start[]");
        Area.attr('readonly', true);
        Area.val(Phase_date_start);
        cell.append(Area);



        cell = $(row.insertCell(-1));
        var expr = $("<input />");
        expr.attr("type", "text");
        expr.attr("name", "Phase_date_end[]");
        expr.attr('readonly', true);
        expr.val(Phase_date_end);
        cell.append(expr);


        cell = $(row.insertCell(-1));

        var time = $("<input />");
        time.attr("type", "text");
        time.attr("name", "Hours[]");
        tech1.attr('readonly', true);
        time.val(Hours);
        cell.append(time);

        //Add Button cell.
        cell = $(row.insertCell(-1));
        var btnRemove = $("<input />");
        btnRemove.attr("type", "button");
        btnRemove.attr("onclick", "Remove(this);");
        btnRemove.val("Remove");
        cell.append(btnRemove);
    };
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

    function Add_modules() {

        if($('#Modules').val() == "")
        {
            alert("Please Enter Modules...");
        }
        else
        {
            AddRow_modules($('#Modules').val());
            $("#Modules").val("");
        }
    };
    function AddRow_modules(Modules) {
        var tBody = $("#tblCustomers6 > TBODY")[0];

        //Add Row.
        row = tBody.insertRow(-1);

        //Add Name cell.
        var cell = $(row.insertCell(-1));

        var tech = $("<input />");
        tech.attr("type", "text");
        tech.attr("name", "Modules[]");
        tech.val(Modules);
        cell.append(tech);
        //Add Button cell.
        cell = $(row.insertCell(-1));
        var btnRemove = $("<input />");
        btnRemove.attr("type", "button");
        btnRemove.attr("onclick", "Remove_module(this);");
        btnRemove.val("Remove");
        cell.append(btnRemove);
    };
    function Remove_module(button) {
        //Determine the reference of the Row using the Button.
        var row = $(button).closest("TR");
        var name = $("TD", row).eq(0).html();
        if (confirm("Do you want to delete: ")) {

            //Get the reference of the Table.
            var table = $("#tblCustomers6")[0];

            //Delete the Table row using it's Index.
            table.deleteRow(row[0].rowIndex);
        }
    };


    // ** Member **//
    function Add_member() {

        if($('#Member').val() == "")
        {
            alert("Please Select member..");
        }
        else if($("#Role_Master").val() == "")
        {
            alert("Please Select Role...");
        }
        else if($("#Member_start_working_date").val() == "")
        {
            alert("Please Select Start Working Date..");
        }
        else
        {

            var text_t = $("#Member option:selected").text();

            AddRow_member($("#Member option:selected").val(),$('#designation').val(),$('#Role_Master').val(),$('#Member_start_working_date').val(),text_t);
            $("#Member").val("");
            $("#designation").val("");
            $("#Role_Master").val("");
            $("#Member_start_working_date").val("");

        }
    };
    function AddRow_member(Member,designation,Role_Master,Member_start_working_date,text_t) {
        var tBody = $("#tblCustomers7 > TBODY")[0];

        //Add Row.
        row = tBody.insertRow(-1);

        //Add Name cell.
        var cell = $(row.insertCell(-1));

        var tech = $("<input />");
        tech.attr("type", "hidden");
        tech.attr("name", "Member[]");
        tech.val(Member);
        cell.append(tech);

//        cell = $(row.insertCell(-1));
//
//        var mem = $("<input />");
//        mem.attr("type", "text");
//        mem.attr("name", "Member[]");
//        mem.val(Member);
//        cell.append(mem);


//
        var tech1 = $("<input />");
        tech1.attr("type", "text");
        tech1.attr("name", "test1");
        tech1.val(text_t);
        cell.append(tech1);

        cell = $(row.insertCell(-1));
        var expr = $("<input />");
        expr.attr("type", "text");
        expr.attr("name", "designation[]");
        expr.val(designation);
        cell.append(expr);


        cell = $(row.insertCell(-1));

        var time = $("<input />");
        time.attr("type", "text");
        time.attr("name", "Role_Master[]");
        time.val(Role_Master);
        cell.append(time);


        cell = $(row.insertCell(-1));

        var Area = $("<input />");
        Area.attr("type", "text");
        Area.attr("name", "Member_start_working_date[]");
        Area.attr('readonly', true);
        Area.val(Member_start_working_date);
        cell.append(Area);
        //Add Button cell.
        cell = $(row.insertCell(-1));
        var btnRemove = $("<input />");
        btnRemove.attr("type", "button");
        btnRemove.attr("onclick", "Remove_member(this);");
        btnRemove.val("Remove");
        cell.append(btnRemove);
    };

    function cancel() {
        location.reload();
    }

    //** Save Fixed Cost **//
    function Save_Fixed()
    {
        var project = document.getElementById('Project_Name').value;
        var Client = document.getElementById('Client').value;
        var Work = document.getElementById('Work_Category').value;
        var Work_Type = document.getElementById('Work_Type').value;
        var checkboxes = document.getElementsByName('case');



        var vals = "";
        for (var i=0, n=checkboxes.length;i<n;i++)
        {
            if (checkboxes[i].checked)
            {
                vals += ","+checkboxes[i].value;
            }
        }
        var client_contact=vals;
        var contract_type = '1';
        var project_WO = document.getElementById('date_Wo').value;
        var Project_Start = document.getElementById('startdate').value;
        var Project_End = document.getElementById('enddate').value;
        var Est_Hour = document.getElementById('E_Hour').value;
        var tech = document.getElementById('technical').value;
        var skill = document.getElementById('skill').value;
        var project_P = document.getElementsByName("Phase_Master[]");
//        var names = document.getElementsByName('name[]');

        var project_Phase = [];
        for (var i = 0, iLen = project_P.length; i < iLen; i++) {
            project_Phase.push(project_P[i].value);
        }
        var Phase_Start_P = document.getElementsByName("Phase_date_start[]");
        var Phase_Start = [];
        for (var i = 0, iLen = Phase_Start_P.length; i < iLen; i++) {
            Phase_Start.push(Phase_Start_P[i].value);
        }

        var Phase_End_P = document.getElementsByName("Phase_date_end[]");
        var Phase_End = [];
        for (var i = 0, iLen = Phase_End_P.length; i < iLen; i++) {
            Phase_End.push(Phase_End_P[i].value);

        }

        var phase_Hour_P = document.getElementsByName("Hours[]");
        var phase_Hour = [];
        var total = 0;
        for (var i = 0, iLen = phase_Hour_P.length; i < iLen; i++) {
            phase_Hour.push(phase_Hour_P[i].value);

        }
        for (var i = 0, iLen = phase_Hour_P.length; i < iLen; i++) {

            total += parseFloat(phase_Hour_P[i].value);

        }
        // alert(total);



        var Modules_P = document.getElementsByName("Modules[]");

        var Modules = [];
        for (var i = 0, iLen = Modules_P.length; i < iLen; i++) {
            Modules.push(Modules_P[i].value);
        }

        var Member_P =document.getElementsByName("Member[]");

       // alert(Member_P[0].value);

        var Membersss = [];
        for (var j = 0, iLen = Member_P.length; j < iLen; j++) {
            Membersss.push(Member_P[j].value);
        }

      // alert(Membersss);
        var desig_P = document.getElementsByName('designation[]');

        var desig = [];
        for (var i = 0, iLen = desig_P.length; i < iLen; i++) {
            desig.push(desig_P[i].value);
        }
        var Role_P = document.getElementsByName('Role_Master[]');
        var Role = [];
        for (var i = 0, iLen = Role_P.length; i < iLen; i++) {
            Role.push(Role_P[i].value);
           //  alert(Role_P[i].value);
        }


//        function add(a, b) {
//            vat vaaa =  a + b;
//        }
//        alert(vaaa);

        var member_start = document.getElementsByName("Member_start_working_date[]");
        var Member_start_date = [];
        for (var i = 0, iLen = member_start.length; i < iLen; i++) {
            Member_start_date.push(member_start[i].value);

        }
        alert(Member_start_date);



        if(project == "" || Client == "" || Work == "" || Work_Type == "" || client_contact == "" ||  contract_type == "" || project_WO == "" || Project_Start == "" || Project_End == "" || Est_Hour == ""
            || project_Phase =="" ||  Phase_Start == "" || Phase_End == "" || phase_Hour == "" || Modules == "" )
        {
            alert("Please Fill All Fields...");
        }
        else if(total != Est_Hour)
        {
            alert("Estimated Hour Calcuation Failed..")
        }
        else
        {
            $.ajax({
                url:"<?php echo site_url('Admin_Controller/Save_Fixed'); ?>",
                data: {Project_Name: project,Client_Id: Client,Work_Category: Work,Work_type: Work_Type,Client_Contact: client_contact,Contract:contract_type,Proj_WO: project_WO,Proj_start:Project_Start,
                    Proj_End:Project_End,Est_Hour:Est_Hour,Phase:project_Phase,Phase_Start:Phase_Start,Phase_End:Phase_End,Phase_Hour:phase_Hour,Module:Modules,Members:Membersss,
                    Designation:desig,Role_master:Role,Technical:tech,Skill:skill,Member_Start:Member_start_date},
                type: "POST",
                cache: false,
                success:function(data) {
                    if(data == '1')
                    {
                        alert("Successs");
                        location.reload();
                    }
                    else {
                        alert("Failed..");
                    }

                }
            })

        }
    }

</script>
