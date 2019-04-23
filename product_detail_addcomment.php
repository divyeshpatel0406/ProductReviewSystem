<?php
$ctext = $_POST['ctext'];
$rating = $_POST['rating'];
$uname = $_POST['uname'];
$ctime = $_POST['ctime'];
$clike = $_POST['clike'];
$mID = $_POST['mID'];
?>
<html>
<body>
  <?php
  $con = mysqli_connect("localhost","root","root");
  if (!$con)
    {
    die('Could not connect: ' . mysqli_error());
    }
   $round=0;
   $total=0;
  mysqli_select_db( $con,"productrate");
  $u = mysqli_query($con,"SELECT * FROM `users` WHERE `uname`='$uname'");
  $row1 = mysqli_fetch_array($u);
  $uID = $row1['uID'];
  echo $mID;
  echo $ctext;
  echo $ctime;
  echo $rating;

  $query = mysqli_query($con,"INSERT INTO `comment` (`uID`  ,`productID`,`content` ,`time`,`numlikes`,`ratings`)
  VALUES ('$uID', '$mID', '$ctext', '$ctime','$clike','$rating')");
  if($query){$comments = mysqli_query($con,"SELECT * FROM `comment` WHERE `productID` ='$mID'");
  while($row2 = mysqli_fetch_array($comments)){
    $total+=$row2['ratings'];
    $round +=1;
  }
  echo $total;

  $new=$total*2/$round;
  $mcate = mysqli_query($con,"UPDATE `products` SET `mrates` = '$new' where `productID`='$mID'");
}
  
  //echo $new;
  
 // echo "<script language='javascript'>"; 
 // echo " location='product_detail.html?id=$mID';"; 
  //echo "</script>"; 
  ?>
</body>
</html>