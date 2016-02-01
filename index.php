<?php

require 'inc/config.php';

require 'html/header.php';
?>

<section>
	<form action="catalogue.php" method="get">
		<input type ="text" name ="q" value =""/>
		<input type ="submit" value="Rechercher"/>
		
	</form>
</section>

<?phprequire 'html/footer.php';