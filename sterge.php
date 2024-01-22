<?php
    include("database.php");

    if(isset($_POST['delete'])){
        session_start();
        $name = $_SESSION['user'];
        $img = filter_input(INPUT_POST, "img_delete", FILTER_SANITIZE_SPECIAL_CHARS);

            $sql = "DELETE FROM pics WHERE name = \"$name\" AND image = \"$img.png\"";
            echo $sql;
            $stmt = mysqli_stmt_init($database);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
             try{
                mysqli_stmt_execute($stmt);
             }catch(mysqli_sql_exception)
             {
                die(mysqli_error($database));
                echo "<div class='alert alert-success'>Nu s-a putut sterge imaginea.</div>";
             }
             
                
            }else{
                die("Something went wrong");
            }
        }
           header("Location: Galerie.php");
?>