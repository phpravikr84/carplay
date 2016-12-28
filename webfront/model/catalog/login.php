<?php
class ModelCatalogLogin extends Model {		
	   public function adduser($data) {	
		$data['dob']=$data['year_id'].'-'.$data['month_id'].'-'.$data['date_id'];
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "userprofile SET name = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', month_id = '" . $this->db->escape($data['dob']) . "', gender = '" . (int)($data['gender']) . "', ctime=NOW(), uptime=NOW()");
		
		$uid = $this->db->getLastId();
		
		if(!empty( $data['password']))
		{
			$this->db->query("INSERT INTO " . DB_PREFIX . "userpassword SET  salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', uid= '" . (int)$uid . "',time=NOW()");
		}
		
		}
		
		
		public function getuser($uid) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "userprofile WHERE uid = '" .(int)$uid ."'");
		}
		
		public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
		}
}
?>