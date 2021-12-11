<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>

<?php
// $password and $password_confirm variables are unused and it should stay this way
$name = $name_error = $password = $password_error = $password_confirm = $password_confirm_error = "";
$hashed_password = $hashed_password_confirm = "";
$name_taken = false;

if(isset($_POST["name"]))
{
    if(empty($_POST["name"]))
    {
        $name_error = "Name cant be empty";
        //echo ' name empty';
    }
    else
    {
        $name = $_POST["name"];
        // TODO: do name check from DB, if exists show error
        //$name_error = "Name already taken";
        //$name_taken = true;
    }
}

if(isset($_POST["password"]))
{
    if(empty($_POST["password"]))
    {
        $password_error = "Password cant be empty";
        //echo ' pass empty';
    }
    else
    {
        //echo ' pass not empty';
        $hashed_password = hash('sha256', $name.$_POST["password"]);
    }
}
else
{
    //echo ' pass not set';
}

if(isset($_POST["password_confirm"]))
{
    if(empty($_POST["password_confirm"]))
    {
        //echo ' confirm empty';
        $password_confirm_error = "Password must be confirmed";
    }
    else
    {
        //echo ' confirm not empty';
        $hashed_password_confirm = hash('sha256', $name.$_POST["password_confirm"]);
        echo '<p> Hash1 = '.$hashed_password.' </p>';
        echo '<p> Hash2 = '.$hashed_password_confirm.' </p>';
        if($hashed_password == $hashed_password_confirm)
        {
            echo '<p> Passwords match!!! :D </p>';
            if(!$name_taken)
            {
                //TODO: add to DB
            }
        }
        else
        {
            $password_confirm_error = "Passwords must match!";
        }
    }
}
else
{
    //echo ' confirm not set';
}

?>

<h1>Register</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  User Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"> <?php echo $name_error;?></span>
  <br><br>
  Password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error"> <?php echo $password_error;?></span>
  <br><br>
  Confirm Password: <input type="password" name="password_confirm" value="<?php echo $password_confirm;?>">
  <span class="error"><?php echo $password_confirm_error;?></span>
  <br><br>
  <input type="submit" name="AccountSubmit" value="Register">  
</form>

</body>
</html>