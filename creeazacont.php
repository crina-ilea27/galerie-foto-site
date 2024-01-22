<!DOCTYPE html>
<html>
<head>
    <title>Creeaza cont</title>
    <link rel="stylesheet" href="style2.css">
     <style>
    .transparent {
      opacity: 0.7;
    }
    </style>
</head>
<body>
<nav class="transparent">
    <ul><li><a href="login.html">Inapoi la autentificare</a></li></ul>
</nav>
  <div class="container">
    <div class="login-box">
      <div class="form-box"> 
            <h1>Creeaza un cont</h1>
            <form action="creeazacont.php" method="post" onsubmit="return validateForm()">
              <div>
                <label for="create-username">Nume de utilizator:</label>
                <input type="text" id="create-username" name="create-username" required>
              </div>
              <div>
                <label for="create-password">Creare parola:</label>
                <input type="password" id="create-password" name="create-password" required>
              </div>
              <div >
                <label for="confirm-password">Repeta parola:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
              </div>
              <hr>
              <div >
                <input type="submit" value="Creeaza cont" >
              </div>             
            </form>
            <?php
    include("database.php");
?>
<br>
<?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = filter_input(INPUT_POST, "create-username", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "create-password", FILTER_SANITIZE_SPECIAL_CHARS);
        $conf = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_SPECIAL_CHARS);

           $errors = array();
           if (strlen($pass)<8) {
            array_push($errors,"Parola trebuie sa contina cel putin 8 caractere.");
           }
           if ($pass!==$conf) {
            array_push($errors,"Parolele nu corespund.");
           }
          
           require_once "database.php";
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO user (name, pass) VALUES ( ?, ? )";
            $stmt = mysqli_stmt_init($database);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
             try{
                 mysqli_stmt_bind_param($stmt,"ss",$name, $pass);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Te-ai inregistrat cu succes.</div>";
             }catch(mysqli_sql_exception)
             {
                echo "<div class='alert alert-success'>Numele este deja folosit.</div>";
             }
             
                
            }else{
                die("Something went wrong");
            }
           }
        }

       
           
?>
        </div>
     </div>
   </div> 
      
</body>
</html>


