<?php
class Session{

	 public static function init(){
	 	
	 	if(version_compare(phpversion(),'5.4.0', '<')) {
	 		if (session_id()=='') {
	 			session_start();
	 		}
	 	}else{
	 		if (session_status()==PHP_SESSION_NONE) {
	 			session_start();
	 		}
	 	}
	 	
	 }
	 
	 public static function set($key, $val){
	 	$_SESSION[$key] = $val;
	 }

	 public static function get($key){
	 	if (isset($_SESSION[$key])) {
	 		return $_SESSION[$key];
	 	} else {
	 		return false;
	 	}
	 }
      public static function checkAdminSession(){
	 	self::init();
	 	if (self::get("adminlogin") == false) {
	 		self::destroy();
	 		header("Location:../index.php");
	 	}
	 }
	  public static function checkAdminLogin(){
	 	self::init();
	 	if (self::get("adminlogin") == true) {
	 		header("location:admin");
	 	}
	 }

	 public static function checkTeacherSession(){
	 	self::init();
	 	if (self::get("teacherlogin") == false) {
	 		self::destroy();
	 		header("Location:../index.php");
	 	}
	 }

	 public static function checkTeacherLogin(){
	 	    self::init();
	 	if (self::get("teacherlogin") == true) {
	 		header("Location:location:teacher/home.php");
	 	}
	 }

	  public static function checkStudentSession(){
	 	self::init();
	 	if (self::get("studentlogin") == false) {
	 		self::destroy();
	 		header("Location:../index.php");
	 	}
	 }

	 public static function checkStudentLogin(){
	 	    self::init();
	 	if (self::get("studentlogin") == true) {
	 		header("Location:student/home.php");
	 	}
	 }




	 public static function destroy(){
	 
	 	session_destroy();
	 	session_unset();
	 	header("location:../index.php");
	 }


}



?>