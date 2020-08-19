<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 

class Pages extends CI_Controller {

	public function __construct() {

		parent::__construct();
	
		// load base_url
		$this->load->helper('url');

		$this->load->model('Main_model');

	}

	public function index(){
		 $this->load->view('welcome_message');
	}

	public function display(){
			
		$data["Main"] = $this->Mainmodel->getMain();
		$geojson = array( 'type' => 'FeatureCollection', 'features' => array());
		$i = 0;
		if($data["Main"]->num_rows() > 0){
			foreach($data["Main"]->result() as $row){
				  
				$ip = $row->ip;
				$parts = explode('/', $ip);
				$network = ip2long($parts[0]);
				 $feature = array(
		                    'type' => 'Feature',
		                    "geometry" => array(
		                        'type' => 'Point',
		                        'coordinates' => array( 
		                                         $row->longitude + 0.0,
		                                        $row->latitude + 0.0 
		                        )
		                    ),
		                    'properties' => array(
		                        'title' => $row->network,
		                        'description' => array(
		                         				$row->city,
		                         				$row->state
		                        ) 
		                    )
		    		);

				 array_push($geojson['features'], $feature);
				 if(++$i == 10){
				 	break;
				 }
				  
			}
				
		}

		$data['geoJson'] = json_encode($geojson, JSON_NUMERIC_CHECK);

		$this->load->view('homepage',$data);

	}

}
