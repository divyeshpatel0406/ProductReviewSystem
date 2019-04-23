
<?php 
$mname=$_POST["productname"];
?>

 

<html>
<body>
<?php
$con = mysqli_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

mysqli_select_db( $con,"productrate");

$result = mysqli_query($con,"SELECT * FROM `products` WHERE `productName` = '$mname'");

while($row = mysqli_fetch_array($result))
 {
  $mid=$row['productID'];
 }



mysqli_close($con);


  echo "<script language='javascript'>"; 
  echo " location='product_detail.html?id=$mid';"; 
  echo "</script>"; 
  ?>
</body>
</html>