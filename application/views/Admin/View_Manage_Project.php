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
            View/Manager Project
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
                        foreach ($project as $key)
                        {
                            ?>
                        <div class="row padding_class">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Project</label>
                                    <input class="form-control"  type="text" id="Project_Name" name="Project_Name" value="<?php echo $key['Project_Name']; ?>" placeholder="Enter Project Name" readonly >
                                    <input type="hidden" name="project_icode" id="project_icode" value="<?php echo $key['Project_Icode']; ?>" >
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
                                        <label>Project WO Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            <input class="form-control" id="date_Wo" name="date_Wo" value="<?php echo $key['Project_WO_Date']; ?>"  type="text" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Project Start Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            <input class="form-control" type="text" value="<?php echo $key['Project_Start_Date']; ?>" name="date_start" id="startdate" readonly/>

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
                                            <input class="form-control" type="text" value="<?php echo $key['Planned_End_Date']; ?>" name="date_end" id="enddate" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Estiamtion Hour</label>
                                        <div class="input-group">
                                            <input class="form-control" id="E_Hour" name="E_Hour" value="<?php echo $key['Estimation_Hours']; ?>" type="number" min="0" step="1" readonly/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3"> <input type="radio" name="Rtype" id="Project" value="Project" checked  onclick="show_phase()" /> <label style="margin-right: 20px; font-weight: normal;">Change Date</label></div>
                                    <div class="col-md-3"><input type="radio" name="Rtype" id="Resource" value="Resource" onclick="show_Resource()" /> <label style="font-weight: normal;">Change Resource</label></div>
                                    <div class="col-md-3"><input type="radio" name="Rtype" id="Resource" value="Status" onclick="show_Status()" /> <label style="font-weight: normal;">Change Status</label></div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="col-md-3">
                                    <label>New End Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar">
                                            </i>
                                        </div>
                                        <input class="form-control" id="date_new" name="date_new" placeholder="New End Date"   type="text" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea name="Comments" id="Comments" class="form-control"></textarea>
                                </div>
                                </div>
                            </div>

                            <div class="row padding_class" id="Show_Phase" >
                                <div class="col-md-12" >
                                    <h2>Phase Management</h2>
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
                                        <?php
                                        $i=1;
                                        foreach ($phase as $row)
                                        {
                                            ?>
                                            <tr id="row<?php echo $row['Project_Phase_Icode'];?>">
                                                <td id="phase<?php echo $row['Project_Phase_Icode'];?>"><?php echo $row['Phase_Name'];?></td>
                                                <td id="start<?php echo $row['Project_Phase_Icode'];?>"><?php echo $row['Phase_Start_Date'];?></td>
                                                <td id="end<?php echo $row['Project_Phase_Icode'];?>"><?php echo $row['Phase_End_Date'];?></td>
                                                <td id="hour<?php echo $row['Project_Phase_Icode'];?>"><?php echo $row['Estimate_Hour'];?></td>
                                                <td>
                                                    <input type='button' class="edit_button" id="edit_button<?php echo $row['Project_Phase_Icode'];?>" value="edit" onclick="edit_row('<?php echo $row['Project_Phase_Icode'];?>');">
                                                    <input type='button' class="save_button" style="display: none" id="save_button<?php echo $row['Project_Phase_Icode'];?>" value="save" onclick="save_row('<?php echo $row['Project_Phase_Icode'];?>');">
                                                    <input type='button' class="delete_button" id="delete_button<?php echo $row['Project_Phase_Icode'];?>" value="delete" onclick="delete_row('<?php echo $row['Project_Phase_Icode'];?>');">
                                                </td>
                                            </tr>

                                        <?php
                                            $i++;
                                        }
                                        ?>

                                        <tr id="new_row">
                                            <td>
                                                <div class="form-group">
                                                    <select name="Phase_Master[]" class="form-control" id="Phase_Master" required >
                                                        <option value="" >Select Phase</option>
                                                        <?php foreach ($Phase_master as $row):
                                                        {
                                                            echo '<option value= "'.$row['Project_Phase_Master_Icode'].'">' . $row['Phase_Name'] . '</option>';
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

                                            <td>
                                                <input type='button' class="save_button"  id="save_button" value="save" onclick="insert_row();">
<!--                                                <input type="button" onclick="Add()" value="Add" /></td>-->
                                        </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success pull-right"  onclick="Save_Phase_History()" >Save</button>
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

        $("#Phase_Master").change(function(){
            var value = $("#Phase_Master option:selected").val();
            var theDiv = $(".is" + value);

            theDiv.slideDown().removeClass("hidden");
            $("#Phase_Master option:selected").attr('disabled','disabled');
        });

        $('#Phase_date_start').datepicker({
            todayBtn:  1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Phase_date_end').datepicker('setStartDate', minDate);
        });

        var date_input_WO=$('input[name="date_new"]');
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input_WO.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
            startDate: new Date()
        })

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
    });

    function show_phase()
    {
        alert("dsfdsf");
        $('#Show_Phase').show();
        $('#show_Resource').hide();
        $('#show_Status').hide();
    }
    function edit_row(id)
    {
        var Phase=document.getElementById("phase"+id).innerHTML;
        var Start=document.getElementById("start"+id).innerHTML;
        var End=document.getElementById("end"+id).innerHTML;
        var Hour=document.getElementById("hour"+id).innerHTML;
        document.getElementById("phase"+id).innerHTML="<input type='text' name='Phase_Master[]' id='Phase_Master"+id+"' value='"+Phase+"' readonly>";
        document.getElementById("start"+id).innerHTML="<input  type='text' name='Phase_date_start[]' class='phase_Start' id='Phase_date_start"+id+"' name='Phase_date_start' value='"+Start+"' onmousedown='show_date1()'  >";
        document.getElementById("end"+id).innerHTML="<input type='text' name='Phase_date_end[]' class='phase_end' id='Phase_date_end"+id+"' value='"+End+"' >";
        document.getElementById("hour"+id).innerHTML="<input type='number' name='Hour[]' id='Hours"+id+"' value='"+Hour+"' min='0' step='1'>";

        document.getElementById("edit_button"+id).style.display="none";
        document.getElementById("save_button"+id).style.display="block";
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
        var phase=document.getElementById("Phase_Master"+id).value;
        var start=document.getElementById("Phase_date_start"+id).value;
        var end=document.getElementById("Phase_date_end"+id).value;
        var hour=document.getElementById("Hours"+id).value;
        var project_icode=document.getElementById("project_icode").value;


        $.ajax
        ({
            type:'post',
                url:"<?php echo site_url('Admin_Controller/Save_Phase'); ?>",
                data: {
                    project:id,
                    project_icode:project_icode,
                    phase_code:phase,
                    Start_date:start,
                    End_date:end,
                    Hours:hour
            },
            success:function(response) {
                if(response=="1")
                {
                    document.getElementById("phase"+id).innerHTML=phase;
                    document.getElementById("start"+id).innerHTML=start;
                    document.getElementById("end"+id).innerHTML=end;
                    document.getElementById("hour"+id).innerHTML=hour;
                    document.getElementById("edit_button"+id).style.display="block";
                    document.getElementById("save_button"+id).style.display="none";
                }
            }
        });
    }
    function Save_Phase_History()
    {
        var project_icode=document.getElementById("project_icode").value;
        var project_Old_End=document.getElementById("enddate").value;
        var project_New_End=document.getElementById("date_new").value;
        var Cmd=document.getElementById("Comments").value;

        if(project_New_End == "" || Cmd == "" )
        {
            alert("Please Enter All Fields...");
        }
        else
            {
                $.ajax({
                    url:"<?php echo site_url('Admin_Controller/Save_History'); ?>",
                    data: {Project_id:project_icode,
                        Project_old:project_Old_End,
                        Project_New:project_New_End,
                        Comments:Cmd
                    },
                    type: "POST",
                    success:function(server_response){
                        if(server_response == 1)
                        {
                            alert("Success...");
                            window.location.href = document.referrer;
                        }
                        else {
                            alert("Failed..");
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
                        var row = document.getElementById("row" + id);
                        row.parentNode.removeChild(row);
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
                        var id=response;
                        var table=document.getElementById("tblCustomers5");
                        var table_len=(table.rows.length)-1;
                        var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='phase"+id+"'>"+text_t+"</td><td id='start"+id+"'>"+start+"</td><td id='end"+id+"'>"+end+"</td><td id='hour"+id+"'>"+hour+"</td><td><input type='button' class='edit_button' id='edit_button"+id+"' value='edit' onclick='edit_row("+id+");'/><input type='button' class='save_button' id='save_button"+id+"' value='save' onclick='save_row("+id+");'/><input type='button' class='delete_button' id='delete_button"+id+"' value='delete' onclick='delete_row("+id+");'/></td></tr>";

                        $("#Phase_Master").val("");
                        $("#Phase_date_start").val("");
                        $("#Phase_date_end").val("");
                        $("#Hours").val("");
                    }
                }
            });

        }

    }



    



</script>
