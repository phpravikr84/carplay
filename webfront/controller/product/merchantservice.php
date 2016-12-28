<?php
class ControllerProductMerchantservice extends Controller {
	private $error = array();

	public function index() {
		
		$this->load->language('product/merchant');
		$this->load->language('account/login');
		
		$this->load->model('catalog/category');
		$this->load->model('catalog/merchant');
		$this->load->model('catalog/manufacturer');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('localisation/city');
		$this->load->model('localisation/location');
		
		if (isset($this->request->get['merchant'])) {
			$merchant_id = (int)$this->request->get['merchant'];
		} else {
			$merchant_id = 0;
		}
		
		
		
		

		$merchant_services = $this->model_catalog_merchant->getAllProductsByMerchantId($merchant_id); 

		
		
		$data['merchant_services'] = array();
		if($merchant_services){
			foreach ($merchant_services as $recomond) {
				$data['merchant_services'][] = array(
					'merchant_id'		=> $recomond['merchant_id'],
					'name' 				=> $recomond['name'],
					'product_id' 		=> $recomond['product_id'],
					'duration'  		=> $recomond['duration'],
					'price'  			=> $recomond['price'],
					// 'amount'     		=> $this->currency->format(round($recomond['price']), $this->session->data['currency'])
					'amount'     		=> $this->currency->getSymbolLeft($this->session->data['currency']).''.$this->currency->newformat(round($recomond['price']), $this->session->data['currency'])
				);
			}
		}
		
		$this->response->setOutput($this->load->view('common/homespaservice', $data));
		

		///print_r($merchant_services);
	
	}
}
