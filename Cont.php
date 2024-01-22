<?php
    include("database.php");

    session_start();
?>
<!DOCTYPE html>
<head>
    <title>Cont </title>
    <link rel="stylesheet" href="style3.css">
    

    <style>
        .transparent {
      opacity: 0.7;
    }
    </style>

</head>
<body>
    <nav class="transparent">
        <ul>
          <li> <?php
             echo "Bun venit, " . $_SESSION['user'] . "!";
            ?></li>
          <li><?php
             echo " ...................................................................................................................................................................................................... ";
            ?></li>
          <li><a href="GALERIE2.php" >Acasa</a></li>
          <li><a href="Galerie.php" >Galerie</a></li>
          <li><a href="Cont.php">Cont</a></li>
          <li><a href="Despre.html">Despre</a></li>
          <li><a href="login.html">Deconecteaza-te</a></li>
        </ul>
      </nav>
      <h1 class = "title"><img src = "img/title3.png"></h1>
      <div class="container">
              <div class="login-box">
                <div class="form-box"> 
                  <form class = "login-box" action="Cont.php" method="POST">
                    <h3>Schimbare parola </h3>
                    <br>
                    <label for="parola_veche">Parolă veche:</label>
                    <input type="password" id="parola_veche" name="parola_veche" required><br>
                    
                    <label for="parola_noua">Parolă nouă:</label>
                    <input type="password" id="parola_noua" name="parola_noua" required><br>
                    <label for="parola_noua2">Repeta parola :</label>
                    <input type="password" id="parola_noua2" name="parola_noua2" required><br>
                    <hr>
                    <input type="submit" value="Schimbă parola">
                </form>
              </div>
              <?php
                if($_SERVER["REQUEST_METHOD"] === "POST"){
                  $name = $_SESSION['user'];
                  $old = filter_input(INPUT_POST, "parola_veche", FILTER_SANITIZE_SPECIAL_CHARS);
                  $new = filter_input(INPUT_POST, "parola_noua", FILTER_SANITIZE_SPECIAL_CHARS);
                  $rep = filter_input(INPUT_POST, "parola_noua2", FILTER_SANITIZE_SPECIAL_CHARS);
            
                      
                      $sql = "SELECT pass FROM user WHERE name = \"$name\"";
                      $stmt = mysqli_stmt_init($database);
                      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                      if ($prepareStmt) {
                       try{
                          mysqli_stmt_execute($stmt);
                          $res = $stmt->get_result();
                          if($res->fetch_column(0) == $old){
                            if(strlen($new) >= 8){
                              if($new == $rep){
                                  $sql = "UPDATE user set pass = \"$new\" WHERE name = \"$name\"";
                                  $stmt = mysqli_stmt_init($database);
                                  $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                                  mysqli_stmt_execute($stmt);
                                  echo "<div class='alert alert-success'>Parola schimbata cu succes.</div>";
                              }
                              else{
                                echo "<div class='alert alert-success'>Parolele introduse difera.</div>";
                              }
                            }
                            else{
                              echo "<div class='alert alert-success'>Parola trebuie sa contina minim 8 caractere.</div>";
                            }
                          }
                          else{
                            echo "<div class='alert alert-success'>Parola este gresita.</div>";
                          }
                       }catch(mysqli_sql_exception)
                       {
                          die(mysqli_error($database));
                          echo "<div class='alert alert-success'>Nu s-a putut realiza operatia.</div>";
                       }
                       
                          
                      }else{
                          die("Something went wrong");
                      }
                  }
              ?>
            </div>
      </div>
</body>
</html>