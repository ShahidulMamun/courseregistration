
<?php
require '../Database/db.php';
require '../Database/Session.php';
Session::checkStudentSession();

 $db = new Database();


if (isset($_GET['action']) && $_GET['action']=="logout") {
    Session::destroy();
  }

?>



<?php
           

       if($_SERVER["REQUEST_METHOD"] == "POST"){
          $course_name    = $_POST['course_name'];
          $course_code    = $_POST['course_code'];
          $course_credit  = $_POST['course_credit'];
          $course_seat    = $_POST['course_seat'];
        
        
          $permited  = array('txt', 'csv', 'jpeg', 'png','jpg');
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];

          $div = explode('.', $file_name);
          $file_ext = strtolower(end($div));
          $unique_file = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_file = "../uploads/course/".$unique_file;
          move_uploaded_file($file_temp, $uploaded_file);

            

           if($course_name=="") {


              $error= "<span style=color:#ffff;>"."Course Name Must Not Empty.</span>";
            
            }else{  
                   $checkquery  ="SELECT * FROM courses WHERE courseCode= '$course_code'";
                   $checkresult = $db->select($checkquery);
                   if ($checkresult!=false){
                     $error="This Course already Recorded!";
                 
                   }else{
               
                 $query ="INSERT INTO courses(courseCode,courseName,noofSeats,courseCredit,coursePlan) VALUES('$course_code','$course_name','$course_seat','$course_credit','$uploaded_file')";
                  $insert_userdata = $db->insert($query);

                 $msg ="Course Added!";

                 header("location:course.php?msg=$msg");
                
                        
                         
                   }

            
          }
          }
      
      ?>
  <?php 
   
    $db = new Database();

  
   
      
    $usr=Session::get("userID");
    $query="SELECT * FROM users WHERE userID='$usr'";
    $select_username=$db->select($query);
    $result = mysqli_fetch_array($select_username,MYSQLI_ASSOC);
    $syllabus_version = $result['syllabus_version'];
   



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
        <a href="course_history.php" class="nav-link" style="color: #ffff; font-size: 18px">Enroll History</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="profile.php" class="nav-link" style="color: #ffff; font-size: 18px">Profile

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


    <!-- Content Header -->
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
 <section class="content"  style=" min-height: 430px">
      <div class="container-fluid">

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
                <h3 class="card-title">Course List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <?php
                      
                $query="SELECT * FROM semesters";
                $semestar =$db->select($query);

                if ($semestar) {
              ?>
                <table id="example1" class="table table-bordered table-striped" style="text-align: center;">
                  <thead>
                  <tr>
                    <th>Semester </th>
                    <th>Semester Start</th>
                    <th>Semester End</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
              <?php   
                $date = date("Y-m-d");
             
              while ($semestardata = $semestar->fetch_assoc()) 
              if ($semestardata['status']==1 &&  strtotime($date)<strtotime($semestardata['regi_deadline'])) {
                           
             { ?>
                <tr>
                   <td><?php echo $semestardata['semester_name']?>   <?php echo $semestardata['semester_year']?></td>
                   <td><?php echo $semestardata['start_date']?></td>
                   <td><?php echo $semestardata['end_date']?></td>
                   <!--<td><?php echo $semestardata['dept_id']?></td>
                   <td><?php echo $semestardata['program_id']?></td>
                   <td></td> -->
                 
                   <td style="text-align: center;"> 
                  <a href="course.php?sem_id=<?php echo $semestardata['id']?>"><button type="button" class="btn btn-info">
                  <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp; View Offered Course
                   </button>
                </a>

              </td>
                </tr>
                <?php }}?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Semester </th>
                    <th>Semester Start</th>
                    <th>Semester End</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              <?php }else{ ?>

                  <button type="button" class="btn btn-info"> </i> &nbsp; Sorry! Semester Not Found!
                   </button>
            <?php  }?>
              </div>
              <!-- /.card-body -->
            </div> 
                             
      </div><!--/. container-fluid -->
  </section>
    <!-- /.content -->


 

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
