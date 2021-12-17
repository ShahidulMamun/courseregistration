
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

    $usr=Session::get("userID");
    $query="SELECT * FROM users WHERE userID='$usr'";
    $select_username=$db->select($query);
    $result = mysqli_fetch_array($select_username,MYSQLI_ASSOC);
    $name   = $result['name'];
   


?>
<?php
         if (isset($_GET['courseCode']) && isset($_GET['courseName'])  && isset($_GET['courseCredit'])=='POST') {
         $course_code  =$_GET['courseCode']; 
         $courseName   =$_GET['courseName'];
         $courseCredit =$_GET['courseCredit']; 

      



       }
  ?>


<?php
           

       if($_SERVER["REQUEST_METHOD"] == "POST"){
          $transactionid    = $_POST['transactionid'];
          $paymentnumber    = $_POST['paymentnumber'];
          $stdID           = $_POST['stdID'];
          $PayCourseID      = $_POST['PayCourseID'];
          $PayAmount        = $_POST['PayAmount'];
          $permited  = array('jpg', 'jpeg', 'png', 'gif');
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];
          $div = explode('.', $file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "../uploads/".$unique_image;
          move_uploaded_file($file_temp, $uploaded_image);
          if($transactionid=="" ) {

            $error= "<span style=color:#ffff;>"."Fill Out Transaction ID.</span>";

        }
            

        else{  
             $checkquery  ="SELECT * FROM transactionid WHERE trnxID= '$transactionid'";
             $checkresult = $db->select($checkquery);
              if(!$checkresult){
                $error="Transaction ID Invalid";
              }else{

             while ($trnxStatus = $checkresult->fetch_assoc()){
              $status = $trnxStatus['status'];
              if ($status==2) {
                 $error="This Transaction ID Already Used!";
              }else{
                $query ="INSERT INTO payments(TransactionID,UserID,PayCourseID,payAmount,PaymentSS) VALUES('$transactionid','$stdID','$PayCourseID','$PayAmount','$uploaded_image')";
                $insert_userdata = $db->insert($query);
                $query = "UPDATE courseenrolls
                SET
                payment_status ='1'
                WHERE student_regno ='$stdID' AND courseCode='$PayCourseID'";
                $updated_row = $db->update($query);


                $query = "UPDATE transactionid
                SET
                status ='2'
                WHERE trnxID ='$transactionid'";
                $updated_row = $db->update($query);
                $msg ="<strong>Success!</strong> Payment Successfull!";

                header("location:home.php?msg=$msg&&usr=$usr");
           
             }
            
             }
             }
             }
          }    
      ?>

<?php
             if (isset($_GET['courseCredit'])=='POST') {
              $courseCredit=$_GET['courseCredit']; }
              $perCreditPrice =3000;
              $total =$perCreditPrice*$courseCredit;

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
  <link rel="stylesheet" href="../dist/css/custom.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light"  style="background: #17A2B8; margin-left: 0;line-height: 100px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li>
        <a href="home.php?usr=<?php echo $usr?>">
          
           <img src="../dist/img/logo.png" alt="Logo" class="logo" style="width: 100%;border-radius: 20px;">
        </a>
     
      </li>
   
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php?usr=<?php echo $usr?>" class="nav-link" style="color: #ffff; font-size: 18px">Home</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="peakcourse_by_semester.php" class="nav-link" style="color: #ffff; font-size: 18px">Register Course</a>
      </li>

     
      <li class="nav-item d-none d-sm-inline-block">
        <a href="course_history.php?usr=<?php echo $usr?>" class="nav-link" style="color: #ffff; font-size: 18px">Enroll History</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="profile.php?usr=<?php echo $usr?>" class="nav-link" style="color: #ffff; font-size: 18px">Profile

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

                 echo   "<button type='button' class='btn btn-warning col-md-12 text-white'>".$error."</button>";
                   
                   }
                if (isset($msg)) {
                  echo    "<button type='button' class='btn btn-info col-md-12'>".$msg."</button>";
                   
                }
               ?>
              
                <div class="modal-header">
                     <img src="../dist/img/bkash_rocket_nagad.png" style="width: 100%; border-radius: 5px">

                  
                     
                </div>
            <div class="row">
               <div class="paymentinstruction" style="padding: 25px; text-align: justify;">
                ❑ Go to your bkash/Rocket/Nagad Mobile Menu.
                ❑ Choose Payment.
                ❑ Enter The Merchant Bkash/Rocket/Nagad Number.
                ❑ Enter Amount your course amount <mark><?php echo $total ?> BDT</mark>.
                ❑ Enter your menu pin.
                ❑ Done! You will receive a confirmation message.
                ❑ Now Put the Transaction ID and Payment number in the flowwing Box and Press make payment.

              
            </div>

 <div class="modal-body">
                   
<div class="card card-primary">
            
<form role="form" action="" method="POST" enctype="multipart/form-data">
<div class="card-body">

 <div class="row">
  <div class="col-75">
    <div class="container">
      
        <div class="row">
          <div class="col-50">
          
            <label for="name"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo $name ?>" readonly>
            <label for="userID"><i class="fa fa-id-card" aria-hidden="true"></i>Student ID</label>
            <input type="text" id="stdID" name="stdID" value="<?php echo  $usr ?>" readonly>
            
          </div>

          <div class="col-50">

             <label for="cname"><i class="fa fa-exchange" aria-hidden="true"></i>Transaction ID</label>
            <input type="text" id="transactionid" name="transactionid" placeholder="EX: BDHFBG2X4">
            <label for="ccnum">Pyment Number</label>
            <input type="text" id="paymentnumber" name="paymentnumber" placeholder="EX: 018569XXXX">

            <?php 

             if (isset($_GET['course_code'])=='POST') {
              $course_code=$_GET['course_code']; }

            ?>

            <input type="" name="PayCourseID" value="<?php echo  $course_code ?>" hidden="">
         
            
          </div>
          
        </div>

        
           <div class="form-group">
                    <label for="exampleInputFile">Transaction Screenshot</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Transaction Screenshot</label>
                      </div>
                     
                    </div>
           </div>

           <div class="form-group">
             
             
            <p>Total Amount <span class="price" style="color:#ffff"><b><?php echo  $total?></b> BDT</span></p>
           </div>
          <input type="" name="PayAmount" value="<?php echo $total?>" hidden>

    </div>
  </div>

</div>

</div>
               

      <div class="card-footer">

         <div class="row">

           <div class="col-md-6"><button type="submit" class="btn btn-info">Make Payment</button>
           </div>
            <div class="col-md-6">
              
               <button class="btn btn-warning" style="float: right;"><a href="course_history.php?usr=<?php echo $usr?>"> Not Now</a></button>
            </div>

       
       
           

         </div>
     
       
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
