<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Fold and Tilt!</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/CI.css">

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/uploadAndProcess.js"></script>


</head>
<body>

<div id="container">
	<h1>Welcome to Fold and Tilt!</h1>
	<p class="timid">Yes, I did totally steal the CI stylesheet!</p>
	<div id="body">

		<form id="form" action="process/upload" method="post" enctype="multipart/form-data">
		  <input id="uploadImage" type="file"  name="image" />
		  <input id="button" type="submit" value="Upload">
		</form>

		<span id="error"></span>
		<span id="preview"></span>

	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>