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
<link rel="stylesheet" href="cart.css">

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
<p class="text-xl-center" style="font-size: 50px;">Your Shopping Cart</p> 
<?php
$stmt3=$pdo->prepare("SELECT COUNT(F_ID) FROM cart WHERE userid=:usr");
$stmt3->execute(array(':usr'=>$_SESSION['userid']));

$row2=$stmt3->fetch(PDO::FETCH_ASSOC);
$count1=implode($row2);
if($count1>0)
{
?>
    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
<table class="table table-striped">
  <thead>
<tr>
<th width="40%">Food Name</th>
<th width="10%">Quantity</th>
<th width="20%">Price Details</th>
<th width="15%">Order Total</th>
<th width="5%">Action</th>
</tr>
</thead>
<?php
$total = 0;
$stmt=$pdo->prepare("SELECT * FROM cart WHERE userid=:usr");
$stmt->execute(array(':usr'=>$_SESSION['userid']));
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["quantity"] ?></td>
<td>&#8377; <?php echo $row["price"]; ?></td>
<td>&#8377; <?php echo number_format($row["quantity"] * $row["price"], 2); ?></td>
<td><a href="cart.php?action=delete&id=<?php echo $row["F_ID"]; ?>"><span class="text-danger">Remove</span></a></td>
</tr>
<?php 
$total = $total + ($row["quantity"] * $row["price"]);
}
?>
<tr>
<td colspan="3" align="right">Total</td>
<td align="right">&#8377; <?php echo number_format($total, 2); ?></td>
<td></td>
</tr>
</table>
<?php
  echo '<a href="cart.php?action=empty"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Empty Cart</button></a>&nbsp;<a href="index.php"><button class="btn btn-warning">Continue Shopping</button></a>&nbsp;<a href="order.php"><button class="btn btn-success pull-right"><span class="glyphicon glyphicon-share-alt"></span> Check Out</button></a>';
?>
</div>
<?php
}
else if($count1==0)
{
?>
<p>Oops! We can't smell any food here. Go back and <a href="index.php">order now.</a></p>
<?php
}
?>

<?php
if(isset($_GET["action"]))
{
if($_GET["action"] == "delete")
{
$sql="DELETE FROM cart WHERE F_ID=:fid";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(':fid'=>$_GET['id']));
echo '<script>alert("Item is removed")</script>';
echo '<script>window.location="cart.php"</script>';

}
}

if(isset($_GET["action"]))
{
if($_GET["action"] == "empty")
{
$sql="DELETE FROM cart WHERE userid=:usr";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(':usr'=>$_SESSION['userid']));
echo '<script>alert("Cart is made empty!")</script>';
echo '<script>window.location="cart.php"</script>';
}
}

?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
