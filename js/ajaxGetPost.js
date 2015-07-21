var base_url="http://localhost:8888/adhandapani/16raagas/16raagas/v1/";
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
	//alert("error");
success.call(this, data);
},
error:function(data){
//alert("Error In Connecting");
alert("Please Check your credentials");
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