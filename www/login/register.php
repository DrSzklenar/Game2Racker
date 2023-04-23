<?php

session_start();
require("../depend/connection.php");
if(isset($_POST['submit'])){
   $name = htmlspecialchars($_POST['name']);
   $email = htmlspecialchars($_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $select = "SELECT * FROM `users` WHERE email = ? OR nev = ?";
   $stmt = $conn->prepare($select);
   $stmt->bind_param('ss', $email,$name);
   $stmt->execute();
   $result = $stmt->get_result();
   $stmt->reset();
   if($result->num_rows > 0){
      
      $error[] = 'User already exist!';
      
   }else{
      
      if($pass != $cpass){
         $error[] = 'Password not matched!';
      }else{
         $insert = "INSERT INTO `users`(nev, email, jelszo) VALUES(?,?,?)";
         $stmt = $conn->prepare($insert);
         $stmt->bind_param('sss', $name,$email,$pass);
         $stmt->execute();
         $stmt->reset();   

         $getNewUsersId = "SELECT `users`.`id` FROM `users` WHERE nev = ? AND email = ?";
         $stmt = $conn->prepare($getNewUsersId);
         $stmt->bind_param('ss', $name,$email);
         $stmt->execute();
         $newUsersId = $stmt->get_result();
         $row = $newUsersId->fetch_assoc();
         $stmt->reset();
         
         // mysqli_query($conn,"INSERT INTO `lists`(`userID`, `nev`, `type`, `order`) VALUES ('{$row['id']}','favorite','favorite',5)");
         // mysqli_query($conn,"INSERT INTO `lists`(`userID`, `nev`, `type`, `order`) VALUES ('{$row['id']}','wishlist','wishlist',4)");
         // mysqli_query($conn,"INSERT INTO `lists`(`userID`, `nev`, `type`, `order`) VALUES ('{$row['id']}','completed','completed',3)");
         // mysqli_query($conn,"INSERT INTO `lists`(`userID`, `nev`, `type`, `order`) VALUES ('{$row['id']}','playing','playing'),2");
         $_SESSION['registered'] = "
         
         <script type=\"text/javascript\" defer>
         console.log(\"adadawda\");
         Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'You registered successfully',
            showConfirmButton: false,
            timer: 1000
          })
          </script>
         
         
         
         
         ";
         header("Location: login.php");
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

   
   <link rel="stylesheet" href="../css/login.css">
   

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
      <p id="account">Already have an account? <a href="login.php">Login now</a></p>
   </form>

</div>
<script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>