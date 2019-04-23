<?php
$mID=$_GET["id"];
$mname=$_POST["productname"];
$mdate=$_POST["price"];
$nation=$_POST["mnation"];
$md=$_POST["origin"];
$company=$_POST["company"];
$category=$_POST["category"];
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
#get category id
$cate = mysqli_query($con,"SELECT * FROM `category` WHERE `caName`='$category'");
$row = mysqli_fetch_array($cate);
$catID = $row['caID'];
#get company id
$company = mysqli_query($con,"SELECT * FROM `company` WHERE `aName`='$company'");
$row3 = mysqli_fetch_array($company);
$companyID = $row3['companyID'];
$result = mysqli_query($con,"UPDATE `products` SET `productName`='$mname',`price`='$mdate',`origin`='$md',`mnation`='$nation' WHERE `productID`='$mID'");
$mcate = mysqli_query($con,"UPDATE `mcate` SET `caID`='$catID' WHERE `productID`='$mID'");
$mcompany = mysqli_query($con,"UPDATE `mcompany` SET `companyID`='$companyID' WHERE `productID`='$mID'");
if($result &&$mcate &&$mcompany)
{
	echo "update success!";
	echo '<br><a href=Admin.html>Back<a/>';
}
else
{
	echo 'Update failed!';
}
 

mysqli_close($con)
?>
</body>
</html>