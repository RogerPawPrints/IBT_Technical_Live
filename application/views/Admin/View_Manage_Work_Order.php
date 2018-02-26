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
            View/Manager Work Order
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
                        <?php
                        foreach ($WO as $key)
                        {
                        ?>
                        <div class="row padding_class">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Project</label>
                                    <input class="form-control"  type="text" id="Project_Name" name="Project_Name" value="<?php echo $key['Project_Name']; ?>" placeholder="Enter Project Name" readonly >
                                    <input type="hidden" name="project_icode" id="project_icode" value="<?php echo $key['Work_Order_Icode']; ?>" >
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Client Name</label>
                                        <input class="form-control"  type="text" id="Client" name="Client" value="<?php echo $key['Client_Company_Name']; ?>" readonly >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Work Category</label>
                                        <input class="form-control"  type="text" id="Work_Category" name="Work_Category" value="<?php echo $key['WorkCategory_Name']; ?>" readonly >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Work Type</label>
                                        <input class="form-control"  type="text" id="Work_Type" name="Work_Type" value="<?php echo $key['Work_Name']; ?>" readonly >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="Fixed" >
                            <div class="row padding_class" >
                                <div class="col-md-12" >
                                    <div class="col-md-3">
                                        <label>Signed Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            <input class="form-control" id="date_Wo" name="date_Wo" value="<?php echo $key['Contract_Signed_Date']; ?>"  type="text" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Work Order Title</label>
                                        <div class="input-group">
                                            <input class="form-control" id="E_Hour" name="E_Hour" value="<?php echo $key['Work_Order_Title']; ?>" type="text"  readonly/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12" style="padding: 15px;">

                                    <ul  class="nav nav-pills" id="myTab">
                                        <li class="active"><a  href="#1a" data-toggle="tab">Renewal</a></li>
                                        <li><a href="#2a" data-toggle="tab">Resource Management</a></li>
                                        <li><a href="#4a" data-toggle="tab">Change Client Contacts</a></li>
<!--                                        <li><a href="#3a" data-toggle="tab">Change Status</a></li>-->
                                    </ul>

                                    <!--<div class="col-md-3" style="font-size: 15px;color: #d43b13;"> <input type="radio" name="Rtype" id="Project" value="Project" checked  onclick="show_phase()" /> <label style="margin-right: 20px; font-weight: normal;">Change Date</label></div>
                                    <div class="col-md-3" style="font-size: 15px;color: #d43b13;"><input type="radio" name="Rtype" id="Resource" value="Resource" onclick="show_Resource()" /> <label style="font-weight: normal;">Change Resource</label></div>
                                    <div class="col-md-3" style="font-size: 15px;color: #d43b13;"><input type="radio" name="Rtype" id="Resource" value="Status" onclick="show_Status()" /> <label style="font-weight: normal;">Change Status</label></div>-->
                                </div>
                            </div>
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="1a">
                                    <div class="row padding_class" id="Show_Phase" >
                                        <div class="col-md-12" >
                                            <h2>Extend Resource Date</h2>
                                            <table id="tblCustomers5"  data-page-length='25' class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Contract Terms </th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Min Billable Hours</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                <?php
                                                $i=1;
                                                foreach ($Resource as $row)
                                                {
                                                    ?>
                                                    <tr id="row<?php echo $row['WO_Resource_Icode'];?>">
                                                        <td id="member<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['User_Name'];?></td>
                                                        <td id="role<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Role_Name'];?></td>
                                                        <td id="term<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Contract_Term_Name'];?></td>
                                                        <td id="start<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Start_Date'];?></td>
                                                        <td id="end<?php echo $row['WO_Resource_Icode'];?>" ><?php echo $row['End_Date'];?></td>
                                                        <td id="hour<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Min_Hour'];?></td>
                                                        <td>
                                                            <button type="button" id="mymodal1" class="btn btn-success"  data-toggle="modal" onclick="Show_Renewal('<?php echo $row['WO_Resource_Icode']; ?>','<?php echo $row['Start_Date'];?>','<?php echo $row['End_Date'];?>')"
                                                                    value="<?php echo $row['WO_Resource_Icode']; ?>" data-target="#myModal1">Renewal</button>

                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                                <th colspan="2" style="text-align:center"><span id="sum"></span></th>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>



                                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Renewal Date</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <input type="hidden" class="form-control" id="resource_id" name="resource_id">

                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <label>Current Start Date</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="Start_date" name="Start_date" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Current End Date</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="End_date" name="End_date" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <h3>Renewal Details</h3>
                                                        <div class="form-group">
                                                        <label>Start Date</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar">
                                                                </i>
                                                            </div>
                                                            <input class="form-control" id="Contract_date_start" name="Contract_date_start" placeholder="YYYY/MM/DD" type="text"/>
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <label>End Date</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar">
                                                                </i>
                                                            </div>
                                                            <input class="form-control" id="Contract_date_end" name="Contract_date_end" placeholder="YYYY/MM/DD" type="text"/>
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Contract Term</label>
                                                            <select name="Terms" class="form-control" id="Terms" required >
                                                                <option value="" >Select Contract Term</option>
                                                                <?php foreach ($Contract_Term as $row):
                                                                {
                                                                    echo '<option value= "'.$row['Contract_Term_Icode'].'">' . $row['Contract_Term_Name'] . '</option>';
                                                                }
                                                                endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Min Billable Hours</label>
                                                            <input  class="form-control" name="Hours[]" id="Hours" placeholder="Min Billable Hours" type="number" min="0" step="1" required />
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" onclick="save_row()" >Save</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="2a">
                                    <div class="row padding_class" id="show_Resource"  >
                                        <div class="col-md-12" >
                                            <h2>Resource Management</h2>
                                            <table id="tblCustomers"  data-page-length='25' class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <!--                                           // <th>#</th>-->
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Contract Terms </th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Min Billable Hours</th>
                                                    <th>Active</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i=1;
                                                foreach ($Resource as $row)
                                                {
                                                    ?>
                                                    <tr id="row<?php echo $row['WO_Resource_Icode'];?>">

                                                        <td id="member<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['User_Name'];?></td>
                                                        <td id="role<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Role_Name'];?></td>
                                                        <td id="term<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Contract_Term_Name'];?></td>
                                                        <td id="start<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Start_Date'];?></td>
                                                        <td id="end<?php echo $row['WO_Resource_Icode'];?>" ><?php echo $row['End_Date'];?></td>
                                                        <td id="hour<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Min_Hour'];?></td>
                                                        <td id="status<?php echo $row['WO_Resource_Icode'];?>"><?php echo $row['Active'];?></td>
                                                        <td>
                                                            <button type="button" id="mymodal" class="btn btn-danger"  data-toggle="modal" onclick="Save_Comments('<?php echo $row['WO_Resource_Icode']; ?>','<?php echo $row['Active'];?>')"
                                                                    value="<?php echo $row['WO_Resource_Icode']; ?>" data-target="#myModal">Stop Work</button>
                                                            <button type="button" id="mymodal2" class="btn btn-info"  data-toggle="modal" onclick="Switch('<?php echo $row['WO_Resource_Icode']; ?>','<?php echo $row['Start_Date'];?>','<?php echo $row['End_Date'];?>')"
                                                                    value="<?php echo $row['WO_Resource_Icode']; ?>" data-target="#myModal2">Switch Resource</button>

                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Comments</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <input type="hidden" id="team_id" name="team_id">
                                                        <input type="hidden" id="status" name="status">
                                                        <div class="form-group">
                                                            <label for="work_progress" class="form-control-label">Why?</label>
                                                            <textarea class="form-control" id="comments" name="comments"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" onclick="insert_comments()" >Save changes</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Switch Resource</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" class="form-control" id="WO_resource_id" name="WO_resource_id">

                                                        <div class="col-md-12">
                                                            <div class="col-md-6">
                                                                <label>Current Start Date</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="WO_Start_date" name="WO_Start_date" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Current End Date</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="WO_End_date" name="WO_End_date" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <h3>Replacement Resource</h3>

                                                            <div class="form-group">
                                                                <label>Select Resource</label>
                                                                <select name="WO_New_Resource" class="form-control" id="WO_New_Resource" required >
                                                                    <option value="" >Select Resource</option>
                                                                    <?php foreach ($Member as $row):
                                                                    {
                                                                        echo '<option value= "'.$row['User_Icode'].'">' . $row['User_Name'] . '</option>';
                                                                    }
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Start Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar">
                                                                        </i>
                                                                    </div>
                                                                    <input class="form-control" id="WO_Contract_date_start" name="WO_Contract_date_start" placeholder="YYYY/MM/DD" type="text"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>End Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar">
                                                                        </i>
                                                                    </div>
                                                                    <input class="form-control" id="WO_Contract_date_end" name="WO_Contract_date_end" placeholder="YYYY/MM/DD" type="text" readonly/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="work_progress" class="form-control-label">Change Comments</label>
                                                                <textarea class="form-control" id="Change_comments" name="Change_comments"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" onclick="Change_Comments()" >Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="4a">
                                    <div class="row padding_class" id="show_Contact"  >
                                        <div  class="col-md-12">
                                            <h2>Client Contact Management</h2>

                                        <table id="tblClient"  data-page-length='25' class="table table-striped">
                                            <thead>
                                            <tr>


                                                <th>Contact Name</th>
                                                <th>Designation</th>
                                                <th>Contact Number </th>
                                                <th>Email</th>
                                                <th>Active</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            foreach ($client_contact as $row)
                                            {
                                                ?>
                                                <tr>

                                                    <td id=""><?php echo $row['Contact_Name'];?></td>
                                                    <td id=""><?php echo $row['Contact_Designation'];?></td>
                                                    <td id=""><?php echo $row['Contact_Number'];?></td>
                                                    <td id=""><?php echo $row['Contact_Email'];?></td>
                                                    <td id="">Yes</td>
                                                    <td><button type="button" id="mymodal" class="btn btn-danger"  onclick="Inactive('<?php echo $row['WO_Client_Contact_Icode']; ?>')"
                                                                value="<?php echo $row['WO_Client_Contact_Icode']; ?>" >InActive</button>
                                                    </td>
                                                </tr>

                                                <?php

                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                            <?php

                                            foreach ($client_inactive as $row)
                                            {
                                                ?>
                                                <tr>

                                                    <td id=""><?php echo $row['Contact_Name'];?></td>
                                                    <td id=""><?php echo $row['Contact_Designation'];?></td>
                                                    <td id=""><?php echo $row['Contact_Number'];?></td>
                                                    <td id=""><?php echo $row['Contact_Email'];?></td>
                                                    <td id="">No</td>
                                                    <td><button type="button" id="mymodal" class="btn btn-success"   onclick="Active('<?php echo $row['Contact_ID']; ?>','<?php echo $row['Contact_Client_Icode']; ?>')"
                                                                value="<?php echo $row['Contact_ID']; ?>" >Active</button>
                                                    </td>
                                                </tr>

                                                <?php

                                            }
                                            ?>
                                            </tfoot>
                                        </table>
                                        </div>

                                    </div>

                                </div>



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

<script type="text/javascript" src="modify_records.js"></script>

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

        $("#Contract_date_start").datepicker({
            todayBtn:  1,
            autoclose: true,

        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Contract_date_end').datepicker('setStartDate', minDate);
        });

        $("#Contract_date_end").datepicker()
            .on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#Contract_date_start').datepicker('setEndDate', minDate);
            });


        $("#WO_Contract_date_start").datepicker({
            todayBtn:  1,
            autoclose: true,

        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#WO_Contract_date_end').datepicker('setStartDate', minDate);
        });




    });


    function save_row()
    {
        var start=document.getElementById("Contract_date_start").value;
        var end=document.getElementById("Contract_date_end").value;
        var hour=document.getElementById("Hours").value;
        var terms=document.getElementById("Terms").value;
        var id = document.getElementById("resource_id").value;
        $.ajax
        ({
            type:'post',
            url:"<?php echo site_url('Admin_Controller/Save_Extended_Date'); ?>",
            data: {
                Resource:id,
                Start_date:start,
                End_date:end,
                Hours:hour,
                Terms:terms
            },
            success:function(response) {
                if(response=="1")
                {
                    // alert("Success...");
                    $('#myModal1').modal('hide');
                    swal({
                            title: "success!",
                            text: "Resource Date Renewed Successfully...!",
                            type: "success"
                        },
                        function(){
                            location.reload();
                        });
                }
            }
        });
    }

     function Add_member()
    {
        var member=document.getElementById("Member").value;
        var terms=document.getElementById("Terms").value;
        var role=document.getElementById("Role_Master").value;
        var start=document.getElementById("Contract_date_start").value;
        var end=document.getElementById("Contract_date_end").value;
        var Hours=document.getElementById("Hours").value;
        var project_icode=document.getElementById("project_icode").value;
        if(member == "" || role == "" || terms=="" || start=="" ||end=="" || Hours == "" )
        {
            alert("Please Select All Fields...");
        }
        else
        {
            $.ajax
            ({
                type:'post',
                url:"<?php echo site_url('Admin_Controller/Save_New_WO_Resource'); ?>",
                data: {
                    WO_Icode:project_icode,
                    Member:member,
                    Term:terms,
                    Role:role,
                    Start:start,
                    End:end,
                    Hours:Hours
                },
                success:function(response) {
                    if(response!="")
                    {
                        swal({
                                title: "success!",
                                text: "Resource Assigned ...!",
                                type: "success"
                            },
                            function(){
                                //window.history.back();
                                location.reload();
                            });
                    }
                }
            });
        }
    }

    function Save_Comments(id,status)
    {
        document.getElementById('team_id').value = id;
        document.getElementById('status').value = status;
    }
    function Show_Renewal(id,sdate,edate)
    {
        document.getElementById('resource_id').value = id;
        document.getElementById('Start_date').value = sdate;
        document.getElementById('End_date').value = edate;

    }
    function Switch(id,sdate,edate)
    {
        document.getElementById('WO_resource_id').value = id;
        document.getElementById('WO_Start_date').value = sdate;
        document.getElementById('WO_End_date').value = edate;
        document.getElementById('WO_Contract_date_end').value = edate;

    }
    function insert_comments()
    {
        var team_id=document.getElementById('team_id').value;
        var cmt = document.getElementById('comments').value;

        if (confirm("Do you want to stop work for this Resource: ")) {

            $.ajax
            ({
                type: 'post',
                url: "<?php echo site_url('Admin_Controller/WO_Resource_Cancel'); ?>",
                data: {
                    Team_id: team_id,
                    Comments: cmt,
                },
                success: function (response) {
                    //alert(response);
                    if (response == '1') {
                        $('#myModal').modal('hide');
                        swal({
                                title: "success!",
                                text: "Resource Stop Successfully ...!",
                                type: "success"
                            },
                            function () {
                                //window.history.back();
                                location.reload();

                            });
                    }
                }
            });
        }
    }

    function Change_Comments()
    {
        var team_id=document.getElementById('WO_resource_id').value;
        var cmt = document.getElementById('Change_comments').value;
        var new_resource = document.getElementById('WO_New_Resource').value;
        var new_sdate = document.getElementById('WO_Contract_date_start').value;
        var new_enddate = document.getElementById('WO_Contract_date_end').value;

        if (confirm("Do you want to Switch this Resource: ")) {

            $.ajax
            ({
                type: 'post',
                url: "<?php echo site_url('Admin_Controller/WO_Resource_Switch'); ?>",
                data: {
                    Team_id: team_id,
                    Comments: cmt,
                    New_Resource_Id: new_resource,
                    New_Start: new_sdate,
                    New_End: new_enddate
                },
                success: function (response) {
                    //alert(response);
                    if (response == '1') {
                        $('#myModal2').modal('hide');
                        swal({
                                title: "success!",
                                text: "Resource Switch Successfully ...!",
                                type: "success"
                            },
                            function () {
                                //window.history.back();
                                location.reload();

                            });
                    }
                }
            });
        }
    }

    //** In Active **//
    function Inactive(id)
    {
        if (confirm("Do you want to DeActive: ")) {

            $.ajax
            ({
                type: 'post',
                url: "<?php echo site_url('Admin_Controller/WO_Inactive_contact'); ?>",
                data: {id: id},
                success: function (response) {
                    //alert(response);
                    if (response == '1') {
                        swal({
                                title: "success!",
                                text: "Status Changed Deactive ...!",
                                type: "success"
                            },
                            function () {
                                //window.history.back();
                                location.reload();

                            });
                    }
                }
            });
        }
    }
    function Active(contact_id,Client_id)
    {
        var project_icode=document.getElementById("project_icode").value;

        if (confirm("Do you want to Active: ")) {

            $.ajax
            ({
                type: 'post',
                url: "<?php echo site_url('Admin_Controller/WO_Active_contact'); ?>",
                data: {Contact: contact_id,
                    Client: Client_id,
                    Project: project_icode },
                success: function (response) {
                    //alert(response);
                    if (response == '1') {
                        swal({
                                title: "success!",
                                text: "Status Changed to Active ...!",
                                type: "success"
                            },
                            function(){
                                //window.history.back();
                                location.reload();

                            });
                    }
                }
            });
        }

    }

</script>
