<!DOCTYPE html>
<html lang="fr">
<!-- <script>
	function getEC(){
		var ecnum1 = document.getElementById("ec1").value;
		var ecnum2 = document.getElementById("ec2").value;
		var ecnum3 = document.getElementById("ec3").value;
		var ecnum4 = document.getElementById("ec4").value;
		document.getElementById("ecnum1").innerHTML = ecnum1;
		document.getElementById("ecnum2").innerHTML = ecnum2;
		document.getElementById("ecnum3").innerHTML = ecnum3;
		document.getElementById("ecnum4").innerHTML = ecnum4;
}
</script> -->


	<body class = "rechch">		
		
		<?php
		session_start();
		$titre = "Recherche Simple";
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		echo '<h1>Recherche Simple</h1>';
		if ($id == 0) erreur(ERR_IS_NOT_CO);

		?>

		<div id="corps">
					<div id="form">
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" oninput="getEC()">


						<label for="ec">EC Number</label> </br>
								  <input type="number" name="ec1" id="ec1" style=" width:110px;
								    text-align:center; height:45px;font-size:20pt;" maxlength="15"
								 size="6" value="<?php echo isset($_POST['ec1']) ? $_POST['ec1'] : '' ?>">
  								-  <input type="number"  name="ec2" id="ec2" style=" width:110px; text-align:center; height:45px;font-size:20pt;" maxlength="15" size="6" value="<?php echo isset($_POST['ec2']) ? $_POST['ec2'] : '' ?>" >
  								-  <input type="number"  name="ec3" id="ec3" style=" width:110px; text-align:center; height:45px;font-size:20pt;" maxlength="15" size="6" value="<?php echo isset($_POST['ec3']) ? $_POST['ec3'] : '' ?>" >
  								-  <input type="number"  name="ec4" id="ec4" style=" width:110px; text-align:center; height:45px;font-size:20pt;" maxlength="15" size="6" value="<?php echo isset($_POST['ec4']) ? $_POST['ec4'] : '' ?>" >

							</br></br>

<!-- 							<p id="ecnum1"></p>
							<p id="ecnum2"></p>
							<p id="ecnum3"></p>
							<p id="ecnum4"></p> -->

							


							<label for="a_name">Accepted Name</label> </br> <input name="a_name" list="a_name" style=" width:450px; height:45px;font-size:20pt;" maxlength="15" size="6" value="<?php echo isset($_POST['a_name']) ? $_POST['a_name'] : '' ?>" >

							<?php
							echo '<datalist id="a_name">';
								$query_an = $db->prepare('SELECT accepted_name FROM enzyme');
								$query_an->execute();
								$result_an = $query_an->fetchAll(PDO::FETCH_ASSOC);
								foreach ($result_an as $row_an) {
									echo "<option value='".$row_an['accepted_name']. "'>";
								}
							echo '</datalist></br></br>';
							?>




							<label for="s_name">Systematic Name</label> </br> <input name="s_name" list="s_name" style=" width:450px; height:45px;font-size:20pt;" maxlength="15" size="6" value="<?php echo isset($_POST['s_name']) ? $_POST['s_name'] : '' ?>">

							<?php
							echo '<datalist id="s_name">';
								$query_sn = $db->prepare('SELECT systematic_name FROM enzyme');
								$query_sn->execute();
								$result_sn = $query_sn->fetchAll(PDO::FETCH_ASSOC);
								foreach ($result_sn as $row_sn) {
									echo "<option value='".$row_sn['systematic_name']. "'>";
								}
							echo '</datalist></br></br>';
							?>





							<label for="cofactors">Cofactors</label> </br> <input name="cofactors" list="cofactors" style=" width:450px; height:45px;font-size:20pt;" maxlength="15" size="6" value="<?php echo isset($_POST['cofactors']) ? $_POST['cofactors'] : '' ?>">

							<?php
							echo '<datalist id="cofactors">';
								$query_co = $db->prepare('SELECT cofactors FROM enzyme');
								$query_co->execute();
								$result_co = $query_co->fetchAll(PDO::FETCH_ASSOC);
								foreach ($result_co as $row_co) {
									echo "<option value='".$row_co['cofactors']. "'>";
								}
							echo '</datalist></br></br>';

							echo '<input type="submit" value="Recherche" />';

						echo '</form>
					</div>
			</div>';

					

			$ec1=$_POST['ec1'];
			$ec2=$_POST['ec2'];
			$ec3=$_POST['ec3'];
			$ec4=$_POST['ec4'];
			$a_name = $_POST['a_name'];
			$s_name = $_POST['s_name'];
			$cofactors = $_POST['cofactors'];

			$q_sql = "SELECT * FROM enzyme ";
			if ($ec1 | $ec2 | $ec3 | $ec4 | $a_name | $s_name | $cofactors) {
				$q_sql=$q_sql."WHERE ";
				if ($ec1){
					$q_sql=$q_sql."ec1='$ec1' ";
					if ($ec2 | $ec3 | $ec4 | $a_name | $s_name | $cofactors) {
						$q_sql=$q_sql."AND ";
					}
				}
				if ($ec2){
					$q_sql=$q_sql."ec2='$ec2' ";
					if ($ec3 | $ec4 | $a_name | $s_name | $cofactors) {
						$q_sql=$q_sql."AND ";
					}
				}
				if ($ec3){
					$q_sql=$q_sql."ec3='$ec3' ";
					if ($ec4 | $a_name | $s_name | $cofactors) {
						$q_sql=$q_sql."AND ";
					}
				}
				if ($ec4){
					$q_sql=$q_sql."ec4='$ec4' ";
					if ($a_name | $s_name | $cofactors) {
						$q_sql=$q_sql."AND ";
					}
				}
				if ($a_name){
					$q_sql=$q_sql."accepted_name='$a_name' ";
					if ($s_name | $cofactors) {
						$q_sql=$q_sql."AND ";
					}
				}
				if ($s_name){
					$q_sql=$q_sql."systematic_name='$s_name' ";
					if ($cofactors) {
						$q_sql=$q_sql."AND ";
					}
				}
				if ($cofactors){
					$q_sql=$q_sql."cofactors='$cofactors' ";
				}
			}
			echo $q_sql."</br></br>";

			if ($q_sql != "SELECT * FROM enzyme "){
				$query = $db->query($q_sql); // Run your query

				// Loop through the query results, outputing the options one by one

				$res = '';
				while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
					$res = $res.'
				   	<tr>

				       <td>'.$row['ec1']."-".$row['ec2']."-".$row['ec3']."-".$row['ec4'].'</td>

				       <td>'.$row['accepted_name'].'</td>

				       <td>'.$row['systematic_name'].'</td>

				       <td>'.$row['cofactors'].'</td>

				   </tr>';			
				}

				if ($res!='') {
					echo '<table> 
				<tr>
					<td>EC Number</td>
					<td>Accepted Names</td>
					<td>Systematic Names</td>
					<td>Cofactors</td>
				</tr>';
					echo $res;
					echo '</table>';
				}
				else{
					echo 'Querry returned nothing';
				}	
			}
		?>
	</body>
</html>