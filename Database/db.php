<?php
require 'config.php';

 class Database{

 	public $host     = mysql_host;
 	public $user     = mysql_user;
 	public $password = mysql_pass;
 	public $dbname   = mysql_db;

 	public $link;
 	public $error;

 	Public function __construct(){
        $this->ConnectDB();

 	}
 	public function ConnectDB(){
 		$this->link = new mysqli($this->host, $this->user, $this->password, $this->dbname);
 		if (!$this->link) {
 		  echo "Connection Fail".$this->link->connect_error;
 			return false;
 		}else{       
    
 		}
 		

 	}
     
  public function insert($query){
    $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
    if ($insert_row){  
        return false;
    }

  }

  public function select($query){
    $select_row = $this->link->query($query)  or die($this->link->error.__LINE__);
    if ($select_row->num_rows>0) {
        return $select_row;
    }
     else{

      return false;
    }
  }

  public function getuserData($query){
    $select_userdata = $this->link->query($query)  or die($this->link->error.__LINE__);
    if ( $select_userdata->num_rows>0) {

        return  $select_userdata;
    }
    else{

      return false;
    }
  } 
  
  //Delete user
   public function delete($query){
  $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
  if($delete_row){
    return $delete_row;
  } else {
    return false;
  }
  }
  

  public function DeletePendingCourse($delcourse){

        $query = "DELETE FROM courseenrolls WHERE id =$delcourse";
        $deletedata = $this->delete($query);

        if($deletedata){

           $msg ="<span class='success'>Success! Course Deleted! </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'> Something Went Wrong! </span>";
           return $msg;
        }
      }

      public function ApprovePendingCourse($appcourse){

        $query = "UPDATE courseenrolls
        SET
        status ='2'
        WHERE id ='$appcourse' ";
        $updated_row = $this->update($query);
        if($updated_row){

           $msg ="<span class='success'>Success! Course Appoved! </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'>Something went Wrong!</span>";
           return $msg;
        }
       

      }

   public function CompletedApprovedCourse($comcourse){

        $query = "UPDATE courseenrolls
        SET
        status ='3'
        WHERE id ='$comcourse' ";
        $updated_row = $this->update($query);
        if($updated_row){

           $msg ="<span class='success'>Success! Updated Data! </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'>Something went Wrong!</span>";
           return $msg;
        }
       

      }

     public function ActiveSemester($active_sem){

        $query = "UPDATE semesters
        SET
        status ='1'
        WHERE id ='$active_sem' ";
        $updated_row = $this->update($query);
        if($updated_row){

           $msg ="<span class='success'>Success! Semester Acivated! </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'>Something went Wrong!</span>";
           return $msg;
        }
       

      }
      public function ActiveUser($actecher){

        $query = "UPDATE users
        SET
        status ='1'
        WHERE id ='$actecher' ";
        $updated_row = $this->update($query);
        if($updated_row){

           $msg ="<span class='success'>Success! Updated Data! </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'>Something went Wrong!</span>";
           return $msg;
        }
       

      }


       public function DeactiveUser($detecher){

        $query = "UPDATE users
        SET
        status ='2'
        WHERE id ='$detecher' ";
        $updated_row = $this->update($query);
        if($updated_row){

           $msg ="<span class='success'>Success! Updated Data! </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'>Something went Wrong!</span>";
           return $msg;
        }
       

      }


  

      public function DeleteDepartment($userid){

        $query = "DELETE FROM department WHERE id =$userid";
        $deletedata = $this->delete($query);

        if($deletedata){

           $msg ="<span class='success'>Course Delete successfully </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'>Course Not Deleted </span>";
           return $msg;
        }
      }

// disable user 
    public function update($query){
  $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
  if($update_row){
    return $update_row;
  } else {
    return false;
  }
  }    

       public function updateUserData($uid,$userdata){
  
           $name = $userdata['name'];
           $email = $userdata['email'];

        $query = "UPDATE users
        SET
        username ='$name'
        email    ='$email'
        WHERE id ='$uid'";
        $updated_row = $this->update($query);
        if($updated_row){

           $msg ="<span class='success'>Update successfully </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'> Not Updated </span>";
           return $msg;
        }
       

      } 
        public function DisableUser($userid){

        $query = "UPDATE users
        SET
        status ='2'
        WHERE id ='$userid' ";
        $updated_row = $this->update($query);
        if($updated_row){

           $msg ="<span class='success'>User disabled </span>";
           return $msg;
           
        }else{

           $msg ="<span class='error'>User Not disabled </span>";
           return $msg;
        }
       

      }
    


      public function UpdateProfile($myID, $userdata){

         $name =  $userdata['name'];
         $email = $userdata['email'];
         $phone = $userdata['phone'];
       


        $query   = "UPDATE users

        SET
        name ='$name',
        email    ='$email',
        phone    ='$phone'
        WHERE userID ='$myID'";
        $updated_row = $this->update($query);
        if($updated_row){

           $msg ="<strong>Success!</strong> Data Updated!";

           $usr = base64_encode($myID);
           header("Location: profile.php?msg=$msg&&usr=$usr");
           
        }else{

             $msg ="<strong>Sorry!</strong> Data Updated!";
           return $msg;
        }
       

      }

       public function UpdatePass($email,$updatpass){

        $CPassword  = md5($updatpass['CPassword']); 
        $NPassword  = md5($updatpass['NPassword']);
        $CNPassword = md5($updatpass['CNPassword']);

        if ($NPassword==$CNPassword) {
        if ($CPassword=="") {
          $error= "<span style=color:red;>"."Old Password Not Empty</span>";
                
            
        }else{  

        $checkquery  ="SELECT * FROM users WHERE password='$CPassword' AND email='$email'";
        $checkresult = $this->select($checkquery);

        if ($checkresult!=false){

        $query   = "UPDATE users

        SET
        password ='$NPassword'
        WHERE email ='$email'";
        
        $updated_row = $this->update($query);
        if($updated_row){
 
            $msg ="<strong>Success!</strong> Password Updated successfully! Login by new Password!";

            session_destroy();
            
            header("Location: ../index.php?msg=$msg");

            }

       }else{
               
         $msg ="<strong>Sorry!</strong> Old Password Not Match!";

       return $msg;
                         
            }
         
      }
  }else{

     $msg ="<strong>Sorry!</strong> Confirm Password Not Match!";

       return $msg;

  }
 }





 	
 }

?>