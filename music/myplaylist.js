/*
	For Edit This File Please Read Documentation
*/

var myPlaylist = [
	
	{
		mp3:'music/1.Mental Manadhil.mp3',
		// oga:'music/5.ogg',
		title:'ok kanmani',
		artist:'A. R. Rahman',
		rating:5,
		buy:'#',
		price:' 5',
		duration:'5:25',
		cover:'music/5.jpg'	
	},
	{
		mp3:'music/2.Loveaa Loveaa.mp3',
		// oga:'music/4.ogg',
		title:'Uttama Villain',
		artist:'Mohamaad Ghibran',
		rating:4,
		buy:'#',
		price:' 6',
		duration:'2:51',
		cover:'music/4.jpg'	
	},		
	{
		mp3:'http://1.s3.envato.com/files/54821639/preview.mp3',
		oga:'music/1.ogg',
		title:'Masss',
		artist:'Yuvan Shankar Raja',
		rating:5,
		buy:'#',
		price:' 7',
		duration:'4:29',
		cover:'music/1.jpg'
	},
	{
		mp3:'http://2.s3.envato.com/files/62716273/preview.mp3',
		oga:'music/6.ogg',
		title:'A Happy Carefree Day',
		artist:'JoshKramerMusic',
		rating:5,
		buy:'#',
		price:' 3',
		duration:'2:45',
		cover:'music/6.jpg'	
	},
	{
		mp3:'http://3.s3.envato.com/files/41975807/preview.mp3',
		oga:'music/2.ogg',
		title:'Anegan',
		artist:'Harris Jayaraj',
		rating:4,
		buy:'#',
		price:'5',
		duration:'5:56',
		cover:'music/2.jpg'	
	},
	{
		mp3:'http://3.s3.envato.com/files/2229255/preview.mp3',
		oga:'music/3.ogg',
		title:'Enakkul Oruvan',
		artist:'Santhosh Narayanan',
		rating:5,
		buy:'#',
		price:' 4',
		duration:'2:31',
		cover:'music/3.jpg'	
	}
];
jQuery(document).ready(function ($) {
	$('.music-player-list').ttwMusicPlayer(myPlaylist, {
		currencySymbol:'<del>&#2352;</del>',
		buyText:'BUY',
		tracksToShow:3,
		ratingCallback:function(index, playlistItem, rating){
			//some logic to process the rating, perhaps through an ajax call
		},
		jPlayer:{
			swfPath:'http://www.jplayer.org/2.1.0/js'
		},
		autoPlay:true
	});
});