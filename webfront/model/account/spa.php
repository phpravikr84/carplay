<?php
class ModelAccountSpa extends Model {
	public function addMerchantOwner($data) {
                
       $sql = "INSERT INTO " . DB_PREFIX . "merchant_request SET "
			. "company = '" . $data['company'] . "', " 
			. "street = '" . $data['street'] . "', " 
			. "housenum = '" . $data['housenum'] . "', " 
			. "postalcode = '" . $data['postalcode'] . "', " 
			. "city = '" . $data['city'] . "', " 
			. "phone = '" . $data['phone'] . "', " 
			. "firstname = '" . $data['firstname'] . "', " 
			. "lastname = '" . $data['lastname'] . "', "
			. "request_type = 'Owner', " 
			. "email = '" . $data['email'] . "', " 
			
			. "reg_date = NOW()";
            
		$this->db->query($sql);

		
		} 


		public function addMerchantRecommended($data) {
                
       $sql = "INSERT INTO " . DB_PREFIX . "merchant_request SET "
			. "company = '" . $data['company'] . "', " 
			. "street = '" . $data['street'] . "', "
			. "housenum = '" . $data['housenum'] . "', "
			. "postalcode = '" . $data['postalcode'] . "', " 
			. "city = '" . $data['city'] . "', " 
			. "phone = '" . $data['phone'] . "', " 
			. "firstname = '" . $data['firstname'] . "', " 
			. "lastname = '" . $data['lastname'] . "', "
			. "request_type = 'Recommended', " 
			. "email = '" . $data['email'] . "', " 
			
			. "reg_date = NOW()";
            
		$this->db->query($sql);

		
		} 
	 
}
