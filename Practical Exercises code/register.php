<?php 
require 'connetion.php';

if ($_SERVER['REQUEST_METHOD']==="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    $sql='SELECT * FROM users WHERE name=?';
    $data=$pdo->prepare($sql);
    $data->execute([$username]);
    $exuser=$data->fetch(PDO::FETCH_ASSOC);
    if($exuser){
        echo 'user already exists';
    }else{
        $hashedpassword=password_hash($password,PASSWORD_DEFAULT);
        $insert=$pdo->prepare("INSERT INTO participates (name , password , role) VALUES (? , ? ,?)");
        $insert->execute([$username,$hashedpassword,$role]);
        header("location:login.php");
    }

}else{
    echo ' please fill all records';
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    <form method="POST">
        <label for="username">USERNAME</label>
        <input type="text" name="username">
        <br>
        <label for="password">PASSWORD</label>
        <input type="password" name="password">
        <br>
        <label for="role">ROLE</label>
        <select name="role" >
            <option value="admin">admin</option>
            <option value="user">user</option>
            

        </select>
        <br>
        <input type="submit">
    </form>
</body>
</html>