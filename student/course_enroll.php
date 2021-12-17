
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

     if (isset($_GET['course_code']) && isset($_GET['courseName'])  && isset($_GET['courseCredit'])&& isset($_GET['courseTeacher'])&& isset($_GET['sem_id'])=='POST') {
         $course_code=$_GET['course_code']; 
         $courseName=$_GET['courseName'];
         $courseCredit=$_GET['courseCredit'];
         $courseTeacher=$_GET['courseTeacher'];
         $sem_id=$_GET['sem_id'];


        $query="SELECT * FROM users WHERE userID='$courseTeacher'";
        $select_username=$db->select($query);
        $result = mysqli_fetch_array($select_username,MYSQLI_ASSOC);
        $TeacherName= $result['name'];


        
      


       }

?>

  <?php 
   
    

   
    $usr=Session::get("userID");
    $query="SELECT * FROM users WHERE userID='$usr'";
    $select_username=$db->select($query);
    $result = mysqli_fetch_array($select_username,MYSQLI_ASSOC);
    $Std_name       =$result['name'];
    $Std_department = $result['department'];
    $StdRegi_num= $result['userID'];

   ?>

 <?php
           

       if($_SERVER["REQUEST_METHOD"] == "POST"){
          $course_name    = $_POST['course_name'];
          $course_code    = $_POST['course_code'];
          $course_credit  = $_POST['course_credit'];
          $Std_name       = $_POST['Std_name'];
          $Std_department = $_POST['Std_department'];
          $StdRegi_num    = $_POST['StdRegi_num'];
          $semester_name  = $_POST['semester_name'];
          $courseTeacher  = $_POST['courseTeacher'];
          $courseCredit   =$_POST['courseCredit'];
          if($course_name=="") {


              $error= "<span style=color:#ffff;>"."Course Name Must Not Empty.</span>";
            
            }else{  
                   $checkquery  ="SELECT * FROM courseenrolls WHERE courseCode= '$course_code' AND student_regno='$StdRegi_num'";
                   $checkresult = $db->select($checkquery);
                   if ($checkresult!=false){
                     $error="You are already enlisted for this Course!";
                 
                   }else{
               
                 $query ="INSERT INTO courseenrolls(student_regno,Student_Dept,semester,courseCode,courseName,courseTeacher,courseCredit) VALUES('$StdRegi_num','$Std_department','$semester_name','$course_code','$course_name','$courseTeacher','$courseCredit')";
                  $insert_userdata = $db->insert($query);

                 $msg ="Congrats! You are enlisted successfully for this course!";

                 header("location:payment.php?usr=$usr&&msg=$msg&&courseCode=$course_code&&courseName=$courseName&&courseCredit=$courseCredit");
                
                        
                         
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



   
    <!-- /.content-header -->

 
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
    <section class="content" style=" min-height: 430px">
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
                  <h4 class="modal-title">Course Information</h4>
                
                </div>
                <div class="modal-body">
                   
                   <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Course Name</label>
                    <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo  $courseName ?>" readonly>
                  </div>

                   <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="phone">Course Credit</label>
                    <input type="text" class="form-control" id="course_credit" name="course_credit" value="<?php echo $courseCredit ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                     <div class="form-group">
                        <label for="phone">Course Code</label>
                       <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo  $course_code ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="name">Course Teacher</label>
                    <input type="text" class="form-control" id="courseTeacher" value="<?php echo $TeacherName ?>" readonly>
                  </div>

                   <div class="form-group">
                    <label for="$usr">Semester</label>
                  <select name="semester_name" id="semester_name" required="" class="form-control" required="">
                  <?php
                          
                    $query="SELECT * FROM semesters WHERE id='$sem_id'";
                    $semester =$db->select($query);
                    ?>
                  
                 <?php  while ($semesterdata = $semester->fetch_assoc()) { ?>

                    <option value="<?php echo $semesterdata['id']?>"> <?php echo $semesterdata['semester_name']?>  <?php echo $semesterdata['semester_year']?></option>
                
                    <?php }?>
                 </select>
                  </div>

                  <input type="text" name="Std_name" hidden="" value="<?php echo $Std_name ?>">
                  <input type="text" name="Std_department" hidden="" value="<?php echo $Std_department ?>">
                  <input type="text" name="StdRegi_num" hidden="" value="<?php echo $StdRegi_num ?>">
                  <input type="courseTeacher" name="courseTeacher"  hidden="" value="<?php echo $courseTeacher ?>">
                  <input type="" name="courseCredit" value="<?php echo $courseCredit ?>" hidden="">





  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
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
