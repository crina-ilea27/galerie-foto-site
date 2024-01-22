<!DOCTYPE html>
<html>
<head>
    <title>Autentificare</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
           
            <div class="container">
              <div class="login-box">
                <div class="form-box"> 
                    <h1>Autentificare</h1>   
            <form action="login.php" method="post">
              <label for="username">Nume de utilizator:</label>
              <input type="text" id="username" name="username" required>
              <label for="password">Parola:</label>
              <input type="password" id="password" name="password" required>
              <hr>
              <input type="submit" value="Autentificare">
            </form>
            
            <p>Nu ai un cont? <a href="creeazacont.html">Creeaza unul aici</a>.</p>
            <?php
    include("database.php");
?>
<br> 
<?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            
            $sql = "select pass from user where name = '$name' ";
            $result = mysqli_query($database, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if ($pass === $user["pass"]) {
                    session_start();
                    $_SESSION["user"] = $name;
                    header("Location: GALERIE2.php");
                   
                }else{
                    echo "<div class='alert alert-danger'>Parola introdusa gresit.</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Numele de utilizator nu exista.</div>";
            }
        }
?>
        </div>
      </div>
      </div>
</body>
</html>

     
