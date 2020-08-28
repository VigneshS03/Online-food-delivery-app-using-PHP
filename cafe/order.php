<?php 
session_start();
if(!isset($_SESSION['name'])){
header("location:index.php"); 
}

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=cafe','fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!doctype html>
<html lang="en">
  <head>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Great Vibes' rel='stylesheet'>
<link rel="stylesheet" href="order.css">

</head>
<body>
<?php
if(!isset($_SESSION['name']))
{
echo '<nav class="navbar navbar-expand-sm navbar-dark bg-dark py-0" id="nav-main">';
echo '<h1 class="navbar-brand" id="title">Cafe</h1>';
echo '<div class="collapse navbar-collapse" id="navbarcontent">';
    echo '<ul class="navbar-nav mr-auto">';
      echo '<li class="nav-item active">';
        echo '<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>';
      echo '</li>';
      echo '<li class="nav-item active">';
        echo '<a class="nav-link" href="signin.php">Signin</a>';
      echo '</li>';
      echo '<li class="nav-item active">';
        echo '<a class="nav-link" href="signup.php">Signup</a>';
      echo '</li>';
 echo '</ul>';
echo '</div>';
echo '</nav>';
}
else 
{
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark py-0" id="nav-main">
<h1 class="navbar-brand" id="title">Cafe</h1>
<div class="collapse navbar-collapse" id="navbarcontent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="cart.php">MyCart
      (<?php
        $stmt3=$pdo->prepare("SELECT COUNT(F_ID) FROM cart WHERE userid=:usr");
        $stmt3->execute(array(':usr'=>$_SESSION['userid']));
        $row2=$stmt3->fetch(PDO::FETCH_ASSOC);
        $count=implode($row2);
              if($count>0){
               echo $count; 
            }
              else
                echo "0";
              ?>)
       </a>
      </li>
     <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <?php
          echo 'Welcome '.$_SESSION['name'];
         ?> 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">logout</a>
        </div>
     </li>
 </ul>
</div>
</nav>
<?php
}
?>
<p class="text-xl-center" style="font-size: 50px;">Make Payment</p> 

<?php

$stmt=$pdo->prepare("SELECT * FROM cart WHERE userid=:usr");
$stmt->execute(array(':usr'=>$_SESSION['userid']));
$gtotal=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
$fid=$row["F_ID"];
$name=$row["name"];
$quantity=$row["quantity"];
$price=$row["price"];
$total=$row["quantity"] * $row["price"];
$order_date = date('Y-m-d');
$gtotal = $gtotal + $total;
if(isset($_GET["action"]))
{
if($_GET["action"] == "cod")
{
$query = "INSERT INTO orders(F_ID,foodname,price,quantity,order_date,username,userid) 
              VALUES(:fID,:foodname,:prize,:qn,:date,:usrname,:usr)";
$stmt2=$pdo->prepare($query);
$stmt2->execute(array(
        ':fID' => htmlentities($fid),
        ':foodname' => htmlentities($name),
        ':prize' => htmlentities($price),
        ':qn' => htmlentities($quantity),
        ':date' => htmlentities($order_date),
        ':usrname' => htmlentities($_SESSION['name']),
        ':usr' => htmlentities($_SESSION['userid'])));

echo '<script>window.location="cod.php?action=clear"</script>';
}
else if($_GET["action"] == "online")
{
$query = "INSERT INTO orders(F_ID,foodname,price,quantity,order_date,username,userid) 
              VALUES(:fID,:foodname,:prize,:qn,:date,:usrname,:usr)";
$stmt2=$pdo->prepare($query);
$stmt2->execute(array(
        ':fID' => htmlentities($fid),
        ':foodname' => htmlentities($name),
        ':prize' => htmlentities($price),
        ':qn' => htmlentities($quantity),
        ':date' => htmlentities($order_date),
        ':usrname' => htmlentities($_SESSION['name']),
        ':usr' => htmlentities($_SESSION['userid'])));

echo '<script>window.location="onlinepayment.php"</script>';
}
}
}
?>
<h1 class="text-center">Grand Total: &#8377;<?php echo "$gtotal"; ?>/-</h1>
<div class="text-center" style="padding-top: 3rem;">
<a href="cart.php"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Back to Cart</button></a>&nbsp;<a href="order.php?action=cod"><button class="btn btn-warning">Cash on Delivery</button></a>&nbsp;<a href="order.php?action=online"><button class="btn btn-success pull-right"><span class="glyphicon glyphicon-share-alt"></span> Online Payment</button></a>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

