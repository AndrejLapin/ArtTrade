<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>

<?php
//require("functions.php");
$name = $name_error = "";
$for_sale = true;
$art_price = 0;

// $name_not_empty = false;

// $db_connection = Connect_to_project_db();

// if(isset($_POST["name"]))
// {
//     if(empty($_POST["name"]))
//     {
//         $name_error = "To log in you must enter your User Name";
//     }
//     else
//     {
//         $name_not_empty = true;
//     }
// }

// if(isset($_POST["password"]))
// {
//     if(empty($_POST["password"]))
//     {
//         $password_error = "To log in you must enter your Password";
//     }
//     else if($name_not_empty)
//     {
//         Login_user($db_connection, $_POST["name"], $_POST["password"]);
//     }
// }
?>

<h1 class="w3-container w3-white w3-padding-16">Upload</h1>
<form class="w3-container w3-padding-32" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Artwork Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"> <?php echo $name_error;?></span>
  <br><br>
  For Sale: <input class="w3-check" type="checkbox" name="for_sale" value="<?php echo $for_sale;?>" id="for_sale_check" onclick="Enable_price_input_field()" checked>
  Price: <input type="number" name="art_price" value="<?php echo $art_price;?>" min="0" id="price_input_field">
  <br><br>
  <input class="w3-btn w3-blue-grey" type="submit" name="Upload" value="Upload">  
</form>

<script>
    function Enable_price_input_field()
    {
        document.getElementById("price_input_field").disabled = !document.getElementById("for_sale_check").checked;
    }

</script>

</body>
</html>