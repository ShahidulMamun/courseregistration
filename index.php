
<?php
 require 'Database/Session.php';
 require 'Database/db.php';
 Session::checkAdminLogin();
 Session::checkTeacherLogin();
 Session::checkStudentLogin();
 $db = new Database();

?>
<!-- php for admin login -->
<?php

    if(isset( $_POST['submit']) ) {

          $email   = $_POST['email'];
          $password= $_POST['password'];
          $password= md5($password);
          $query = "SELECT * FROM admins WHERE email= '$email' AND password= '$password'";
             $select_userdata = $db->getuserData($query);
        
         if ($select_userdata==true) {
             $query ="SELECT * FROM admins WHERE email='$email' AND password='$password'";
             $confirmecode= $db->select($query);
             $row = $db->select($query)->fetch_assoc();

             if($row['status']== 1)
             {  
                Session::init();
                Session::set("adminlogin",true);
                Session::set("username",$row['username']);
                Session::set("email",$row['email']);
                header("location:admin?email=$email");
             }
             else{
            $err ="Email or Password is Wrong!";
         
                                
         }
       } 
      }
  ?>

<!-- php for tescher & studennt login -->
<?php
  



      if(isset( $_POST['user_submit']) ) {
        $regiORid   = $_POST['regiORid'];
        $password= $_POST['password'];
        $password= md5($password);
        $user_type= $_POST['user_type'];
        
       $query = "SELECT * FROM users WHERE userID ='$regiORid' AND password= '$password'";
           $select_userdata = $db->getuserData($query);
           if ($select_userdata==true) {
           $query ="SELECT * FROM users WHERE userID='$regiORid' AND password='$password'";
           $row = $db->select($query)->fetch_assoc();
           if ($row['user_type']== $user_type){


              if ($row['status']== 1){

                  

                if ($row['user_type']==1) {
                    Session::init();
                    Session::set("teacherlogin",true);
                    Session::set("name",$row['name']);
                    Session::set("email",$row['email']);
                    Session::set("phone",$row['phone']);
                    Session::set("userID",$row['userID']);
                  $usr_id     = $regiORid;
                  $usr = base64_encode($usr_id);
                  header("location:teacher/home.php");
                }elseif ($row['user_type']==2) {

                    Session::init();
                    Session::set("studentlogin",true);
                    Session::set("name",$row['name']);
                    Session::set("email",$row['email']);
                    Session::set("phone",$row['phone']);
                    Session::set("userID",$row['userID']);

                  $usr_id     = $regiORid;
                  $usr = base64_encode($usr_id);

                header("location:student/home.php");
                }
           }else{
             $error ="Your account is blocked! Check email!";
           } 
           }else{
              $error = "User type is wrong!";
           }
       }else{

          $error ="ID or Password is Wrong!";
                              
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

   <link rel="icon" type="image/png" href="favicon.png">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light"  style="background: #17A2B8; margin-left: 0;height: 95px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li>
        <a href="index.php"><img src="dist/img/logo.png" alt="Logo" class="logo" style="width: 100%;border-radius: 20px;"></a>
      
      </li>
   
    
      
      
    </ul>


    
      <ul class="navbar-nav ml-auto">


          
            
             
                  
                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                   <li class="nav-item d-none d-sm-inline-block">Admin <i class="fas fa-sign-in-alt"></i>
                   </li>
                  </button>
         
     
          
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


 <div class="login-box" style="margin:0 auto">
  <div class="login-logo" style="background: #17A2B8">
    <img src="dist/img/logo.png" alt="Logo" class="logo" style="width: 100%;border-radius: 20px;">
   
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
     <?php
      if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        
                  echo    "<button type='button' class='btn btn-info col-md-12'>".$msg."</button>";
                   
                }
               ?>

        <?php  


          if(isset($error)) {  

                 echo   "<button type='button' class='btn btn-warning col-md-12'>".$error."</button>";

             }
          ?>
      <p class="login-box-msg"> Teacher & Student Login</p>

      <form action="" method="POST">
        <div class="input-group mb-3" >
          <input type="text" class="form-control" placeholder="Your ID" name="regiORid" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">

           <select class="form-control" name="user_type" required="">
             <option>User Type</option>
             <option value="1">Teacher</option>
             <option value="2">Student</option>
           </select>
        
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8"> <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p></div>

          
          <div class="col-4" style="float: right;">

           
            <button type="submit" name="user_submit" value="user_submit" class="btn btn-info btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


     
      
    <!-- /.login-card-body -->
  </div>
</div>



          
  </div>
       <div class="modal fade" id="modal-info">
            <div class="modal-dialog">
              <div class="modal-content bg-info">
                <div class="modal-header">
                  <h4 class="modal-title"> <img src="dist/img/logo.png" alt="Logo" class="logo" style="width: 100%;border-radius: 20px;"></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
        
                                  
                   <div class="login-box" style="margin:0 auto">
                  <div class="login-logo">
                    Admin Login  
                  </div>
                  <!-- /.login-logo -->
                      <div class="card">
                         <div class="card-body login-card-body">
                      

                             <form action="" method="POST">
                                  <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" required="" name="email">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                      </div>
                                    </div>
                                  </div>
                                    <div class="input-group mb-3">
                                      <input type="password" class="form-control" placeholder="Password" required="" name="password">
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span class="fas fa-lock"></span>
                                        </div>
                                      </div>
                                    </div>

                        
                                    <div class="row">
                                     
                                      <div class="col-4">
                                        <button type="submit" name="submit" class="btn btn-info btn-block">Sign In</button>
                                      </div>
                                      <!-- /.col -->
                                    </div>
                               </form>

                    <!-- / .login-card-body -->
                               </div>
                             </div>



                          
                         </div>
                   </div>
                     <div class="modal-footer justify-content-between">
                    
                     <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                  
                  </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div><!--/. container-fluid -->

     </div> 
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->

 

  <!-- Main Footer -->
  <footer class="main-footer" style="margin-left: 0">
    <strong>Copyright &copy; 2021 <a href="#">SM IT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Maintainece</b>  SM IT
    </div>
  </footer>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
