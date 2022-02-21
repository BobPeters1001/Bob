<?php  

require_once("database.php");


     $stmt = $con->prepare("
    SELECT 
      reservering.id,
      reservering.tafelnummer,
      reservering.klantvoornaam,
      reservering.klantachternaam,
      reservering.allergien,
      reservering.nummer,
      


      
      warmedranken.naam AS warmedranken,

      

      koudedranken.naam AS koudedranken

      

    FROM 
      reservering
      LEFT JOIN warmedranken ON reservering.warmedranken_id = warmedranken.id
      
      LEFT JOIN koudedranken ON reservering.koudedranken_id = koudedranken.id
      
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
		
	
		<table class="table table-striped">
			<thead class="table-dark">
				<th>Id</th>
				<th>Tafelnummer</th>
				<th>Voornaam</th>
				<th>Achternaam</th>
				<th>Allergien</th>
				<th>Nummer</th>
				<th>Warme Dranken</th>
				
				<th>Koude Dranken</th>
				
				<th></th>
			</thead>
			<tbody>
				<?php
					foreach($reserveringen as $reservering) {
						echo "<tr>";
						echo "<td>$reservering->id</td>";
						echo "<td>$reservering->tafelnummer</td>";
						echo "<td>$reservering->klantvoornaam</td>";
						echo "<td>$reservering->klantachternaam</td>";
						echo "<td>$reservering->allergien</td>";
						echo "<td>$reservering->nummer</td>";
						echo "<td>$reservering->warmedranken</td>";
						
						echo "<td>$reservering->koudedranken</td>";
						
						echo "<td><a href='index.php?id=$reservering->id'?>Verwijderen</a></td>";
                        echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<a href="barman.php"></a>
	</body>
</html>