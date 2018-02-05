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
        <h1 style="margin-bottom: 20px;">
            Task Entry
            <small></small>
        </h1>


            <ul  class="nav nav-pills">
                <li class="active"><a  href="#1a" data-toggle="tab">Assigned Task</a></li>
                <li><a href="#2a" data-toggle="tab">Other</a></li>
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
                                        <h3>Assigned Task</h3>
                                    </div>
                                    <div class="tab-pane" id="2a">
                                        <h3>Other Task</h3>
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

        $(".add").click(function() {
            $('<div><input class="files form-control-file" name="user_files[]" type="file" ><span class="rem" ><a href="javascript:void(0);" >Remove</span></div>').appendTo(".contents");
        });
        $('.contents').on('click', '.rem', function() {
            $(this).parent("div").remove();
        });


        $("#startdate").datepicker({
            todayBtn: 1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#enddate').datepicker('setStartDate', minDate);
        });


        $("#enddate").datepicker()
            .on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
            });


        $("#Project_Select").change(function () {         /*Selecting Project Detais And Resource*/
            //alert("hiiii");
            /*dropdown post *///
            //document.getElementById('Resource_Select').value = '';
            $.ajax({
                url: "<?php echo site_url('User_Controller/Show_On_Project_Select'); ?>",
                data: {
                    id:
                        $(this).val()
                },
                type: "POST",
                success: function (data) {
                    // alert(data);
                    $("#show_on_project").show();
                    var task_details = $.parseJSON(data);
                    //alert(task_details);
                    var client_name = task_details.Client_Details[0]['Client_Company_Name'];
                    //alert(client_name);
                    document.getElementById('Client_Name').value = client_name;

                    var Client_Name_icode = task_details.Client_Details[0]['Client_Icode'];
                    //alert(client_name);
                    document.getElementById('Client_Name_icode').value = Client_Name_icode;

                    var work_cat = task_details.Client_Details[0]['WorkCategory_Name'];
                    document.getElementById('Work_Category').value = work_cat;

                    var work_type = task_details.Client_Details[0]['Work_Name'];
                    document.getElementById('Work_Type').value = work_type;

                }


            });
        });


        $("#Project_Select").change(function () {         /*Selecting Project Detais And Resource*/
            //alert("hiiii");
            /*dropdown post *///
            //document.getElementById('Resource_Select').value = '';
            $.ajax({
                url: "<?php echo site_url('User_Controller/Show_On_Project_Resource'); ?>",
                data: {
                    id:
                        $(this).val()
                },
                type: "POST",
                success: function (data) {
                    $("#Resource_Select").html(data);
                }


            });
        });
    });


</script>

?>