<?php

require("../depend/connection.php");


$error = [];
session_start();


if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   
   

   $select = "SELECT `users`.`id` FROM `users` WHERE email = ? && jelszo = ?";
   $stmt = $conn->prepare($select);
   $stmt->bind_param('ss', $email,$pass);
   $stmt->execute();
   $result = $stmt->get_result();
   $row = $result->fetch_assoc();
   $stmt->reset();

   if($result->num_rows == 1){
      $bytes = random_bytes(20);
      $token = bin2hex($bytes);
      $newId =  $row['id'];
      $stmt = $conn->prepare("INSERT INTO `sessions`(`userID`, `active`, `token`, `expires`) VALUES (?,true,?,DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 3 DAY));");

      $stmt->bind_param('ss', $row['id'],$token);
      $stmt->execute();
      $stmt->reset();
      
      setcookie("session", $token, time() + (60*60*24*3), "/");
      // if (mysqli_num_rows(mysqli_query($conn,"SELECT `lists`.`id`,`lists`.`type` FROM `lists` WHERE `userID` = {$row['id']} AND type = 'favorite'")) < 1) {
      //    mysqli_query($conn,"INSERT INTO `lists`(`userID`, `nev`, `type`, `order`) VALUES ('{$row['id']}','favorite','favorite',5)");
      //    mysqli_query($conn,"INSERT INTO `lists`(`userID`, `nev`, `type`, `order`) VALUES ('{$row['id']}','wishlist','wishlist',4)");
      //    mysqli_query($conn,"INSERT INTO `lists`(`userID`, `nev`, `type`, `order`) VALUES ('{$row['id']}','completed','completed',3)");
      //    mysqli_query($conn,"INSERT INTO `lists`(`userID`, `nev`, `type`, `order`) VALUES ('{$row['id']}','playing','playing'),2");
      // }



      // $_SESSION['email'] = $row['email'];
      // $_SESSION['jelszo'] = $row['jelszo'];
      
     header("Location: ". $_SESSION['current_page']);

   }
   else
   {
      array_push($error,"incorrect password or email");
   }

};
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <title>Game2Racker</title>

   
   <link rel="stylesheet" href="../css/login.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login now" class="form-btn">
      <p id="account">Don't have an account? <a href="register.php">Register now</a></p>
   </form>

</div>
<script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo $_SESSION['registered']; 

unset($_SESSION["registered"])
?>

</body>
</html>