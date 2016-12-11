<?php include_once("fct.inc.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
	<meta charset="UTF-8">
	<title>Lecture d'un flux RSS facebook</title>
	<link rel="stylesheet" href="style.css" />
    </head>
    <body class="gradient">
        <?php
        	$fluxFB = get_flux_rss_fb();
		$maxCount = 4;
		$counter = 0;
   	?>
        <div class="postFB">
		<h1>Flux RSS Facebook</h1>
		<br /><br /><br />
		<?php
			if (!empty($fluxFB->channel->item)){
				foreach($fluxFB->channel->item as $item){
					if($counter == $maxCount){ break;} // on arrete la boucle

					// récupérer mes infos
					echo "<p class='titre'>".$item->title."</p>";
					echo "<p class='date'>".date2fb($item->pubDate)."</p>";
					echo "<p class='content'>".$item->description."</p>";

					$counter++;
				}
			}
		?>
        </div>
    </body>
</html>

