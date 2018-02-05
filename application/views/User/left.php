  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('img/male.png'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo("{$_SESSION['username']}"."<br />");?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?php echo site_url('User_Controller/dashboard'); ?>"><i class="fa fa-book"></i> <span>Dashboard</span></a></li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-table"></i> <span>Task Management</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo site_url('User_Controller/Create_Task'); ?>"><i class="fa fa-circle-o"></i> <span>Create Task</span></a></li>
                 <!-- <li><a href="<?php /*echo site_url('Admin_Controller/Work'); */?>"><i class="fa fa-circle-o"></i> <span>Work Category</span></a></li>
                  <li><a href="<?php /*echo site_url('Admin_Controller/Work_Type'); */?>"><i class="fa fa-circle-o"></i> <span>Work Type</span></a></li>
                  <li><a href="<?php /*echo site_url('Admin_Controller/Phase_Master'); */?>"><i class="fa fa-circle-o"></i> <span>Phase Master</span></a></li>
                  <li><a href="<?php /*echo site_url('Admin_Controller/Role_Master'); */?>"><i class="fa fa-circle-o"></i> <span>Role Master</span></a></li>-->

              </ul>
          </li>
          <li><a href="<?php echo site_url('User_Controller/Task_Entry'); ?>"><i class="fa fa-history"></i> <span>Task Entry</span></a></li>
          <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Client Entry</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php /*echo site_url('Admin_Controller/Add_Client'); */?>"><i class="fa fa-circle-o"></i> <span>Add Client</span></a></li>
              <li><a href="<?php /*echo site_url('Admin_Controller/View_Client_Details'); */?>"><i class="fa fa-circle-o"></i>View Client</a></li>
            <li><a href="<?php /*echo site_url('Admin_Controller/Add_Contact'); */?>"><i class="fa fa-circle-o"></i>Add Contact</a></li>
              <li><a href="<?php /*echo site_url('Admin_Controller/View_Client'); */?>"><i class="fa fa-circle-o"></i>View Contact</a></li>
           
          </ul>
        </li>
          <li class="treeview">
              <a href="#">
                  <i class="fa fa-table"></i> <span>Project</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php /*echo site_url('Admin_Controller/Create_Project'); */?>"><i class="fa fa-circle-o"></i> <span>Create Fixed Cost Project</span></a></li>
                  <li><a href="<?php /*echo site_url('Admin_Controller/Create_Resource'); */?>"><i class="fa fa-circle-o"></i>Resource Project</a></li>
<!--                  <li><a href="--><?php /*//echo site_url('Admin_Controller/Add_Contact'); */?><!--"><i class="fa fa-circle-o"></i>Add Contact</a></li>-->
<!--                  <li><a href="--><?php /*//echo site_url('Admin_Controller/View_Client'); */?><!--"><i class="fa fa-circle-o"></i>View Contact</a></li>-->

              </ul>
          </li>-->
         <!-- <li class="treeview">
              <a href="#">
                  <i class="fa fa-table"></i> <span>Manage Project</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php /*echo site_url('Admin_Controller/List_Project'); */?>"><i class="fa fa-circle-o"></i> <span>List of Project</span></a></li>
<!--                  <li><a href="--><?php /*//echo site_url('Admin_Controller/Create_Resource'); */?><!--"><i class="fa fa-circle-o"></i>Resource Project</a></li>-->
                  <!--                  <li><a href="--><?php /*//echo site_url('Admin_Controller/Add_Contact'); */?><!--"><i class="fa fa-circle-o"></i>Add Contact</a></li>-->
                  <!--                  <li><a href="--><?php /*//echo site_url('Admin_Controller/View_Client'); */?><!--"><i class="fa fa-circle-o"></i>View Contact</a></li>-->

              </ul>
          </li>-->
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>