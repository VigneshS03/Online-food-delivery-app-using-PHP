<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=cafe','fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST['email'])&&isset($_POST['pass']))
{
unset($_SESSION['email']);
unset($_SESSION['userid']);
$salt = 'XyZzy12*_';
$check = hash('md5', $salt.$_POST['pass']);
$stmt = $pdo->prepare('SELECT userid, firstName FROM users
    WHERE username = :em AND password = :pw');
$stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row !== false ) {
    $_SESSION['name'] = $row['firstName'];
    $_SESSION['userid'] = $row['userid'];
    header("Location: index.php");
    return;
}
else
{
$_SESSION['failure']="WrongCredentials";
header("Location:signin.php");
return;
}
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
    <link href="login.css" rel="stylesheet">
    
  </head>
  <body class="text-center">
<div class="container">
    <form method="POST" class="form-signin">
   <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
 <?php
if ( isset($_SESSION['failure']) ) {
    echo('<p class="mt-4 mb-4 text-danger">'.htmlentities($_SESSION['failure'])."</p>\n");
    unset($_SESSION['failure']);
}
if ( isset($_SESSION['success']) ) {
    echo('<p class="mt-4 mb-4 text-success">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
?>
  <label for="email" class="sr-only">Email address</label>
  <input type="email" id="email" name="email" class="form-control" placeholder="email" required autofocus>
  <label for="pass" class="sr-only">Password</label>
  <input type="password" id="pass" name="pass" class="form-control" placeholder="password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-success	 btn-block" type="submit">Sign in</button>
 <p class="mt-4 mb-4 text-dark">Don't have an account?<a class="text-primary" href="signup.php">Create an account</a></p>
  
</form>
</div>	
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
