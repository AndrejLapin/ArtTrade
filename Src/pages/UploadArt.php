<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>

<?php
//require("functions.php");
$name = $name_error = $file_error=  "";
$for_sale = true;
$art_price = 500;

$db_connection = Connect_to_project_db();
$configs = Get_configs();

$target_dir = "art_pecies/";
$target_file = $target_dir; // file name should be artwork index + extension
echo '<p>'.basename($_FILES["fileToUpload"]["name"].'</p>';
$uploadOk = 1; // upload status?
//$image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // guess this is getting extension

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) 
{
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "<p> File is an image - " . $check["mime"] . ". <p>";
    $uploadOk = 1;
  } else {
    //echo "<p> File is not an image. <p>";
    $file_error = 'File is not an image!';
    $uploadOk = 0;
  }
}

// Check if file already exists
if(file_exists($target_file))
{
  echo "<p> ERROR: File already exists <p>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > $configs->File_configs->max_upload_size) 
{
  $file_error = 'File is too large. Size should be below '.$configs->File_configs->max_upload_size/(1000000).' Megabytes.';
  $uploadOk = 0;
}

// Allow certain file formats
$format_allowed = false;
foreach($configs->File_configs->allowed_formats as $format)
{
  echo '<p>'.$format.'<p>'; // DEBUG
  if($image_file_type == $format)
  {
    $format_allowed = true;
  }
}
if(!$format_allowed)
{
  $file_error = 'Only '
  $uploadOk = 0;
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

      if(Check_arte_name_exists($db_connection, $name))
      {
        $name_error = "Artwork name already taken";
        $name_taken = true;
      }
    }
}

// $name_taken = false;

// $db_connection = Connect_to_project_db();

// if(isset($_POST["name"]))
// {
//     if(empty($_POST["name"]))
//     {
//         $name_error = "To log in you must enter your User Name";
//     }
//     else
//     {
//         $name_taken = true;
//     }
// }
?>

<h1>Upload</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
  Select artwork to upload:<input type="file" name="fileToUpload" id="fileToUpload">
  <span class="error"> <?php echo $file_error;?></span>
  <br><br>
  Artwork Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"> <?php echo $name_error;?></span>
  <br><br>
  For Sale: <input type="checkbox" name="for_sale" value="<?php echo $for_sale;?>" id="for_sale_check" onclick="Enable_price_input_field()" checked>
  Price: <input type="number" name="art_price" value="<?php echo $art_price;?>" min="0" id="price_input_field">
  <br><br>
  <input type="submit" name="Upload" value="Upload">
</form>

<script>
    function Enable_price_input_field()
    {
        document.getElementById("price_input_field").disabled = !document.getElementById("for_sale_check").checked;
    }

</script>

</body>
</html>