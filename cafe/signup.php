<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=cafe','fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])&&isset($_POST['phone'])&&isset($_POST['pass'])&&isset($_POST['address']))
{
$salt = 'XyZzy12*_';
$check = hash('md5', $salt.$_POST['pass']);
$sql="INSERT INTO users(firstName,lastName,username,phone,password,address) values(:fname,:lname,:username,:phone,:pass,:address)";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(
        ':fname' => htmlentities($_POST['fname']),
        ':lname' => htmlentities($_POST['lname']),
        ':username' => htmlentities($_POST['email']),
        ':phone' => htmlentities($_POST['phone']),
        ':pass' => htmlentities($check),
        ':address' => htmlentities($_POST['address'])));
        $_SESSION["success"]="Account created";
        header("location:signin.php");
        return;
}

?>
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="signupp.css" rel="stylesheet">
    
  </head>
  <body class="text-center">
<div class="container">
    <form method="POST" class="form-signin">
  
  <h1 class="h3 mb-3 font-weight-normal">Create an account</h1>
  <label for="fname" class="sr-only">First Name</label>
  <input type="text" id="fname" name="fname" class="form-control form-control-lg" placeholder="firstname" required>
  <label for="lname" class="sr-only">Last Name</label>
  <input type="text" id="lname" name="lname" class="form-control" placeholder="lastname" required>
  <label for="email" class="sr-only">Email address</label>
  <input type="email" id="email" name="email" class="form-control" placeholder="email" required>
  <label for="phone" class="sr-only">Phone number</label>
  <input type="tel" id="phone" name="phone" class="form-control" placeholder="phonenumber" required> 
  <label for="pass" class="sr-only">Password</label>
  <input type="password" id="pass" name="pass" class="form-control" placeholder="password" required>
  <label for="address" class="sr-only">Address</label>
  <input type="text" id="address" name="address" class="form-control" placeholder="address" required>
  <div class="checkbox mb-3">
  <button class="btn btn-lg btn-success	btn-block" type="submit">Sign Up</button>
 <p class="mt-4 mb-4 text-dark">Already an user!<a class="text-primary" href="signin.php">Signin</a></p>
  
</form>
</div>	
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
