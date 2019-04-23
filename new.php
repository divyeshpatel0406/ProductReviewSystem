<?php
$name = $_POST['productname'];
$year = $_POST['price'];
$ratings = $_POST['ratings'];
$origin = $_POST['origin'];
$company = $_POST['company'];
$category = $_POST['category'];
?>
<html>
<body>
	<?php
	$con = mysqli_connect("localhost","root","root");
	if (!$con)
	  {
	  die('Could not connect: ' . mysqli_error());
	  }

	mysqli_select_db($con,"productrate");
	#get category id
	$cate = mysqli_query($con,"SELECT * FROM `category` WHERE `caName`='$category'");
	$row = mysqli_fetch_array($cate);
	$catID = $row['caID'];
	#insert a new product
	$query = mysqli_query($con,"INSERT INTO `products` (`productName` ,`price` ,`mrates`,`origin`,`mnation`)
	VALUES ('$name', '$year', '$ratings', '$origin','$nation')");
	#get product id
	$products = mysqli_query($con,"SELECT * FROM `products` WHERE `productName`='$name'");
	$row2 = mysqli_fetch_array($products);
	$mID = $row2['productID'];
	#get company id
	$company = mysqli_query($con,"SELECT * FROM `company` WHERE `aName`='$company'");
	$row3 = mysqli_fetch_array($company);
	$companyID = $row3['companyID'];
	#insert relation to product and category
	$mcate = mysqli_query($con,"INSERT INTO `mcate`(`caID`, `productID`) VALUES ('$catID','$mID')");
	#inter relation to product and company
	$mcompany = mysqli_query($con,"INSERT INTO `mcompany`(`companyID`, `productID`) VALUES ('$companyID','$mID')");
	echo "insert product success!<br>";
	echo '<a href="admin.html">back</a>';
	?>
</body>
</html>