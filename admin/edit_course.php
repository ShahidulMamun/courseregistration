<?php
 require '../Database/db.php';
 require '../Database/Session.php';
 Session::init();
 Session::checkAdminSession();
 $db = new Database();


 if (isset($_GET['action']) && $_GET['action']=="logout") {
     Session::destroy();
    
  }
?>
<?php 

if (isset($_GET['course_id'])=='POST'){
      $course_id  =$_GET['course_id'];

      $query="SELECT * FROM courses WHERE id='$course_id'";
      $courses =$db->select($query);
      while ($coursesdata = $courses->fetch_assoc()){
        $courseName= $coursesdata['courseName'];
        $courseCode= $coursesdata['courseCode'];
        $courseCredit= $coursesdata['courseCredit'];
        $noofSeats= $coursesdata['noofSeats'];
        $courseTeacher= $coursesdata['courseTeacher'];
     
     }

      $query="SELECT * FROM users WHERE userID='$courseTeacher'";
      $courseTeacher =$db->select($query);
      while ($courseTeacherdata = $courseTeacher->fetch_assoc()){
        $courseTeacherName= $courseTeacherdata['name'];

       }
    }

?>

<?php
     


       if($_SERVER["REQUEST_METHOD"] == "POST"){
          $course_name    = $_POST['course_name'];
          $course_code    = $_POST['course_code'];
          $course_credit  = $_POST['course_credit'];
          $courseTeacherID = $_POST['courseTeacherID'];

          if($course_name=="" || $course_code=="" || $course_credit=="" || $courseTeacherID=="") {
              $error= "<span style=color:#ffff;>"."Sorry! One Or More Field Missing!.</span>";
          }else{
               
              $query = "UPDATE courses
              SET
              courseName ='$course_name',
              courseCode    ='$course_code',
              courseCredit    ='$course_credit',
              courseTeacher    ='$courseTeacherID'
              WHERE id ='$course_id'";
              $updated_row = $db->update($query);

              $msg ="Course Updated!";
              header("location:course.php?msg=$msg");
                
                        
                         
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



  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
   
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="fa fa-user" aria-hidden="true" style="color: #ffff"></i>
        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 100%;">


          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
        
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
            <h1 class="m-0 text-dark">

               

            </h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

            
            
           
          <div class="" id="modal-info">
            <div class="modal-dialog">
              <div class="modal-content bg-info">
                <?php
             if (isset($_GET['msg'])) {
               $msg =$_GET['msg'];
             }
             if (isset($error)) {  

                 echo   "<button type='button' class='btn btn-warning col-md-12'>".$error."</button>";
                   
                   }
                if (isset($msg)) {
                  echo    "<button type='button' class='btn btn-info col-md-12'>".$msg."</button>";
                   
                }
               ?>
                <div class="modal-header">
                  <h4 class="modal-title">Course Update</h4>
                 
                </div>
                <div class="modal-body">
                   
                   <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body"> 
                

                   <div class="form-group">
                    <label for="name">Course Name</label>
                    <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo  $courseName?>">

                      
  
                  
                      <div class="form-group">
                        <label for="phone">Course Code</label>
                       <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo  $courseCode?>">
                      </div>
               

                   <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="phone">Course Credit</label>
                    <input type="number" class="form-control" id="course_credit" name="course_credit" value="<?php echo  $courseCredit?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group">
                    <label for="courseTeacher">Teacher</label>
                  <select name="courseTeacherID" id="courseTeacherID" required="" class="form-control">
                    <option style="color: red" disabled="">Selected Teacher : <?php echo $courseTeacherName?></option>
                  <?php
                          
                    $query="SELECT * FROM users WHERE user_type=1";
                    $teacherdata =$db->select($query);
                    ?>
                  
                 <?php  while ($allteacher = $teacherdata->fetch_assoc()) { ?>

                    <option value="<?php echo $allteacher['userID']?>"> <?php echo $allteacher['name']?></option>
                
                    <?php }?>
                 </select>
                  </div>
                    </div>
                  </div>
                  
                  

                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update</button>
                </div>
              </form>
            </div>   



                </div>
               
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        
                    
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


<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
