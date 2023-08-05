<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    
    <form action="index.php" method="post">
        <div class="register-card">
            <p class="header-name">REGISTER</p>
            <div class="username-container">
                <p class="username-label">username</p>
                <p id="username-taken-label"></p>
                <input class="username-textbox" type="text" name="username">
            </div>
            
            <div class="password-container">
                <p class="password-label">password</p>
                <p id="password-taken-label"></p>
                <input class="password-textbox" type="password" name="password"><br>
            </div>
            
            <input class="register-button" type="submit" name="submit" value="register">
        </div>
    </form>
    
    
</body>
</html>

<?php

    if(isset($_POST["submit"])){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
        if(empty($username)){
            echo '<script>document.getElementById("username-taken-label").innerHTML = "enter a username";</script>';
        }

        elseif (empty($password)){
            echo '<script>document.getElementById("password-taken-label").innerHTML = "enter a password";</script>';
        }

        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user, password) 
                    VALUE ('$username', '$hash')";

            try{
                mysqli_query($conn, $sql);
                echo '<script>alert("Login successfull!");</script>';
            }
            catch(mysqli_sql_exception){
                echo '<script>document.getElementById("username-taken-label").innerHTML = "username already taken";</script>';
            }
            
        }
    
    
    }

    mysqli_close($conn);
?>