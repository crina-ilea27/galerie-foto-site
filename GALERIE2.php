<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style3.css">
  <title>Galerie Foto</title>
  <style>
    div.desc {
  padding: 15px;
  text-align: center;
}
    .transparent {
      opacity: 0.7;
    }
    .gallery {
      display:grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 10px;
      padding: 8px 4px;
       margin: 8px 0;
       justify-content: center;
       align-items: center;
    }

    .gallery img {
      width: 10;
      height: auto;
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
  <h1 class = "title"><img src = "img/title3.png"></h1>
  <form action = "galerieAbs.php" method = "post">
  <div class="gallery">
  <?php
      include("database.php");

    session_start();
    if (!isset($_SESSION["user"])) {
      header("Location: login.php");
    }
    $sql = "SELECT * FROM pics";
    $stmt = mysqli_stmt_init($database);
    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
    if ($prepareStmt) {
      try{
        mysqli_stmt_execute($stmt);
        $res = $stmt->get_result();
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)){
            $i = $row[0];
            echo "<input type = \"image\" name = \"hhh[$i]\" src=\"img/$row[1]\" class=\"img\" >";
        }
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
</form>
</body>
</html>
