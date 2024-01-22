<?php
    include("database.php");

    if(isset($_POST['submit']) && isset($_FILES['imagine'])){
        session_start();
        $name = $_SESSION['user'];
        $img = $_FILES['imagine']['name'];
            
            $sql = "INSERT INTO pics (name, image) VALUES ( ?, ? )";
            $stmt = mysqli_stmt_init($database);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
             try{
                 mysqli_stmt_bind_param($stmt,"ss",$name, $img);
                mysqli_stmt_execute($stmt);
             }catch(mysqli_sql_exception)
             {
                die(mysqli_error($database));
                echo "<div class='alert alert-success'>Nu s-a putut incarca imaginea.</div>";
             }
             
                
            }else{
                die("Something went wrong");
            }
        }
           header("Location: Galerie.php");
?>
