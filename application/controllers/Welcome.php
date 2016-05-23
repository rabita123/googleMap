<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
    public function index()
	{
		
            $this->load->library('googlemaps');

$config = array();
$config['center'] = 'auto';
$config['onboundschanged'] = 'if (!centreGot) {
	var mapCentre = map.getCenter();
	marker_0.setOptions({
		position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
	});
}
centreGot = true;';
$this->googlemaps->initialize($config);
   
// set up the marker ready for positioning 
// once we know the users location



 $this->db->select("*");
 $this->db->from('mosq_mosques');
 $query_result = $this->db->get();
 $result = $query_result->result();
 

$config['center'] = 'auto';
$config['zoom'] = 'auto';
//$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';

$this->load->library('googlemaps');

$this->googlemaps->initialize($config);
foreach($result as $results)
{
$marker = array();
$marker['position'] = $results->lat.",".$results->lng;
$marker['infowindow_content'] =$results->mosqueName ;
//$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
$marker['icon'] ='http://localhost/testGoogleMap/images/mosque.png';
$marker['draggable'] = TRUE;
$marker['animation'] = 'DROP';
$this->googlemaps->add_marker($marker);
}
/*$marker = array();
$marker['position'] = '37.409, -122.1319';
$marker['draggable'] = TRUE;
$marker['animation'] = 'DROP';
$this->googlemaps->add_marker($marker);

$marker = array();
$marker['position'] = '37.449, -122.1419';
$marker['onclick'] = 'alert("You just clicked me!!")';
$this->googlemaps->add_marker($marker);*/
$data['map'] = $this->googlemaps->create_map();

$this->load->view('test', $data);


        }
}