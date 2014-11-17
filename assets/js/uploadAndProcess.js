$(document).ready(function() {
	var f = $('form');
	var r = $('error');
	//var l = $('#loader'); // loder.gif image
	var b = $('#button'); // upload button
	var p = $('#preview'); // preview area
	var imageHTML = {};

	var uploadPicture = function()
	{
		// implement with ajaxForm Plugin
		f.ajaxForm({
			beforeSend: function(){
			//l.show();

			b.attr('disabled', 'disabled');
			p.fadeOut();

      		},
      		success: function(e){
		        //l.hide();
		        f.resetForm();
		        b.removeAttr('disabled');
		      
		        if (e.error == false)
		        {
		        	imageHTML[e.stage] = e.html;

		        	p.html(e.imghtml).fadeIn();

		        	resizePictures();
		        	//p.html("hihi");
		        	FnTPicture(e.sendback);
		        }
		        else
		        {
		        	r.html(e.errorMessage).fadeIn();
		        	b.removeAttr('disabled');
		        }
        
      		},
      		error: function(e){
		        b.removeAttr('disabled');
		        r.html(e).fadeIn();
		        b.removeAttr('disabled');
      		},
      		dataType: 'json'
    	});
	}

	var FnTPicture = function(sendback)
	{
		//var d = {"sendback" : sendback};

		$.ajax({
			type: "POST",
			url: "process/FnT",
			data: sendback,
			beforeSend: function(){
			//l.show();

				b.attr('disabled', 'disabled');
				p.fadeOut();

      		},
			success: function(e){
				p.fadeOut();
				p.html(e).fadeIn();


	  		},
	  		error: function(e){
		        b.removeAttr('disabled');
		        p.html(e).fadeIn();
		        r.html(e).fadeIn();
		        b.removeAttr('disabled');
	  		}//,
		  	//dataType: "json"
		});

	}

	var resizePictures = function()
	{
		var maxSize = 250;

		$('img.resize').each(function(){

			var $img = $(this);

			$img.on('load', function(){

				var scaleFactor = 1;

			    var imgWidth = $img.width();
			    var imgHeight = $img.height();

			    if (maxSize / imgWidth < scaleFactor) scaleFactor = maxSize / imgWidth;
			    if (maxSize / imgHeight < scaleFactor) scaleFactor = maxSize / imgHeight;

			        
			   $img.width(imgWidth * scaleFactor);
			   //$img.height(imgHeight * scaleFactor);
			});

		});
	}

	// Submit picture
	b.click(uploadPicture());




});
