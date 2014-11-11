<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function getUniqueFilename()
{
	date_default_timezone_set('UTC');
	return date('Y-m-d-H-i-s') . rand ( 0 , 10000 );
}

