<?php  

require_once("database.php");


     $stmt = $con->prepare("
    SELECT 
      reservering.id,
      reservering.klantvoornaam,
      reservering.klantachternaam,
      reservering.tafelnummer,
      reservering.personen,
      reservering.pro,
      


      
      allergie.naam AS allergie


    FROM 
      reservering
      LEFT JOIN allergie ON reservering.allergie_id = allergie.id
      
      ");

   $stmt->execute();
  $reserveringen = $stmt->fetchAll(PDO::FETCH_OBJ);


   if(isset($_GET["id"])){

	$stmt = $con->prepare("DELETE FROM reservering WHERE id=?");
	$stmt->bindValue(1, $_GET["id"]);
    $stmt->execute();

    header('Location: index.php');
}
  
?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body>
		<a href="toevoegen.php" class="btn btn-primary m-2">Toevoegen +</a>
	    <a href="barman.php">barman</a>
		<table class="table table-striped">
			<thead class="table-dark">
				<th>Id</th>
				<th>Voornaam</th>
				<th>Achternaam</th>
				<th>Tafelnummer</th>
				<th>Personen</th>
				<th>Pro</th>
				<th>Allergien</th>
				<th></th>
				<th></th>
			</thead>
			<tbody>
				<?php
					foreach($reserveringen as $reservering) {
						echo "<tr>";
						echo "<td>$reservering->id</td>";
						
						echo "<td>$reservering->klantvoornaam</td>";
						echo "<td>$reservering->klantachternaam</td>";
						echo "<td>$reservering->tafelnummer</td>";
						echo "<td>$reservering->personen</td>";
						if($reservering->pro){
							echo "<td>Extra portie patat</td>";
						}
						else{
							echo "<td>Geen extra portie patat</td>";
						}
						echo "<td>$reservering->allergie</td>";
						echo "<td><a href='index.php?id=$reservering->id'?>Verwijderen</a></td>";
						echo "<td><a href='update.php?id=$reservering->id'>Update</a></td>";
                        echo "</tr>";
					}
				?>
			</tbody>
		</table>
		
	</body>
</html>