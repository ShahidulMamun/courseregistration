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
           

       if($_SERVER["REQUEST_METHOD"] == "POST"){
          $name      = $_POST['name'];
          $email     = $_POST['email'];
          $phone     = $_POST['phone'];
          $dept_name = $_POST['dept_name'];
          $password  =$_POST['password'];
          $password  = md5($password);
          $user_type = $_POST['user_type'];
          $designation = $_POST['designation'];
          $faculty_id  = $_POST['faculty_id'];
        
          $permited  = array('jpg', 'jpeg', 'png', 'gif');
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];

          $div = explode('.', $file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "../uploads/".$unique_image;
          move_uploaded_file($file_temp, $uploaded_image);

            

           if($name=="") {


              $error= "<span style=color:red;>"."Teacher's Name Must Not Empty.</span>";
            
            }else{  
                   $checkquery  ="SELECT * FROM users WHERE email= '$email'";
                   $checkresult = $db->select($checkquery);
                   if ($checkresult!=false){
                     $error="This Faculty Member already Recorded!";
                 
                   }else{
               
                 $query ="INSERT INTO users(name,email,phone,department,designation,userID,password,user_type, photo) VALUES('$name','$email','$phone','$dept_name','$designation','$faculty_id','$password','$user_type','$uploaded_image')";
                  $insert_userdata = $db->insert($query);

                 $msg ="Teacher Added!";
                
                        
                         
                   }

            
          }
          }
      
      ?>
  <?php 


if(isset($_GET['activate'])){

    $activate_teacher_id = (int)$_GET['activate'];
    $ActiveTeacher = $db->ActiveUser($activate_teacher_id);

}


if(isset($_GET['deactive'])){

    $deactive_teacher_id = (int)$_GET['deactive'];
    $DeactiveTeacher = $db->DeactiveUser($deactive_teacher_id);

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
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">

               

            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">
                
          
              </a>
            </li>
            
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


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
           
       
        
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">Course History</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if(isset($delCourse)){

               echo   "<button type='button' class='btn btn-danger col-md-12'>".$delCourse."</button>";

             }
             ?>

              <?php
               
                      
                $query="SELECT * FROM courseenrolls";
                $courseEnroll =$db->select($query);

                if ($courseEnroll) {

                 ?>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Student ID</th>
                    <th>Enroll Date</th>
                    <th>Course Status</th>
                    <th>Pyment Status</th>
                  
                  </tr>
                  </thead>
                  <tbody>
            <?php   

              while ($courseEnrolldata = $courseEnroll->fetch_assoc()) 
               

              
                           
             { ?>
             
                <tr>
                   <td><?php echo $courseEnrolldata['courseCode']?></td>
                   <td><?php echo $courseEnrolldata['courseName']?></td>
                   <td><?php echo $courseEnrolldata['student_regno']?></td>
                   
                   <td><?php echo $courseEnrolldata['enrollDate']?></td>


                    <td >
                    
                <?php if ($courseEnrolldata['status']==1) {?>
                      
                     <button type="button" class="btn btn-warning"> &nbsp; Not Approved
                   </button>
                </a>
               
               <?php   

                }elseif($courseEnrolldata['status']==2){ ?>
                <button type="button" class="btn btn-info"> </i> &nbsp; Ongoing
                   </button>
                </a>
                <?php      }elseif($courseEnrolldata['status']==3){?>

                  <button type="button" class="btn btn-info"> </i> &nbsp; Completed

                <?php } ?>
                   </td>


                   <td>
                    
                     <?php  if($courseEnrolldata['status']==3)
                     {
                      ?>
                      
                  <button type="button" class="btn btn-info"> &nbsp; Paid
                   </button>
                
                    <?php }else{

                    if($courseEnrolldata['payment_status']==1) {?>
                      
                  <button type="button" class="btn btn-info"> </i> &nbsp; Paid
                   </button>
                </a>
               <?php  
               }elseif($courseEnrolldata['payment_status']==0){ ?>

                      <button type="button" class="btn btn-warning"> &nbsp; Pending
                   </button>
                
                <?php       } } ?>
                   

                 
                   </td>
               
            

                   
                </tr>
                <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Student ID</th>
                    <th>Enroll Date</th>
                    <th>Course Status</th>
                    <th>Pyment Status</th>
                   
                    
                  </tr>
                  </tfoot>
                </table>

              <?php  }else{?>

                 <button type="button" class="btn btn-info"> </i> &nbsp; Sorry! Course Not Found!
                   </button>
           <?php   }?>
              </div>
              <!-- /.card-body -->
            </div>
            
    </div>
              <!-- /.card-body -->
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
