<?php
    function Get_configs()
    {
        $config_file = file_get_contents('Configs/Config.json');
        return json_decode($config_file);
    }

    function Connect_to_project_db()
    {
        $config_object = Get_configs();

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

    function Check_art_name_exists($db_connection, $name)
    {
        $sql_request = 'SELECT Artwork_Name FROM art_pecies WHERE Artwork_Name = "'.$name.'";';
        $result = $db_connection->query($sql_request);
        return $result->num_rows > 0; // if rows are returned, that means that name already exists
    }

    function Uload_art($db_connection, $name, $file, $target_dir, $for_sale, $price)
    {
        $current_user_id = 0;
        $current_user_name = "";
        //check if user is logged in
        if(isset($_SESSION['Current_user_ID']) && $_SESSION['Current_user_ID'] != 0
            && isset($_SESSION['User_Name']))
        {
            $current_user_id = $_SESSION['Current_user_ID'];
            $current_user_name = $_SESSION['User_Name'];
        }
        else
        {
            return "ERROR: No user is currently loggedin";
        }

        //create new DB entry
        $sql_request = 'INSERT INTO art_pecies (Artwork_Name, Author_Name, Current_Owner_ID, Current_Owner_Name, Price, For_Sale)
        VALUES ("'.$name.'", "'.$current_user_name.'", '.$current_user_id.', "'.$current_user_name.'", '.$price.', '.$for_sale.')';
        if($db_connection->query($sql_request) == TRUE)
        {
            $art_id;
            $target_file = $target_dir;
            //get primary key
            $sql_request = 'SELECT max(Artwork_ID) from art_pecies;';
            //echo '<p>'.$sql_request.'</p>'; // DEBUG
            $result = $db_connection->query($sql_request);
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc(); // getting first result
                $art_id = $row[array_key_first($row)]; // getting first element of the array
                //echo '<p> Artwork_ID = '.$art_id.' </p>'; // DEBUG
            }
            //generate new name using target_dir + primary + file extension
            $target_file = $target_file.$art_id.'.'.strtolower(pathinfo(basename($file["name"]), PATHINFO_EXTENSION));
            //echo '<p> Target file = '.$target_file.' </p>'; // DEBUG
            $uploadOk = 1;
            // Check if file already exists
            if(file_exists($target_file))
            {
                return "ERROR(2): Failed to upload file"; // file with this name already exists
            }
            //upload to server 
            if(move_uploaded_file($file["tmp_name"], $target_file))
            {
                // generate currency for user who uploaded the file
                Add_currency_to_user($current_user_id, Get_configs()->File_configs->upload_currency_reward);
                return "Artowrk has been uploaded";
            }
            return "ERROR(3): Failed to upload file"; // error occured while trying to move file to the target directory
        }
        return "ERROR(1): Failed to upload file"; // could not create DB entry        
    }

    function Add_currency_to_user($user_id, $add)
    {
        $db_connection = Connect_to_project_db();
        if($add < 0)
        {
            return "ERROR: cant add negative numbers to balance";
        }
        $sql_request = 'UPDATE user SET Currency_Balance = Currency_Balance + '.$add.' WHERE User_ID = '.$user_id.';';
        if($db_connection->query($sql_request) == TRUE)
        {
            if(isset($_SESSION['Current_user_ID']) && $user_id == $_SESSION['Current_user_ID'])
            {
                $_SESSION['Currency_Balance'] = Get_user_currency($user_id);
                // refresh balance, maybe use javasript
            }
            return "Currency has been updated";
        }
        return "ERROR: querry error occured";
    }

    function Subtract_currency_from_user($user_id, $subtract)
    {
        $db_connection = Connect_to_project_db();
        $return_message = '';
        if($subtract < 0)
        {
            return "ERROR: cant subtract negative numbers from balance";
        }
        if(Get_user_currency($user_id) < $subtract)
        {
            $sql_request = 'UPDATE user SET Currency_Balance = 0 WHERE User_ID = '.$user_id.';';
            $return_message = 'User currency nulified';
        }
        else
        {
            $sql_request = 'UPDATE user SET Currency_Balance = Currency_Balance - '.$subtract.' WHERE User_ID = '.$user_id.';';
            $return_message = 'Currency has been updated';
        }

        if($db_connection->query($sql_request) == TRUE)
        {
            if(isset($_SESSION['Current_user_ID']) && $user_id == $_SESSION['Current_user_ID'])
            {
                $_SESSION['Currency_Balance'] = Get_user_currency($user_id);
                // refresh balance, maybe use javasript
            }
            return $return_message;
        }
        return "ERROR: querry error occured";
    }

    function Get_user_currency($user_id)
    {
        $db_connection = Connect_to_project_db();
        $sql_request = 'SELECT Currency_Balance FROM user WHERE User_ID = '.$user_id.';';
        $result = $db_connection->query($sql_request);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc(); // getting first result
            return $row['Currency_Balance'];
        }
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
                //header("Location: http://localhost/ArtTrade/Src/");
                header("Refresh:0");
            }
            // else password doesnt match
        }
        // else couldnt find user by $name
    }
?>