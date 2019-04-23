<?php 
$cID=$_GET["cID"];
?>
<html>
<body>
<?php
echo $cID;
$con = mysqli_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

mysqli_select_db( $con,"productrate");


$com = mysqli_query($con,"SELECT * FROM `comment` WHERE `comID` ='$cID'");
$row = mysqli_fetch_array($com);
$mID = $row['productID'];
$query = mysqli_query($con,"DELETE FROM `comment` WHERE `comID` = $cID");
$comments = mysqli_query($con,"SELECT * FROM `comment` WHERE `productID` ='$mID'");
    while($row4 = mysqli_fetch_array($comments)){
    $total+=$row4['ratings'];
    $round +=1;
    }
    //echo $total;

  $new=$total*2/$round;
  $mcate = mysqli_query($con,"UPDATE `products` SET `mrates` = '$new' where `productID`='$mID'");


mysqli_close($con);
?>
</body>
</html>