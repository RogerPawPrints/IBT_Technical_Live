<script>
    $(document).ready( function () {

        $('#demoPostTable').addClass( 'nowrap' ).DataTable( {

        });
    } );
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Client Details
            <small></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <ul class="breadcrumb">
                            <li>
                                <a href="<?php echo site_url('Admin_Controller/Add_Client'); ?>">Add Client</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Admin_Controller/View_Client_Details'); ?>">View Client</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Admin_Controller/Add_Contact'); ?>">Add Contact</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Admin_Controller/View_Client'); ?>">View Client</a>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th>
                                        <th>WebURL</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Email</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    foreach($contacts_details as $r)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $r['Client_Company_Name']; ?></td>
                                            <td><?php echo $r['Client_WebURL']; ?></td>
                                            <td><?php echo $r['Client_Address']; ?></td>
                                            <td><?php echo $r['Client_Country']; ?></td>
                                            <td><?php echo $r['Client_State']; ?></td>
                                            <td><?php echo $r['Client_City']; ?></td>
                                            <td><?php echo $r['Client_Phone_Number']; ?></td>
                                            <td><?php echo $r['Client_Company_Email_ID']; ?></td>

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


                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 60%;" >
                        <div class="modal-content" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Contact</h4>
                            </div>
                            <div class="modal-body" id="edit_code">
                            </div>
                            <div class="modal-footer">
                                <button type="Submit" onclick="update()" class="btn btn-success" >Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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


    $('input.typeahead').typeahead({
        source:  function (query, process) {
            return $.get('<?php echo site_url('Admin_Controller/get_client'); ?>', { query: query }, function (data) {
                console.log(data);
                data = $.parseJSON(data);
                return process(data);
            });
        }
    });

    function search()
    {
        var company_name = document.getElementById('client_name').value;
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/get_client_Details'); ?>",
            data: {company: company_name},
            type: "POST",
            success:function(data){

                if(data == 1)
                {
                    alert("Client Already Added...");
                }
                else
                {
                    data = $.parseJSON(data);
                    $('#details').show();
                    var url = data[0]['WebURL'];
                    document.getElementById('client_web').value = url;
                    var address = data[0]['Address'];
                    document.getElementById('client_Address').value = address;
                    var Country = data[0]['Country'];
                    document.getElementById('Country').value = Country;
                    var State = data[0]['State'];
                    document.getElementById('State').value = State;
                    var City = data[0]['City'];
                    document.getElementById('City').value = City;
                    var phone = data[0]['Company_Contact'];
                    document.getElementById('phone').value = phone;
                    var Email = data[0]['Company_Email'];
                    document.getElementById('Email').value = Email;b
                }


            }
        });

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