<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=cafe','fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['signin'])) {
    header("Location:signin.php");
return;
}
if (isset($_POST['add'])) {
    $sql="INSERT INTO cart (userid,F_ID,name,quantity,price) VALUES (:usr,:fid,:name,:qn,:price)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array(
        ':usr' => htmlentities($_SESSION['userid']),
        ':fid' => htmlentities($_POST['hidden_FID']),
        ':name' => htmlentities($_POST['hidden_name']),
        ':qn' => htmlentities($_POST['quantity']),
        ':price' => htmlentities($_POST['hidden_price']))); 
      header("Location:index.php");

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Great Vibes' rel='stylesheet'>

<link rel="stylesheet" href="home.css">
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
<main role="main">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
<div class="carousel-inner">
  <div class="carousel-item active">
                <img src="carousel4.jpg"  class="d-block w-100" alt="...">
                 <div class="container">
          
        </div>
        </div>
  
  <div class="carousel-item">
                <img src="carousel6.jpg" class="d-block w-100" alt="...">
                 <div class="container">
          
        </div>
        </div>
  <div class="carousel-item">
                <img src="carousel8.jpg" class="d-block w-100" alt="...">
                 <div class="container">
          
        </div>
        </div>

</div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
</main>
<div id="name">
<p class="text-xl-center">Welcome to Cafe</p> 
</div>

<div class="alert alert-success" role="alert">
<h5>Beverages</h5>
</div>
<div class="container" style="width:95%;">
<?php
$stmt=$pdo->query("SELECT * FROM beverages");
$stmt2=$pdo->query("SELECT COUNT(F_ID) FROM beverages");
$row1=$stmt2->fetch(PDO::FETCH_ASSOC);
$count=implode($row1);
if($count>0)
{
$n=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
if($n==0)
echo "<div class='row'>";
?>
<div class="col-md-3" style="padding-top:2rem; padding-bottom:2rem;">

<form method="post">
<div class="mypanel" align="center";>
<img src="<?php echo $row["images_path"]; ?>" class="img-responsive" style="height:10rem;width:14rem;">
<h4 class="text-dark"><?php echo $row["name"]; ?></h4>
<h5 class="text-info"><?php echo $row["description"]; ?></h5>
<h5 class="text-danger">&#8377; <?php echo $row["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_FID" value="<?php echo $row["F_ID"]; ?>">
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">

<?php
if(isset($_SESSION['name'])){
?>
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
<?php
}
else
{
?>
<input type="submit" name="signin" style="margin-top:5px;" class="btn btn-success" value="Signin">
<?php
}
?>
</div>
</form>
</div>
<?php
$n++;
if($n==4)
{
  echo "</div>";
  $n=0;
}
}
}
?>
</div>
</div>
<div class="alert alert-success" role="alert">
<h5>Milkshakes</h5>
</div>
<div class="container" style="width:95%;">
<?php
$stmt=$pdo->query("SELECT * FROM milkshakes");
$stmt2=$pdo->query("SELECT COUNT(F_ID) FROM milkshakes");
$row1=$stmt2->fetch(PDO::FETCH_ASSOC);
$count=implode($row1);
if($count>0)
{
$n=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
if($n==0)
echo "<div class='row'>";
?>
<div class="col-md-3" style="padding-top:2rem; padding-bottom:2rem;">

<form method="post">
<div class="mypanel" align="center";>
<img src="<?php echo $row["images_path"]; ?>" class="img-responsive" style="height:10rem;width:14rem;">
<h4 class="text-dark"><?php echo $row["name"]; ?></h4>
<h5 class="text-info"><?php echo $row["description"]; ?></h5>
<h5 class="text-danger">&#8377; <?php echo $row["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_FID" value="<?php echo $row["F_ID"]; ?>">
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">

<?php
if(isset($_SESSION['name'])){
?>
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
<?php
}
else
{
?>
<input type="submit" name="signin" style="margin-top:5px;" class="btn btn-success" value="Signin">
<?php
}
?>
</div>
</form>
</div>
<?php
$n++;
if($n==4)
{
  echo "</div>";
  $n=0;
}
}
}
?>
</div>
</div>
<div class="alert alert-success" role="alert">
<h5>Sandwiches</h5>
</div>
<div class="container" style="width:95%;">
<?php
$stmt=$pdo->query("SELECT * FROM sandwich");
$stmt2=$pdo->query("SELECT COUNT(F_ID) FROM sandwich");
$row1=$stmt2->fetch(PDO::FETCH_ASSOC);
$count=implode($row1);
if($count>0)
{
$n=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
if($n==0)
echo "<div class='row'>";
?>
<div class="col-md-3" style="padding-top:2rem; padding-bottom:2rem;">

<form method="post">
<div class="mypanel" align="center";>
<img src="<?php echo $row["images_path"]; ?>" class="img-responsive" style="height:10rem;width:14rem;">
<h4 class="text-dark"><?php echo $row["name"]; ?></h4>
<h5 class="text-info"><?php echo $row["description"]; ?></h5>
<h5 class="text-danger">&#8377; <?php echo $row["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_FID" value="<?php echo $row["F_ID"]; ?>">
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">

<?php
if(isset($_SESSION['name'])){
?>
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
<?php
}
else
{
?>
<input type="submit" name="signin" style="margin-top:5px;" class="btn btn-success" value="Signin">
<?php
}
?>
</div>
</form>
</div>
<?php
$n++;
if($n==4)
{
  echo "</div>";
  $n=0;
}
}
}
?>
</div>
</div>

<div class="alert alert-success" role="alert">
<h5>Rolls & Shawarma</h5>
</div>
<div class="container" style="width:95%;">
<?php
$stmt=$pdo->query("SELECT * FROM rolls");
$stmt2=$pdo->query("SELECT COUNT(F_ID) FROM rolls");
$row1=$stmt2->fetch(PDO::FETCH_ASSOC);
$count=implode($row1);
if($count>0)
{
$n=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
if($n==0)
echo "<div class='row'>";
?>
<div class="col-md-3" style="padding-top:2rem; padding-bottom:2rem;">

<form method="post">
<div class="mypanel" align="center";>
<img src="<?php echo $row["images_path"]; ?>" class="img-responsive" style="height:10rem;width:14rem;">
<h4 class="text-dark"><?php echo $row["name"]; ?></h4>
<h5 class="text-info"><?php echo $row["description"]; ?></h5>
<h5 class="text-danger">&#8377; <?php echo $row["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_FID" value="<?php echo $row["F_ID"]; ?>">
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">

<?php
if(isset($_SESSION['name'])){
?>
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
<?php
}
else
{
?>
<input type="submit" name="signin" style="margin-top:5px;" class="btn btn-success" value="Signin">
<?php
}
?>
</div>
</form>
</div>
<?php
$n++;
if($n==4)
{
  echo "</div>";
  $n=0;
}
}
}
?>
</div>
</div>


<div class="alert alert-success" role="alert">
<h5>Pizza</h5>
</div>
<div class="container" style="width:95%;">
<?php
$stmt=$pdo->query("SELECT * FROM pizza");
$stmt2=$pdo->query("SELECT COUNT(F_ID) FROM pizza");
$row1=$stmt2->fetch(PDO::FETCH_ASSOC);
$count=implode($row1);
if($count>0)
{
$n=0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
if($n==0)
echo "<div class='row'>";
?>
<div class="col-md-3" style="padding-top:2rem; padding-bottom:2rem;">

<form method="post">
<div class="mypanel" align="center";>
<img src="<?php echo $row["images_path"]; ?>" class="img-responsive" style="height:10rem;width:14rem;">
<h4 class="text-dark"><?php echo $row["name"]; ?></h4>
<h5 class="text-info"><?php echo $row["description"]; ?></h5>
<h5 class="text-danger">&#8377; <?php echo $row["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_FID" value="<?php echo $row["F_ID"]; ?>">
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">

<?php
if(isset($_SESSION['name'])){
?>
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
<?php
}
else
{
?>
<input type="submit" name="signin" style="margin-top:5px;" class="btn btn-success" value="Signin">
<?php
}
?>
</div>
</form>
</div>
<?php
$n++;
if($n==4)
{
  echo "</div>";
  $n=0;
}
}
}
?>
</div>
</div>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
