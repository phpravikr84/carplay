<?php
class ControllerAccountSpa extends Controller {
	private $error = array();

	public function index() {

			

			if(isset($this->request->post['userName'])){
				$firstname = $this->request->post['userName'];
			}
			else{

				$firstname='';
			}
			if(isset($this->request->post['userSurname'])){
				$lastname = $this->request->post['userSurname'];
			}
			else{

				$lastname='';
			}

			if(isset($this->request->post['userEmail'])){
				$email = $this->request->post['userEmail'];
			}
			else{

				$email='';
			}

			if(isset($this->request->post['companyName'])){
				$company = $this->request->post['companyName'];
			}
			else{

				$company='';
			}

			if(isset($this->request->post['companyStreet'])){
				$street = $this->request->post['companyStreet'];
			}
			else{

				$street='';
			}


			if(isset($this->request->post['companyHousenumber'])){
				$houseNumber = $this->request->post['companyHousenumber'];
			}
			else{

				$houseNumber='';
			}

			if(isset($this->request->post['companyZipcode'])){
				$postalcode = $this->request->post['companyZipcode'];
			}
			else{

				$postalcode='';
			}

			if(isset($this->request->post['companyCity'])){
				$city = $this->request->post['companyCity'];
			}
			else{

				$city='';
			}

			if(isset($this->request->post['companyCode'])){

				$companyCode = $this->request->post['companyCode'];
			}
			else{

				$companyCode ='';
			}

			if(isset($this->request->post['companyPhone'])){
				$phone = $companyCode.'-'.$this->request->post['companyPhone'];
			}
			else{

				$phone=$companyCode.'-';
			}

			$data=array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'company' => $company, 'street' => $street, 'housenum' => $houseNumber, 'city' => $city, 'postalcode' => $postalcode);
		
			$this->load->model('account/spa');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST')){
			$this->model_account_spa->addMerchantOwner($data);

		

			$this->response->redirect($this->url->link('account/successrequest'));
			}
		

	
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/spa', $data));
	}

	
}