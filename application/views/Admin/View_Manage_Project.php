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



        $('#Phase_date_start').datepicker({
            todayBtn:  1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Phase_date_end').datepicker('setStartDate', minDate);
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
        document.getElementById("phase"+id).innerHTML="<input type='text' id='Phase_Master"+id+"' value='"+Phase+"' readonly>";
        document.getElementById("start"+id).innerHTML="<input  type='text' class='phase_Start' id='Phase_date_start"+id+"' name='Phase_date_start' value='"+Start+"' onmousedown='show_date1()'  >";
        document.getElementById("end"+id).innerHTML="<input type='text' class='phase_end' id='Phase_date_end"+id+"' value='"+End+"' >";
        document.getElementById("hour"+id).innerHTML="<input type='number' id='Hours"+id+"' value='"+Hour+"'>";
    }

//    function show_date()
//    {
//        $('.phase_end').datepicker({
//            dateFormat: 'yy-mm-dd',
//            startDate: new Date(),
//            todayBtn:  1
//        }).on('changeDate', function (selected) {
//            var minDate = new Date(selected.date.valueOf());
//            $('.phase_Start').datepicker('setStartDate', minDate);
//        });
//    }
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




</script>
