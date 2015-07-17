/*
	For Edit This File Please Read Documentation
*/

var myPlaylist = [
	{
		mp3:'music/Bagulu Odayum Dagulu Mari.mp3',
		oga:'music/5.ogg',
		title:'ok kanmani',
		artist:'A. R. Rahman',
		rating:5,
		buy:'#',
		price:'29.99',
		duration:'03.25',
		cover:'music/maari.jpg'	
	},
	{
		mp3:'music/Don\'u Don\'u Don\'u.mp3',
		oga:'music/5.ogg',
		title:'Love ah',
		artist:'A. R. Rahman',
		rating:5,
		buy:'#',
		price:'10.99',
		duration:'02.25',
		cover:'music/maari.jpg'	
	}
];
jQuery(document).ready(function ($) {
	$('.music-single').ttwMusicPlayer(myPlaylist, {
		currencySymbol:'<del>&#2352;</del>',
		buyText:'Add to Cart',
		tracksToShow:3,
		ratingCallback:function(index, playlistItem, rating){
			//some logic to process the rating, perhaps through an ajax call
		},
		jPlayer:{
			swfPath:'../../../www.jplayer.org/2.1.0/js'
		},
		autoPlay:false
	});
});