<?php

class API{
	public function __construct(){
	}

	public function getArearesults($parameters){
		
		$today = time();
		$start = strtotime($parameters['start_date']);
		
		if($start < $today){
			$start_date = $parameters['start_date'] = date('Y-m-d');
		}else{
			$start_date = date('Y-m-d');
		}

		//$service_url = self::specificHotelSearch($start_date,$parameters);	
		$service_url = self::keyWordSearch($parameters);	
		
		//$service_url = self::specialOfferHotel($parameters);	
	
		echo '<!-- service URL '.$service_url.' -->';		

		$curl = curl_init($service_url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('TLRG-AppId: 257B8C35-CD18-4A58-92AC-13EC6FBF78A3'));

		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		$decoded = json_decode($curl_response);
	
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		    die('error occured: ' . $decoded->response->errormessage);
		}
		
		if($decoded){
			return $decoded;		
		}else{
			return "No results";
		}
	}
	public function keyWordSearch($parameters){
			
			$service_url ='https://api.laterooms.com/search/text/'. $parameters['keyword_name'] .'/?d='.
			$parameters['start_date'].'&n='. $parameters['nights'] .'&o='.$parameters['adults'].'-'.
			$parameters['children'].'&cur='.$parameters['currency'].'&b='.
			$parameters['brand'].'&s='.$parameters['order_by'].'&sd='.$parameters['sortOrder'].'&nf=true&ps='.$parameters['page_size'];
			
			if($parameters['starrating']){
				$service_url = $service_url.'&star='.$parameters['starrating'];
			};
			return $service_url;
	}


	/*public function keyWordSearchLatlong(){
			
			//$service_url ='https://api.laterooms.com/search/text/'. $parameters['keyword'] .'/?d='. $parameters['start_date'];
			$service_url ='https://api.laterooms.com/search/text/M5/?d=2015-05-22';
			
			return $service_url;
	}
	*/

	public function specificHotelSearch($start_date, $parameters){

		$service_url ='https://api.laterooms.com/search/hotelid/'.
		'?d='.$start_date.'&n'. $parameters['nights'] .'&o='.$parameters['adults'].'-'.$parameters['children'].'&p=1&hid='.$parameters['ids'] .'&nf=true';

		return $service_url ;
	}

	public function specialOfferHotel($parameters){
		//$service_url ='https://api.laterooms.com/hotel/'.$parameters['ids'].'/rates?d='.$parameters['start_date'].'&n='. $parameters['nights'] .'&o='.$parameters['adults'].'-'.$parameters['children'];
		$service_url ='https://api.laterooms.com/hotel/'.$parameters['ids'].'/rates/?d='.$parameters['start_date'].'&n='. $parameters['nights'] .'&o='.$parameters['adults'].'-'.$parameters['children'];
		return $service_url ;
	}
	public function getKeywordLatlong($eventlocation){
	
		$start_date = date('Y-m-d');

		$service_url = "https://api.laterooms.com/search/text/".$eventlocation."/?d=" . $start_date;

		$curl = curl_init($service_url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('TLRG-AppId: 257B8C35-CD18-4A58-92AC-13EC6FBF78A3'));

		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		$decoded = json_decode($curl_response);
	
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		    die('error occured: ' . $decoded->response->errormessage);
		}


		if($decoded){
			return $decoded->meta->search_location;
		}else{
			return "No results";
		}

	}

}

?>
