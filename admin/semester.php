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

             $program_code   = $_POST['program_code'];
             $department_id  = $_POST['department_id'];
             $semester_name  = $_POST['semester_name'];
             $semester_year  = $_POST['semester_year'];
             $start_date     = $_POST['start_date'];
             $end_date       = $_POST['end_date'];
             $regi_deadline  = $_POST['regi_deadline'];
             $syl_id         = $_POST['syl_id'];
       


           if($program_code=="" || $department_id=="" ||  $semester_name=="" || $semester_year=="" || $start_date=="" || $end_date=="" ) {

              $error= "<span style=color:#ffff;>"." Sorry! One or More Field are Missing!.</span>";
            
            }else{  
                   $checkquery  ="SELECT * FROM semesters WHERE semester_name= '$semester_name' AND program_id ='$program_id' AND semester_year='$semester_year'";
                   $checkresult = $db->select($checkquery);
                   if ($checkresult!=false){
                     $error="This Semester already Recorded!";
                 
                   }else{
               
                  $query ="INSERT INTO semesters(semester_name,dept_id,program_id,semester_year,syl_id,start_date,end_date,regi_deadline) VALUES('$semester_name','$department_id','$program_code','$semester_year','$syl_id','$start_date','$end_date','$regi_deadline')";
                  $insert_userdata = $db->insert($query);


                 

                 $msg ="Semester Added!";
                
                        
                         
                   }

            
          }
          }
      
?>
<?php 

    if(isset($_GET['active_semester'])){

    $active_semester = (int)$_GET['active_semester'];
    $ActiveSem = $db->ActiveSemester($active_semester);

}
?>
 
                        
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>State Universirty || Course Registration Panel</title>

<!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  

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

  <!-- Fetch programe code by department -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

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

    <!-- SEARCH FORM -->
   

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
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">
                
                 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" style="margin-top: 45px">
                  Semester Add
                </button>
              </a>
            </li>
            
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            
              <?php
             if (isset($error)) {  

                 echo   "<button type='button' class='btn btn-warning col-md-12'>".$error."</button>";
                   
                   }
                if (isset($msg)) {
                  echo    "<button type='button' class='btn btn-info col-md-12'>".$msg."</button>";
                   
                }
               ?>
           
          <div class="modal fade" id="modal-info">
            <div class="modal-dialog">
            
              <div class="modal-content bg-info">
                <div class="modal-header">
                  <h4 class="modal-title">Semester Information</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                   
                   <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">

              <div class="form-group">
                  <label style="color: #93979C;">Department</label>
                  <select class="form-control" id="category" name="department_id">
               
                    <?php
                      $query="SELECT * FROM departments";
                      $deptdata =$db->select($query);
                      while ($result = $deptdata->fetch_assoc()) {
                  ?>
                    <option value="<?php echo $result["id"];?>"><?php echo $result["dept_name"];?></option>
                  <?php
                  }
                  ?>
                  
                  </select>
             </div>


                <div class="form-group">
                  <label style="color: #93979C;">Program</label>
                  <select class="form-control" id="sub_category" name="program_code">
                  
                  </select>
                </div>
                 
                 <div class="form-group">
                    <label style="color: #93979C;">Syllabuse</label>
                  <select class="form-control" id="syl_id" name="syl_id">
                  
                  </select>
                </div>

                  
                   <div class="form-group">
                      <label style="color: #93979C;">Semester</label>
                    
                     <select name="semester_name" class="form-control">
                      <option value="Fall">Fall</option>
                      <option value="Spring">Spring</option>
                      <option value="Summer">Summer</option>
                     </select>
                  </div>

                  

                    <div class="form-group">
                         <label style="color: #93979C;">Year</label>
                    <select name="semester_year" class="form-control">
                            
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2019</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                            <option value="2033">2033</option>
                            <option value="2034">2034</option>
                            <option value="2035">2035</option>
                            <option value="2036">2036</option>
                            <option value="2037">2037</option>
                            <option value="2038">2038</option>
                            <option value="2039">2039</option>
                            <option value="2040">2040</option>
                    </select>
                  </div>
                   <div class="row">
                     <div class="col-sm-6">
                           <div class="form-group">
                    <label for="name"  style="color:#93979C">Semester start</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Semester">
                  </div>
                     </div>

                     <div class="col-sm-6">
                          <div class="form-group">
                    <label for="name"  style="color:#93979C" >Semester end</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Semester">
                  </div>
                     </div>
                   </div>

                  
                  <div class="form-group">

                    <label for="name" style="color:#93979C">Registration deadline</label>
                    <input type="date" class="form-control" id="regi_deadline" name="regi_deadline" data-placeholder="Semester">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </form>
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
        
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">Semester List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <?php
               
                      
                $query="SELECT * FROM semesters";
                $semester =$db->select($query);

                if ($semester) {
              

              ?>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Semester</th>
                    <th>Year</th>
                    <th>Department</th>
                    <th>Program</th>
                     <th>Syllabus</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Action</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php   

              while ($semesterdata = $semester->fetch_assoc()) 
                           
             { ?>
             
                <tr>
                    <td><?php echo $semesterdata['id']?></td>
                    <td><?php echo $semesterdata['semester_name']?></td>
                    <td><?php echo $semesterdata['semester_year']?></td>
                       
                  <td>
          
                  <?php 
                   $department_id =$semesterdata['dept_id'];
                   $query="SELECT * FROM departments WHERE id='$department_id'";
                   $deptdata =$db->select($query);

                   while ($result = $deptdata->fetch_assoc()) { 
                   echo $result['dept_name']; }
                    ?>
                   </td>

                     <td>

                    <?php

                      $program_Id = $semesterdata['program_id'];
                      $query="SELECT * FROM programs WHERE program_Id='$program_Id'";
                      $deptdata =$db->select($query);

                      while ($result = $deptdata->fetch_assoc()) { 
                      echo $result['program_code']; }
                    ?>

                  </td>
                     <td>

                    <?php

                      $syllabus_Id = $semesterdata['syl_id'];
                      $query="SELECT * FROM syllabuses WHERE id='$syllabus_Id'";
                      $deptdata =$db->select($query);

                      while ($result = $deptdata->fetch_assoc()) { 
                      echo $result['syllabus_version']; 
                    
                    }
                    ?>

                  </td>
                    <td><?php echo $semesterdata['start_date']?></td>
                    <td><?php echo $semesterdata['end_date']?></td>
                  
               
                   
                

                <td style="text-align: center;"> 
                  <a href="course_offer.php?sem_id=<?php echo $semesterdata['id']?>"><button type="button" class="btn btn-info">
                 Offer Course
                   </button>
                </a>

              </td>

                <td><?php 
                if ($semesterdata['status']=='0'){ ?>
               
                    <a href="?active_semester=<?php echo $semesterdata['id']?>"><button type="button" class="btn btn-warning">Deactivated
                   </button>
                   </a>
                <?php }elseif($semesterdata['status']=='1') {
                  ?>
                   <button type="button" class="btn btn-info">
                     Activated
                   </button>
                <?php }
              
              ?></td>
                   
                </tr>
                <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Semester</th>
                    <th>Year</th>
                    <th>Department</th>
                    <th>Program</th>
                     <th>Syllabus</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Action</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>
                </table>
                 <?php } else{ ?>
                    <button type="button" class="btn btn-info"> </i> &nbsp; Sorry! Semester Not Found!

               <?php  } ?>
 
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
<script>
$(document).ready(function() {
  $('#category').on('change', function() {
      var category_id = this.value;
      $.ajax({
        url: "pro_cat.php",
        type: "POST",
        data: {
          category_id: category_id
        },
        cache: false,
        success: function(dataResult){
          $("#sub_category").html(dataResult);
        }
      });
    
    
  });
});
</script>
<script>
$(document).ready(function() {
  $('#category').on('change', function() {
      var id = this.value;
      $.ajax({
        url: "syl_cat.php",
        type: "POST",
        data: {
          id: id
        },
        cache: false,
        success: function(dataResult){
          $("#syl_id").html(dataResult);
        }
      });
    
    
  });
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

<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>

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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

   
    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
</body>
</html>
