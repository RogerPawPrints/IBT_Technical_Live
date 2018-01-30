<script>
    $(document).ready( function () {

        $('#tblCustomers').addClass( 'nowrap' ).DataTable( {
            responsive: true
        });
    } );

</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Contact
            <small></small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Contact</li>
        </ol>
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
                                <a href="<?php echo site_url('Admin_Controller/View_Client'); ?>">View Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                            <form method="post" role="form" action="<?php echo site_url('Admin_Controller/insert_contact'); ?>" name="data_register">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Client</label>
                                        <select name="Company_code" class="form-control" id="company_resource" required >
                                            <option value="" >Select Company</option>
                                            <?php foreach ($Client as $row):
                                            {

                                                echo "<option value= " .$row['Client_Icode'].">" . $row['Client_Company_Name'] . "</option>";

                                            }
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="" id="details1" style="display: none;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Web URL</label>
                                            <input type="text" class="form-control" name="url" id="url1" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country" id="country1" readonly="">
                                        </div>
                                    </div>
                                </div>

                                <table id="tblCustomers"  data-page-length='25' class="table  table-bordered bootstrap-datatable datatable responsive">
                                    <thead>
                                    <tr>
                                        <th>Contact Name</th>
                                        <th>Contact Designation</th>
                                        <th>Contact Number</th>
                                        <th>Email address</th>
                                        <th>Contact IM</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="contact_name[]" id="contact_name" placeholder="Contact Name" required >

                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="contact_desig[]" id="contact_desig" placeholder="Contact Designation" required >
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="contact_phone1[]" id="contact_phone1" placeholder="Contact Number " required  >
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="contact_email" name="contact_email[]" placeholder="Enter email">

                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="contact_im[]" id="contact_im" placeholder="Contact IM" required >
                                            </div>
                                        </td>



                                        <td><input type="button" onclick="Add()" value="Add" />
                                          </td>
                                    </tr>

                                    </tfoot>
                                </table>
                                <button type="submit" class="btn btn-info pull-right" >Save</button>

                            </form>
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
    $("#company_resource").change(function(){
        //  alert("hiiii");
        /*dropdown post *///
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/get_Company_Details'); ?>",
            data: {id:
                $(this).val()},
            type: "POST",
            success:function(server_response){
                $('#details1').show();

                var data = $.parseJSON(server_response);
                var url = data[0]['Client_WebURL'];
                document.getElementById('url1').value = url;
                var country = data[0]['Client_Country'];
                document.getElementById('country1').value = country;
            }
        });
    });
    </script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">

    function Add() {

        if($('#contact_name').val() == "")
        {
            alert("Please Enter Contact Name...");
        }
        else if($("#contact_desig").val() == "")
        {
            alert("Please Type Designation...");
        }
        else if($("#contact_phone1").val() == "")
        {
            alert("Please Enter Contact name...");
        }
        else if($("#contact_email").val() == "")
        {
            alert("Please Email ID..");
        }
        else if($("#contact_im").val() == "")
        {
            alert("Please Enter IM...");
        }
        else
        {
            AddRow($('#contact_name').val(), $("#contact_desig").val(),$("#contact_phone1").val(),$("#contact_email").val(),$("#contact_im").val());
            $("#contact_name").val("");
            $("#contact_desig").val("");
            $("#contact_email").val("");
            $("#contact_phone1").val("");
            $("#contact_im").val("");

        }


    }

    function AddRow(contact_name, contact_desig,contact_phone1,contact_email,contact_im) {
        //Get the reference of the Table's TBODY element.


        var tBody = $("#tblCustomers > TBODY")[0];

        //Add Row.
        row = tBody.insertRow(-1);

        //Add Name cell.
        var cell = $(row.insertCell(-1));

        var tech = $("<input />");
        tech.attr("type", "text");
        tech.attr("name", "contact_name[]");
        tech.val(contact_name);
        cell.append(tech);

        //Add Country cell.
        cell = $(row.insertCell(-1));

        var Area = $("<input />");
        Area.attr("type", "text");
        Area.attr("name", "contact_desig[]");
        Area.val(contact_desig);
        cell.append(Area);



        cell = $(row.insertCell(-1));
        var expr = $("<input />");
        expr.attr("type", "text");
        expr.attr("name", "contact_phone1[]");
        expr.val(contact_phone1);
        cell.append(expr);


        cell = $(row.insertCell(-1));

        var time = $("<input />");
        time.attr("type", "text");
        time.attr("name", "contact_email[]");
        time.val(contact_email);
        cell.append(time);


        cell = $(row.insertCell(-1));
        var edate = $("<input />");
        edate.attr("type", "text");
        edate.attr("name", "contact_im[]");
        edate.val(contact_im);
        cell.append(edate);

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
            var table = $("#tblCustomers")[0];

            //Delete the Table row using it's Index.
            table.deleteRow(row[0].rowIndex);
        }
    };
</script>