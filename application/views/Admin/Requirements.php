<?php
/**Vibu */
?>
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
        <?php if($this->session->flashdata('message')){?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('message')?>
            </div>
        <?php } ?>
        <h1 style="margin-bottom: 20px;">
            Requirements
            <small></small>
        </h1>

        <ul  class="nav nav-pills" id="myTab">
            <li class="active"><a  href="#1a" data-toggle="tab">Un Assigned </a></li>
            <li><a href="#2a" data-toggle="tab">Assigned</a></li>
        </ul>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row padding_class">
                            <div class="col-md-12">
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="1a">
                                        <h3>Un Assigned Requirements </h3>

                                        <table id="assigned_tasks" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <th>Client</th>
                                                <th>Project</th>
                                                <th>Contract Type</th>                                
                                                <th>Ddate</th>
                                                <th>Select Leader</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php
                                            $i=1;
                                            foreach($Requirements as $r)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $r['Company_Name']; ?></td>
                                                    <td><?php echo $r['Project_Title']; ?></td>
                                                    <td><?php echo $r['Requirement_Type']; ?></td>
                                                    <td><?php echo $r['Estimation_Date']; ?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select id="Leader" name="Leader"  >
                                                                <option>Select Leader</option>
                                                            <?php foreach ($Leader as $row):
                                                            { 
                                                            echo "<option value= " .$row['User_Icode'].">" . $row['User_Name'] . "</option>";
                                                            } 
                                                            endforeach; ?>
                                                            </select> 
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <button id="myBtn" class="btn btn-success" value="<?php echo $r['Requirement_Icode']; ?>" 
                                                        onclick="Assign_Leader(this.value)" >Assign</button>
                                                    </td>
                                                   

                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                         </div>
                                    <div class="tab-pane" id="2a">
                                        <div class="row padding_class">
                                            <div class="col-md-12" >
                                                <h2>Other Task</h2>
                                                <table id="tblCustomers5"  data-page-length='25' class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Company Name</th>
                                                        <th>Contract Type</th>
                                                        <th>Project Title</th>
                                                        <th>Estimate Date</th>
                                                        <th>Tech Team Date</th>
                                                        <th>Leader Name</th>
                                                        <th>Status</th>

                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                    $i=1;
                                                    foreach($Assigned as $r)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $r['Company_Name']; ?></td>
                                                            <td><?php echo $r['Requirement_Type']; ?></td>
                                                            <td><?php echo $r['Project_Title']; ?></td>
                                                            <td><?php echo $r['Estimation_Date']; ?></td>
                                                            <td><?php echo $r['Tech_Team_Date']; ?></td>
                                                            <td><?php echo $r['User_Name']; ?></td>
                                                            <td><?php echo $r['Req_Name']; ?></td>
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
                </div>
            </div>
        </div>
    </section>
</div>
</div>
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
        $('#assigned_tasks').DataTable();

    });
    function Assign_Leader(id)
    {
        var leader = document.getElementById('Leader').value;
        if(leader == " ")
        {
            alert("Please Select Leader");
        }
        else
        {
            if (confirm("Do you want to Assign Leader  "))
            {
                $.ajax({   url:"<?php echo site_url('Admin_Controller/Assigned_Leader'); ?>",
                    data: {id: id,
                           Leader_Id: leader },
                    type: "POST",
                    cache: false,
                    success:function(data){
                        if(data == '1')
                        {
                            swal({
                                    title: "Good job!",
                                    text: "You clicked the button!",
                                    type: "success"
                                },
                                function(){
                                    location.reload();
                                });
                        }
                        else
                        {
                            alert("These Contract Assigned to Project Dont Delete that Contract");
                        }
                    }
                });
            }

        }


    }



</script>

?>