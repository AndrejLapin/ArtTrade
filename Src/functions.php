<?php
    function Connect_to_project_db()
    {
        $config_file = file_get_contents('Configs/Config.json');
        $config_object = json_decode($config_file);

        $connection = new mysqli(
            $config_object->Server_configs->server_name,
            $config_object->Server_configs->username,
            $config_object->Server_configs->password,
            $config_object->Server_configs->dbName
        );

        if($connection->connect_error)
        {
            die("Connection failed: ".$connection->connect_error);
        }
        else
        {
            return $connection;
        }
    }

    function Check_name_exists($db_connection, $name)
    {
        $sql_request = 'SELECT User_Name FROM user WHERE User_Name = "'.$name.'";';
        $result = $db_connection->query($sql_request);
        return $result->num_rows > 0; // if rows are returned, that means that name already exists

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

    function Register_new_user($db_connection, $name, $hashed_password, $starting_currency)
    {
        $sql_request = 'INSERT INTO user (User_Name, Hashed_Password, Currency_Balance, Owned_Art_Amount) 
        VALUES ("'.$name.'", "'.$hashed_password.'", '.$starting_currency.', '.(0).');';

        if($db_connection->query($sql_request) == TRUE)
        {
            echo '<p> You have succesfully registered </p>';
        }
        else
        {
            echo '<p> Could not register </p>';
        }    
    }

    function Login_user($db_connection, $name, $password)
    {
        $sql_request = 'SELECT User_ID, User_Name, Hashed_Password, Currency_Balance, Owned_Art_Amount FROM user WHERE User_Name = "'.$name.'";';
        $result = $db_connection->query($sql_request);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc(); // getting first result
            if(hash('sha256', $name.$password) == $row['Hashed_Password'])
            {
                // user has succesfully logged int
                $_SESSION['Current_user_ID'] = $row['User_ID'];
                $_SESSION['User_Name'] = $row['User_Name'];
                $_SESSION['Currency_Balance'] = $row['Currency_Balance'];
                $_SESSION['Owned_Art_Amount'] = $row['Owned_Art_Amount'];

                // heading to the main page
                header("Location: http://localhost/ArtTrade/Src/");
            }
            // else password doesnt match
        }
        // else couldnt find user by $name
    }
?>