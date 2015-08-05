var base_url="http://localhost:8888/adhandapani/16raagas/16raagas/v1/";
//var base_url="http://16raagas.com/beta/v1/";
function post_ajax_data(url,encodedata, success)

{
$.ajax({
type:"POST",
url:url,
data :encodedata,
dataType:"json",
restful:true,
//contentType: 'application/json',
contentType: 'application/x-www-form-urlencoded',
cache:false,
timeout:20000,
async:true,
beforeSend :function(data) { },
success:function(data){
success.call(this, data);
},
error:function(data){
alert("Internal Server Error");
}
});
}


function post_ajax_data_header(url,encodedata, headerraagas, session_email_16raagas, success)

{
	var finalurl = base_url+url;
$.ajax({
type:"POST",
url:finalurl,
	headers: {'X-Sngauth': headerraagas,
	'X-Snguname': session_email_16raagas},
data :encodedata,
dataType:"json",
restful:true,
//contentType: 'application/json',
contentType: 'application/x-www-form-urlencoded',
cache:false,
timeout:20000,
async:true,
beforeSend :function(data) { },
success:function(data){
success.call(this, data);
},
error:function(data){
alert("Internal Server Error");
}
});
}





function ajax_data(type,url, success)
{
var data = "";
$.ajax({
type:type,
url:url,
dataType:"json",
contentType: 'application/json',
restful:true,
cache:false,
timeout:20000,
async:true,
beforeSend :function(data) { },
success:function(data){
	//console.log(data.tasks[0]);
success.call(this, data);
},
error:function(data){
alert(data);
}
});
}

function test_ajax_data(type,url, success)
{
	var finalurl = base_url+url;
var data = "";
$.ajax({
type:type,
url:finalurl,
dataType:"json",
contentType: 'application/json',
restful:true,
cache:false,
timeout:20000,
async:true,
beforeSend :function(data) { },
success:function(data){
	//console.log(data.tasks[0]);
success.call(this, data);
},
error:function(data){
alert(data);
}
});
}