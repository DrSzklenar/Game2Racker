<?php

require("../dependencies/connection.php");

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   

   $select = " SELECT * FROM user WHERE email = '$email' && jelszo = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'User already exist!';

   }else{
      
      if($pass != $cpass){
         $error[] = 'Password not matched!';
      }else{
         $insert = "INSERT INTO user(nev, email, jelszo) VALUES('$name','$email','$pass')";
      
         mysqli_query($conn, $insert);
         header("Location: login/login.php");
         exit();
      }
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Game2Racker</title>

   
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your name">
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <input type="submit" name="submit" value="Register now" class="form-btn">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>

</div>

</body>
</html>