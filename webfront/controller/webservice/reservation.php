<?php
class ControllerWebserviceReservations extends Controller {
	public function index() {
		
		$data['orders'] = array();

		$this->load->model('webservice/account/order');
		$this->load->model('webservice/checkout/order');
		
		$json = array();
		$json_data = array();
		$reserve_data = array();
		$this->load->model('webservice/account/api');

		$rest_json = @file_get_contents('php://input');
		$rest_var = json_decode($rest_json, true);	
		
		// $rest_json = file_get_contents("php://input");
		// $rest_vars = json_decode($rest_json, true);
		// $api_request = apache_request_headers();

		// $request_body = json_encode($this->request->request);
		//print_r($request_body);

		//$rest_var = json_decode($request_body, true);

		$api_request = apache_request_headers();


	

						

						
		
		 // print_r($this->request->post);exit;
		//*******************************************************************************//
		// REQUEST GET METHOD OF RESERVATION  THROUGH CUSTOMER ID OR RESERVATION ID
		//*******************************************************************************//
		// API Key
		
		if(isset($api_request['key']) && isset($api_request['token'])){

				$api_info = $this->model_webservice_account_api->getApiByKey($api_request['key']);
		
			if($api_info){
				
		 
		
		
						

								if ((isset($this->request->get['customer_id'])) && (!isset($this->request->get['merchant_id'])) && $this->request->server['REQUEST_METHOD'] == 'GET'){

									$customer_id = $this->request->get['customer_id'];
			
				 					$results = $this->model_webservice_account_order->getOrdersMobileApi($customer_id);
				 				// 	print_r($results);
									// exit;


				
											if(count($results) > 0){

																// $results = $this->model_webservice_account_order->getOrdersMobileApi($customer_id);

																// print_r($results);
																// exit;

																$reservation_count = $this->model_webservice_account_order->getTotalReservationsApiByCustomerId($customer_id);
			
														foreach ($results as $result) {
																$product_total = $this->model_webservice_account_order->getTotalOrderProductsByOrderId($result['order_id']);

						
																$voucher_total = $this->model_webservice_account_order->getTotalOrderVouchersByOrderId($result['order_id']);
						
																$OrderP = $this->model_webservice_account_order->getAllOrderProductsMobileApiByCustomer($result['order_id']); 
						
																	//print_r($result['order_id']);exit;

																	$OrderService = array(); 				// exit;

																foreach($OrderP as $services){

																			if(isset($services['service_name'])){
																		$service_name = $services['service_name'];
																	}
																	else{

																		$service_name='';
																	}


																	if(isset($services['bookingDiscountTime'])){
																		$bookingDiscountTime = $services['bookingDiscountTime'];
																	}
																	else{

																		$bookingDiscountTime ='';
																	}

																	if(isset($services['persons'])){
																		$persons = $services['persons'];
																	}
																	else{

																		$persons ='';
																	}

																	if(isset($services['duration'])){
																		$duration = $services['duration'];
																	}
																	else{

																		$duration ='';
																	}

																	if(isset($services['name'])){
																		$merchant_name = $services['name'];
																	}
																	else{

																		$merchant_name ='';
																	}


																	if(isset($services['address'])){
																		$merchant_address = $services['address'];
																	}
																	else{

																		$merchant_address ='';
																	}


																	if(isset($services['image'])){
																		$service_thumb = $services['image'];
																	}
																	else{

																		$service_thumb ='';
																	}

																	if(isset($services['latitude'])){
																		$latitude = $services['latitude'];
																	}
																	else{

																		$latitude ='';
																	}


																	if(isset($services['longitude'])){
																		$longitude = $services['longitude'];
																	}
																	else{

																		$longitude ='';
																	}


																	if(isset($services['price'])){
																		$price = $services['price'];
																	}
																	else{

																		$price ='';
																	}

																	if(isset($services['disc_amount'])){
																		$disc_amount = $services['disc_amount'];
																	}
																	else{

																		$disc_amount ='';
																	}

																	if(isset($services['total'])){
																		$total = $services['total'];
																	}
																	else{

																		$total ='';
																	}

																	if(isset($services['total'])){
																		$total = $services['total'];
																	}
																	else{

																		$total ='';
																	}


																	$OrderService[] = array(
																		'percentage' =>  $services['discount'],
																		'disc_amount'   => (int)$disc_amount,
																		'duration'     => (int)$duration,
																		'persons'     => (int)$persons,
																		'price'     	=> (int)$price,
																		'reservation_time'     => date("H:i", strtotime(trim(str_replace(" ","",$bookingDiscountTime)))),

																		
																	'service_name'   => $service_name,
																		
																		
																		
																		
																		// 'discount'     => (float)$OrderP['discount'],
																		
																		
																		'total'   => (int)$total,
																		); 
																		$reservation = $this->model_webservice_checkout_order->getOrderApiNew($result['order_id']);

																	
																}

						
						
																$json['reservations'][] = array(
																'date_added' 	=> date("d-m-Y", strtotime($reservation['date_added'])),
																'reservation_date' 	=> date("d-m-Y", strtotime($reservation['booking_date'])),
																'currency_code'      => $reservation['currency_code'],
																	'currency_symbol'	=> $reservation['currency_symbol'],
															'reservation_id'  	=> (string)$reservation['order_id'],
															'reservation_status' =>  $reservation['order_status'],
																		
																		
																		'name'	=> $reservation['firstname'],
																			'email'	=> $reservation['email'],
																			'mobile'	=> $reservation['mobile'],
																		

																		'merchant_id' => $reservation['merchant_id'],
																		'merchant_address' => $reservation['merchant_address'],
																		'merchant_name'	=> $reservation['merchant_name'],
																		'thumb'	=> $reservation['thumb'],

																		'latitude'	=>$reservation['latitude'],
																		'longitude'	=>$reservation['longitude'],
																		'category'	=>'',
							 
																		// 'name'       	=> $result['firstname'] . ' ' . $result['lastname'],
																			// 'status'     	=> $result['status'],
																		'services'   => $OrderService,
																			
																			// 'timezone'			=> '',
							
							
																					);
														}


														//print_r($OrderService);
					
													$json_data['status'] = '1';
													$json_data['message'] = 'Success';
													$json_data['reservation_count'] = $reservation_count;
													$json_data['reservations'] = $json['reservations'];
				
											}
												else{
														$json_data['status'] = '0';
														$json_data['message'] = 'Failure: Customer order not exist'; 
													}
										
												
								}
									
								if (isset($this->request->request['reservation_id']) && $this->request->server['REQUEST_METHOD'] == 'GET') {


																		$order_id = $this->request->request['reservation_id'];
																			// $OrderP = $this->model_webservice_account_order->getOrderProductsMobileApi($order_id); 
																		$OrderP = $this->model_webservice_account_order->getAllOrderProductsMobileApiByReservation($order_id); 
																if(!empty($OrderP)){

																				// print_r($OrderP);
																$OrderService = array(); 				// exit;

																foreach($OrderP as $services){

																			if(isset($services['service_name'])){
																		$service_name = $services['service_name'];
																	}
																	else{

																		$service_name='';
																	}


																	if(isset($services['bookingDiscountTime'])){
																		$bookingDiscountTime = $services['bookingDiscountTime'];
																	}
																	else{

																		$bookingDiscountTime ='';
																	}

																	if(isset($services['persons'])){
																		$persons = $services['persons'];
																	}
																	else{

																		$persons ='';
																	}

																	if(isset($services['duration'])){
																		$duration = $services['duration'];
																	}
																	else{

																		$duration ='';
																	}

																	if(isset($services['name'])){
																		$merchant_name = $services['name'];
																	}
																	else{

																		$merchant_name ='';
																	}


																	if(isset($services['address'])){
																		$merchant_address = $services['address'];
																	}
																	else{

																		$merchant_address ='';
																	}


																	if(isset($services['image'])){
																		$service_thumb = $services['image'];
																	}
																	else{

																		$service_thumb ='';
																	}

																	if(isset($services['latitude'])){
																		$latitude = $services['latitude'];
																	}
																	else{

																		$latitude ='';
																	}


																	if(isset($services['longitude'])){
																		$longitude = $services['longitude'];
																	}
																	else{

																		$longitude ='';
																	}


																	if(isset($services['price'])){
																		$price = $services['price'];
																	}
																	else{

																		$price ='';
																	}

																	if(isset($services['disc_amount'])){
																		$disc_amount = $services['disc_amount'];
																	}
																	else{

																		$disc_amount ='';
																	}

																	if(isset($services['total'])){
																		$total = $services['total'];
																	}
																	else{

																		$total ='';
																	}

																	if(isset($services['total'])){
																		$total = $services['total'];
																	}
																	else{

																		$total ='';
																	}


																	$OrderService[] = array(
																		
																		// 'service_thumb'	=> $service_thumb,
																		'percentage' => $services['discount'],
																		'disc_amount'   => (int)$disc_amount,
																		'duration'     => (int)$duration,
																		'persons'     => (int)$persons,
																		'price'     	=> (int)$price,
																		'reservation_time'     => date("H:i", strtotime(trim(str_replace(" ","",$bookingDiscountTime)))),

																		
																	'service_name'   => $service_name,
																		
																		
																		
																		
																		// 'discount'     => (float)$OrderP['discount'],
																		
																		
																		'total'   => (int)$total,
																		); 
																		$reservation = $this->model_webservice_checkout_order->getOrderApiNew($order_id);

																	
																}

																	
						
																	//print_R($OrderP);exit;
						
																	
							
																	
																		//print_r($reservations);
																		//exit;

															$json['reservations'][] = array(
																'date_added' 	=> date("d-m-Y", strtotime($reservation['date_added'])),
																'reservation_date' 	=> date("d-m-Y", strtotime($reservation['booking_date'])),
																'currency_code'      => $reservation['currency_code'],
																	'currency_symbol'	=> $reservation['currency_symbol'],
															'reservation_id'  	=> (string)$reservation['order_id'],
															'reservation_status' =>  $reservation['order_status'],
																		
																		
																		'name'	=> $reservation['firstname'],
																			'email'	=> $reservation['email'],
																			'mobile'	=> $reservation['mobile'],
																		

																		'merchant_id' => $reservation['merchant_id'],
																		'merchant_address' => $reservation['merchant_address'],
																		'merchant_name'	=> $reservation['merchant_name'],
																		'thumb'	=> $reservation['thumb'],

																		'latitude'	=>$reservation['latitude'],
																		'longitude'	=>$reservation['longitude'],
																		'category'	=>'',
							 
																		// 'name'       	=> $result['firstname'] . ' ' . $result['lastname'],
																			// 'status'     	=> $result['status'],
																		'services'   => $OrderService,
																			
																			// 'timezone'			=> '',
							
							
																			);
																$json_data['status'] = '1';
														$json_data['message'] = 'Success';
										$json_data['reservations'] = $json['reservations'];
																			}
				
																			else{
																					$json_data['status']   = '0';
            																		$json_data['message']  = 'Failure: Reservation not found';
																				}

								}

				
				
								if( !isset($this->request->get['reservation_id']) && isset($rest_var['customer_id']) && isset($this->request->get['merchant_id']) && isset($rest_var['service_id']) && isset($rest_var['customer_email']) && $this->request->server['REQUEST_METHOD'] == 'GET' || $this->request->server['REQUEST_METHOD'] == 'DELETE'){

											$json_data['status']   = '0';
            								$json_data['message']  = 'Failure: Invalid Request';

								}
				


							//**************************************************************************************//
							// END
							//**************************************************************************************//




							//*******************************************************************************//
							// REQUEST POST METHOD OF RESERVATION  THROUGH CUSTOMER ID OR RESERVATION ID
							//*******************************************************************************//

								
									if ((!isset($this->request->get['customer_id'])) && (!isset($this->request->get['merchant_id'])) && (!isset($this->request->get['reservation_id'])) && $this->request->server['REQUEST_METHOD'] == 'GET'  || $this->request->server['REQUEST_METHOD'] == 'DELETE'){

											$json_data['status']   = '0';
            								$json_data['message']  = 'Failure';
									}

									if ((isset($this->request->get['customer_id'])) && (!isset($this->request->get['merchant_id'])) && $this->request->server['REQUEST_METHOD'] == 'POST'  || $this->request->server['REQUEST_METHOD'] == 'DELETE'){

											$json_data['status']   = '0';
            								$json_data['message']  = 'Failure: Invalid Request';
									}

									if (isset($this->request->request['reservation_id']) && $this->request->server['REQUEST_METHOD'] == 'POST') {

											$json_data['status']   = '0';
            								$json_data['message']  = 'Failure: Invalid Request';
									}

									if(isset($this->request->get['reservation_id']) && !isset($this->request->get['customer_id']) && $this->request->server['REQUEST_METHOD'] == 'DELETE'){

									$orderStatus = $this->model_webservice_account_order->CancelReservationApi($this->request->get['reservation_id']);
											if($orderStatus==1)
											{
												$json_data['status']   = '1';
            									$json_data['message']  = 'Success : Reservation Cancelled';
											}

											else{

													$json_data['status']   = '1';
            										$json_data['message']  = 'Failure';

												}
						
										}

									if( !isset($this->request->get['reservation_id']) && isset($rest_var['customer_id']) && isset($rest_var['merchant_id']) && isset($rest_var['service_id']) && isset($rest_var['discount_id']) && isset($rest_var['customer_email']) && $this->request->server['REQUEST_METHOD'] == 'POST'){
				

										if(isset($rest_var['customer_id']))
										{
											$customer_id = $rest_var['customer_id']; 
										}
											else{
													$customer_id = '';
												}
										if(isset($rest_var['merchant_id']))
											{
												$merchant_id = $rest_var['merchant_id']; 
											}
										else{
													$merchant_id = '';
											}
										if(isset($rest_var['service_id']))
											{
												$service_id = $rest_var['service_id']; 
											}
										else{
												$service_id = '';
											}
										if(isset($rest_var['discount_id']))
											{
												$discount_id = $rest_var['discount_id']; 
											}
										else{
												$discount_id = '';
											}
										if(isset($rest_var['booking_date']))
											{
												$booking_date = $rest_var['booking_date']; 
											}
										else{
												$booking_date = '';
											}
										if(isset($rest_var['booking_time']))
											{
												$booking_time = $rest_var['booking_time']; 
											}
										else{
												$booking_time = '';
											}
										if(isset($rest_var['merchant_discount_id']))
											{
												$merchant_discount_id = $rest_var['merchant_discount_id']; 
											}
										else{
												$merchant_discount_id = '';
											}
										if(isset($rest_var['persons']))
											{
												$persons = $rest_var['persons']; 
											}
										else{
												$persons = '';
											}
										if(isset($rest_var['duration']))
											{
												$duration = $rest_var['duration']; 
											}
											else{
												$duration = '';
												}
										if(isset($rest_var['price']))
											{
												$price = $rest_var['price']; 
											}
											else{
													$price = '';
												}
										if(isset($rest_var['discount_amount']))
											{
												$discount_amount = $rest_var['discount_amount']; 
											}
										else{
												$discount_amount = '';
											}
										if(isset($rest_var['payment_amount']))
											{
												$payment_amount = $rest_var['payment_amount']; 
											}
										else{
												$payment_amount = '';
											}
										if(isset($rest_var['total_amount']))
											{
												$total_amount = $rest_var['total_amount']; 
											}
											else{
											$total_amount = '';
											}	
										if(isset($rest_var['payment_method']))
											{
											$payment_method = $rest_var['payment_method']; 
											}
										else{
												$payment_method = '';
											}
										if(isset($rest_var['currency_code']))
											{
											$currency_code = $rest_var['currency_code']; 
											}
										else{
												$currency_code = '';
											}
										if(isset($rest_var['customer_name']))
											{
												$customer_name = $rest_var['customer_name']; 
											}
										else{
												$customer_name = '';
											}
										if(isset($rest_var['customer_email']))
											{
												$customer_email = $rest_var['customer_email']; 
											}
										else{
												$customer_email = '';
											}
										if(isset($rest_var['customer_phone']))
											{
												$customer_phone = $rest_var['customer_phone']; 
											}
										else{
												$customer_phone = '';
											}
										if(isset($rest_var['country_id']))
											{
												$country_id = $rest_var['country_id']; 
											}
										else{
												$country_id = '';
											}
										if(isset($rest_var['device_id']))
											{
												$device_id = $rest_var['device_id']; 
											}
										else{
												$device_id = '';
											}

										$reserve_data = array(
								
										'customer_id'			=>	$customer_id,
										'merchant_id'			=>	$merchant_id,
										'service_id'			=>	$service_id,
										'discount_id'			=>	$discount_id,
										'booking_date'			=>	$booking_date,
										'booking_time'			=>	$booking_time,
										'merchant_discount_id'	=>	$merchant_discount_id,
										'persons'				=>	$persons,
										'duration'				=>	$duration,
										'price'					=>	$price,
										'discount_amount'		=>	$discount_amount,
										'payment_amount'		=>	$payment_amount,
										'total_amount'			=>	$total_amount,
										'payment_method'		=>	$payment_method,
										'currency_code'			=>	$currency_code,
										'customer_name'			=>	$customer_name,
										'customer_email'		=>	$customer_email,
										'customer_phone'		=>	$customer_phone,
										'country_id'			=>	$country_id,
										'device_id'				=>	$device_id
										);


											$orderStatus = $this->model_webservice_account_order->ReservationPostApi($reserve_data);
												if($orderStatus==1)
													{
														$json_data['status']   = '1';
            											$json_data['message']  = 'Success : Reservation Cancelled';
													}
														if($orderStatus==0){

															$json_data['status']   = '0';
            												$json_data['message']  = 'Failure : Reservation';

															}
														if($orderStatus > 1){

																$json_data['status']   = '1';
            													$json_data['message']  = 'Success : Reservation Confirmed';
            													$json_data['reservation_id'] = $orderStatus-1;

															}
									}



				



			}

				else{

											$json_data['status']   = '0';
            								$json_data['message']  = 'Failure';

					}

				
		} 

				else{

											$json_data['status']   = '0';
            								$json_data['message']  = 'Failure';

					}





		//**************************************************************************************//
		// END
		//**************************************************************************************//


		//print '<pre>'; print_r($json);
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Api-Key: Y0ZfLUllmxEYZujBr5OW7ApP6I55aJyweClgTX8xrITnzhkwLSHM3GKSum34ANUeDfbN5u57TnNoarmDOmoy8P9EmaSRN7fOSeoOda8FW85sJHzbuSJ0TBD85INTNTCAjE6OxfV1AsjTQy9JYBlBM5v76QFOa59MsRpExAhtquhtpGCVwP9LrVL2wrgGnm9sxEKxSJNlFjB6MC2IRlrDwrWXO50f5IlcbzGqq0IjJMXMQA9Am90GZsqvff9v70FB');
		$this->response->setOutput(json_encode($json_data));
		
		
	}
}