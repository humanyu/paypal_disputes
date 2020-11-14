<?php 
session_start();
date_default_timezone_set('Asia/Kolkata');
include('token.php');
$Results=[];
function multiRequest($data) {
	global $token;
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
 $_SESSION['lastTime']=time();
  foreach($curly as $id => $c) {
    $dOutcome = json_decode(curl_multi_getcontent($c));
	if(isset($dOutcome->dispute_outcome->outcome_code)){
	if($dOutcome->dispute_outcome->outcome_code=="RESOLVED_SELLER_FAVOUR"){
	$won++;
	} else if($dOutcome->dispute_outcome->outcome_code=="RESOLVED_BUYER_FAVOUR"){
	$lost++;	
	}
	}
    curl_multi_remove_handle($mh, $c);
  }
 curl_multi_close($mh);
 return array('won'=>$won,'lost'=>$lost);
}
/*(isset($_SESSION['lastTime'])){
	$diff=time()-$_SESSION['lastTime'];
	$timeDiff=60-$diff;
	if($diff < 60){
	sleep($timeDiff);	
	}
	}*/
	$disputeOutcome=multiRequest($_POST['link']);
	if($disputeOutcome['won']!=0 || $disputeOutcome['lost']!=0){
$arr = array('won' => $disputeOutcome['won'], 'lost' => $disputeOutcome['lost'], 'status' => 1);
} else {
$arr = array( 'status' => 0);	
}
header('Content-Type: application/json');
echo json_encode($arr);die;

?>