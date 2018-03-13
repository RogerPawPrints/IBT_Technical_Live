  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Add Client
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
                <form method="post" role="form" action="<?php echo site_url('Admin_Controller/insert_client'); ?>" name="data_register">
                  <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Select Client</label>
                      <input class="typeahead form-control" style="width:300px;" type="text" id="client_name" name="client_name" >
                  </div>
                  <div class="col-md-4">
                    <button type="button"  class="btn btn-info" id="test" onclick="search()" >Search</button>   
                  </div>   
                  </div>
                  <div class="col-md-12" id="details" style="display: none;">
                  <div class="col-md-3">
                  <div class="form-group">
                     <label>Web URL</label>
                    <input type="text" class="form-control" name="client_web" id="client_web" readonly=""  >
                  </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                     <label>client Address</label>
                    <input type="text" class="form-control" name="client_Address" id="client_Address" readonly=""  >
                  </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                     <label>Country</label>
                    <input type="text" class="form-control" name="Country" id="Country" readonly=""  >
                  </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                     <label>State</label>
                    <input type="text" class="form-control" name="State" id="State" readonly=""  >
                  </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                     <label>City</label>
                    <input type="text" class="form-control" name="City" id="City" readonly=""  >
                  </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                     <label>Contact Number</label>
                    <input type="text" class="form-control" name="phone" id="phone" readonly=""  >
                  </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                     <label>Company Email</label>
                    <input type="text" class="form-control" name="Email" id="Email" readonly=""  >
                  </div>
                  </div>
                      <div class="col-md-3">

                    <button type="submit" style="float: right;"  class="btn btn-primary">Submit</button>
                      </div>
                
                </div>
                </div>
                </form>
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


</script>