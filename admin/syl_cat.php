 
<?php
 require '../Database/db.php';
 require '../Database/Session.php';
 Session::init();
 Session::checkAdminSession();
 
 $db = new Database();

?>



 <?php


           $id=$_POST["id"];
           $query="SELECT * FROM syllabuses WHERE department_id='$id'";
           $semester =$db->select($query);
       
          ?>
         
          <?php
          while ($semesterdata = $semester->fetch_assoc()){ 
          ?>
            <option value="<?php echo $semesterdata["id"];?>"><?php echo $semesterdata["syllabus_version"];?></option>
          <?php
          }
 ?>

