
<?php
require '../Database/db.php';
require '../Database/Session.php';
Session::checkStudentSession();



  if (isset($_GET['action']) && $_GET['action']=="logout") {
     Session::destroy();
    
  }


?>

<?php 
   
   $db = new Database();

   
    $usr=Session::get("userID");
    $query="SELECT * FROM users WHERE userID='$usr'";
    $select_username=$db->select($query);
    $result = mysqli_fetch_array($select_username,MYSQLI_ASSOC);
   





   if (isset($_GET['msg'])=='POST') {
      $msg=$_GET['msg'];


  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>State Universirty || Course Registration</title>

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

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light"  style="background: #17A2B8; margin-left: 0;line-height: 100px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
       <li>
        <a href="home.php">
          
           <img src="../dist/img/logo.png" alt="Logo" class="logo" style="width: 100%;border-radius: 20px;">
        </a>
     
      </li>
   
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link" style="color: #ffff; font-size: 18px">Home</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="peakcourse_by_semester.php" class="nav-link" style="color: #ffff; font-size: 18px">Register Course</a>
      </li>

      
      <li class="nav-item d-none d-sm-inline-block">
        <a href="course_history.php" class="nav-link" style="color: #ffff; font-size: 18px">Enroll History

       </a>
      </li>

       <li class="nav-item d-none d-sm-inline-block">
        <a href="profile.php" class="nav-link" style="color: #ffff; font-size: 18px">
          Profile


       </a>
      </li>
      
    </ul>


    
      <ul class="navbar-nav ml-auto">

      <a href="?action=logout">
        
         <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
       <li class="nav-item d-none d-sm-inline-block"> Logout  <i class="fas fa-sign-in-alt"></i>
       </li>
      </button>
      </a>
      
         
     
          
      </ul>
  </nav>
  <!-- /.navbar -->



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style=" min-height: 430px">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">

       
    </div><!--/. container-fluid -->
          
          <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <a href="">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Available Courses</span>
                <span class="info-box-number">
                  

                <?php  

                $query="SELECT * FROM courses";
              
                  $course =$db->select($query);
                  if ($course) {

                    $row = mysqli_num_rows($course);
                
                   echo $row;
                    
                  }
                
               
                ?>
                </span>

                <div class="progress">
                 
                </div>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fa fa-check" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">My Completed Courses</span>
                <span class="info-box-number">
                  
                   <?php  

                $query="SELECT * FROM courseenrolls WHERE student_regno='$usr'";
              
                  $course =$db->select($query);
                  if ($course) {

                    $row = mysqli_num_rows($course);
                
                   echo $row;
                    
                  }else{
                    echo "There is no completed Coueses!";
                  }
                
               
                ?>
                </span>

                <div class="progress">
                  
                </div>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <a href="">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Events</span>
                <span class="info-box-number">Upcomming</span>

                <div class="progress">
                 
                </div>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-md-3 col-sm-6 col-12">
            <a href="">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-chalkboard-teacher"></i></span>
              
              <div class="info-box-content">
                <span class="info-box-text">Faculty List</span>
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

                <div class="progress">
                 
                </div>
               
              </div>
              <!-- /.info-box-content -->
            </div>
             </a>
            <!-- /.info-box -->
          </div>

       
          <!-- /.col -->
        </div>


        <div class="row" style="min-height: 300px">
           <?php if (isset($msg)) {
              
                  echo    "<button type='button' class='col-md-12'>".$msg."</button>";
                   
                }
            ?>
        </div>
            
            
           

     </div> 
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->



 

  <!-- Main Footer -->
  <footer class="main-footer"style="margin-left: 0">
    <strong>Copyright &copy; 2021 <a href="#">SM IT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Maintainece</b>  by SM IT
    </div>
  </footer>

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
</body>
</html>
