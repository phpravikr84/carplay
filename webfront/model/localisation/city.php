<?php
class ModelLocalisationCity extends Model {
	public function getCity($city_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city WHERE city_id = '" . (int)$city_id . "' AND status = '1'");

		return $query->row;
	}
	
	public function getCityName($city_id) { //  print $city_id;exit;
		$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "city WHERE city_id = '" . (int)$city_id . "' AND status = '1'");

		return $query->row['name'];
	}
	
	public function getCountryByCityId($city_id) { //  print $city_id;exit;
		$query = $this->db->query("SELECT country_id FROM " . DB_PREFIX . "city WHERE city_id = '" . (int)$city_id . "' AND status = '1'");

		return $query->row['country_id'];
	}
	
	public function getCitys() {
		$sql = "SELECT *, ci.name, c.name AS country, z.name AS zone FROM " . DB_PREFIX . "city ci LEFT JOIN " . DB_PREFIX . "country c ON (ci.country_id = c.country_id) LEFT JOIN " . DB_PREFIX . "zone z ON (z.zone_id = ci.zone_id) Where ci.status=1";
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	

	public function getCitysByZoneId($zone_id) {
		$city_data = $this->cache->get('city.' . (int)$zone_id);

		if (!$city_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city WHERE zone_id = '" . (int)$zone_id . "' AND status = '1' ORDER BY name");

			$city_data = $query->rows;

			$this->cache->set('city.' . (int)$zone_id, $city_data);
		}

		return $city_data;
	}
}