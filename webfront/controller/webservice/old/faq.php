<?php
class ControllerWebserviceFaq extends Controller {
	public function index() {
		$this->language->load('information/faq');
		
		$json = array();
		$this->load->model('account/api');
		//$json['key']= $rest_var['key'];
		// Faq with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
                
                //$json['headers'] = apache_request_headers();
                
		$rest_json = file_get_contents("php://input");
		$rest_var = json_decode($rest_json, true); 
		
		$json['all_faq'] = array();
		
		$this->load->model('extension/faq');
	  
		 
		$filter_data = array(); 
		
		if($api_info){
		
			$all_faq = $this->model_extension_faq->getAllFaq($filter_data);  
		 
			foreach ($all_faq as $faq) {
				$json['all_faq'][] = array (
					'question' 	=> html_entity_decode($faq['question'], ENT_QUOTES), 
					'answer' 	=> (html_entity_decode($faq['answer'], in)) //'answer' 	=> (strip_tags(html_entity_decode($faq['answer'], ENT_QUOTES))) 
				);
			}
			
			$json['status'] = '1';
		}else{
			$json['status'] = '0';
			$json['message'] = $this->language->get['error_invalidapikey'];
		}
		
		//print '<pre>'; print_r($json);
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Api-Key: Y0ZfLUllmxEYZujBr5OW7ApP6I55aJyweClgTX8xrITnzhkwLSHM3GKSum34ANUeDfbN5u57TnNoarmDOmoy8P9EmaSRN7fOSeoOda8FW85sJHzbuSJ0TBD85INTNTCAjE6OxfV1AsjTQy9JYBlBM5v76QFOa59MsRpExAhtquhtpGCVwP9LrVL2wrgGnm9sxEKxSJNlFjB6MC2IRlrDwrWXO50f5IlcbzGqq0IjJMXMQA9Am90GZsqvff9v70FB');
		$this->response->setOutput(json_encode($json));
		 
	} 
	
}