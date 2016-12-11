// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//	after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		height: '390',
		width: '640',
		videoId: '-T7wN8eMMUI',
		playerVars: {
			autoplay: 1,
			controls: 1,
			showinfo: 0,
			theme: 'light'
		},
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
	event.target.playVideo();
}

// 5. The API calls this function when the player's state changes.
//	The function indicates that when playing a video (state=1),
//	the player should play for six seconds and then stop.
var done = false;
function onPlayerStateChange(event) {
	if (event.data == YT.PlayerState.PLAYING && !done) {
		//setTimeout(stopVideo);
		//setTimeout(pauseVideo, 3000);
		//setTimeout(seekTo);
		setTimeout(mute);
		done = true;
	}
}
function stopVideo() {
	player.stopVideo(); // stop la vidéo
}
function pauseVideo() {
	player.pauseVideo(); // Met la vidéo en pause
}
function seekTo() {
	player.seekTo(15, true); // La vidéo se met à sa 15eme seconde
}
function mute() {
	player.mute(); // enlève le son
}
function unmute() {
	player.unmute(); // met le son
}
