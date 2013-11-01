<?php

class Project extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model("project_model", "model");
	}

	public function create() {

		authorizedContent(true);

		$companyInfo = $this->session->userdata("company");
		if($companyInfo['isOwner']) {

			$name = $this->input->post("name");

			if($name) {

				if($this->model->create($companyInfo['id'], $name)) {

					$this->sendJson(array("success" => true));
				} else {

					$this->sendJson(array("success" => false));
				}
				

			} else {

				$this->sendJson(array("error" => "No Name Provided"));
			}
		} else {
			$this->sendJson(array("error" => "You are not the owner of this project"));
		}
	}

	private function sendJson($obj) {
		
		header("Content-Type: application/json");
		echo json_encode($obj);
	}

}