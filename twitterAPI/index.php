<?php include "library/twitteroauth.php"; ?>

<?php
	$ConsumerKey = "h7r69apmQFv41mKkzPsFw";
	$ConsumerSecret = "cyrhNdT1lp17XTfCXyIDJluGVg7nLW7MlHPKFdFhYHY";
	$AccessToken = "369054763-tGDLS0WElEgV8OOCtX3Pu7JL7rlak1qGIqoRZshK";
	$AccessTokenSecret = "GeiD1UogmXTLLzNCJnxfdc7VPqxYczdnZYBwmBIBxoHiZ";
	
	$twitter = new TwitterOAuth($ConsumerKey, $ConsumerSecret, $AccessToken, $AccessTokenSecret);
	
	if(isset($_POST['keywords'])){
		$keywords = $_POST['keywords'];
		$nbTweet = $_POST['nbTweet'];
		
		if(empty($nbTweet)){
			$nbTweet = 10;
		}
		
		$tweets = $twitter->get("https://api.twitter.com/1.1/search/tweets.json?q=".$keywords."&result_type=recent&count=".$nbTweet);
	}
?>

<!DOCTYPE html>
<html>
	<head>
	        <meta charset="utf-8" />
	        <title>Twitter et Json</title>
		<link href="common/css/reset.css" rel="stylesheet">
		<link href="common/css/style.css" rel="stylesheet">
		
	</head>

	<body>
		<div id="resultat">
			<form action="" method="post">
				<label>Mots-clés* : </label><input type="text" name="keywords" /><br />
				<label>Nombre de tweets : </label><input type="text" name="nbTweet" /><br />
				<input type="submit" name="OK" />
			</form>
			<hr>
			<?php
				if(isset($_POST['keywords'])):
				foreach($tweets->statuses as $tweet):
			?>
			
			<p class="tweet">
				<img src="<?php echo $tweet->user->profile_image_url; ?>" alt="user picture" />
				<span><?php echo $tweet->text; ?></span>
			</p>
			
			<?php
				endforeach;
				else:
			?>
			<p>Veuillez remplir le formulaire</p>
			<?php
				endif;
			?>
		</div>
	</body>
</html>
