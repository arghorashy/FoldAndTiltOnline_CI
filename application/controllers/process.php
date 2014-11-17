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

	//$valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
	//$max_size = 200 * 1024; // max file size

	
	public $path = 'uploads/'; // upload directory

	public function upload()
	{
		$data = array("stage" => "upload");



		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		  if( ! empty($_FILES['image']) ) 
		  {
		    // get uploaded file extension
		    //$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		    // looking for format and size validity
		    //if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size) {
		      //$path = $path . uniqid(). '.' .$ext;
		      // move uploaded file from temp to uploads directory
		  	
		  	$basename = getUniqueFilename();
		  	$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		  	$newimgpath = $this->path . $basename . "." . $ext;
		  	$imgurl = base_url() . $newimgpath;
		    if (move_uploaded_file($_FILES['image']['tmp_name'], $newimgpath)) 
		    {
		    	$data["imgurl"] = $imgurl;
		    	$data["sendback"] = array("basename" => $basename, "ext" => $ext);
		    }
		    else 
		    {
		      	$data["error"] = 'Upload failed! Could not copy file from temporary location!';
		    }
		  } 
		  else 
		  {
		    $data["error"] = 'Upload failed! No file received!';
		  }
		} 
		else 
		{
		  	$data["error"] = 'Bad request!  Expected POST request.';
		}
		$this->load->view('json_processProgress', $data);

	}

	public function FnT()
	{
		$data = array("stage" => "FnT");

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		  	$basename = $_POST['basename'];
		  	$ext = $_POST['ext'];
		  	$imgpath = $this->path . $basename . "." . $ext;
		  	$imgurl = base_url() . $imgpath;

		  	$plusimgpath = $this->path . $basename . "plus." . $ext;
		  	$plusimgurl = base_url() . $plusimgpath;

		  	$minusimgpath = $this->path . $basename . "minus." . $ext;
		  	$minusimgurl = base_url() . $minusimgpath;

		  	$outplus = array();
		  	$outminus = array();


			exec("cd bin/foldandtilt; ./FoldnTilt ../../$imgpath ../../$minusimgpath -100 false", $outminus);

			exec("cd bin/foldandtilt; ./FoldnTilt ../../$imgpath ../../$plusimgpath 100 false", $outplus);

			//echo json_encode($_POST);
			$errors = "";
			if (count($outminus) != 0)
			{
				$errors = $errors . "Minus Warp Errors:\n" . join("\n",$outminus) . "\n\n";
			} 
			if (count($outplus) != 0)
			{
				$errors = $errors . "Plus Warp Errors:\n" . join("\n",$outplus) . "\n\n";
			}
			
			if ($errors != "")
			{
				$data["error"] = $errors;
			}
			else
			{
				$data["plusimgurl"] = $plusimgurl;
				$data["minusimgurl"] = $minusimgurl;
			}

		}
		else
		{
			$data["error"] = 'Bad request!  Expected POST request.';
		}

		$this->load->view('json_processProgress', $data);
	}


		  	// call program
		//   if( ! empty($_FILES['image']) ) 
		//   {
		//     // get uploaded file extension
		//     //$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		//     // looking for format and size validity
		//     //if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size) {
		//       //$path = $path . uniqid(). '.' .$ext;
		//       // move uploaded file from temp to uploads directory
		  
		//   	$newimgpath = $path . getUniqueFilename() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		//   	$imgurl = base_url() . $newimgpath;
		//     if (move_uploaded_file($_FILES['image']['tmp_name'], $newimgpath)) 
		//     {
		//     	$data["imgurl"] = $imgurl;
		//     	$data["origImgPath"] = $newimgpath;
		//     }
		//     else 
		//     {
		//       	$data["error"] = 'Upload failed! Could not copy file from temporary location!';
		//     }
		//   } 
		//   else 
		//   {
		//     $data["error"] = 'Upload failed! No file received!';
		//   }
		// } 
		// else 
		// {
		//   	
		// }
		// $this->load->view('json_processProgress', $data);
		

	

}

