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
                                        <li class="active"><a  href="#1a" data-toggle="tab">Extend Date</a></li>
                                        <li><a href="#2a" data-toggle="tab">Change Resource</a></li>
<!--                                        <li><a href="#4a" data-toggle="tab">Change Client Contacts</a></li>-->
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
                                                            <input type='button' class="edit_button" id="edit_button<?php echo $row['WO_Resource_Icode'];?>" value="edit" onclick="edit_row('<?php echo $row['WO_Resource_Icode'];?>');">
                                                            <input type='button' class="save_button" style="display: none" id="save_button<?php echo $row['WO_Resource_Icode'];?>" value="save" onclick="save_row('<?php echo $row['WO_Resource_Icode'];?>');">
                                                            <input type='button' class="cancel_button" style="display: none" id="cancel_button<?php echo $row['WO_Resource_Icode'];?>" value="cancel" onclick="cancel('<?php echo $row['WO_Resource_Icode'];?>');">

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
                                                        <?php
                                                        if($row['Active'] == 'Yes')
                                                        {
                                                            ?>
                                                            <td>
                                                                <button type="button" id="mymodal" class="btn btn-danger"  data-toggle="modal" onclick="Save_Comments('<?php echo $row['WO_Resource_Icode']; ?>','<?php echo $row['Active'];?>')"
                                                                        value="<?php echo $row['WO_Resource_Icode']; ?>" data-target="#myModal">InActive</button>
                                                            </td>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <td>
                                                                <button type="button" id="mymodal" class="btn btn-success"  data-toggle="modal" onclick="Save_Comments('<?php echo $row['WO_Resource_Icode']; ?>','<?php echo $row['Active'];?>')"
                                                                        value="<?php echo $row['WO_Resource_Icode']; ?>" data-target="#myModal">Active</button>
                                                            </td>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tr>

                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                                </tbody>
                                                <tfoot>

                                                <tr id="new_row1">
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

                                                    <td><input type="button" onclick="Add_member()" value="Add" /></td>



                                                </tr>

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
                                    </div>

                                </div>

                                <div class="tab-pane" id="3a">
                                    <div class="row padding_class" id="show_Status"  >
                                        <div  class="col-md-12">
                                            <h2>Status Management</h2>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Change Status</label>
                                                    <select name="Status" class="form-control" id="Status" required >
                                                        <option value="" >Select Member</option>
                                                        <?php foreach ($Status as $row):
                                                        {
                                                            echo '<option value= "'.$row['project_status_Icode'].'">' . $row['Status_Name'] . '</option>';
                                                        }
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="work_progress" class="form-control-label">Reason</label>
                                                    <textarea class="form-control" id="status_comments" name="status_comments"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success pull-right" onclick="save_status()" >Save</button>
                                            </div>
                                            <div class="col-md-8">
                                                <table id="tblCustomers1"  data-page-length='25' class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Status</th>
                                                        <th>Date </th>
                                                        <th>Comments</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $i=1;
                                                    foreach ($Status_History as $status)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $status['Status_Name']; ?></td>
                                                            <td><?php echo $status['Created_On']; ?></td>
                                                            <td><?php echo $status['History_Comments']; ?></td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="4a">
                                    <div class="row padding_class" id="show_Contact"  >
                                        <div  class="col-md-12">
                                            <h2>Client Contact Management</h2>
                                        </div>
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
                                                    <td><button type="button" id="mymodal" class="btn btn-danger"  onclick="Inactive('<?php echo $row['Proj_Client_Contact_Icode']; ?>')"
                                                                value="<?php echo $row['Proj_Client_Contact_Icode']; ?>" >InActive</button>
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


    });

    function edit_row(id)
    {
        // alert (id);
        var Start=document.getElementById("start"+id).innerHTML;
        var End=document.getElementById("end"+id).innerHTML;
        var Hour=document.getElementById("hour"+id).innerHTML;
        document.getElementById("start"+id).innerHTML="<input  type='text' name='Phase_date_start[]' class='phase_Start' id='Phase_date_start"+id+"' name='Phase_date_start' value='"+Start+"' onmousedown='show_date1()'  >";
        document.getElementById("end"+id).innerHTML="<input type='text' name='Phase_date_end[]' class='phase_end' id='Phase_date_end"+id+"' value='"+End+"' >";
        document.getElementById("hour"+id).innerHTML="<input type='number' name='Hour[]' id='Hours"+id+"' class=estimation' value='"+Hour+"' min='0' step='1'>";
        document.getElementById("edit_button"+id).style.display="none";
        document.getElementById("save_button"+id).style.display="block";
        document.getElementById("cancel_button"+id).style.display="block";
    }
    function show_date1()
    {
        $('.phase_Start').datepicker({
            dateFormat: 'yy-mm-dd',
            startDate: new Date(),
            autoclose: true,
            todayBtn:  1
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('.phase_end').datepicker('setStartDate', minDate);
        });
    }
    function save_row(id)
    {
        var start=document.getElementById("Phase_date_start"+id).value;
        var end=document.getElementById("Phase_date_end"+id).value;
        var hour=document.getElementById("Hours"+id).value;
        $.ajax
        ({
            type:'post',
            url:"<?php echo site_url('Admin_Controller/Save_Extended_Date'); ?>",
            data: {
                Resource:id,
                Start_date:start,
                End_date:end,
                Hours:hour
            },
            success:function(response) {
                if(response=="1")
                {
                    document.getElementById("start"+id).innerHTML=start;
                    document.getElementById("end"+id).innerHTML=end;
                    document.getElementById("hour"+id).innerHTML=hour;
                    document.getElementById("edit_button"+id).style.display="block";
                    document.getElementById("save_button"+id).style.display="none";
                    document.getElementById("delete_button"+id).style.display="block";
                    document.getElementById("cancel_button"+id).style.display="none";
                }
            }
        });
    }
    function Save_Phase_History()
    {
        var project_icode=document.getElementById("project_icode").value;
        var project_Old_End=document.getElementById("enddate").value;
        var project_New_End=document.getElementById("date_new").value;
        var New_Hours=document.getElementById("New_Hours").value;
        var Old_Hours=document.getElementById("E_Hour").value;
        var Cmd=document.getElementById("Comments").value;
        var sum = 0;
        $(".estimation").each(function(){
            sum += parseFloat($(this).text());
        });
        var current_hours = sum;
        if(project_New_End == "" || Cmd == "" || New_Hours =="" )
        {
            swal("Please fill all fileds!")
        }
        else if(current_hours!= New_Hours )
        {
            swal("Please Estimation Hours not tallying with Project Hours..!")
        }
        else
        {
            $.ajax({
                url:"<?php echo site_url('Admin_Controller/Save_History'); ?>",
                data: {Project_id:project_icode,
                    Project_old:project_Old_End,
                    Project_New:project_New_End,
                    New_Hours:New_Hours,
                    Old_Hours:Old_Hours,
                    Comments:Cmd
                },
                type: "POST",
                success:function(server_response){
                    if(server_response == 1)
                    {
                        // alert("Success...");
                        swal({
                                title: "success!",
                                text: "Revised Scheduled Updated...!",
                                type: "success"
                            },
                            function(){
                                window.history.back();
                            });
                        //window.location.href = document.referrer;
                    }
                    else {
                        swal("Oops...", "Something went wrong!", "error");
                    }
                }
            });
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

    function cancel(id)
    {
        var start=document.getElementById("Phase_date_start"+id).value;
        var end=document.getElementById("Phase_date_end"+id).value;
        var hour=document.getElementById("Hours"+id).value;
        document.getElementById("start"+id).innerHTML=start;
        document.getElementById("end"+id).innerHTML=end;
        document.getElementById("hour"+id).innerHTML=hour;
        document.getElementById("edit_button"+id).style.display="block";
        document.getElementById("save_button"+id).style.display="none";
        document.getElementById("cancel_button"+id).style.display="none";
    }
    function delete_row(id)
    {
        // alert(id);
        if (confirm("Do you want to delete: ")) {
            $.ajax
            ({
                type: 'post',
                url: "<?php echo site_url('Admin_Controller/Delete_Phase'); ?>",
                data: {
                    Phase_id: id,
                },
                success: function (response) {
                    //alert(response);
                    if (response == '1') {
                        //alert("dfafaf");
                        // var row = document.getElementById("row" + id);
                        // row.parentNode.removeChild(row);
                        location.reload();
                    }
                }
            });
        }
    }

    function insert_row()
    {
        var phase=document.getElementById("Phase_Master").value;
        var start=document.getElementById("Phase_date_start").value;
        var end=document.getElementById("Phase_date_end").value;
        var hour=document.getElementById("Hours").value;
        var project_icode=document.getElementById("project_icode").value;
        var text_t = $("#Phase_Master option:selected").text();

        if(phase == "0" || start == "" || end=="" || hour==""  )
        {
            alert("Please Select All Fields...");
        }
        else
        {
            $.ajax
            ({
                type:'post',
                url:"<?php echo site_url('Admin_Controller/Save_New_Phase'); ?>",
                data: {

                    project_icode:project_icode,
                    phase_code:phase,
                    Start_date:start,
                    End_date:end,
                    Hours:hour
                },
                success:function(response) {
                    if(response!="")
                    {
                        //alert(response);
                        var id=response;
                        var table=document.getElementById("tblCustomers5");
                        var table_len=(table.rows.length)-1;
                        var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='phase"+id+"'>"+text_t+"</td><td id='start"+id+"'>"+start+"</td><td id='end"+id+"'>"+end+"</td><td id='hour"+id+"'>"+hour+"</td><td><input type='button' class='edit_button' id='edit_button"+id+"' value='edit' onclick='edit_row("+id+");'/><input type='button' class='save_button' style='display: none'  id='save_button"+id+"' value='save' onclick='save_row("+id+");'/><input type='button' class='delete_button' id='delete_button"+id+"' value='delete' onclick='delete_row("+id+");'/><input type='button' style='display: none' class='cancel_button' id='cancel_button"+id+"' value='cancel' onclick='cancel("+id+");'/></td></tr>";

                        $("#Phase_Master").val("");
                        $("#Phase_date_start").val("");
                        $("#Phase_date_end").val("");
                        $("#Hours").val("");
                    }
                }
            });
        }
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
    function insert_comments()
    {
        var team_id=document.getElementById('team_id').value;
        var statuss = document.getElementById('status').value;
        var cmt = document.getElementById('comments').value;

        if(statuss == 'Yes')
        {
            var type = 'InActive';
            var status ='No';
        }
        else
        {
            var type= 'Active';
            var status ='Yes';
        }
        $.ajax
        ({
            type: 'post',
            url: "<?php echo site_url('Admin_Controller/Insert_Resource_Changed_Reason'); ?>",
            data: {
                Team_id: team_id,
                Status:status,
                Comments:cmt,
                Type:type
            },
            success: function (response) {
                //alert(response);
                if (response == '1') {
                    $('#myModal').modal('hide');
                    swal({
                            title: "success!",
                            text: "Status Changed ...!",
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

    //** Saver Status **//
    function save_status()
    {
        var project_icode=document.getElementById("project_icode").value;
        var status_code =document.getElementById("Status").value;
        var comments = document.getElementById("status_comments").value;
        $.ajax
        ({
            type: 'post',
            url: "<?php echo site_url('Admin_Controller/Save_Project_Status'); ?>",
            data: {
                Project: project_icode,
                Status:status_code,
                Comments:comments,
            },
            success: function (response) {
                //alert(response);
                if (response == '1') {
                    swal({
                            title: "success!",
                            text: "Status Changed ...!",
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

    //** In Active **//
    function Inactive(id)
    {
        if (confirm("Do you want to DeActive: ")) {

            $.ajax
            ({
                type: 'post',
                url: "<?php echo site_url('Admin_Controller/Inactive_contact'); ?>",
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
                url: "<?php echo site_url('Admin_Controller/Active_contact'); ?>",
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
