<?php

$TitreOk = false;
$AnnéeOk = false;
$SynopsisOk = false;
$DescriptionOk = false;
$ActeursOk = false;
$FichierOk = false;
$AfficheOk = false;
$formSoumis = false;
$formOk = false;
// Si le formulaire est soumis
if (!empty($_POST)) {
	$formSoumis = true;
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';

	// Traitement des données en POST
	if (isset($_POST['Titre'])) {
		$_POST['Titre'] = strip_tags(strtoupper(trim($_POST['Titre'])));
	}
	if (isset($_POST['Année'])) {
		$_POST['Année'] = strip_tags(trim($_POST['Année']));
	}
	if (isset($_POST['Synopsis'])) {
		$_POST['Synopsis'] = strip_tags(trim($_POST['Synopsis']));
	}
	if (isset($_POST['Description'])) {
		$_POST['Description'] = strip_tags(trim($_POST['Description']));
	}
	if (isset($_POST['Acteurs'])) {
		$_POST['Acteurs'] = strip_tags(trim($_POST['Acteurs']));
	}
	if (isset($_POST['Fichier'])) {
		$_POST['Fichier'] = strip_tags(trim($_POST['Fichier']));
	}
	if (isset($_POST['Affiche'])) {
		$_POST['Affiche'] = strip_tags(trim($_POST['Affiche']));
	}


	// Validation 
	$TitreOk = isset($_POST['Titre']) && strlen($_POST['Titre']) > 1;
	$AnnéeOk = isset($_POST['Année']) && strlen($_POST['Année']) > 3;
	$SynopsisOk = isset($_POST['Synopsis']) && strlen($_POST['Synopsis']) > 1;
	$DescriptionOk = isset($_POST['Description']) && strlen($_POST['Description']) > 1;
	$ActeursOk = isset($_POST['Acteurs']) && strlen($_POST['Acteurs']) > 1;
	$FichierOk = isset($_POST['Fichier']) && strlen($_POST['Fichier']) > 1;
	$AfficheOk = isset($_POST['Affiche']) && strlen($_POST['Affiche']) > 1;
	


	if ($TitreOk && $AnnéeOk && $SynopsisOk && $DescriptionOk && $ActeursOk && $FichierOk && $AfficheOk) {
		$formOk = true;
		//echo 'form Ok<br/>';
		
		$pdo = new PDO('mysql:host=localhost;dbname=gcfl', 'root', 'toto');
		$sql='INSERT INTO film (sup_id,cat_id,fil_titre,fil_annee,fil_affiche,fil_synopsis,fil_acteurs,fil_description,fil_filename) 
		VALUES (1,1,:fil_titre,:fil_annee,:fil_affiche,:fil_synopsis,:fil_acteurs,:fil_description,:fil_filename)';

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':fil_titre',$_POST['Titre'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':fil_annee',$_POST['Année'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':fil_affiche',$_POST['Affiche'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':fil_synopsis',$_POST['Synopsis'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':fil_acteurs',$_POST['Acteurs'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':fil_description',$_POST['Description'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':fil_filename',$_POST['Fichier'], PDO::PARAM_STR);

		$pdoStatement->execute();
		echo "<br/>";
		//print_r($_POST);
		
	}
}

?>

<html>
<head>
	<title>formulaire de films</title>
</head>
<body>
	<?php
	// Si le formulaire est soumis et qu'il est OK
	if ($formSoumis && $formOk) {
		/*	echo 'Titre : '.$_POST['Titre'].'<br />';
			echo 'Année : '.$_POST['Année'].'<br />';
			echo 'Synopsis : '.$_POST['Synopsis'].'<br />';
			echo 'Description : '.$_POST['Description'].'<br />';
			echo 'Acteurs : '.$_POST['Acteurs'].'<br />';
			echo 'Fichier : '.$_POST['Fichier'].'<br />';
			echo 'Affiche : '.$_POST['Affiche'].'<br />';*/
	}
	// Sinon
	else {
	?>
	<h1>Gestion de films</h1>

	<form name="formulaire" action="" method="post">
	<table>
		<tr>
			<td>
				<label></label>
				<input name="Titre" type="text" placeholder="Titre" value="<?php if ($formSoumis) { echo $_POST['Titre']; } ?>"/>
				<?php
				if ($formSoumis && !$TitreOk) {
					echo 'incorrect';
				}
				?><br/>
			</td>
		</tr>	
		<tr>
			<td>
				<label></label>
				<input name="Année" type="text" placeholder="Année" value="<?php if ($formSoumis) { echo $_POST['Année']; } ?>"/>
				<?php
				if ($formSoumis && !$AnnéeOk) {
					echo 'incorrect';
				}
				?><br/>
			</td>
		</tr>	
		<tr>
			<td>
				<label></label> 
				<textarea name="Synopsis" rows="8" cols="45" placeholder="synopsis"><?php if ($formSoumis) { echo $_POST['Synopsis']; } ?></textarea> 
				<?php
				if ($formSoumis && !$SynopsisOk) {
					echo 'incorrect';
				}
				?><br/>
			</td>
		</tr>	
		<tr>
			<td>
				<label></label> 
				<textarea name="Description" rows="8" cols="45" placeholder="description"><?php if ($formSoumis) { echo $_POST['Description']; } ?></textarea> 
				<?php
				if ($formSoumis && !$DescriptionOk) {
					echo 'incorrect';
				}
				?><br/>
			</td>
		</tr>
		<tr>
			<td>
				<label></label>
				<input name="Acteurs" type="text" placeholder="Acteurs" value="<?php if ($formSoumis) { echo $_POST['Acteurs']; } ?>"/>
				<?php
				if ($formSoumis && !$ActeursOk) {
					echo 'incorrect';
				}
				?><br/>
			</td>
		</tr>
		<tr>
			<td>
				<label></label>
				<input name="Fichier" type="text" placeholder="Fichier" value="<?php if ($formSoumis) { echo $_POST['Fichier']; } ?>"/>
				<?php
				if ($formSoumis && !$FichierOk) {
					echo 'incorrect';
				}
				?><br/>
			</td>
		</tr>
		<tr>
			<td>
				<label></label>
				<input name="Affiche" type="text" placeholder="Afffiche" value="<?php if ($formSoumis) { echo $_POST['Afffiche']; } ?>"/>
				<?php
				if ($formSoumis && !$AfficheOk) {
					echo 'incorrect';
				}
				?><br/>
			</td>
		</tr>
		<tr>
			<td>
				<button type="submit">Ajouter</button>
			</td>
		</tr>

	</table>
	</form>

</body>
<?php
}
?>
</html>