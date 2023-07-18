<div class="modal fade" id="addClientMachine" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content contractContent">
     
        </div>
      </div>
    </div>



    <div class="modal fade modal-lg" id="addContract"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
	  <img src="../image/icon.jpg" class="img-fluid" style="width:25%;height:15%;padding-right:14px;" alt="...">
        <h5 class="modal-title " id="title1"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <div class="container">
	  <form action="#" method="POST" id="add-contract-form" autocomplete="off">
      <input type="hidden" name="clientId" id="clientId" value=''>
      <input type="hidden" name="clientName" id="clientName" value=''>
	 <div class="row">
	 <div class="col">
	 <div class="input-group input-group-static mb-4">
	<label class="ms-0">Machine Type</label>
	<select class="form-control" name="machine_type" required>
	<?php
		$sql ="Select * from machine_type";
		$stmt = $client->conn->prepare($sql);
		$stmt ->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row){	
	?>
	   <option value = "<?php echo $row['machine_id']?>"><?php echo $row['machine_name']?></option>
		<?php } ?>
	</select>
	</div>
	</div>
	   <div class="col">
      <div class="input-group input-group-static mb-4">
        <label class="form-">Brand :</label>
        <input type="text" name="brand" class="form-control" required>
			<input type="hidden" id="client_id" name="client_id" >
			
      </div>
    </div>
	<div class="col">
      <div class="input-group input-group-static mb-4">
        <label class="form-">Model :</label>
        <input type="text"  name="model" class="form-control" required>
      </div>
    </div>
	
	 </div>
  <div class="row">
  	<div class="col">
      <div class="input-group input-group-static mb-4">
        <label class="form-">Turn Over / Coverage Date:</label>
        <input type="text" class="form-control"name="datefilter" required>
      </div>
    </div>
		<div class="col">
      <div class="input-group input-group-static mb-4">
        <label class="form-">First PMS date:</label>
        <input type="date" class="form-control"name="first_pms" required>
      </div>
    </div>
	 <div class="col">
	 <div class="input-group input-group-static mb-4">
	<label class="ms-0">Frequency</label>
	<select class="form-control " name="frequency" required>
	<option value="Quarterly" selected> Quarterly </option>
	<option value="Semi-Annually"> Semi-Annual </option>
	<option value="Annually" > Annually </option>
	</select>
	</div>
	</div>
	
  </div>
   <div class="row">
    <div class="col">
	 <div class="input-group input-group-static mb-4"  >
	<label class="ms-0" id="test">Type</label>
	<select class="form-control freq" name="contract_type" id="sAccept"required>
	<option value="1" selected > Installation Warranty </option>
	<option value="2"> PMS Contract </option>
	</select>
	</div>
	<div class="input-group input-group-outline" style="display:none"  id="reason">
									<label class="form-label">PMS Count:</label>
									<input type="number" min=1 name="pms_count"  id="inp_reason" class="form-control" >
									</div>
	</div>
	 
	
   </div>

  </div>
      </div>
      <div class="modal-footer">
	  <button type="submit" class="btn btn-primary" id="add-contract-btn" >Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
	  </form>
    </div>
    </div>
  </div>



  <div class="modal fade" id="addClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<div class="modal-header">
	  <img src="../image/icon.jpg" class="img-fluid" style="width:25%;height:15%;padding-right:14px;" alt="...">
        <h5 class="modal-title ">Add Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <form id="add-client-form"role="form text-left" action="../inc/addClient.php" autocomplete="off"> 
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="clientName" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Address</label>
                    <input type="text" name= "clientAddress" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
				  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Contact Person</label>
                    <input type="text" name="contactPerson" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
				  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email Address</label>
                    <input type="text" name= "emailAddress" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                 <!-- <div class="form-check form-switch d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
				  !-->
                
                </form>
      </div>
      <div class="modal-footer">
	  	<button type="button" class="btn btn-primary addClientBtn">Save changes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

    