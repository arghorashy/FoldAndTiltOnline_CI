<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function upload()
	{
		//$valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		//$max_size = 200 * 1024; // max file size
		$path = 'uploads/'; // upload directory

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		  if( ! empty($_FILES['image']) ) 
		  {
		    // get uploaded file extension
		    //$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		    // looking for format and size validity
		    //if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size) {
		      //$path = $path . uniqid(). '.' .$ext;
		      // move uploaded file from temp to uploads directory
		  
		  	$newimgpath = $path . basename($_FILES['image']['name']);
		  	$imgurl = base_url() . $newimgpath;
		    if (move_uploaded_file($_FILES['image']['tmp_name'], $newimgpath)) 
		    {
		    	echo "<img src='$imgurl' />";
		    }
		    else 
		    {
		      echo 'Invalid file!';
		    }
		  } 
		  else 
		  {
		    echo 'File not uploaded!';
		  }
		} 
		else 
		{
		  echo 'Bad request!';
		}



		echo "hihihihi";
	}
}