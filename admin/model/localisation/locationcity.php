<?php
class ModelLocalisationLocationcity extends Model {
	public function addLocationCity($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "locationcity SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', country_id = '" . (int)$data['country_id'] . "',zone_id = '" . (int)$data['zone_id'] . "', city_id = '" . (int)$data['city_id'] . "'");

		$this->cache->delete('Location');
		
		return $this->db->getLastId();
	}

	public function editLocationCity($location_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "locationcity SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "',  country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', city_id = '" . (int)$data['city_id'] . "' WHERE location_id = '" . (int)$location_id . "'");

		$this->cache->delete('Location');
	}

	public function deleteCity($location_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "locationcity WHERE location_id = '" . (int)$location_id . "'");

		$this->cache->delete('city');
	}

	public function getLocationCity($location_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "locationcity WHERE location_id = '" . (int)$location_id . "'");

		return $query->row;
	}
	
	public function getCityName($location_id) {
		$query = $this->db->query("SELECT DISTINCT name FROM " . DB_PREFIX . "locationcity WHERE location_id = '" . (int)$location_id . "'");

		return $query->row['name'];
	}

	public function getLocationCitys($data = array()) {
		$sql = "SELECT *, lc.name As location, co.name AS country, z.name AS zone, c.name as city , lc.name as location FROM " . DB_PREFIX . "locationcity lc 
		LEFT JOIN " . DB_PREFIX . "country co ON (lc.country_id = co.country_id) 
		LEFT JOIN " . DB_PREFIX . "zone z ON (lc.zone_id = z.zone_id)
		LEFT JOIN " . DB_PREFIX . "city c ON (lc.city_id = c.city_id) ";

		$sort_data = array(
			'co.name',
			'lc.name' 
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY lc.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		//print $sql;

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getLocationsByCityId($city_id) {
		$locationcity_data = $this->cache->get('locationcity.' . (int)$city_id);
		$locationcity_data='';
		if (!$locationcity_data) {
			
			$sql = "SELECT * FROM " . DB_PREFIX . "locationcity WHERE city_id = '" . (int)$city_id . "' AND status = '1' ORDER BY name";
			
			$query = $this->db->query($sql);

			$locationcity_data = $query->rows;

			$this->cache->set('locationcity.' . (int)$city_id, $locationcity_data);
		}

		return $locationcity_data;
	}

	public function getLocationsByCountryId($country_id) {
		$location_data = $this->cache->get('Location.' . (int)$country_id);

		if (!$location_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "locationcity WHERE country_id = '" . (int)$country_id . "' AND status = '1' ORDER BY name");

			$location_data = $query->rows;

			$this->cache->set('Location.' . (int)$country_id, $location_data);
		}

		return $location_data;
	}

	public function getTotalLocationsCitys() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "locationcity");

		return $query->row['total'];
	}

	public function getTotalLocationsByCountryId($country_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "locationcity WHERE country_id = '" . (int)$country_id . "'");

		return $query->row['total'];
	}
}