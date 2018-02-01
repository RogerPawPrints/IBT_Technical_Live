<script>
    $(document).ready( function () {

        $('#tblCustomers').addClass( 'nowrap' ).DataTable( {
            responsive: true
        });
        $('#tblCustomers1').addClass( 'nowrap' ).DataTable( {
            responsive: true
        });
    } );

</script>
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
           Resource Project - T&M / Retainer
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Client</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-body">
<!--                        //<form method="post" id="login_form" role="form" action="--><?php //echo site_url('Admin_Controller/Save_Resource'); ?><!--" name="data_register">-->
                        <div class="row padding_class">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Project</label>
                                    <input class="form-control"  type="text" id="Project_Name" name="Project_Name" placeholder="Enter Project Name" >
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Client Name</label>
                                        <select name="Client" class="form-control" id="Client"  required >
                                            <option value="" >Select Client</option>
                                            <?php foreach ($Client as $row):
                                            {

                                                echo "<option value= " .$row['Client_Icode'].">" . $row['Client_Company_Name'] . "</option>";

                                            }
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Work Category</label>
                                        <select name="Work_Category" class="form-control" id="Work_Category"  required >
                                            <option value="" >Select Category</option>
                                            <?php foreach ($work_details as $row):
                                            {

                                                echo "<option value= " .$row['WorkCategory_Icode'].">" . $row['WorkCategory_Name'] . "</option>";

                                            }
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Work Type</label>
                                        <select name="Work_Type" class="form-control" id="Work_Type"  required >
                                            <option value="" >Select Work Type</option>
                                            <?php foreach ($Work_Type as $row):
                                            {

                                                echo "<option value= " .$row['Work_Icode'].">" . $row['Work_Name'] . "</option>";

                                            }
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <div class="row padding_class">-->
<!--                            <div class="col-md-12" id="details" style="display: none;">-->
<!--                                <table id="tblCustomer"  data-page-length='25' class="table  table-bordered bootstrap-datatable datatable responsive">-->
<!--                                    <thead>-->
<!--                                    <th><input id="check-all" type="checkbox" /></th>-->
<!--                                    <th>#</th>-->
<!--                                    <th>Name</th>-->
<!--                                    <th>Designation</th>-->
<!--                                    <th>Phone</th>-->
<!--                                    <th>Email</th>-->
<!--                                    <th>IM</th>-->
<!--                                    </thead>-->
<!--                                    <tbody id="contacts">-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
<!--                        </div>-->

                        <div id="Fixed" >
                            <div class="row padding_class" >
                                <div class="col-md-12" >
                                    <div class="col-md-3">
                                        <label>Contract Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            <input class="form-control" id="date_Wo" name="date_Wo" placeholder="YYYY/MM/DD" type="text"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Contract Start Date</label>
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
                                        <label>Contract End Date </label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            <!--                                        <input class="form-control" id="date_end" name="date_end" placeholder="YYYY/MM/DD" type="text"/>-->
                                            <input class="form-control" type="text" placehoder="End Date" name="date_end" id="enddate"/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Contract Type</label><br>
                                <input type="radio" name="Rtype" id="Retainer" value="3"  /> <label style="margin-right: 20px; font-weight: normal;">Retainer</label>
                                <input type="radio" name="Rtype" id="T&M" value="2" /> <label style="font-weight: normal;">T&M</label>

                            </div>
                            <div class="row padding_class">
                                <div class="col-md-12" >
                                    <h2>Resource</h2>
                                    <table id="tblCustomers5"  data-page-length='25' class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Resource</th>
                                            <th>Contract Term </th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Min Billable Hours/Month</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
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
                                                    <select name="Terms[]" class="form-control" id="Terms" required >
                                                        <option value="" >Select Contract Term</option>
                                                        <?php foreach ($Contract_Term as $row):
                                                        {
                                                            echo '<option value= "'.$row['Contract_Term_Icode'].'">' . $row['Contract_Term_Name'] . '</option>';
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
                            <button type="submit" class="btn btn-danger pull-right" onclick="cancel()" >Cancel</button>


                        </div>
<!--                        </form>-->
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

    $("#startdate").datepicker({
        todayBtn:  1,
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

    $("#Contract_date_start").datepicker({
        todayBtn:  1,
        autoclose: true,
        startDate: new Date(),
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#Contract_date_end').datepicker('setStartDate', minDate);
    });

    $("#Contract_date_end").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Contract_date_start').datepicker('setEndDate', minDate);
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

    $("#Client").change(function(){
        //  alert("hiiii");
        /*dropdown post *///
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/get_Client_Contact'); ?>",
            data: {id:
                $(this).val()},
            type: "POST",
            success:function(data){
                $("#details").show();
                $("#contacts").html(data);
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


    $('#check-all').checkAll();




    function Add() {

//        var sval = $('#Role_Master').val();
//
//        var project_P = document.getElementsByName("Role_Master[]");
//
//        var sval = $('#Terms').val();
//        var Contract_term = document.getElementsByName("Terms[]");
//
//        var sval = $('#Member').val();
//        var Tech_Member = document.getElementsByName("Member[]");


        if($('#Role_Master').val() == "")
        {
            alert("Please Select Role...");
        }
        else if($("#Terms").val() == "")
        {
            alert("Please Select Terms...");
        }
        else if($("#Member").val() == "")
        {
            alert("Please Select Member...");
        }
        else if($("#Contract_date_start").val() == "")
        {
            alert("Please Select Start Date...");
        }
        else if($("#Contract_date_end").val() == "")
        {
            alert("Please End Date...");
        }
        else if($("#Hours").val() == "")
        {
            alert("Please Type of Hours..");
        }

        else
        {
            var role = $("#Role_Master option:selected").text();
            var member = $("#Member option:selected").text();
            var term = $("#Terms option:selected").text();
            AddRow($('#Role_Master').val(), $("#Terms").val(),$("#Member option:selected").val(),$("#Contract_date_start").val(),$("#Contract_date_end").val(),$("#Hours").val(),role,member,term);
            $("#Role_Master").val("");
            $("#Terms").val("");
            $("#Member").val("");
            $("#Contract_date_start").val("");
            $("#Contract_date_end").val("");
            $("#Hours").val("");
        }

    };
    function AddRow(Role_Master,Terms,Members,Contract_date_start,Contract_date_end,Hours,role,member,termss) {
        //Get the reference of the Table's TBODY element.
        //alert(text_t);
        var tBody = $("#tblCustomers5 > TBODY")[0];
        //Add Row.
        row = tBody.insertRow(-1);

        //Add Name cell.
        var cell = $(row.insertCell(-1));

        var tech = $("<input />");
        tech.attr("type", "hidden");
        tech.attr("name", "Role_Master[]");
        tech.val(Role_Master);
        cell.append(tech);

        var tech1 = $("<input />");
        tech1.attr("type", "text");
        tech1.attr("name", "test");
        tech1.attr('readonly', true);
        tech1.val(role);
        cell.append(tech1);


        var cell = $(row.insertCell(-1));

        var term = $("<input />");
        term.attr("type", "hidden");
        term.attr("name", "Member[]");
        term.val(Members);
        cell.append(term);

        var term1 = $("<input />");
        term1.attr("type", "text");
        term1.attr("name", "test1");
        term1.attr('readonly', true);
        term1.val(member);
        cell.append(term1);

        var cell = $(row.insertCell(-1));

        var membe = $("<input />");
        membe.attr("type", "hidden");
        membe.attr("name", "Terms[]");
        membe.val(Terms);
        cell.append(membe);

        var membe1 = $("<input />");
        membe1.attr("type", "text");
        membe1.attr("name", "test2");
        membe1.attr('readonly', true);
        membe1.val(termss);
        cell.append(membe1);



        //Add Country cell.
        cell = $(row.insertCell(-1));

        var Area = $("<input />");
        Area.attr("type", "text");
        Area.attr("name", "Contract_date_start[]");
        Area.attr('readonly', true);
        Area.val(Contract_date_start);
        cell.append(Area);



        cell = $(row.insertCell(-1));
        var expr = $("<input />");
        expr.attr("type", "text");
        expr.attr("name", "Contract_date_end[]");
        expr.attr('readonly', true);
        expr.val(Contract_date_end);
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


    function cancel() {
        location.reload();
    }

    //** Save Fixed Cost **//
    function Save_Fixed()
    {
        var contract_type = $('input[name=Rtype]:checked').val();
        var project = document.getElementById('Project_Name').value;
        var Client = document.getElementById('Client').value;
        var Work = document.getElementById('Work_Category').value;
        var Work_Type = document.getElementById('Work_Type').value;
//        var checkboxes = document.getElementsByName('case');
//
//
//
//        var vals = "";
//        for (var i=0, n=checkboxes.length;i<n;i++)
//        {
//            if (checkboxes[i].checked)
//            {
//                vals += ","+checkboxes[i].value;
//            }
//        }
//        var client_contact=vals;
//        var contract_type = '1';
        var project_WO = document.getElementById('date_Wo').value;
        var Project_Start = document.getElementById('startdate').value;
        var Project_End = document.getElementById('enddate').value;


        var Member_P =document.getElementsByName("Member[]");

        // alert(Member_P[0].value);

        var Membersss = [];
        for (var j = 0, iLen = Member_P.length; j < iLen; j++) {
            Membersss.push(Member_P[j].value);
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

        var member_start = document.getElementsByName("Contract_date_start[]");
        var Member_start_date = [];
        for (var i = 0, iLen = member_start.length; i < iLen; i++) {
            Member_start_date.push(member_start[i].value);

        }

        var Phase_Start_P = document.getElementsByName("Contract_date_end[]");
        var Contract_End = [];
        for (var i = 0, iLen = Phase_Start_P.length; i < iLen; i++) {
            Contract_End.push(Phase_Start_P[i].value);
        }
        var Hour_P = document.getElementsByName("Hours[]");
        var Min_Hour = [];
        var total = 0;
        for (var i = 0, iLen = Hour_P.length; i < iLen; i++) {
            Min_Hour.push(Hour_P[i].value);

        }
        var Term_P = document.getElementsByName("Terms[]");
        var Resource_Term = [];
        for (var i = 0, iLen = Term_P.length; i < iLen; i++) {
            Resource_Term.push(Term_P[i].value);
        }




        if(project == "" || Client == "" || Work == "" || Work_Type == ""  ||  contract_type == "" || project_WO == "" || Project_Start == "" || Project_End == ""  )
        {
            alert("Please Fill All Fields...");
        }

        else
        {
            $.ajax({
                url:"<?php echo site_url('Admin_Controller/Save_Resource'); ?>",
                data: {Project_Name: project,Client_Id: Client,Work_Category: Work,Work_type: Work_Type,Contract:contract_type,Proj_WO: project_WO,Proj_start:Project_Start,
                    Proj_End:Project_End,Members:Membersss, Role_master:Role,Contract_Start:Member_start_date,Contract_End:Contract_End,Min_Hours: Min_Hour,Resource_Terms: Resource_Term },
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
