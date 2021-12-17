
<?php
 require 'Database/Session.php';
 require 'Database/db.php';
 Session::checkAdminLogin();
 Session::checkTeacherLogin();
 Session::checkStudentLogin();
 $db = new Database();

?>



<!-- php for forget password request mail send -->
<?php
  



      if(isset( $_POST['submit']) ) {
        $email   = $_POST['email'];
        
        
       $query = "SELECT * FROM users WHERE email ='$email'";
           $select_userdata = $db->getuserData($query);
           if ($select_userdata==false) {
           $error="<strong class='text-white'>Sorry!</strong> <span class='text-white'>No account found by <u>$email</u></span>";
         
       }elseif($select_userdata==true) {
             $query ="SELECT * FROM users WHERE email='$email'";
             $row = $db->select($query)->fetch_assoc();

             $name= $row['name'];
             $password =$row['password'];
            

            $recipient_mail = $email;
      			$subject  = "Forget Passwoord Request";


            $body ='<html><body>';
            $body ='<input type="text" name="email">';

      		 

            $body ='</body></html>';
      			$headers = "From: cradmin@gmail.com";
      			 
      			if (mail($recipient_mail, $subject, $body, $headers)) {
      			    $msg="<strong class='text-white'>Success!</strong> <span class='text-white'>Check Your Email  <u><a target='blank' href='https://mail.google.com' class='text-white'>$email</a></u></span>";  
      			} else {
      			   $error="<strong class='text-white'>Sorry!</strong> <span class='text-white'>Email not sent</u></span>";
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
  
  <!-- /.login-logo -->
  <div class="card">
  	<div class="message">
    
      <?php
      if (isset($msg)) {
       
                  echo    "<button type='button' class='btn btn-info col-md-12'>".$msg."</button>";
                   
                }
               ?>

        <?php  


          if(isset($error)) {  

                 echo   "<button type='button' class='btn btn-warning col-md-12'>".$error."</button>";

             }
          ?>
   
  </div>
    <div class="card-body login-card-body">
     
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="" method="POST">
        <div class="input-group mb-3" >
          <input type="email" class="form-control" placeholder="Your Existing Email" name="email" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
       

        
        <div class="row">

          
          <div class="col-12" style="float: right;">

           
            <button type="submit" name="submit" value="user_submit" class="btn btn-info btn-block"><i class="fa fa-paper-plane" aria-hidden="true"></i>  Sent Request</button>
          </div>
          <!-- /.col -->
        </div>
      </form>  
      
    <!-- /.login-card-body -->
  </div>
</div>

          
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
