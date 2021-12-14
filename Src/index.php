<?php
session_start();
require("functions.php");

?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body{
  font-family: 'Montserrat', sans-serif;
}
.textbold{
  font-weight: bold;
}
</style>

</head>
<body>

<!--<h1>Main Page</h1>-->
<?php

if(!isset($_SESSION['Current_user_ID'])) $_SESSION['Current_user_ID'] = 0;
echo '<p> Current userId: '.$_SESSION['Current_user_ID'] .'</p>'; // should be hidden from users, now only for debugging
if($_SESSION['Current_user_ID'] != 0)
{//<img src="images/nft1.png" alt="Alps" style="width: auto; height: 300px;">
//<p>NFT1</p>
  echo '<div class="w3-row w3-padding w3-border w3-pale-blue w3-padding-16 w3-wide w3-large"  style="margin:auto;">
  <div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
    
    <div class="w3-container w3-center">
      
    </div>
  </div>';
  echo '<p class="w3-center w3-white w3-padding-small">'.$_SESSION['User_Name'].' balance:'.$_SESSION['Currency_Balance'].' coins, art pecies owned: '.$_SESSION['Owned_Art_Amount'].'</p>
  </div>';
    
    
}
?>
<div class="w3-bar w3-border w3-light-grey">
    <div class="w3-bar-item textbold">NFTCAP</div>
    <div class="w3-bar-item w3-border-left w3-border-right"><i class="fa fa-search"></i></div>
      <input class="w3-input w3-bar-item" name="search" type="text" placeholder="Search">
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
<?php 
    echo ' <input class="w3-button w3-white w3-right" type="submit" value="Browse" name="MenuAction"> ';
    // log in and register buttons get enabled
    if(!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0)
    echo '  <input class="w3-button w3-white w3-right" type="submit" value="Register" name="MenuAction"> 
            <input class="w3-button w3-white w3-right" type="submit" value="Login" name="MenuAction">';

    // log out button gets enabled
    if(isset($_SESSION['Current_user_ID']) && $_SESSION['Current_user_ID'] != 0)
    echo '  <input class="w3-button w3-white w3-right" type="submit" value="LogOut" name="MenuAction">
            <input class="w3-button w3-white w3-right" type="submit" value="Upload Art" name="MenuAction">'; ?>
</form>
</div>


<?php

if(isset($_POST['MenuAction']))
{
    $menu_action = $_POST['MenuAction'];
    //echo '<p>'.strpos($menu_action, 'Buy ').'</p>';
    if($menu_action == 'Register' && (!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0))
    {
      include('pages/Register.php');
    }
    else if($menu_action == 'Login' && (!isset($_SESSION['Current_user_ID']) || $_SESSION['Current_user_ID'] == 0))
    {
      include('pages/Login.php');
    }
    else if($menu_action == 'LogOut')
    {
      $_SESSION['Current_user_ID'] = 0;
      $_SESSION['User_Name'] = '';
      $_SESSION['Currency_Balance'] = 0;
      $_SESSION['Owned_Art_Amount'] = 0;

      //header("Location: http://localhost/ArtTrade/Src/");
      header("Refresh:0");
    }
    else if($menu_action == 'Upload Art' && isset($_SESSION['Current_user_ID']) && $_SESSION['Current_user_ID'] != 0)
    {
      include('pages/UploadArt.php');
    }
    else if(strpos($menu_action, 'Buy ') === 0)
    {
      $_SESSION['Buying_artwork'] = str_replace('Buy ', '', $menu_action);
      include('pages/Buy.php');
    }
    else
    {
      include('pages/Browse.php');
    }
}
else
{
  include('pages/Browse.php');
}

?>

<!-- NFTs -->
<!-- <div class="w3-row w3-padding w3-border w3-pale-blue w3-padding-16 w3-wide w3-large"  style="margin:auto;">

<div class="w3-center textbold w3-padding-32">DAY OFFERS</div>

<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
  <img src="images/nft1.png" alt="Alps" style="width: auto; height: 300px;">
  <div class="w3-container w3-center">
    <p>NFT1</p>
  </div>
</div>

<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
  <img src="images/nft2.png" alt="Alps" style="width: auto; height: 300px;">
  <div class="w3-container w3-center">
    <p>NFT2</p>
  </div>
</div>

<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
  <img src="images/nft3.png" alt="Alps" style="width: auto; height: 300px;">
  <div class="w3-container w3-center">
    <p>NFT3</p>
  </div>
</div>

<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
  <img src="images/nft4.png" alt="Alps" style="width: auto; height: 300px;">
  <div class="w3-container w3-center">
    <p>NFT4</p>
  </div>
</div>

<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
  <img src="images/nft5.png" alt="Alps" style="width: auto; height: 300px;">
  <div class="w3-container w3-center">
    <p>NFT5</p>
  </div>
</div>

<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
  <img src="images/nft6.png" alt="Alps" style="width: auto; height: 300px;">
  <div class="w3-container w3-center">
    <p>NFT6</p>
  </div>
</div>

<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
  <img src="images/nft7.png" alt="Alps" style="width: auto; height: 300px;">
  <div class="w3-container w3-center">
    <p>NFT7</p>
  </div>
</div>

<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">
  <img src="images/nft8.png" alt="Alps" style="width: auto; height: 300px;">
  <div class="w3-container w3-center">
    <p>NFT8</p>
  </div>
</div>

</div> -->
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-topbar w3-padding-32">
  <p>NFTCAPⒸ2021. ALL RIGHTS RESERVED.</p>
</footer>

</body>
</html>