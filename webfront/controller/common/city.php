<?php
class ControllerCommonCity extends Controller {
	public function index() {
		$this->load->language('common/currency');
		$this->load->model('localisation/city');

		$data['text_currency'] = $this->language->get('text_currency');

		$data['action'] = $this->url->link('common/city/city', '', $this->request->server['HTTPS']);
		
		if (isset($this->request->get['route']) && $this->request->get['route']=='product/merchantdetail') {
			 
			
			//$this->response->redirect($this->url->link('common/home', '', true));
		}

		if(isset($this->session->data['city_id'])){
			$data['city_name'] = $this->model_localisation_city->getCityName($this->session->data['city_id']); 
			 
		}else{
			$data['city_name'] ='Bangkok';
			$this->session->data['city_id'] = 10;
		}
		
		
		
		
		if (isset($this->request->get['path'])) {
			$data['path'] = $this->request->get['path'];
		}else{
			$data['path'] ='';
		}
		//print '<pre>'; print_r($this->session->data); print '</pre>';

		//City
		
		$data['citys'] = array();

		$citys = $this->model_localisation_city->getCitys(); 
		 
		
		foreach ($citys as $city) {
                    $image =  'image/flags/'.strtolower($city['iso_code_2']).'.png';
                    $data['citys'][] = array(
                            'name'     => $city['name'],
                            'city_id' => $city['city_id'],
                            'country_id' => $city['country_id'],
                            'zone_id' => $city['zone_id'],
                            'image' => $image
                    );
		}
		//print '<pre>'; print_r($data['citys']);exit;

		if (!isset($this->request->get['route'])) {
			$data['redirect'] = $this->url->link('common/home');
		} else {
			$url_data = $this->request->get;

			unset($url_data['_route_']);

			$route = $url_data['route'];

			unset($url_data['route']);

			$url = '';

			if ($url_data) {
				$url = '&' . urldecode(http_build_query($url_data, 'path='.$data['path'], '&'));
			}

			$data['redirect'] = $this->url->link($route, $url, $this->request->server['HTTPS']);
		}

		return $this->load->view('common/city', $data);
	}

	public function city() {
		if (isset($this->request->get['city_id'])) {
			$this->session->data['city_id'] = $this->request->get['city_id'];
		}
		
		$json['success'] = 1;
		 
		 $this->response->addHeader('Content-Type: application/json');
		 $this->response->setOutput(json_encode($json));
	}
}