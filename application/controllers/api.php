<?php

require APPPATH."/libraries/REST_Controller.php";

class Api extends REST_Controller{
	function __constructor(){
		parent::__constructor();

	}

	public function tweet_get(){
		$this->load->model("Model_tweet");
		$usuario_search = $this->uri->segment(3);

		$this->Model_tweet->primary_key="usuario";
		$items = $this->Model_tweet->get($usuario_search);

		$request_response = array();
		$request_response['status'] = "success";

		if (count($items) >0) {
			$request_response['message'] = $items;
		}else{
			$request_response['message'] = null;
		}

		$this->response($request_response);
	}

	public function tweet_post(){
		$this->load->model("Model_tweet");
		$this->load->library("Form_validation");

		$this->form_validation->set_data($this->put());

		if ($this->form_validation->run('tweet_put') !=false) {
				
				$item = $this->post();
				
				$id = $this->Model_tweet->insert($item);

				if(!$id){
					$request_response = array();
					$request_response['status'] = "failure";
					$request_response['message'] = "Especifique ID";

					$this->response($request_response,REST_Controller::HTTP_BAD_REQUEST);

				}else{
					$request_response = array();
					$request_response['status'] = "success";
					$request_response['message'] = 'created';

					$this->response($request_response);
				}

		}else{
			$this->response(array('status' =>'failure', 'message'=>$this->form_validation->get_errors_as_array()), REST_Controller::HTTP_BAD_REQUEST);
		}


	}


}