<?php
//get data passed to script
$cID= $_GET["cID"];
$mID= $_GET["mID"];
?>

<html>
<body>
  <?php
  $con = mysqli_connect("localhost","root","root");
  if (!$con)
    {
    die('Could not connect: ' . mysqli_error());
    }

  $comlike=0;
  mysqli_select_db($con,"productrate");
  $comments = mysqli_query($con,"SELECT * FROM `comment` where `comID`='$cID'");
  $row2 = mysqli_fetch_array($comments);
  $comlike=$row2['numlikes']+1;

  $mcate = mysqli_query($con,"UPDATE `comment` SET `numlikes` = '$comlike' WHERE `comID`='$cID'");
  echo "<script language='javascript'>"; 
  echo " location='product_detail.html?id=$mID';"; 
  echo "</script>"; 
  ?>
</body>
</html>


