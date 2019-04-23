<?php 
$mID=$_GET["mID"];
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

$result = mysqli_query($con,"SELECT * FROM `products` WHERE `productID` = $mID");
$total=0;
$round=1;
while($row = mysqli_fetch_array($result))
 {
  
  
  echo '<h1>'.$row['productName'].'</h1>';
   echo ' <div id="mainpic" >';
       $mID=$row['productID'];
       echo' <img  class="image" src="images/details/'.$row['productID'].'.jpg" />';
       echo ' </div>';
    echo ' <div id="info">';
    #echo ' <p class="pl">Origin: <span class="attrs">'.$row['origin'].'</span></p><br/>';
    $mId=$row['productID'];
    $company = mysqli_query($con,"SELECT * FROM `company` WHERE `companyID`IN(SELECT `companyID` FROM `mcompany`AS a LEFT JOIN `products` as m ON a.`productID` =m.`productID` WHERE m.`productID`=$mId)");
    $row2= mysqli_fetch_array($company);
    $category = mysqli_query($con,"SELECT * FROM `category` WHERE `caID`IN(SELECT `caID` FROM `mcate`AS a LEFT JOIN `products` as m ON a.`productID` =m.`productID` WHERE m.`productID`=$mId)");
    $row3= mysqli_fetch_array($category);
    $comments = mysqli_query($con,"SELECT * FROM `comment` WHERE `productID` ='$mID'");
    while($row4 = mysqli_fetch_array($comments)){
    $total+=$row4['ratings'];
    $round +=1;
    }
    //echo $total;

  $new=$total*2/$round;
  $mcate = mysqli_query($con,"UPDATE `products` SET `mrates` = '$new' where `productID`='$mID'");
    echo '<p class="pl"> Company: <span class="attrs"><a href="company_detail.html?id='.$row2['companyID'].'">'. $row2['aName'].'</a></span></p>';
       # echo ' <p class="pl">company: <span ><a class="attrs" href="/" rel="v:starring">Leonardo DiCaprio</a> </span></p><br/>';
       
           echo' <p class="pl">Category: <span class="attrs"property="v:genre">'.$row3['caName'].'</span></p><br/>';
           echo ' <p class="pl">Country: <span class="attrs">'.$row['mnation'].'</span></p><br/>';
           echo  '<p class="pl">Price: $<span class="attrs">'.$row['price'].'</span></p><br/>';
        echo '  <p class="pl">Rating: <span class="attrs">'.$row['mrates'].'</span></p><br/>';
        echo ' </div>';

 }
 echo '<table>';
echo '<h2>COMMENTS</h2>';

  $comment = mysqli_query($con,"SELECT * FROM `comment` WHERE `productID` = $mID");
  while($row = mysqli_fetch_array($comment))
 {
  echo '<div class="comment">';
  echo '<h3><span class="comment-info"><p class="users">';
  #query user name to display
  $userID = $row['uID'];
  $user = mysqli_query($con,"SELECT * FROM `users` WHERE `uID` = $userID");
  $row1 = mysqli_fetch_array($user);
  
    echo $row1['uname'].'</p>';
    echo ' <span class="times">';
    echo $row['ratings'].'stars  </span>';
    echo ' <span class="times">';
    echo $row['time'].'</span>';
    echo '</span>
            <span class="comment-vote">
                
                <input id="comID" value="'.$row['comID'].'" type="hidden"/>
                <a href="likes_update.php?cID='.$row['comID'].'&mID='.$mID.'" id="votes"><img class="images" src="images/like.png" width="100px" height="50px" /></a>
                <span class="votes" >';
    echo $row['numlikes'].'</span></span></h3>';
    echo'<p class="comcontent">'.$row['content'].'</p>
          </div>
       <div class="comment">';

 }
mysqli_close($con);
?>
</body>
</html>