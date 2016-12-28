<?php
class ControllerCatalogNextcalender extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('user/ticketing');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/ticketing');

		$this->getList();
	} 

	protected function getList() {
		$this->load->model('catalog/merchant');
		//print_r( $this->request->get);exit;
		$data['disocunt_data'] = $this->model_catalog_merchant->getMerchantDiscounts($this->request->get['merchant_id'], $this->request->get['end_date']);
		 
		
		$data['start_date'] =$this->request->get['end_date'];
		$data['end_date'] =date('Y-m-d', strtotime($this->request->get['end_date']. ' + 6 days'));

		$this->response->setOutput($this->load->view('catalog/nextcalender', $data));
	} 
	 
}