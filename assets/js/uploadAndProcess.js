$(document).ready(function() {
	var f = $('form');
	//var l = $('#loader'); // loder.gif image
	var b = $('#button'); // upload button
	var p = $('#preview'); // preview area
	var r = $('#error');
	var imageHTML = "";

	var uploadPicture = function()
	{
		// implement with ajaxForm Plugin
		f.ajaxForm({
			beforeSend: function(){
			//l.show();
				// Form: N/A

				// Button: disable
				b.attr('disabled', 'disabled');

				// Preview: erase and fadeout
				p.html("").fadeOut();

				// Error: erase and fadeout
				r.html("").fadeOut();

      		},
      		success: function(e){
		        //l.hide();
		      
		        if (e.error == false)	// Real success
		        {
		        	// Form: Reset
		        	f.resetForm();

		        	// Button: N/A

		        	//Preview: show
		        	imageHTML = e.imghtml + "";
		        	p.html(e.imghtml).fadeIn();
		        	resizePictures();

		        	// Error: N/A

		        	FnTPicture(e.sendback);
		        }
		        else
		        {
		        	// Form: N/A

		        	// Button: enable 
		        	b.removeAttr('disabled');

		        	// Preview: fadein empty
		        	p.html("").fadeIn();

		        	// Error: show
		        	r.html(e.errorMessage).fadeIn();
		        	
		        }
        
      		},
      		error: function(e)
      		{
      			// Form: N/A

      			// Button: enable 
      			b.removeAttr('disabled');

      			// Preview: fadein empty
      			p.html("").fadeIn();

      			// Error: show
		        r.html(e).fadeIn();
		        
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

      			// Form: N/A

      			// Button: N/A

      			// Preview: N/A

      			// Error: N/A
      		},
			success: function(e){
				if (e.error == false)	// Real success
			    {
					// Form: N/A

					// Button: enable 
					b.removeAttr('disabled');

					// Preview: fade in and out, to show new
					imageHTML = imageHTML + e.imgplushtml + e.imgminushtml;
					p.fadeOut(function(){
						p.html(imageHTML).fadeIn();
						resizePictures();
					});
					
					

					// Error: fade in empty
					r.html("").fadeIn();
				}
				if (e.error == true)	// Real success
			    {
					// Form: N/A

					// Button: enable 
					b.removeAttr('disabled');

					// Preview: fade in, if not showing
			        p.fadeIn();

					// Error: fade in empty
					r.html(e.errorMessage).fadeIn();
				}

	  		},
	  		error: function(e){
				// Form: N/A

				// Button: enable
				b.removeAttr('disabled');

				// Preview: fade in, if not showing
		        p.fadeIn();

		        // Error: show
		        r.html(e).fadeIn();
		        
	  		},
		  	dataType: "json"
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
