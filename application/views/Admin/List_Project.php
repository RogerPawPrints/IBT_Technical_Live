<script>
    $(document).ready( function () {

        $('#demoPostTable').addClass( 'nowrap' ).DataTable( {

        });
    } );
    $(document).ready( function () {

        $('#demoPostTable1').addClass( 'nowrap' ).DataTable( {

        });
    } );
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List of Project
            <small></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Project Status</label>
                                        <select name="Status" class="form-control" id="Status"  required >
                                            <option value="" >Select Client</option>
                                            <?php foreach ($Status as $row):
                                            {

                                                echo "<option value= " .$row['project_status_Icode'].">" . $row['Status_Name'] . "</option>";

                                            }
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <button type="button"  class="btn btn-info" onclick="search_Data()" >Search</button>
                                        <button type="button"  class="btn btn-success" id="reset"  onclick="get_rest()" >Reset</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th>
                                        <th>Country</th>
                                        <th>Project</th>
                                        <th>Start Date</th>
                                        <th>Planned End Date</th>
                                        <th>Actual End Date</th>
                                        <th>Estimated Hours</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    foreach($List as $r)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $r['Client_Company_Name']; ?></td>
                                            <td><?php echo $r['Client_Country']; ?></td>
                                            <td><?php echo $r['Project_Name']; ?></td>
                                            <td><?php echo $r['Project_Start_Date']; ?></td>
                                            <td><?php echo $r['Planned_End_Date']; ?></td>
                                            <td><?php echo $r['Actual_End_Date']; ?></td>
                                            <td><?php echo $r['Estimation_Hours']; ?></td>
                                            <td><?php echo $r['Status_Name']; ?></td>

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
                <div class="box box-primary" id="fulldata" style="display:none">

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <table id="demoPostTable1"  data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                    <thead>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Country</th>
                                    <th>Project</th>
                                    <th>Start Date</th>
                                    <th>Planned End Date</th>
                                    <th>Actual End Date</th>
                                    <th>Estimated Hours</th>
                                    <th>Status</th>
                                    </thead>
                                    <tbody id="comments1">


                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

    function search_Data()
    {

        var Status = document.getElementById('Status').value;

        if(Status == "")
        {
            alert("Please Select Date");
        }
        else
        {
            $.ajax({
                url:"<?php echo site_url('Admin_Controller/Search_Project'); ?>",
                data: {Status: Status },
                type: "POST",
                success:function(data){
                    //alert(data);
                    $('#old').hide();
                    $('#fulldata').show();
                    $('#comments1').html(data);
                    $('#demoPostTable1').DataTable();

                }
            });
        }

    }


    function edit_row(id)
    {
        $.ajax({   url:"<?php echo site_url('Admin_Controller/Edit_Contact'); ?>",
            data: {id: id},
            type: "POST",
            cache: false,
            success:function(data){
                $("#edit_code").html(data);

            }
        });
    }

    function update()
    {
        var contact_id = document.getElementById('contact_id').value;
        var clientid = document.getElementById('client_contact_id').value;
        var contact_name = document.getElementById('contact_name').value;
        var desig = document.getElementById('contact_desig').value;
        var phone = document.getElementById('contact_phone1').value;
        var email = document.getElementById('contact_email').value;
        var im = document.getElementById('contact_im').value;

        $.ajax({url:"<?php echo site_url('Admin_Controller/Update_Contact'); ?>",
            data: {id: contact_id,client_id: clientid, contact_Name: contact_name, Desig: desig, Phone: phone, Email: email, IM: im  },
            type: "POST",
            cache: false,
            success:function(data){
                location.reload();

            }
        });
    }

    function Delete_Contact(id)
    {

        var job = confirm("Are you sure you want  to Delete confirm ?");
        if(job!=true)
        {
            return false;
        }
        else
        {
            $.ajax({   url:"<?php echo site_url('Admin_Controller/Delete_Contact'); ?>",
                data: {id: id},
                type: "POST",
                cache: false,
                success:function(data){
                    if(data == '1')
                    {
                        alert("success");
                        location.reload();
                    }
                    else
                    {
                        alert("Failed");
                    }

                }
            });

        }

    }


</script>