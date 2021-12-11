<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>

<?php
const starting_currency = 100;
// $password and $password_confirm variables are unused and it should stay this way
$name = $name_error = $password = $password_error = $password_confirm = $password_confirm_error = "";
$hashed_password = $hashed_password_confirm = "";
$name_taken = false;

$config_file = file_get_contents('Configs/Config.json');
$config_object = json_decode($config_file);

// connecting to mysql database
$db_connection = new mysqli(
    $config_object->Server_configs->server_name,
    $config_object->Server_configs->username,
    $config_object->Server_configs->password,
    $config_object->Server_configs->dbName
);

if($db_connection->connect_error)
{
    die("Connection failed: ".$db_connection->connect_error);
}

//echo '<p>'.$config_object->Server_configs->dbName.'</p>'; // test

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

        // checking if the name already exists
        $sql_request = 'SELECT User_Name FROM user WHERE User_Name = "'.$name.'";';
        $result = $db_connection->query($sql_request);
        if($result->num_rows > 0) // if rows are returned, that means that name already exists
        {
            $name_error = "Name already taken";
            $name_taken = true;
        }

        // code below prints out all Usaer_Name's from sql request
        //echo '<p>'.$result->num_rows.'</p>';
        // if ($result->num_rows > 0)
        // {
        //     while($row = $result->fetch_assoc()) 
        //     {
        //         echo '<p>'.$row['User_Name'].'</p>';
        //     }
        // }
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
                $sql_request = 'INSERT INTO user (User_Name, Hashed_Password, Currency_Balance, Owned_Art_Amount) 
                VALUES ("'.$name.'", "'.$hashed_password.'", '.starting_currency.', '.(0).');';
                //echo '<p>'.$sql_request.'</p>'; // test
                if($db_connection->query($sql_request) == TRUE)
                {
                    echo '<p> You have succesfully registered</p>';
                }
                else
                {
                    echo '<p> Could not register </p>';
                }
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