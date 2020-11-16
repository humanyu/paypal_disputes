<?php 
date_default_timezone_set('Asia/Kolkata');//country india time zone
include('token.php'); //call a token
function multiRequest($data) {
	global $token; //global initialize to token
  $curly = array();
  $result = array();
  $won=0;
  $lost=0;
  $mh = curl_multi_init();
foreach ($data as $id => $d) {
$curly[$id] = curl_init();
    curl_setopt($curly[$id], CURLOPT_HTTPHEADER,array('Content-Type: application/json', 'Authorization:Bearer '.$token));
      curl_setopt($curly[$id], CURLOPT_ENCODING, 'gzip');
		curl_setopt($curly[$id], CURLOPT_ENCODING, ''); 
		curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curly[$id], CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	
	curl_setopt($curly[$id], CURLOPT_URL,$d);
  curl_multi_add_handle($mh, $curly[$id]);
  }
  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while($running > 0);
  foreach($curly as $id => $c) {
    $dOutcome = json_decode(curl_multi_getcontent($c));//fetch data from api with multi request
	if(isset($dOutcome->dispute_outcome->outcome_code)){
	if($dOutcome->dispute_outcome->outcome_code=="RESOLVED_SELLER_FAVOUR"){//check won condition
	$won++;
	} else if($dOutcome->dispute_outcome->outcome_code=="RESOLVED_BUYER_FAVOUR"){ //check lost condition
	$lost++;	
	}
	}
    curl_multi_remove_handle($mh, $c);
  }
 curl_multi_close($mh);//close multi curl api
 return array('won'=>$won,'lost'=>$lost);
}
	$disputeOutcome=multiRequest($_POST['link']);//call a dispute details api with multiple  
	if($disputeOutcome['won']!=0 || $disputeOutcome['lost']!=0){ //check no of won or lost must be grater than 1
$arr = array('won' => $disputeOutcome['won'], 'lost' => $disputeOutcome['lost'], 'status' => 1);
} else {
$arr = array( 'status' => 0);	
}
header('Content-Type: application/json');
echo json_encode($arr);die;

?>