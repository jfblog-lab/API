<?php

function get_flux_rss_fb(){
	$URL_FLUX = 'http://www.facebook.com/feeds/page.php?id=92270828609&format=rss20';
	$CACHE_FILE = 'fbflux.xml';
	$CACHE_TTL = 24*3600; // durée cache : 24h

	$filemtime = 0;

	if(file_exists($CACHE_FILE)){
		$filemtime = filemtime($CACHE_FILE);
	}

	if($filemtime > time() - $CACHE_TTL){
		$xml = simplexml_load_file($CACHE_FILE, 'simpleXMLElement',LIBXML_NOCDATA);
		return $xml;
	}

	//création d'un contexte de lecture de flux
	$opts = array(
		'http'=>array(
			'method'=>"GET",
			'header'=>"Accept-language: en\r\n" .
			"User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36\r\n"
		)
	);

	$context = stream_context_create($opts);

	$feed_contents = file_get_contents($URL_FLUX, false, $context);

	// erreur de lecture du flux
	if (false == $feed_contents){
		return simplexml_load_file($CACHE_FILE, 'simpleXMLElement',LIBXML_NOCDATA);
	}

	file_put_contents($CACHE_FILE, $feed_contents);

	return simplexml_load_string($feed_contents, 'simpleXMLElement',LIBXML_NOCDATA);
}

function date2fb($date){
	$dateTab = explode(' ',$date);
	$horaire = explode(':', $dateTab["4"]);
	
	// Mois en français
	switch ($dateTab["2"]){
		case "Jan":
			$chiffre = "1";
			$mois = "Janvier";
			break;
		case "Fev":
			$chiffre = "2";
			$mois = "Février";
			break;
		case "Mar":
			$chiffre = "3";
			$mois = "Mars";
			break;
		case "Apr":
			$chiffre = "4";
			$mois = "Avril";
			break;
		case "May":
			$chiffre = "5";
			$mois = "Mai";
			break;
		case "Jun":
			$chiffre = "6";
			$mois = "Juin";
			break;
		case "Jul":
			$chiffre = "7";
			$mois = "Juillet";
			break;
		case "Aug":
			$chiffre = "8";
			$mois = "Aout";
			break;
		case "Sep":
			$chiffre = "9";
			$mois = "Septembre";
			break;
		case "Oct":
			$chiffre = "10";
			$mois = "Octobre";
			break;
		case "Nov":
			$chiffre = "11";
			$mois = "Novembre";
			break;
		case "Dec":
			$chiffre = "12";
			$mois = "Décembre";
			break;
		default;
			echo "Erreur...";
	}

	// jour de la semaine
	$jour_fr = array ("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
	$timestamp = mktime(0,0,0, $chiffre,$dateTab["1"],$dateTab["3"] );
	$wd = date("w", $timestamp);
	$str_dat = $jour_fr[$wd];

	//format finale de la date
	$date = $str_dat." ".$dateTab["1"]." ".$mois." ".$dateTab["3"].", ".$horaire[0].":".$horaire[1];

	return $date;
}

?>
