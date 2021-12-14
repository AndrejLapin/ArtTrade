<div class="w3-row w3-padding w3-border w3-pale-blue w3-padding-16 w3-wide w3-large"  style="margin:auto;">

    <div class="w3-center textbold w3-padding-32">DAY OFFERS</div>

    <?php
        //echo '<p>'.Get_all_images().'</p>';
        $result = Connect_to_project_db()->query(Get_all_images());
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                echo '<div class="w3-card-3 w3-center w3-quarter w3-white w3-padding-16 w3-border">';
                echo '<img src="'.$row["Name_On_Server"].'" alt="Alps" style="width: auto; height: 300px;">';
                echo '<div class="w3-container w3-center">';
                echo '<p>'.$row["Artwork_Name"].'</p>';
                if(isset($_SESSION['Current_user_ID']) && $_SESSION['Current_user_ID'] != 0)
                {
                    $buttonValue = ($_SESSION['Current_user_ID'] == $row['Current_Owner_ID']) || !$row['For_sale']  ? 'Check' : 'Buy';
                    echo '<input class="w3-button w3-white w3-center" type="submit" value="'.$buttonValue.' '.$row["Artwork_Name"].'" name="MenuAction">';
                }
                echo '</div>';
                echo '</div>';
            }
        }
    ?>
</div>