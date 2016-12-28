<?php
class ControllerCatalogDiscountGenerate extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('user/ticketing');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/ticketing');

		$this->getList();
	} 

	protected function getList() {
		$this->load->model('catalog/merchant');
		if(isset($this->request->get['merchant_id'])){
			
			$data['merchant_discounts'] = $this->model_catalog_merchant->getMerchantDiscounts($this->request->get['merchant_id'],$this->request->get['booking_start_date'] );
			
			//print "<pre>"; print_r($data['merchant_discounts']);
			
			}else{
	
			$selectedTime = "8:00"; 
			
			$i=0;
			
			// Start date
			 $date = date('Y-m-d');
			 
			 if(isset($this->request->get['booking_start_date'])){
				$date =$this->request->get['booking_start_date'];
			 }else{
				$date = date('Y-m-d');
			 }
			 
			 // End date
			 //$end_date = date('Y-m-d', strtotime("+6 days"));
			  
				$end_date = date('Y-m-d', strtotime($this->request->get['booking_start_date']. ' + 6 days'));
			 
			 
			 for($x = 0; $x <= 30; $x++) {
				 
				 $endtime = strtotime("+30 minutes", strtotime($selectedTime));
				 
				// print date('G:i', $endtime).'</br>';
				 
				 while (strtotime($date) <= strtotime($end_date)) { 
					 
					 $data['merchant_discount'] []= array( 
						'discount_date'     => $date, 
						'merchant_discount_id'     => '',
						'discount'   		=> 50,
						'seats'   			=> 10  
						);
					 
					$date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); 
					$i++; 
				 }
				 
				 $selectedTime =  date('G:i', $endtime);
				 
				 $data['merchant_discounts'] [$x]= array(        
						'merchant_id'      	=> isset($this->request->get['merchant_id']) ? $this->request->get['merchant_id'] : 0,
						
						'discount_time'     => date('G:i', $endtime),
						'sort_order'		=> $x,
						'discount_data'     => $data['merchant_discount'], 
						 
						);
				 
				 //$data['merchant_discounts'][$x] = ;
			 }
			 
		}
		   	$data['booking_start_date'] =$this->request->get['booking_start_date'];
			$data['booking_end_date'] =$this->request->get['booking_end_date'];
			 
			 

		$this->response->setOutput($this->load->view('catalog/discountGenerate', $data));
		   
		
	}

	 
}