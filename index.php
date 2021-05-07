<?php

  session_start();
  $user;
  if(isset($_SESSION["success"])){
    if($_SESSION["as"] == "teacher"){
      $user == "teacher";
    }
    if($_SESSION["as"] == "student"){
      $user == "student";
    }
    if($_SESSION["as"] == "admin"){
      $user == "admin";
    }
  }else{
    header("location : login.php");
  }

?>