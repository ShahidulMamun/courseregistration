 
<?php
 require '../Database/db.php';
 require '../Database/Session.php';
 Session::init();
 Session::checkAdminSession();
 
 $db = new Database();

?>
<?php


           $category_id=$_POST["category_id"];
           $query="SELECT * FROM programs WHERE department_id='$category_id'";
           $program =$db->select($query);
           
          ?>
        
          <?php
          while ($programdata = $program->fetch_assoc()){ 
          ?>
            <option value="<?php echo $programdata["program_Id"];?>"><?php echo $programdata["program_code"];?></option>
          <?php
          }
 ?>


 
 



