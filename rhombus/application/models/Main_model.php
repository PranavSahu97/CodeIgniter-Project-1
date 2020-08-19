<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Mainmodel extends CI_Model {

		public function __construct(){
			$this->load->database();
		}

		public function getMain(){
			

			$query = $this->db->select('i.network, l.state, l.city, l.latitude, l.longitude')
					 -> from('ip as i')
					 -> where ('i.network = ', 'is not null') 
					 -> join('loc as l','LEFT')
					 -> on('i.network >= l.ip_from', 'i.network <= l.ip_to')
					 ->get();


			return $query;
		}

	}

?>