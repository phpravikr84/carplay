<?php
class ControllerWebserviceCity extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('account/forgotten'); 

		$this->load->model('account/customer');
		
		$json = array();
		$this->load->model('account/api');
		//$json['key']= $rest_var['key'];
		// Forget with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		$rest_json = file_get_contents("php://input");
		$rest_var = json_decode($rest_json, true);
                
                
		//City
		
		$this->load->model('localisation/city');

		$json['citys'] = array();

		$citys = $this->model_localisation_city->getCitys(); 
		 
		
		foreach ($citys as $city) {
			$image =  'image/flags/'.strtolower($city['iso_code_2']).'.png';
			$json['citys'][] = array(
					'name'     => $city['name'],
					'city_id' => $city['city_id'],
					'country_id' => $city['country_id'],
					'zone_id' => $city['zone_id'],
					'image' => $image
				);
		}
		
		$json['status'] = '1'; 
						
		$json['message'] = 'Success';
		 
		//print '<pre>'; print_r($json);
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json)); 
	} 
}
