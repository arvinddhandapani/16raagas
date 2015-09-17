<script src="news/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="news/jquery.easing.min.js"></script>
<script type="text/javascript" src="news/jquery.easy-ticker.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	var dd = $('.vticker').easyTicker({
		direction: 'up',
		easing: 'easeInOutBack',
		speed: 'slow',
		interval: 2000,
		height: 'auto',
		visible: 0,
		mousePause: 0,
	}).data('easyTicker');
	
	cc = 1;
	$('.aa').click(function(){
		$('.vticker ul').append('<li>' + cc + ' Triangles can be made easily using CSS also without any images. This trick requires only div tags and some</li>');
		cc++;
	});
	
});
</script>

<style>
.vticker{
	width: 270px;
}
.vticker ul{
	padding: 0;
}
.vticker li{
	list-style: none;
	border-bottom: 1px solid lightBlue;
	padding: 10px;
}
.et-run{
	background: red;
}
</style>

<div class="vticker">
	<ul>
		<li>Triangles can be made easily using CSS also without any images. This trick requires only div tags and some CSS works. To get this trick, just use the code below.</li>
		<li>List 2</li>
		<li>List 3</li>
		<li>List 4</li>
		<li>List 5 </li>
		<li class="ww">Hey... Triangles can be made easily using CSS also without any images. This trick requires only div tags and some CSS works. To get this trick, just use the code below.</li>
	</ul>
</div>