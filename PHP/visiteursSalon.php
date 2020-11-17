<!DOCTYPE html>
<html>
	
	<!-- En-tête de la page -->
	
	<head>
		<meta charset="utf-8"/>
		<lang = fr/>
		<link rel="stylesheet" type="text/css" href="../CSS/style.css">
		<script type="text/javascript" src="../JS/gabarit.js"></script>
		
		<!-- Titre de la page -->
		<title>
			Visiteurs Stand
		</title>

	</head>


	<!--Corps de la page-->
	
	<body>



		
		<?php

			require("ConnexionALaBDD.php");

			$maConn = ConnexionBDD();

			echo('
				<form method="POST">
			');

			if(isset($_POST['user'])) {
				$req = '
					SELECT *
						FROM Utilisateur
						WHERE idUtilisateur = '.$_POST['user'].';
				';

				foreach($maConn->query($req) as $row) {
					echo('
						<input type="hidden" name="user" value="'.$_POST['user'].'">
						Bienvenue '.$row['prenomUtilisateur'].' '.$row['nomUtilisateur'].'<br>
						<select name="Salon">
					');
				}

				$req = '
					SELECT *
						FROM Salon
						WHERE idSalon IN(
							SELECT idSalon
								FROM AdminSalon
								WHERE idUtilisateur = '.$_POST['user'].'
						);
				';

				foreach($maConn->query($req) as $row) {
					echo('
						<option value="'.$row['idSalon'].'">'.$row['nomSalon'].'</option>
					');
				}

				echo('
					</select><br>
				');

			} else {
				$req = "
					SELECT *
						FROM Utilisateur;
				";

				echo('
					<select id="user" name="user">
				');
				foreach($maConn->query($req) as $row) {
					echo('
						<option value="'.$row['idUtilisateur'].'">'.$row['nomUtilisateur'].' '.$row['prenomUtilisateur'].'</option>
					');
				}

				echo('
					</select><br>
				');
			}

			echo('
				<input type="submit" name="valider" value="valider">
				<a href="visiteursSalon.php"><input type="button" name="annuler" value="annuler"></a>
				</form>
			');



			if(isset($_POST['Salon'])) {
				$req = '
					SELECT *
						FROM Utilisateur
						WHERE idUtilisateur IN(
							SELECT idUtilisateur
								FROM StockageInfoSalon
								WHERE idSalon = '.$_POST['Salon'].'
						);
				';

				echo('
					<table border="">
						<tr>
							<td>
								Nom
							</td>
							<td>
								Prenom
							</td>
							<td>
								Mail
							</td>
						</tr>
				');

				foreach ($maConn->query($req) as $row) {
					echo('
						<tr>
							<td>
								'.$row['nomUtilisateur'].'
							</td>
							<td>
								'.$row['prenomUtilisateur'].'
							</td>
							<td>
								'.$row['mailUtilisateur'].'
							</td>
					');
				}

				echo('
					</table>
				');
			}

		?>


		<!-- Pied de page -->
		<footer>
			<p>
				Contact
				<ul>
					<li>Gaëtan PIOU</li>
					<li>Email : <a href="mailto: gaetan.piou7@gmail.com">gaetan.piou7@gmail.com</a></li>
					<li>Téléphone : 0781904749</li>
				</ul>
			</p>
		</footer>

	</body>

</html>