
<?php
require '../Database/db.php';
require '../Database/Session.php';
Session::checkTeacherSession();

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
    $courseTeacher= $result['userID'];
   



  ?>

 <?php 
    if(isset($_GET['del_course'])){

    $del_course_id = (int)$_GET['del_course'];
    $delCourse = $db->DeletePendingCourse($del_course_id);

}



    if(isset($_GET['approve_course'])){

    $approve_course_id = (int)$_GET['approve_course'];
    $ApproveCourse = $db->ApprovePendingCourse($approve_course_id);

}


if(isset($_GET['completed_course'])){

    $completed_course_id = (int)$_GET['completed_course'];
    $CompletdCourse = $db->CompletedApprovedCourse($completed_course_id);

}

 ?>

 <?php

   if(isset($_GET['std_dtls'])=='POST'){
      
     $std_dtls  =$_GET['std_dtls'];
    
  
    
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
    <style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: right;
      padding-right: .75rem;
    }
    
    .color-palette.disabled {
      text-align: center;
      padding-right: 0;
      display: block;
    }
    
    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette.disabled span {
      display: block;
      text-align: left;
      padding-left: .75rem;
    }

    .color-palette-box h4 {
      position: absolute;
      left: 1.25rem;
      margin-top: .75rem;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light"  style="background: #17A2B8; margin-left: 0;line-height: 100px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li>
        <a href="home.php?email=<?php echo $usr?>">
          
           <img src="../dist/img/logo.png" alt="Logo" class="logo" style="width: 100%;border-radius: 20px;">
        </a>
     
      </li>
   
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link" style="color: #ffff; font-size: 18px">Home</a>
      </li>

     
       <li class="nav-item d-none d-sm-inline-block">
        <a href="mycourse.php" class="nav-link" style="color: #ffff; font-size: 18px">Pending Course</a>
      </li>

     


      <li class="nav-item d-none d-sm-inline-block">
        <a href="profile.php" class="nav-link" style="color: #ffff; font-size: 18px">Profile</a>
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
    <section class="content">
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
                <h3 class="card-title">Course History</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if(isset($delCourse)){

               echo   "<button type='button' class='btn btn-danger col-md-12'>".$delCourse."</button>";

             }
             ?>

              <?php
               
                      
                $query="SELECT * FROM courseenrolls WHERE student_regno='$std_dtls'";
                $courseEnroll =$db->select($query);

                if ($courseEnroll) {

                 ?>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Student Info</th>
                    <th>Enroll Date</th>
                    <th>Course Status</th>
                    <th>Pyment Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php   

              while ($courseEnrolldata = $courseEnroll->fetch_assoc()) 
                                  
             { ?>
             
                <tr>
                   <td><?php echo $courseEnrolldata['courseCode']?></td>
                   <td><?php echo $courseEnrolldata['courseName']?></td>
                
                  <td>   
           
                <h6 class="">

                 <?php 

                    $stdId=$courseEnrolldata['student_regno'];
                
                    $query="SELECT * FROM users WHERE userID='$stdId'";
                    $studentInfo =$db->select($query);
                    while ($studentInfoData = $studentInfo->fetch_assoc()) {
                      echo $studentInfoData['name'];
                ?>
                </h6>
 
                <div class="color-palette-set">

                  <div class="color-palette"><span>

            
             
              <div class="modal-content bg-info">

              
                <div class="modal-body">
                   
                <div class="card card-primary">
              
              <!-- /.card-header -->
          
                <div class="card-body">

                  <div class="row">
                       
                          <div class="form-group" style="color: black">
                       

                           <?php 
                              $dept = $studentInfoData['department'];
                             
                              $query="SELECT * FROM departments WHERE id='$dept'";
                              $deptinfo =$db->select($query);
                              while ($deptinfoData = $deptinfo->fetch_assoc()) { ?>
                               <h6><strong>Dept:</strong> <?php echo $deptinfoData['dept_name']; ?> </h6>

                            <?php } ?>
                     

                          </div>
                          
                    
                      </div> 


                   <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                       
                         <img src="<?php echo $studentInfoData['photo'];?>" style="height: 100px">
                      </div>
                    </div>

                  <div class="col-sm-8">
                    <h6 style="color: black;margin-left: 5px;"><strong>ID: </strong><?php echo $stdId; ?>  </h6>

                
                  </div>
                      
      
                   
                  </div>
                   

         <?php 
               

                $query="SELECT * FROM fees WHERE student_id='$stdId'";
                $select_data=$db->select($query);
                $academicData = mysqli_fetch_array($select_data,MYSQLI_ASSOC);
                $semesterFee  =$academicData['semesterFee'];
                $waiver  =$academicData['waiver'];
                $special_waiver  =$academicData['special_waiver'];
                $gendar_waiver  =$academicData['gendar_waiver'];
                $total_waiver =$waiver+$special_waiver+$gendar_waiver;

 ?>

     


 
            </div>   


                 <div class="form-group">
                   <table class="table table-bordered table-striped">


                    <tbody style="color: black">

    
                      <tr><td>Semester Fee</td><td><?php echo $semesterFee ?></td></tr>
                      <tr><td>Waiver</td><td><?php echo $waiver ?></td></tr>
                      <tr><td>Special Waiver</td><td><?php echo $special_waiver ?>%</td></tr>
                      <tr><td>Female Waiver</td><td><?php echo $gendar_waiver ?>%</td></tr>
                      <tr><td>Total Waiver</td><td><?php echo $total_waiver ?>%</td></tr>
                    </tbody>
                    </table>

                   
              


                </div>
                </div>
               
              </div>
              <!-- /.modal-content -->
            </div>
      
                  
                

              </span></div>
               
                </div>
            <?php  }
                ?>
                   </td>
                   <td><?php echo $courseEnrolldata['enrollDate']?></td>


                    <td >
                    
                <?php if ($courseEnrolldata['status']==1) {?>
                      
                     <button type="button" class="btn btn-warning"> &nbsp; Not Approved Yet!
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
                   <td>

                      <?php if ($courseEnrolldata['status']==1) {?>


                    <a href="?approve_course=<?php echo $courseEnrolldata['id']?>&&usr=<?php echo $usr?>"><button type="button" class="btn btn-info"> &nbsp; Approve

                   </button>
                   </a>

                  <a href="?del_course=<?php echo $courseEnrolldata['id']?>&&usr=<?php echo $usr?>"><button type="button" class="btn btn-danger"> &nbsp; Reject
                   </button>
                </a>


                   <?php   }elseif($courseEnrolldata['status']==2 AND $courseEnrolldata['payment_status']==0 ){?>
                       
                    

                      <a onclick ="return confirm('Sorry! Payment is not paid yet! after making payment you can complet this course!')"href=""><button type="button" class="btn btn-info">Done</button></a>
             

                   <?php }elseif($courseEnrolldata['status']==2 AND $courseEnrolldata['payment_status']==1 ){?>
                       
                        <a href="?completed_course=<?php echo $courseEnrolldata['id']?>&&usr=<?php echo $usr?>"><button type="button" class="btn btn-info">&nbsp; Done</button>


                   </button>
                   </a>

                <?php   }
                elseif($courseEnrolldata['status']==3){?>

                          <button type="button" class="btn btn-success" disabled=""> &nbsp; <i class="fa fa-check" aria-hidden="true"></i></button>
                   
                  <?php } ?>

                   </td>

                   
                </tr>
                <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Student Info</th>
                    <th>Enroll Date</th>
                     <th>Course Status</th>
                    <th>Pyment Status</th>
                     <th>Action</th>
                    
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
        
                    
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  
        

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

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>

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
