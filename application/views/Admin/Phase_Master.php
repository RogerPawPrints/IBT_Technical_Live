<script>
    $(document).ready( function () {
        $('#demoPostTable').addClass( 'nowrap' ).DataTable( {

        });
    } );
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Phase Master
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
                            <div class="col-md-12 ">
                                <div class="box-content">
                                    <form method="post" role="form" action="<?php echo site_url('Admin_Controller/insert_Phase_Master'); ?>" name="data_register">
                                        <div class="form-group">
                                            <label>Phase Master Name</label>
                                            <input type="text" class="form-control" name="Phase_master_name" placeholder="Phase_master_name" required >
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-header">
        <h1>
            View Phase Master
            <small></small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="box-content">
                                    <table id="demoPostTable" data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Phase Master Name</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        foreach ($Phase_Master as $key => $data)
                                        {
                                            ?>
                                            <tr>
                                                <th><?php echo $i; ?></th>
                                                <td><?php echo $data['Phase_Name']; ?></td>
                                                <td>
                                                    <a class="btn btn-danger" href="javascript:;" onclick="Delete_Phase_Master('<?php echo $data['Project_Phase_Icode']; ?>')">
                                                        <i class="glyphicon glyphicon-trash icon-white"></i>
                                                        Delete
                                                    </a>
                                                </td>
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
        </div>
    </section>
    <!-- /.content -->
</div>
<script>

    function Delete_Contact(id)
    {

        var job = confirm("Are you sure you want  to Delete confirm ?");
        if(job!=true)
        {
            return false;
        }
        else
        {
            $.ajax({   url:"<?php echo site_url('Admin_Controller/delete_contract'); ?>",
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
                        alert("These Contract Assigned to Project Dont Delete that Contract");
                    }

                }
            });

        }

    }
</script>