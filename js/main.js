$(document).ready(function() {
	$('#btnPost').click(function (event) {
		event.preventDefault();
	});
});



function ShowCommentArea(i)
{
	
	document.getElementById("div_" + i.toString()).style.display="block";
}

function DeleteComment(i)
{
	$.ajax({
             
             type: 'POST',
             url: 'https://r-rp.su/testik/ajaxhandler.php',
             data: { 'type': "del", 'id': i },
             success: function(d) 
             {
				 if(d != 1) return;
				 else document.getElementById("maindiv_" + i.toString()).innerHTML = "";
			 }
	})
}

function NewComment(i)
{
	var data = JSON.stringify($('#textarea_' + i.toString()).val());
	var lvl = $('#maindiv_' + i).attr('class');
	if(lvl[4] == 5)
	{
		return alert("Нельзя добавлять комменты к 5 уровню, это костыленко");
	}
	$.ajax({
             
             type: 'POST',
             url: 'https://r-rp.su/testik/ajaxhandler.php',
             data: { 'type': "comment", 'data': data, 'parent': i, 'lvl': parseInt(lvl[4]) + 1},
			 beforeSend: function()
			 {
				 $('#comwrapper').html("");
			 },
             success: function(d) 
             {
				 alert(d);
				 if(d == false) return false;
				 else 
				 {
					 $('#textAreaNewComment').Text = "";
					 $('#comwrapper').html(d);
					 
				 }
			 }
	});
}


function NewPost()
{
	
	var data = JSON.stringify($('#textAreaNewComment').val());
	
	$.ajax({
             
             type: 'POST',
             url: 'https://r-rp.su/testik/ajaxhandler.php',
             data: { 'type': "post", 'data': data },
			 beforeSend: function()
			 {
				 $('#comwrapper').html("");
			 },
             success: function(d) 
             {
				 alert(d);
				 if(d == false) return false;
				 else 
				 {
					 $('#textAreaNewComment').Text = "";
					 $('#comwrapper').html(d);
					 
				 }
			 }
	});
}