<?php

class Model_tweet extends MY_Model{

	public function __construct()
	{
		$this->table = 'api_tweet';
        $this->primary_key = 'id';
        $this->return_type="array";
        $this->timestamps = false;
        
        parent::__construct();
	}
}