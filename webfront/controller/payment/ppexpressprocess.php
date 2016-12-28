<?php
class ControllerPaymentppexpressprocess extends Controller {

	public function _GET($label='',$default='',$set_default=false){
		
		$value=$default;
		
		if(isset($this->request->get[$label])&&!empty($this->request->get[$label])){
			
			$value=$this->request->get[$label];
		}
		
		if($set_default===true&&(!isset($this->request->get[$label])||$this->request->get[$label]=='')){
			
			$this->request->get[$label]=$default;
		}

		return $value;		
	}
	
	public function _POST($label='',$default='',$set_default=false){
		
		$value=$default;
		
		if(isset($this->request->post[$label])&&!empty($this->request->post[$label])){
			
			$value=$this->request->post[$label];
		}

		if($set_default===true&&(!isset($this->request->post[$label]) || $this->request->post[$label]=='')){
			
			$this->request->post[$label]=$default;
		}		
		
		return $value;		
	}	
	
	public function _SESSION($label='',$default='',$set_default=false){
		
		$value=$default;
		
		if(isset($this->request->session[$label])&&!empty($this->request->session[$label])){
			
			$value=$this->request->session[$label];
		}
		
		if($set_default===true&&(!isset($this->request->session[$label])||$this->request->session[$label]=='')){
			
			$this->request->session[$label]=$default;
		}	

		return $value;		
	}	


	public function sendPaypalPayment() {

		
		//Post Data received from product list page.
		if($this->_GET('paypal')=='checkout'){
		
		//-------------------- prepare products -------------------------
		
		//Mainly we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
		
		//Please Note : People can manipulate hidden field amounts in form,
		//In practical world you must fetch actual price from database using item id. Eg: 
		//$products[0]['ItemPrice'] = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
		
		$products = [];
		
		
		
		// set an item via POST request
		
		$products[0]['ItemName'] = $this->_POST('itemname'); //Item Name
		$products[0]['ItemPrice'] = $this->_POST('itemprice'); //Item Price
		$products[0]['ItemNumber'] = $this->_POST('itemnumber'); //Item Number
		$products[0]['ItemDesc'] = $this->_POST('itemdesc'); //Item Number
		$products[0]['ItemQty']	= $this->_POST('itemQty'); // Item Quantity
		$products[0]['currencyname'] = $this->_POST('currencyname');
		
		/*
		$products[0]['ItemName'] = 'my item 1'; //Item Name
		$products[0]['ItemPrice'] = 0.5; //Item Price
		$products[0]['ItemNumber'] = 'xxx1'; //Item Number
		$products[0]['ItemDesc'] = 'good item'; //Item Number
		$products[0]['ItemQty']	= 1; // Item Quantity		
		*/
		/*
		
		// set a second item
		
		$products[1]['ItemName'] = 'my item 2'; //Item Name
		$products[1]['ItemPrice'] = 10; //Item Price
		$products[1]['ItemNumber'] = 'xxx2'; //Item Number
		$products[1]['ItemDesc'] = 'good item 2'; //Item Number
		$products[1]['ItemQty']	= 3; // Item Quantity
		*/		
		
		//-------------------- prepare charges -------------------------
		
		$charges = [];
		
		//Other important variables like tax, shipping cost
		$charges['TotalTaxAmount'] = 0;  //Sum of tax for all items in this order. 
		$charges['HandalingCost'] = 0;  //Handling cost for this order.
		$charges['InsuranceCost'] = 0;  //shipping insurance cost for this order.
		$charges['ShippinDiscount'] = 0; //Shipping discount for this order. Specify this as negative number.
		$charges['ShippinCost'] = 0; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
		
		//------------------SetExpressCheckOut-------------------
		
		//We need to execute the "SetExpressCheckOut" method to obtain paypal token

		// print_r($products);
		// print_r($charges);
		// exit;

		$this->load->model('payment/paypalexpress');
		$checkPaypal = $this->model_payment_paypalexpress->SetExpressCheckout($products, $charges);
		if(!is_array($checkPaypal)){
		echo $checkPaypal;
		}
		else{
			print_r($checkPaypal);
		}
		//redirect("$checkPaypal","refresh");
		//$this->response->redirect("$checkPaypal");
		}
		if($this->_GET('token')!='' && $this->_GET('PayerID')!=''){
		// elseif($this->_GET('token')!='' && $this->_GET('PayerID')!=''){
		
		//------------------DoExpressCheckoutPayment-------------------		
		
		//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
		//we will be using these two variables to execute the "DoExpressCheckoutPayment"
		//Note: we haven't received any payment yet.

		$this->load->model('payment/paypalexpress');		
		$this->model_payment_paypalexpress->DoExpressCheckoutPayment();

		}
		// else{
		
		// //order form
		// }

	}

}