
<?php
require '../Database/db.php';
require '../Database/Session.php';
Session::checkTeacherSession();

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
    $name    = $result['name'];
    $email   = $result['email'];
    $phone   = $result['phone'];
    $myID    = $result['userID'];
    $myimage = $result['photo'];
   



 

?>

<?php 


        $db = new Database();


        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])){


                 
           $updateusr = $db->UpdateProfile($myID,$_POST);

      
       }
          
      
      ?>

    <?php 
      

        $db = new Database();


        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changepass'])){
                 
           $updatpass = $db->UpdatePass($email, $_POST);

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
/*body {
  background-image: url("bg.jpg"), url("paper.gif");
  background-color: #cccccc;
  background-repeat: no-repeat;
  background-position: center;
  background-size: 100
} */
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light"  style="background: #17A2B8; margin-left: 0;line-height: 100px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li>
        <a href="">
          
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



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" >
        <!-- Info boxes -->
           <div class="row">

         
 <div class="col-md-6" style="margin: 0 auto">
        
        <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Personal Info</a>
          
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Change Password</a>
        </div>
      </nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    
         <div class="info-box-content">
               

              <div class="profile">
            <div class="modal-dialog">
              <?php if (isset($_GET['msg'])) {
                  $msg=$_GET['msg'];
                  echo    "<button type='button' class='btn btn-info col-md-12'>".$msg."</button>";
                   
                } ?>
              <div class="modal-content bg-info">

                <div class="modal-header">
                  <h4 class="modal-title">Faculty ID: <?php echo $myID ?></h4>
               
                 
                </div>
                <div class="modal-body">
                   
                   <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST">
                <div class="card-body">

                   <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                          <img src="<?php echo $myimage ?>" style="height: 100px">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label for=""></label>
                      
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Teacher Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name?>" required="">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"  value="<?php echo $email?>" required="">
                  </div>

                  <div class="form-group">
                      <label for="phone">Phone</label>
                    <input type="number" class="form-control" id="phone" name="phone"  value="<?php echo $phone?>" required="">
                  </div>

                   
              


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  
                    
                     <button type="submit" class="btn btn-info" value="update" name="update">Update</button>
                
                 
                </div>
              </form>
            </div>   



                </div>
               
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
               
              </div>
              <!-- /.info-box-content -->
  </div>
 
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    


               <div class="info-box-content">


                
            <div class="password">

            <div class="modal-dialog">
              <div class="modal-content bg-info">
                <?php
             if (isset($updatpass)) {  

                 echo   "<button type='button' class='btn btn-warning col-md-12'>".$updatpass."</button>";
                   
                   }
                
               ?>
                <div class="modal-header">

                    <h4 class="modal-title">Faculty ID: <?php echo $myID ?></h4>
               
                </div>
                <div class="modal-body">
                   
                   <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">CPassword</label>
                    <input type="password" class="form-control" id="CPassword" name="CPassword" placeholder="Old Password" required="">
                  </div>
                  <div class="form-group">
                    <label for="email">NPassword</label>
                    <input type="password" class="form-control" id="NPassword" name="NPassword" placeholder="New Password" required="">
                  </div>

                  <div class="form-group">
                      <label for="phone">CNPassword</label>
                    <input type="password" class="form-control" id="CNPassword" name="CNPassword" placeholder="Confirm New Password" required="">
                  </div>

               
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="changepass" value="changepass" class="btn btn-info">Update</button>
                </div>
              </form>
            </div>   



                </div>
                
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
            

               
              </div>
              <!-- /.info-box-content -->
  </div>
</div>
           


         
     
  </div>
         
       
          
          
         
       
 </div>
 



                </div>
                
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
            

               
              </div>
              <!-- /.info-box-content -->
    
          
          </div>
          <!-- /.col -->
         
          
          
         
       
        </div>

       


     </div> 
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->



 

  <!-- Main Footer -->
  <footer class="main-footer"style="margin-left: 0;">
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
