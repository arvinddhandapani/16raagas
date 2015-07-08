function post_ajax_data(url,encodedata, success)
{
$.ajax({
type:"POST",
url:url,
data :encodedata,
dataType:"json",
restful:true,
contentType: 'application/json',
cache:false,
timeout:20000,
async:true,
beforeSend :function(data) { },
success:function(data){
success.call(this, data);
},
error:function(data){
alert("Error In Connecting");
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

//function ajax_data(type,url, success)
//{
//$.ajax({
  //  type: type,
   // url: url,
   // data: { },
   // success: function(response) {
//	}
        //do whatever you want here, response has your JSON array
 //   });
 //}