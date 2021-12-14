<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
.error{
 
 color:#000!important;
 background-color:#f44336!important;
}
</style>
</head>
<body>

<?php
//require("functions.php");
$name = $name_error = $file_error=  "";
$for_sale = true;
$art_price = 500;

$db_connection = Connect_to_project_db();
$configs = Get_configs();

$uploadOk = 0; // upload status?

// Check if image file is a actual image or fake image
if(!empty($_FILES["file_to_upload"]["name"])) 
{
  //echo '<p>'.basename($_FILES["file_to_upload"]["name"]).'</p>';
  $check = getimagesize($_FILES["file_to_upload"]["tmp_name"]);
  $image_file_type = strtolower(pathinfo(basename($_FILES["file_to_upload"]["name"]), PATHINFO_EXTENSION));
  //echo "<p> File extension = " .$image_file_type. ". <p>";
  if($check !== false) 
  {
    //echo "<p> File is an image - " . $check["mime"] . ". <>";
    $uploadOk = 1;
  } 
  else 
  {
    $file_error = $file_error.'File is not an image!';
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["file_to_upload"]["size"] > $configs->File_configs->max_upload_size) 
  {
    $file_error = $file_error.'File is too large. Size should be below '.$configs->File_configs->max_upload_size/(1000000).' Megabytes. ';
    $uploadOk = 0;
  }

  // Allow certain file formats
  $format_allowed = false;
  foreach($configs->File_configs->allowed_formats as $format)
  {
    if($image_file_type == $format)
    {
      $format_allowed = true;
    }
  }
  if(!$format_allowed)
  {
    $file_error = $file_error.' Only ';

    foreach($configs->File_configs->allowed_formats as $format)
    {
      //echo '<p> Last item = '.end($configs->File_configs->allowed_formats).'<p>'; // DEBUG
      if(end($configs->File_configs->allowed_formats) == $format)
      {
        //current items is last
        $file_error = $file_error.'and '.$format.' type files are allowed';
      }
      else
      {
        $file_error = $file_error.$format.', ';
      }
    }
    $uploadOk = 0;
  }
}
else
{
  $file_error = $file_error.'File has to be selected';
}

$name_taken = false;
if(isset($_POST["name"]))
{
    if(empty($_POST["name"]))
    {
        $name_error = "Artwork must have a name";
    }
    else
    {
      $name = $_POST["name"];

      if(Check_art_name_exists($db_connection, $name))
      {
        $name_error = "Artwork name already taken";
        $name_taken = true;
      }
    }
}

if(!$name_taken && $uploadOk != 0)
{
  // or put Uload_art result string into some other variable and display it somewhere nicely
  echo '<p>'.Uload_art(  $db_connection, $name,
              $_FILES["file_to_upload"], $configs->File_configs->target_directory,
              isset($_POST["for_sale"]), isset($_POST["art_price"]) ? $_POST["art_price"] : $art_price).'</p>';
}
else
{
  //file isnt uploaded
}

?>

<h1 class="w3-container w3-white w3-padding-16">Upload</h1>
<form class="w3-container w3-padding-32" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
  Select artwork to upload:<input type="file" name="file_to_upload" id="file_to_upload">
  <p class="w3-red"> <?php echo $file_error;?></p>
  Artwork Name: <input type="text" name="name" value="<?php echo $name;?>">
  <p class="w3-red"> <?php echo $name_error;?></p>
  <br><br>
  For Sale: <input class="w3-check" type="checkbox" name="for_sale" value="<?php echo $for_sale;?>" id="for_sale_check" onclick="Enable_price_input_field()" checked>
  Price: <input type="number" name="art_price" value="<?php echo $art_price;?>" min="0" id="price_input_field">
  <br><br>  
  <input class="w3-btn w3-blue-grey" type="submit" name="MenuAction" value="Upload Art">
</form>

<script>
    function Enable_price_input_field()
    {
        document.getElementById("price_input_field").disabled = !document.getElementById("for_sale_check").checked;
    }

</script>

</body>
</html>