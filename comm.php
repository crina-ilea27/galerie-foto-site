<?php
include("database.php");

 if (isset($_POST['Posteaza']))
 {
    session_start();
    $name = $_SESSION['user'];
     $comentariu = $_POST['comme'];
     $sql = "INSERT INTO comm (name,comentariu,galeria)
     VALUES (?,?,?)";
      $stmt = mysqli_stmt_init($database);
      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
      if ($prepareStmt) {
        try{
            mysqli_stmt_bind_param($stmt,"sss",$name, $comentariu,$_SESSION['clicked']);
           mysqli_stmt_execute($stmt);
        }catch(mysqli_sql_exception)
        {
           die(mysqli_error($database));
           echo "<div class='alert alert-success'>Nu s-a putut incarca imaginea.</div>";
        }
        
           
       }else{
           die("Something went wrong");
       }
     
 }header("Location: galerieAbs.php");
?>
