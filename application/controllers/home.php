<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);

class Home extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		echo "HOME";

		return false;
	}

}