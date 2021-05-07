<?php
  session_start();
  
  $errors = array();
  
  $dblocation = "localhost:";
  $dbuser = "root";
  $dbpassword = "";
  $dbname = "user";
  
  $db = mysqli_connect($dblocation,$dbuser,$dbpassword,$dbname) or die("could not connect to db");
  
  $username = mysqli_real_escape_string($db,$_POST["username"]);
  $email = mysqli_real_escape_string($db,$_POST["email"]);
  $password1 = mysqli_real_escape_string($db,$_POST["password_1"]);
  $password2 = mysqli_real_escape_string($db,$_POST["password_2"]);
  $as = mysqli_real_escape_string($db,$_POST[""]);
  
  //validation:
  //......
  if(password_1 != password_2){array_push($errors,"password does not match");}
  
  //check db
  
  $cquery = 
  "
  SELECT * FROM user WHERE username = '$username' or email = '$email' LIMIT 1
  ";
  
  $result = mysqli_query($db,$cquery);
  
  $userc = mysqli_fetch_assoc($result);
  
  if($userc){
    array_push($errors,"user alredy exists");
  }
  
  //regester
  
  if(count($errors) == 0){
    $password=md5($password1);
    $query =
    "
    INSERT INTO user {username,email,password) VALUES {'$username','$email','$password'} 
    ";
    mysqli_query($db,$query);
    
    $_SESSION["username"] = $username;
    $_SESSION["as"] = $as;
    $_SESSION["success"] = "you have success fully registered as" + $as;
    
    header("location : index.php");
    
  }else{
    $_SESSION["errors"] = $errors;
    header("location : error.php");
  }
  
?>