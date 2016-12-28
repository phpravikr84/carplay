<?php
class ModelLocalisationLocation extends Model {
	public function getLocation($location_id) {
		$query = $this->db->query("SELECT location_id, name, address, geocode, telephone, fax, image, open, comment FROM " . DB_PREFIX . "location WHERE location_id = '" . (int)$location_id . "'");

		return $query->row;
	}
	
	
	public function getLocationName($location_id) {
		$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "locationcity WHERE location_id = '" . (int)$location_id . "' AND status = '1'");
		
		if(isset($query->row['name'])){
			$name = $query->row['name'];
		}else{
			$name = '';
		}

		return $name;
	}
	
	public function getLocationsByCityId($city_id) {
		$query = $this->db->query("SELECT location_id, name FROM " . DB_PREFIX . "locationcity WHERE city_id = '" . (int)$city_id . "' AND status = '1'");
		
		 
		return $query->rows;
	}
}