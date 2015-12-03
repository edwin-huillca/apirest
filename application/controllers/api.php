<?php
/*
REFERENCIA:
https://github.com/avenirer/CodeIgniter-MY_Model/blob/version-3.0/core/MY_Model.php

Los principios REST proveen estrategias para manejar acciones CRUD usando métodos HTTP relacionados de la siguiente forma:
GET /tickets- Devuelve una lista de tickets
GET /tickets/12- Devuelve un ticket específico
POST /tickets- Crea un nuevo ticket
PUT /tickets/12- Actualiza el ticket #12
PATCH /tickets/12- Actualiza parcialmente el ticket #12
DELETE /tickets/12- Elimina el ticket #12"
*/

require APPPATH."/libraries/REST_Controller.php";

class Api extends REST_Controller{
	function __constructor(){
		parent::__constructor();

	}

	public function tweet_get(){
		$this->load->model("Model_tweet");

		$usuario_search = $this->uri->segment(3);

		if($usuario_search !=""){
			$items = $this->Model_tweet->where('usuario',$usuario_search)->get_all();
		}else{
			$items = $this->Model_tweet->get_all();
		}

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
		$op_accion = $this->uri->segment(3);

		switch ($op_accion) {
			case 'eliminar':
				$this->_tweet_borrar();
			break;
			default:
				$this->_tweet_grabar();
			break;
		}
		
	}

	private function _tweet_borrar(){
		$item = $this->post();

		if (isset($item['id_tweet'])) {
			$resultado = $this->Model_tweet->where('id',$item['id_tweet'])->delete();

			$request_response = array();

			if($resultado >0){
				$request_response['status'] = "success";
				$request_response['message'] = 'deleted';
			}else{
				$request_response['status'] = "failure";
				$request_response['message'] = "Especifique ID";
			}

			$this->response($request_response);
		}
	}

	private function _tweet_grabar(){
		$this->load->library("Form_validation");

		$this->form_validation->set_data($this->post());

		if ($this->form_validation->run('tweet_put') !=false) {
				
				$item = $this->post();
				$id = $this->Model_tweet->insert($item);
				$request_response = array();

				if(!$id){
					
					$request_response['status'] = "failure";
					$request_response['message'] = "Especifique ID";

					$this->response($request_response,REST_Controller::HTTP_BAD_REQUEST);

				}else{
					
					$request_response['status'] = "success";
					$request_response['message'] = 'created';

					$this->response($request_response);
				}

		}else{
			$this->response(array('status' =>'failure', 'message'=>$this->form_validation->get_errors_as_array()), REST_Controller::HTTP_BAD_REQUEST);
		}
	}


	public function tweet_put(){
		$this->load->model("Model_tweet");
		$this->load->library("Form_validation");

		$this->form_validation->set_data($this->put());

		if ($this->form_validation->run('tweet_put') !=false) {
				
				$item = $this->put();
				$id = $this->Model_tweet->insert($item);
				$request_response = array();

				if(!$id){
					
					$request_response['status'] = "failure";
					$request_response['message'] = "Especifique ID";

					$this->response($request_response,REST_Controller::HTTP_BAD_REQUEST);

				}else{
					
					$request_response['status'] = "success";
					$request_response['message'] = 'created';

					$this->response($request_response);
				}

		}else{
			$this->response(array('status' =>'failure2', 'message'=>$this->form_validation->get_errors_as_array()), REST_Controller::HTTP_BAD_REQUEST);
		}
	}


}