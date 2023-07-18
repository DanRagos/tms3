<?php
require_once 'db.php';

class Client extends DB {
    public function addClientMachine ($lient_id) {
        return 'test';
    }

    public function client_details($client_id) {
        $sql = 'Select * from clients where client_id = :client_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['client_id'=>$client_id]);
        return $stmt->fetch();
        
    }
    public function check_contract($contract_id) {
        $sql = 'Select * from contract where contract_id = :contract_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['contract_id'=>$contract_id]);
        $result =  $stmt->fetch();
        
    if ($result) {
        return $result; // Return the contract row
    } else {
        return false; // Return false if contract doesn't exist
    }
        
    }

    public function create_contract($contract_id, $clientId, $machineType,$machine, $frequency, $first_chunk, $last_word, $ctr_status) {
        $sql = "INSERT INTO `contract` (`contract_id`, `client_id`, `machine_type`, `model`, `frequency`, `turn_over`, `coverage`, `status`) VALUES (:contract_id, :clientId, :machineType,:machine, :frequency, :first_chunk, :last_word, :ctr_status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['contract_id'=>$contract_id, 'clientId'=>$clientId, 'machineType'=>$machineType, 'machine'=>$machine,'frequency'=>$frequency,'first_chunk'=>$first_chunk,'last_word'=>$last_word,'ctr_status'=>$ctr_status]);
        return true;
    }

    public function insert_schedule($clientId, $machineType, $machine, $contract_id, $first_chunk, $sch_status) {
        $sql= "INSERT INTO `schedule` (`client_id`, `machine_type`, `model`, `contract_id`, `schedule_date`, `status`) 
        VALUES (:clientId, :machineType, :machine, :contract_id, :first_chunk, :sch_status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['clientId'=>$clientId, 'machineType'=>$machineType, 'machine'=>$machine, 'contract_id'=>$contract_id,'first_chunk'=>$first_chunk,'sch_status'=>$sch_status]);
        return true;
    }
    public function update_contract($contract_id, $count) {
        $sql = "UPDATE `contract` SET  `count` = :count,  `total` = :total WHERE `contract`.`contract_id` = :contract_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['contract_id'=>$contract_id, 'count' => $count, 'total' => $count]);
        return true;
    }
    
}

?>