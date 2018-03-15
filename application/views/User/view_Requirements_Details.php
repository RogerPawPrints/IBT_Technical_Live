<?php
/**
 * Created by PhpStorm.
 * User: Karthik
 * Date: 13-03-2018
 * Time: 16:57
 */
?>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>
<div class="content-wrapper">
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
    </section>
    <section class="content">
        <div class="row">
          <div class="col-md-12">
                <div class="col-md-8">
                    <?php foreach ($Req as $new) { ?>
                    <h3><?php echo $new['Company_Name']; ?> |<span><a href="<?php echo $new['WebURL']; ?>"
                                                                      target="_blank"><?php echo $new['WebURL']; ?></a> |<?php echo $new['Requirement_Type']; ?>
                            |<?php echo $new['Project_Title']; ?> | <?php echo $new['Req_Name']; ?> </span></h3>

                </div>
              <div class="col-md-4">
                  <h4><a href='<?php echo site_url('User/List_Requirement'); ?>'>Back</a></h4>
              </div>

              <div class="col-md-12 ">
                  <?php
                  if ($new['Requirement_Status'] == '7') {
                      ?>
                      <div class="col-md-6">
                          <div class="box box-primary">
                              <div class="box-body custom">
                                  <h4 style="font-weight: 600;">Estimated Hours</h4>
                                  <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['Estimate_Hour']; ?> </p>
                                  <h4 style="font-weight: 600;">Project Type</h4>
                                  <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['WorkCategory_Name']; ?> </p>
                                  <h4 style="font-weight: 600;">Contract Type</h4>
                                  <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['Contracttype_Name']; ?> </p>
                                  <h4 style="font-weight: 600;">Project Value</h4>
                                  <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['Project_Price']; ?><?php echo $Won_details['Price_Code']; ?> </p>
                                  <h4 style="font-weight: 600;">Date</h4>
                                  <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Won_details['Project_Get_Date']; ?> </p>
                              </div>
                          </div>
                      </div>
                      <?php
                  } else if ($new['Requirement_Status'] == '8') {
                      ?>
                      <div class="col-md-6">
                          <div class="box box-primary">
                              <div class="box-body custom">
                                  <h4 style="font-weight: 600;">Lost Type</h4>
                                  <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Lost_details['Lost_Type']; ?> </p>
                                  <div>
                                      <h4 style="font-weight: 600;">Lost Reason</h4>
                                      <ul style="margin-left: 10%;  font-size: 20px; list-style: binary; ">
                                          <?php
                                          $i = 0;
                                          foreach ($lost_reason as $lost => $val) {
                                              ?>
                                              <li><?php echo $val[$i]['Reason']; ?></li>
                                              <?php

                                          }
                                          ?>


                                      </ul>
                                  </div>
                                  <h4 style="font-weight: 600;">Comments</h4>
                                  <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Lost_details['Lost_Comments']; ?> </p>
                                  <h4 style="font-weight: 600;">Date</h4>
                                  <p style="margin-left: 12%;  font-size: 20px;"><?php echo $Lost_details['Lost_Date']; ?> </p>


                              </div>
                          </div>
                      </div>
                      <?php
                  } else {
                      ?>
                      <div class="col-md-6">

                          <div class="box box-primary">
                              <div class="box-body custom">
                                  <?php
                                  if ($new['Requirement_Status'] >= '4' && $new['Requirement_Type'] == 'Project') {
                                      ?>

                                      <?php
                                  } else if ($new['Requirement_Status'] < '4' && $new['Requirement_Type'] == 'Project') {
                                      ?>
                                      <div class="row" style="padding: 0 15px;" id="show_Status">
                                          <div class="form-group">
                                              <label>Post Comments</label>
                                              <input type="hidden" name="Requirement_id" id="Requirement_id1"
                                                     value="<?php echo $new['Requirement_Icode']; ?>">
                                              <input type="hidden" name="Req_status" id="Req_status1"
                                                     value="<?php echo $new['Requirement_Status']; ?>">
                                              <input type="hidden" name="Pros_code" id="Pros_code1"
                                                     value="<?php echo $new['Prospect_Icode']; ?>">
                                              <input type="hidden" name="Bde_Code1" id="Bde_Code1"
                                                     value="<?php echo $new['Current_BDE_User_Code']; ?>">

                                              <textarea name="pcmd1" id="pcmd1" class="form-control"></textarea>
                                          </div>
                                          <div class="form-group">
                                              <label>Select Status</label>
                                              <select name="mySelect" class="form-control" id="mySelect">
                                                  <option value="<?php echo $new['Requirement_Status']; ?>">Select
                                                      Status
                                                  </option>

                                                  <?php
                                                  foreach ($Req_Status as $val) {

                                                      echo "<option value= " . $val['Req_Id'] . " >" . $val['Req_Name'] . "</option>";
                                                  }
                                                  ?>
                                              </select>

                                          </div>

                                          <div class="input-group" id="tech_date" style="display: none;">
                                              <label>Our Estimation Date</label>
                                              <div class="input-group-addon">
                                                  <i class="fa fa-calendar">
                                                  </i>
                                              </div>
                                              <input class="form-control" id="Contract_date_start" name="Contract_date_start" placeholder="YYYY/MM/DD" type="text"/>
                                          </div>
                                          <button type="button" id="Save_Comments1" style="float: right;"
                                                  class="btn btn-success" onclick="Save_project_status_cmd()">Save
                                          </button>
                                      </div>

                                      <?php
                                  } elseif ($new['Requirement_Status'] >= '13' && $new['Requirement_Type'] == 'Resource') {
                                      ?>

                                      <?php
                                  } else {
                                      ?>

                                      <?php

                                  }
                                  ?>
                                  <div id="Project_Loss" style="display: none;">
                                      <h3>Project Loss</h3>
                                      <div class="col-md-12">
                                          <div class="form-group">

                                              <input type="radio" name="Rtype" id="Project" value="Client"
                                                     onclick="show_Client()"/> <label
                                                  style="margin-right: 20px; font-weight: normal;">Client Reason</label>
                                              <input type="radio" name="Rtype" id="Resource" value="Our"
                                                     onclick="show_Our()"/> <label style="font-weight: normal;">Our
                                                  Reason</label>

                                          </div>


                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php

                  }
                  }// first foreach
    ?>




    <div class="col-md-6">

        <div class="box box-warning direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Comments</h3>


            </div>
            <!-- /.box-header -->
            <div class="box-body" >
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages" >
                    <!-- Message. Default to the left -->
                    <?php
                    if(isset($leader_cmd) && is_array($leader_cmd) && count($leader_cmd)): $i=1;
                        foreach ($leader_cmd as $key ) {
                            ?>
                            <div class="direct-chat-msg">
                                <?php
                                if($key['Req_Comments'] != "")
                                {
                                    ?>
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left"><?php echo $key['Bde'] ?></span>
                                        <span class="direct-chat-timestamp pull-right"><?php echo $key['Modified_Date'] ?></span>
                                    </div>
                                    <!-- /.direct-chat-info -
                                    <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        <?php echo $key['Req_Comments'] ?>
                                    </div>
                                    <!-- /.direct-chat-text -->
                                    <?php
                                }
                                else
                                {

                                }
                                ?>

                            </div>
                            <div class="direct-chat-msg right">

                                <?php
                                if($key['Tech_Leader_Cmd'] != "")
                                {
                                    ?>
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right"><?php echo $key['Leader'] ?></span>
                                        <span class="direct-chat-timestamp pull-left"><?php echo $key['Modified_Date'] ?></span>
                                    </div>
                                    <div class="direct-chat-text">
                                        <?php echo $key['Tech_Leader_Cmd'] ?>
                                    </div>
                                    <?php
                                }
                                else
                                {

                                }
                                ?>
                            </div>
                            <?php
                        }
                    else:
                        ?>
                        <tr>
                            <td colspan="7" align="center" >No Record Found</td>
                        </tr>
                        <?php
                    endif;
                    ?>

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

<script>

    $(document).ready(function() {
        $("#Contract_date_start").datepicker({
            todayBtn: 1,
            autoclose: true,
            startDate: new Date(),
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#Contract_date_end').datepicker('setStartDate', minDate);
        });
    });
    function Save_project_status_cmd()    // save status cmd
    {
        var req_id = document.getElementById('Requirement_id1').value;
        var req_status = document.getElementById('Req_status1').value;
        var pcode = document.getElementById('Pros_code1').value;
        var pcmd = document.getElementById('pcmd1').value;
        var bde_code = document.getElementById('Bde_Code1').value;
        var next_status = document.getElementById('mySelect').value;
        var Exp_date = document.getElementById('Contract_date_start').value;
        if(pcmd == "" )
        {
            alert("Please put Comments");
        }
        else if(next_status == '4' && Exp_date == "")
        {
            alert("Please Select Date")
        }
        else
        {

            $.ajax({
                url:"<?php echo site_url('User_Controller/save_Status_Comments'); ?>",
                data: {Req_id: req_id,Req_status: req_status,Pcmd: pcmd,Pros_code: pcode,Nstatus: next_status,BDE_Code: bde_code,Expected: Exp_date   },
                type: "POST",
                success:function(data){
                    alert("successfully Comment Posted and Change Status..");
                    window.location.href = document.referrer;
                }
            });

        }

    }

</script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#mySelect").change(function()
        {
            var val = $(this).val();
            if(val =='4')
            {
                $('#tech_date').show();

            }
            else
            {
                $('#tech_date').hide();
            }
        });
    });

</script>

</body>
</html>

