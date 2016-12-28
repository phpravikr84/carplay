<?php
class ControllerWebserviceInformation extends Controller {
	public function index() {
            $this->load->language('information/information');

            $this->load->model('catalog/information');

            $json = array();
            $this->load->model('account/api');
            //$json['key']= $rest_var['key'];
            //API Key
            $api_info = $this->model_account_api->getApiByKey($this->request->request['key']);

            $rest_json = file_get_contents("php://input");
            $rest_var = json_decode($rest_json, true); 
            
            if($api_info){

                if (isset($this->request->request['information_id'])) {
                        $information_id = (int)$this->request->request['information_id'];
                } else {
                        $information_id = 0;
                }

                $information_info = $this->model_catalog_information->getInformation($information_id);

                if ($information_info) {

                    $json['title'] = $information_info['title'];
                    //$json['description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');
                    $json['href'] = html_entity_decode($this->url->link('information/information', 'information_id=' . $information_id), ENT_QUOTES, 'UTF-8');
                    $json['status'] = '1';  
                    $json['message'] = 'Success'; //html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');
                    
                } else{

                    $json['status'] = '0';  
                    $json['message'] = 'Invalid Information Id';
                }
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