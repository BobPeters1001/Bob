<?php  

require_once("database.php");


$stmt = $con->prepare("SELECT * FROM allergie");

$stmt->execute();

$allergien = $stmt->fetchAll(PDO::FETCH_OBJ);

if ($_POST){
	$stmt = $con->prepare("INSERT INTO reservering(klantvoornaam, klantachternaam, tafelnummer, personen, pro, allergie_id) VALUES(?, ?, ?, ?, ?, ?)");
	$stmt->bindValue(1, $_POST["klantvoornaam"]);
    $stmt->bindValue(2, $_POST["klantachternaam"]);
    $stmt->bindValue(3, $_POST["tafelnummer"]);
    $stmt->bindValue(4, $_POST["personen"]);
    $stmt->bindValue(5, isset($_POST["pro"]) ? 1 : 0);
    $stmt->bindValue(6, $_POST["allergie_id"]); 
    $stmt->execute();

    header("location: index.php");
}


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form method="POST">
<input type="text" placeholder="Voornaam" name="klantvoornaam"><br><br>
<input type="text" placeholder="Achternaam" name="klantachternaam"><br><br>
<input type="text" placeholder="Tafelnummer" name="tafelnummer"><br><br>
<input type="text" placeholder="Personen" name="personen"><br><br>
Patat:<input type="checkbox" name="pro" /><br/>

<select name="allergie_id">
	<?php  
     foreach ($allergien as $allergie) {
       echo "<option value='$allergie->id'>$allergie->naam</option>";
     }


	?>

    
</select><br><br>
<input type="submit" value="Opslaan"><br>

</form>

</body>
</html>