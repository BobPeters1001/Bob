<?php
  

  require_once "database.php";
  
 $stmt = $con->prepare("SELECT * FROM allergie");

$stmt->execute();

$allergien = $stmt->fetchAll(PDO::FETCH_OBJ);
  
 
  $stmt = $con->prepare("SELECT * FROM reservering WHERE id=?");
  $stmt->bindValue(1, $_GET["id"]);
  $stmt->execute();
  
  $reservering = $stmt->fetchObject();

  if($_POST) {
    $stmt = $con->prepare("UPDATE reservering SET klantvoornaam=?, klantachternaam=?, tafelnummer=?, personen=?, pro=? , allergie_id=? WHERE id=?");
    $stmt->bindValue(1, $_POST["klantvoornaam"]);
    $stmt->bindValue(2, $_POST["klantachternaam"]);
    $stmt->bindValue(3, $_POST["tafelnummer"]);
    $stmt->bindValue(4, $_POST["personen"]);
    $stmt->bindValue(5, isset($_POST["pro"]) ? 1 : 0);
    $stmt->bindValue(6, $_POST["allergie_id"]);
    $stmt->bindValue(7, $_GET["id"]);
 
    
    $stmt->execute();
    
    header("location: index.php");
  }


  

?>

<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
    <body>
        <form method="post">
            Voornaam:<input type="text" placeholder="Voornaam" name="klantvoornaam" value="<?php echo $reservering->klantvoornaam?>" /><br><br>
            Achternaam:<input type="text" placeholder="Achternaam" name="klantachternaam" value="<?php echo $reservering->klantachternaam?>"/><br><br>
            Tafelnummer:<input type="text" placeholder="Tafelnummer" name="tafelnummer" value="<?php echo $reservering->tafelnummer?>"/><br><br>
            Personen:<input type="text" placeholder="Personen" name="personen" value="<?php echo $reservering->personen?>"/><br><br>
            Patat:<input type="checkbox" name="pro" <?php if($reservering->pro == 1) { echo "checked"; } ?> /><br/>
            <select name="allergie_id">
     <?php  
     foreach ($allergien as $allergie) {
      if($allergie->id == $reservering->allergie_id){
        echo "<option selected value='$allergie->id'>$allergie->naam</option>";
      }
       else{
        echo "<option value='$allergie->id'>$allergie->naam</option>";
       }
        
       
     }
     ?>
     </select>
            <br>
            <br>
      
            <input type="submit" value="Opslaan"><br>

        </form>
    </body>
</html>