
<?php
 require '../Database/db.php';
 require '../Database/Session.php';
 Session::init();
 Session::checkAdminSession();
 $db = new Database();

  if (isset($_GET['action']) && $_GET['action']=="logout"){
     Session::destroy();
  }
?>

<?php
           

             if(isset($_POST['submit'])){
               $topicName        = $_POST['topicName'];
               $deadlineDateTime = $_POST['deadlineDateTime'];
         


           if($topicName=="" || $deadlineDateTime =="") {
            $error= "<span style=color:#ffff;>"." Sorry! One or More Field Missing!.</span>";
            
            }else{  
               $checkquery  ="SELECT * FROM todolists WHERE topicName= '$topicName' AND deadlineDateTime='$deadlineDateTime'";
               $checkresult = $db->select($checkquery);
               if ($checkresult!=false){
                 $error="This Course already Recorded!";
             
           }else{
               
                  $query ="INSERT INTO todolists(topicName,deadlineDateTime) VALUES('$topicName','$deadlineDateTime')";
                  $insert_userdata = $db->insert($query);


                 

                 $msg ="Todo Added!";
                
                        
                         
                   }


            }

            
          }
        



        
         

 
            

      
          
      
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>State Universirty || Course Registration Panel</title>
  <link rel="icon" type="image/png" href="../favicon.png">
   <link rel="stylesheet" href="../dist/css/custom.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light"  style="background: #17A2B8;height: 95px">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #ffff"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link" style="color: #ffff">Dashboard</a>
      </li>


  
     
    
    </ul>

    <!-- SEARCH FORM -->

   
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <form class="form-inline ml-3" action="" method="post">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search..."aria-label="Search" name="s">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit" name="search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
   
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="fa fa-user" aria-hidden="true" style="color: #ffff"></i>
        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 100%;">


          <div class="dropdown-divider"></div>
          <a href="profile.php" class="dropdown-item">
        
            <span class="float-right text-muted text-sm">Profile</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="?action=logout" class="dropdown-item">
         
            <span class="float-right text-muted text-sm">Logout</span>
          </a>
         
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large" style="color: #ffff"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../dist/img/logo.png" alt="Logo" class="logo" style="width: 100%;border-radius: 20px;">
   
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background: #17A2B8">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         

        
          <li class="nav-item">
            <a href="#" class="na
            v-link">
            
              <p hidden>Level 1</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="na
            v-link">
            
              <p ></p>
            </a>
          </li>
           <li class="nav-item">
            <a href="#" class="na
            v-link">
            
              <p ></p>
            </a>
          </li>
            

             <li class="nav-item">
            <a href="teacher.php" class="nav-link">
             <i class="fa fa-users" aria-hidden="true" style="color: #ffff"></i>
              <p style="color: #ffff">&nbsp;Teacher</p>
            </a>
          </li>
             <li class="nav-item">
            <a href="student.php" class="nav-link">
             <i class="fa fa-graduation-cap" aria-hidden="true" style="color: #ffff"></i>
              <p style="color: #ffff"> &nbsp;Student</p>
            </a>
          </li>
             <li class="nav-item">
            <a href="department.php" class="nav-link">
              <i class="fa fa-building" aria-hidden="true" style="color: #ffff"></i>
              <p style="color: #ffff">  &nbsp;&nbsp;Department</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="semester.php" class="nav-link">
            <i class="fa fa-calendar" aria-hidden="true" style="color: #ffff"></i>
         
              <p style="color: #ffff"> &nbsp;&nbsp;&nbsp;Semester</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="prog.php" class="nav-link">
              <i class="fa fa-tasks" aria-hidden="true" style="color: #ffff"></i>
              <p style="color: #ffff">  &nbsp;&nbsp;Program</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="syllabus.php" class="nav-link">
              <i class="fa fa-file" aria-hidden="true" style="color: #ffff"></i>
              <p style="color: #ffff">  &nbsp;&nbsp;&nbsp;Syllabus</p>
            </a>
          </li>
             <li class="nav-item">
            <a href="course.php" class="nav-link">
           <i class="fa fa-list" aria-hidden="true" style="color: #ffff"></i>
              <p style="color: #ffff">  &nbsp;&nbsp;Couerse List</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="enroll.php" class="nav-link">
            <i class="fa fa-graduation-cap" aria-hidden="true" style="color: #ffff"></i>
         
              <p style="color: #ffff"> &nbsp;Enroll Student</p>
            </a>
          </li>

            <li class="nav-item">
            <a href="addtransactionid.php" class="nav-link">
            <i class="fa fa-file" aria-hidden="true" style="color: #ffff"></i>
         
              <p style="color: #ffff"> &nbsp;&nbsp;&nbsp;Transaction ID</p>
            </a>
          </li>

           
         
       
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Teachers</span>
                <span class="info-box-number">

                  <?php  

                        $query="SELECT * FROM users WHERE user_type=1";
                      
                          $teacher =$db->select($query);
                          if ($teacher) {

                            $row = mysqli_num_rows($teacher);
                        
                          echo $row;
                            
                          }
                        
                       
                        ?>
                
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"> <i class="fa fa-graduation-cap" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Students</span>
                  <?php  

                        $query="SELECT * FROM users WHERE user_type=2";
                      
                          $teacher =$db->select($query);
                          if ($teacher) {

                            $row = mysqli_num_rows($teacher);
                        
                          echo $row;
                            
                          }
                        
                       
                        ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"> <i class="fa fa-building" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Department</span>
               <?php  

                $query="SELECT * FROM departments";
              
                  $teacher =$db->select($query);
                  if ($teacher) {

                    $row = mysqli_num_rows($teacher);
                
                   echo $row;
                    
                  }
                
               
                ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-file" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Avaiable Course</span>
                  <?php  

                $query="SELECT * FROM courses";
              
                  $teacher =$db->select($query);
                  if ($teacher) {

                    $row = mysqli_num_rows($teacher);
                
                   echo $row;
                    
                  }
                
               
                ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          
          <div class="col-md-5">


             

            
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>
                   
                <?php
             if (isset($error)) {  

                 echo   "<button type='button' class='btn btn-warning col-md-12 text-white'>".$error."</button>";
                   
                   }
                if (isset($msg)) {
                  echo    "<button type='button' class='btn btn-info col-md-12'>".$msg."</button>";
                   
                }
               ?>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">

                  <?php
                   $currentDateTime = date("Y-m-d h:i:sa");
                      
                $query="SELECT * FROM todolists ORDER BY id DESC";
                $todolist =$db->select($query); 

              if ($todolist) {

                while ($todolistdata = $todolist->fetch_assoc())                   
                
                  if( $todolistdata['deadlineDateTime'] > $currentDateTime){?> 
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="<?php echo $todolistdata['id'] ?>" name="todo" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text"><?php echo $todolistdata['topicName'] ?></span>
                    <!-- Emphasis label -->
                    <small class="badge badge-danger"><i class="far fa-clock"></i>  <?php echo $todolistdata['deadlineDateTime'] ?></small>

                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      
                    </div>
                  </li>
                 
                 <?php }else{
               
                 } }else{

                  echo    "<button type='button' class='btn btn-warning col-md-12 text-white'>No todo enlisted yet</button>";

                 }?>
            
                </ul>
              </div>

           
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                 <div>
               <div class="input_fields_wrap">
                      <button class="add_field_button btn btn-info float-right" style="margin-bottom: 10px"><i class="fas fa-plus"></i></button>
                 
                     
              </div>
             
              </div>
            
             
                 
              </div>

            </div>

              
          </div>


         <div class="col-md-7">
            <div class="card">
            

      <?php 


            if(isset($_POST['search'])){ ?>

                <div class="card-header">

               <h5 class="card-title">Search Result</h5>

               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                   
                       <?php $svalue        = $_POST['s'];
             if ($svalue=="") {
               
                
                $search_error= "<p class='btn btn-warning text-white'>"."Please Enter Search Keyword"."</p>";

             }elseif (!$svalue=="") {
                    
                  $search_data ="SELECT * FROM users WHERE name LIKE '%$svalue%'";
                  $result = $db->select($search_data);

                  if ($result){
                  while ($searchresult = $result->fetch_assoc()){ ?>
                  

              
                  

                   <table id="example1" class="table table-bordered table-striped">
                   <tr><td> <ul><li style="list-style:none;">Name <a href=""><?php echo $searchresult['name'];?> </a>  Email  <a href=""> <?php echo $searchresult['email'];?> </a></li></ul> </td></tr>
                 </table>
                

                <?php  } }else{

              
                

                

                      $search_error= "<button class='btn btn-warning text-white'>"."Ops! Notinh to found by  "."<strong style='color:#DC3545'><u>".$svalue."</strong></u>"."</button>";
                  

                    
          



             
} 

      }
         }
       



      ?>
         <?php 

                      if (isset($search_error)){  

                     echo  $search_error;
                      }
          ?>
             
                  
                  </div>
                 
                </div>
                <!-- /.row -->
              </div>


              
              <!-- ./card-body -->
             
            </div>
            <!-- /.card -->
          </div>

      
          <!-- /.col -->
        </div>
        <!-- /.row -->
        

       
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">SM IT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Maintainece</b>  by SM IT
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="../dist/js/pages/dashboard2.js"></script>


<!-- Todo Field add/remove -->
<script>
  
  $(document).ready(function() {
  var max_fields      = 2; //maximum input boxes allowed
  var wrapper       = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  
  var x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div><form action="" method="POST"><div class="row"><div class="col-md-7"><input type="text" name="topicName" placeholder="Enter Note"></div><div class="col-md-5"><input type="datetime-local" name="deadlineDateTime" style="width: 100%;margin-bottom: 20px;padding: 12px;border: 1px solid #ccc;border-radius: 3px;"></div></div><input type="submit" class="btn btn-info float-right" name="submit"></form></div>');
    }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;
  })
});
</script>
<form action="" method=""></form>

</body>
</html>
