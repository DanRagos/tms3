<?php
require('../classes/ssp.php');

$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'tms',
    'host' => 'localhost'
);

if (isset($_GET['db']) && $_GET['db'] == 1) {
    $table = <<<EOT
 (SELECT * FROM `clients` ORDER BY client_id) temp
EOT;

    $primaryKey = 'client_id';

    $columns = array(
      
        array( 'db' => 'client_id', 'dt' => 0,
'formatter' => function($d,$row){
return '
	<div class="d-flex flex-column justify-content-center">
	<h6 class="text-xs text-secondary mb-0">'.$d.'</h6>
	</div>';
}),
array('db' => 'imglink', 'dt' => ''),
array('db' => 'client_address', 'dt' => ''),
        array('db' => 'client_name', 'dt' => 1,
    'formatter' => function ($d, $row){
        return '<div class="d-flex px-2 py-1">
        <div>
          <img src="'.$row['imglink'].'" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
        </div>
        <div class="d-flex flex-column justify-content-center">
          <h6 class="mb-0 text-sm">'.$d.'</h6>
          <p class="text-xs text-secondary mb-0">'.$row['client_address'].'</p>
        </div>
      </div>' ;
    }),
array('db'=>'contact_email', 'dt' => ''),
        array('db' => 'contact_person', 'dt' => 2,
    'formatter' => function ($d, $row){
        return '<p class="text-xs font-weight-bold mb-0">'.$d.'</p>
        <p class="text-xs text-secondary mb-0">'.$row['contact_email'].'</p>';
    }),
        array('db' => 'client_id', 'dt' => 3,
        'formatter' => function ($d, $row){
            return '	<button  class="btn btn-block bg-gradient-primary mb-1 addClientMachine" data-bs-toggle="modal" data-id= " '.$d.'"data-bs-target="#addContract">
            Add	
          </button>
        <button  class="btn btn-block bg-gradient-secondary mb-1" data-bs-toggle="modal" data-bs-target="#editClient">
            Edit
          </button>';
        })
    );
}

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
?>