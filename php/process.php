<?php
require_once '../classes/session.php';

if(isset($_GET['action']) && $_GET['action']=='addClientMachine') {
$output ='';
$client_id = $_GET['client_id'];
$client_details = $client->client_details($client_id);
$machine_type = $machine -> get_machine_type();
$response =  array(
    'name' => $client_details['client_name'],
    'client_id' => $client_details['client_id']);
echo json_encode($response);
}

if (isset($_POST['action'])&& $_POST['action'] == 'add_client'){
$clientName = $_POST['clientName'];
$clientAddress = $_POST['clientAddress'];
$contactPerson = $_POST['contactPerson'];
$emailAddress = $_POST['emailAddress'];
$imglink = '../image/uploads/mv santiago.webp';

$addClient = $client->add_client($clientName,$clientAddress, $contactPerson, $emailAddress, $imglink);
echo $addClient;

}

if (isset($_POST['action'])&& $_POST['action'] == 'add_contract'){
    $count = 0; 
	$pms_count = 0;
	$status = 0; 
$firstpms = $_POST['first_pms'];
$clientName=$_POST['clientName'];
$clientId=$_POST['clientId'];
$frequency=$_POST['frequency'];
$machineType=$_POST['machine_type'];
$brand=$_POST['brand'];
$model=$_POST['model'];
$machine = $brand.' / '.$model;
$status=$_POST['contract_type'];
$notif_desc = $clientName." contract created";
$datefilter=$_POST['datefilter'];

$contract_id = uniqid();
$check_contract_exist = $client->check_contract($contract_id);
if ($check_contract_exist){
    echo 'Failed';
}
else {
    $string=$datefilter;
$last_space = strrpos($string, ' ');
$last_word = substr($string, $last_space);
$first_chunk = substr($string, 0, $last_space - 2);
$last_word = date('Y-m-d', strtotime($last_word));
$first_chunk = date('Y-m-d', strtotime($first_chunk));
$create_contract = $client->create_contract($contract_id, $clientId, $machineType,$machine, $frequency, $first_chunk, $last_word, $status);
if ($frequency =="Quarterly"  ){
	$num = 3;
}
elseif  ($frequency =="Semi-Annually" ){
$num = 6; }
elseif($frequency =="Annually" ){
	$num = 12;
	}
	else {
	}
    do {
        $first_chunk = date('Y-m-d', strtotime("+$num months", strtotime($first_chunk)));
        $count++;		
    } 
    while($first_chunk < $last_word);   

    if ($firstpms) {
        $first_chunk = date('Y-m-d', strtotime($firstpms));
    
        }


        while ($count > $pms_count) {
            $insert_schedule = $client->insert_schedule($clientId, $machineType, $machine, $contract_id, $first_chunk, $status);
            $first_chunk = date('Y-m-d', strtotime("+$num months", strtotime($first_chunk)));
	$first = date('Y-m',strtotime($first_chunk));
	if ($first < $date_today) {
		$status = 1 ;
	}
	else {
		$status = 0;
	}
	
	
	if ($first_chunk >  $last_word)  
	{
		$status = 4;
	}
	
	
	
	$pms_count++;
        }

$update_contract = $client -> update_contract($contract_id, $count);


echo $count;

}
}
