<?php
    if(isset($_SESSION['Buying_artwork']))
    {
        $result = Connect_to_project_db()->query(Get_images_by_name($_SESSION['Buying_artwork'])));
        if($result->num_rows > 0)
        {
            
        }
    }
    echo '<p> You are now buying :) </p>';
?>