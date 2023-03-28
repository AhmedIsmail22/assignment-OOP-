<?php

use assignment\Database\Database;
use assignment\image\Image;

require_once 'Database/Database.php';
require_once 'image/Image.php';


$host = "localhost";
$username = "root";
$password = "";
$dbname = "blog_sun_offline_39";

$db = new Database($host, $username, $password, $dbname);


// //1- Select All
// $allData = $db->selectAll("posts");
// foreach($allData as $row){
//     echo $row['id'] . " - " . $row['title'] ."<br>";
// }


// //2-selectColumns
// $data_of_column = $db->selectColumns('posts', "id, title");
// foreach($data_of_column as $row){
//     echo $row['id'] . " - " . $row['title'] ."<br>";
// }


// //2-delete
// $db->delete('posts', "id=19");
// echo "is deleted.";


// //2-update
// $db->update('posts', "title='new title'", "id=18");
// echo "is updated.";


?>

<form method="POST" enctype="multipart/form-data">
        <input type = "file" name = "image" />
        <input type="submit" value="submit" name="upload" />
    </form><br/><br/>

<?php

if(isset($_FILES['image'] ,$_POST['upload'])){
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_size = $image['size']/(1024*1024);
    $image_error = $image['error'];
    $image_tmp_name = $image['tmp_name'];
    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

    $img = new Image($image_name, $image_error, $image_size, $image_tmp_name);
    $errors = $img->validate();
    foreach($errors as $error){
        echo $error . "<br>";
    }
    if(empty($errors)){
        echo $img->rename()->upload();
    }
}