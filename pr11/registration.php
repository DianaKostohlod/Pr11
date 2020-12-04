<?php
require_once 'connection.php'; 
if(count($_POST)>0)
{
 $err = [];
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    $query = mysqli_query($conn, "SELECT id FROM users WHERE login='".mysqli_real_escape_string($conn, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }
    if(count($err) == 0)
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $login = $_POST['login'];
        mysqli_query($conn,"INSERT INTO users SET first_name='".$first_name."', last_name='".$last_name."', password='".$password."', login='".$login."'");  
        
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }

$target_dir = "public/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
    	$uploadOk = 1;
	} else {
        echo "File is not an image.";
    	$uploadOk = 0;
	}
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
	$uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}

if ($uploadOk == 1) {
        if (!file_exists($target_file)) {
            $bool = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
       mysqli_query($conn,"UPDATE users SET img = '" .basename($_FILES["fileToUpload"]["name"]). "' WHERE login = '{$_POST['login']}'");
    header("Location: login.html"); 
        exit();
	} 


}
?>
