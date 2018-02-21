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
            Manage Work Order
            <small></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row" id="old">
                            <div class="col-md-12 ">
                                <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th>
                                        <th>Country</th>
                                        <th>Project</th>
                                        <th>Signed Date</th>
                                        <th>No.of Resource</th>
                                        <th>Work Order Title</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    foreach($WO_List as $r)
                                    { ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a href="select_Work_Order/<?php echo $r['Work_Order_Icode'] ?>/<?php echo $r['Resource_Client_Icode'] ?>"><?php echo $r['Client_Company_Name']; ?></a></td>
                                                <td><?php echo $r['Client_Country']; ?></td>
                                                <td><?php echo $r['Project_Name']; ?></td>
                                                <td><?php echo $r['Contract_Signed_Date']; ?></td>
                                                <td><?php echo $r['Resource_count']; ?></td>
                                                <td><?php echo $r['Work_Order_Title']; ?></td>
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

    function get_rest()
    {
        location.reload();

    }

</script>