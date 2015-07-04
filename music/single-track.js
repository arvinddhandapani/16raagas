/*
	For Edit This File Please Read Documentation
*/

var myPlaylist = [
	{
		mp3:'../../../3.s3.envato.com/files/10407161/preview.mp33',
		oga:'music/5.ogg',
		title:'ok kanmani',
		artist:'A. R. Rahman',
		rating:5,
		buy:'#',
		price:'29.99',
		duration:'5:25',
		cover:'music/5.jpg'	
	}
];
jQuery(document).ready(function ($) {
	$('.music-single').ttwMusicPlayer(myPlaylist, {
		currencySymbol:'<del>&#2352;</del>',
		buyText:'BUY',
		tracksToShow:3,
		ratingCallback:function(index, playlistItem, rating){
			//some logic to process the rating, perhaps through an ajax call
		},
		jPlayer:{
			swfPath:'../../../www.jplayer.org/2.1.0/js'
		},
		autoPlay:true
	});
});