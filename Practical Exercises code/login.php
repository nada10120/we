<?php 
require 'connection.php';
if($_SERVER['REQUEST_METHOD']==="POST"){
    $name=$_POST['username'];
    $password=$_POST['password'];
    if($name&&$password){
        $req=$pdo->prepare('SELECT * FROM participates WHERE name=?');
        $req->execute([$name]);
        $exuser=$req->fetch(PDO::FETCH_ASSOC);
        if($exuser){
            if($exuser['name']==$name&&password_verify($password,$exuser['password'])){
                header('location:index.php');
            }else{
                echo 'unvalid username or password ';
            }
        }else{
           echo 'no such username exists'; 
        }
    
    }else{
        echo 'please fill your input fields';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label for="username">USERNAME</label>
        <input type="text" name="username">
        <br>
        <label for="password">password</label>
        <input type="password" name="password">
        <br>
        <input type="submit">
    </form>
</body>
</html>