<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>

<?php
//require("functions.php");

const starting_currency = 100;
// $password and $password_confirm variables are unused and it should stay this way
$name = $name_error = $password = $password_error = $password_confirm = $password_confirm_error = "";
$hashed_password = $hashed_password_confirm = "";
$name_taken = false;

$db_connection = Connect_to_project_db();

if(isset($_POST["name"]))
{
    if(empty($_POST["name"]))
    {
        $name_error = "Name cant be empty";
    }
    else
    {
        $name = $_POST["name"];

        if(Check_name_exists($db_connection, $name)) // if rows are returned, that means that name already exists
        {
            $name_error = "Name already taken";
            $name_taken = true;
        }
    }
}

if(isset($_POST["password"]))
{
    if(empty($_POST["password"]))
    {
        $password_error = "Password cant be empty";
    }
    else
    {
        $hashed_password = hash('sha256', $name.$_POST["password"]);
    }
}

if(isset($_POST["password_confirm"]))
{
    if(empty($_POST["password_confirm"]))
    {
        $password_confirm_error = "Password must be confirmed";
    }
    else
    {
        $hashed_password_confirm = hash('sha256', $name.$_POST["password_confirm"]);
        //echo '<p> Hash1 = '.$hashed_password.' </p>';
        //echo '<p> Hash2 = '.$hashed_password_confirm.' </p>';

        if($hashed_password == $hashed_password_confirm)
        {
            //echo '<p> Passwords match!!! :D </p>';
            if(!$name_taken)
            {
                Register_new_user($db_connection, $name, $hashed_password, starting_currency);
                Login_user($db_connection, $name, $_POST["password"]);
            }
        }
        else
        {
            $password_confirm_error = "Passwords must match!";
        }
    }
}

?>

<h1 class="w3-container w3-white w3-padding-16">Register</h1>
<form class="w3-container w3-padding-32" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  User Name: <input class="w3-input" type="text" name="name" value="<?php echo $name;?>">
  <p class="w3-red"> <?php echo $name_error;?></p>
  <br><br>
  Password: <input class="w3-input" type="password" name="password" value="<?php echo $password;?>">
  <p class="w3-red"> <?php echo $password_error;?></p>
  <br><br>
  Confirm Password: <input class="w3-input" type="password" name="password_confirm" value="<?php echo $password_confirm;?>">
  <p class="w3-red"><?php echo $password_confirm_error;?></p>
  <br><br>
  <input class="w3-btn w3-blue-grey" type="submit" name="MenuAction" value="Register">  
</form>

</body>
</html>