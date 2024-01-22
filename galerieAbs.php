<?php
 include("database.php");
 session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style3.css">
  <title>Galerie Foto</title>
  <style>
    .transparent {
      opacity: 0.7;
    }
    .container1
    {
      display: flex;
      height: 100px;
      justify-content: center;
      align-items: center;
      width:400px;
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
  .commi{
    background-color: white;
    width: 415px;
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
      <li> <?php
           if(isset($_POST['hhh'])){
            $keys = array_keys($_POST['hhh']);
            $clicked = $keys[0];
          }
             echo "Autor: " . $clicked;
            ?></li>
          <li><?php
             echo " .................................................................................................................................................................................................................... ";
            ?></li>
        <li><a href="GALERIE2.php" >Acasa</a></li>
        <li><a href="Galerie.php" >Galerie</a></li>
        <li><a href="Cont.php">Cont</a></li>
        <li><a href="Despre.html">Despre</a></li>
        <li><a href="login.html">Deconecteaza-te</a></li>
      </ul>
    </nav>
  <h1 class = "title"><img src = "img/title3.png"></h1>
  <div class="gallery">
<?php
       if(isset($_POST['hhh'])){
        $keys = array_keys($_POST['hhh']);
        $_SESSION['clicked'] = $keys[0];
      }
      $clicked = $_SESSION['clicked'];
    
    $sql = "SELECT image FROM pics WHERE name = \"$clicked\"";
    $stmt = mysqli_stmt_init($database);
    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
    if ($prepareStmt) {
      try{
        mysqli_stmt_execute($stmt);
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            echo "<div class=\"gallery\">";
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                echo "<input type = \"image\" src=\"img/$row[0]\" class=\"img\" >";
            }
            echo "</div>";
        }
            }catch(mysqli_sql_exception)
            {
            die(mysqli_error($database));
            echo "<div class='alert alert-success'>Nu s-a putut incarca imaginea.</div>";
            }               
    }else{
        die("Something went wrong");
  }
 echo "</div>";
 // echo "Autor: $clicked";
?>
<form action = "comm.php" method = "post" >
   
  <div class="container1">
    <input id="post_button" type="submit" name="Posteaza" value="Posteaza">
  <input type = "text" name = "comme" placeholder = "Adauga comentariu">
  </div>
</form>

  <?php
$sql = "SELECT * FROM comm WHERE galeria = \"$clicked\" ";

$stmt = mysqli_stmt_init($database);
$prepareStmt = mysqli_stmt_prepare($stmt,$sql);
if ($prepareStmt) {
  try{
    mysqli_stmt_execute($stmt);
    $res = $stmt->get_result();
    if($res->num_rows > 0){
        echo "<div class=\"commi\">";
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)){
            echo "<label> ($row[0]) a comentat:  $row[1] </label>";
             echo "<br>";
           // echo "<br>";
        }
        echo "</div>";
    }
        }catch(mysqli_sql_exception)
        {
        die(mysqli_error($database));
        echo "<div class='alert alert-success'>Nu s-a putut incarca comentariul.</div>";
        }               
}else{
    die("Something went wrong");
}
//echo "</div>";
  ?>
</body>
</html>
