<?php
    if(isset($_SESSION['Buying_artwork']))
    {
        $result = Connect_to_project_db()->query(Get_images_by_name($_SESSION['Buying_artwork']));
        //echo '<p>'.Get_images_by_name($_SESSION['Buying_artwork']).'</p>';
        //echo '<p>'.$result->num_rows.'</p>';
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc(); // getting only first result
            echo '<div class="w3-row w3-padding w3-border w3-pale-blue w3-padding-16 w3-wide w3-large w3-center"  style="margin:auto;">';
            echo '<div class="w3-card-3 w3-center w3-white w3-padding-16 w3-border" style="margin:auto; width:50%;">';
            echo '<img src="'.$row["Name_On_Server"].'" alt="Alps" style="width: auto; height: 300px;">';
            echo '<div class="w3-container w3-center">';
            echo '<p>'.$_SESSION['Buying_artwork'].'</p>';
            echo '<p> By: '.$row["Author_Name"].'</p>';
            echo '<p> Price: '.$row["Price"].'</p>';
            echo '<form action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post">';
            echo '<input class="w3-button w3-green w3-center " type="submit" value="Confirm Purchase" name="MenuAction">';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        else
        {
            echo '<div class="w3-red"> An error has occured </div>';
        }
    }
    //echo '<p> You are now buying :) </p>';
?>