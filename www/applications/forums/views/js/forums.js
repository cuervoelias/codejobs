$(document).on("ready", function() {
	$("#ftags").hide();
	$("#fcontent").hide();
	$("#fpublish").hide();
	$("#fcancel").hide();

	$("#ftitle").on("focus", function() {
		$("#ftags").show();
		$("#fcontent").show();
		$("#fpublish").show();
		$("#fcancel").show();
	});

	$("#cpublish").on("click", function() {
		var content = $('#ccontent').val();
		var fid = $('#fid').val();

		if(content != '' && fid > 0) {
			var newPost = '';

			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/publishComment',
				dataType: 'json',
				data: 'fid=' + fid + '&content=' + content,
				success: function(response) {	
					console.log(response);							
				}
			});
		}
	});

	$("#fpublish").on("click", function() {
		var fid = $("#fid").val();
		var forumName = $("#fname").val();
		var title = $("#ftitle").val();
		var tags = $("#ftags").val();
		var content = $("#fcontent").val();

		var needTitle = '<div id="alert-message" class="alert alert-error">' + $("#needtitle").val() + '</div>';
		var needContent = '<div id="alert-message" class="alert alert-error">' + $("#needcontent").val() + '</div>';
		var needTags = '<div id="alert-message" class="alert alert-error">' + $("#needtags").val() + '</div>';			
				
		if(tags == $("#ftags-temp").val()) {
			tags = "";
		}

		if(title.length == 0 || title == $("#ftitle-temp").val()) { 
			$("#fmessage").html(needTitle);
		} else if(content.length == 0 || content == $("#fcontent-temp").val()) { 
			$("#fmessage").html(needContent);
		} else if(tags.length == 0 || tags == $("#ftags-temp").val()) { 
			$("#fmessage").html(needTags);
		} else {
			var newPost = '';

			$.ajax({
				type: 'POST',
				url:   PATH + '/forums/publish',
				dataType: 'json',
				data: 'title=' + title + '&content=' + content + '&tags=' + tags + '&forumID=' + fid + '&fname=' + forumName,
				success: function(response) {	
					console.log(response);				
					$("#fmessage").html(response.alert);
					var oldPosts = $("#fposts").html();

					newPost = newPost + '<div class="post">';
					newPost = newPost + '	<div class="post-title">';
					newPost = newPost + '		' + response.title;
					newPost = newPost + '	</div>';
					newPost = newPost + '	<div class="post-left">';
					newPost = newPost + '		' + response.date;
					newPost = newPost + '	</div>';
					newPost = newPost + '	<div class="clear">';
					newPost = newPost + '		' + response.description;
					newPost = newPost + '   </div>';
					newPost = newPost + '</div>';

					$("#fposts").html(newPost + oldPosts);	

					$("#ftitle").val($("#ftitle-temp").val());
					$("#ftags").val($("#ftags-temp").val());
					
					$("#ftags").hide();
					$("#fcontent").hide();
					$("#fpublish").hide();
					$("#fcancel").hide();				
				}
			});
		}
	});

	$("#fcancel").on("click", function() {
		$("#ftitle").val($("#ftitle-temp").val());

		$("#ftags").val($("#ftags-temp").val());
		
		$("#ftags").hide();
		$("#fcontent").hide();
		$("#fpublish").hide();
		$("#fcancel").hide();
	});
});