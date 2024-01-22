<!DOCTYPE html>
<head>
    <title>Galerie</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .transparent {
      opacity: 0.7;
    }
    </style>
     <style>
body {
  color: black;
}
.gallery {
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 10px;
      padding: 8px 4px;
       margin: 8px 0;
       justify-content: center;
       align-items: center;
    }

</style>
</head>
<body>    
    <nav class="transparent">
        <ul>
          <li><a href="GALERIE2.php" >Acasa</a></li>
          <li><a href="Galerie.php" >Galerie</a></li>
          <li><a href="Cont.php">Cont</a></li>
          <li><a href="Despre.html">Despre</a></li>
          <li><a href="login.html">Deconecteaza-te</a></li>
        </ul>
      </nav>
      <h3 class = "title">Încarcă imagini pentru galeria ta</h3>
      <div class="container">
      <div class="login-box">
                <div class="form-box"> 
      <form action = "adauga.php" method = "post" enctype="multipart/form-data">
      <i class='bx bxs-cloud-upload icon' ></i>
      <input type = "file" name = "imagine" value = "Submit" >
      <input type = "submit" name = "submit" value = "Submit">
      </form>
      <br>
      <form action = "sterge.php" method = "post">
        <input type = "text" name = "img_delete" placeholder = "Numele imaginii...">
      <input type = "submit" name = "delete" value = "Sterge">
    </form>
                  
                </div>
    
      </div>
</div>
  <br>
      <div class="gallery">
      <?php
        include("database.php");

            session_start();
            $name = $_SESSION['user'];
                
                $sql = "SELECT image FROM pics WHERE name = \"$name\"";
                $stmt = mysqli_stmt_init($database);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if ($prepareStmt) {
                 try{
                    mysqli_stmt_execute($stmt);
                    $res = $stmt->get_result();
                    echo "<div class=\"gallery\">";
                    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) 
                      foreach ($row as $r) {
                        echo "<img src=\"img/$r\" class=\"img\" >";
                      }
                    echo "</div>";
                 }catch(mysqli_sql_exception)
                 {
                    die(mysqli_error($database));
                    echo "<div class='alert alert-success'>Nu s-a putut incarca imaginea.</div>";
                 }
                 
                    
                }else{
                    die("Something went wrong");
                }
      ?>
      </div>      
</body>
</html>