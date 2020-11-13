<?php date_default_timezone_set('Asia/Kolkata');  ?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Humanyu Malik</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body >
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-3"><h3>Humanyu Malik</h3></div>
				<div class="col-sm-6 pull-right">
					<div class="row">
						<div class="col-sm-12">
						<div class="col-sm-12" id="divid">
							<h3>Select date</h3>
							<select class="form-control" id="lastdays" >
								<option value="<?php echo date("Y-m-d",strtotime("-7 days")); ?>" selected="selected">Last 7 days</option>
								<option value="<?php echo date("Y-m-d",strtotime("-15 days")); ?>">Last 15 days</option>
								<option value="<?php echo date("Y-m-d",strtotime("-30 days")); ?>">Last 30 days</option>
								<option value="<?php echo date("Y-m-d",strtotime("-60 days")); ?>">Last 60 days</option>
								<option value="<?php echo date("Y-m-d",strtotime("-90 days")); ?>">Last 90 days</option>
								<option value="<?php echo date("Y-m-d",strtotime("-180 days")); ?>">Last 180 days</option>
								<option value="custom">Custom Start Date</option>
							</select>
							</div>
							<div class="col-sm-7" id="showdate" style="display:none;">
							<div class="row">
								<div class="col-sm-8">
									<h3>Custom date</h3>
									<input type="date" placeholder="Select Date" class="form-control " id="date" min="<?php echo date("Y-m-d",strtotime("-180 days")); ?>" max="<?php echo date("Y-m-d"); ?>" >
								</div>
								<div class="col-sm-4">
									<h3>&nbsp;</h3>
									<button type="button" id="submitData"  class="btn btn-success">Submit</button>
															
								</div>
								
							</div>
							
						</div>
						</div>
						
						
						
					</div>
				</div>
			</div>
			
		</div>
		<div class="row" style="margin:0">
		  <div class="col-sm-3" style="background-color: #f5f5f5">
		  	<h3>Total</h3>
			
		  	<b  class="commonClass" id="total_count">0</b>
		  </div>
		  <div class="col-sm-3" style="background-color: #fcf8e3">
		  	<h3>Unresolved </h3>
		  	
		  	<b  class="commonClass" id="unsolved">0</b>
		  </div>
		  <div class="col-sm-6" style="background-color: #dff0d8">
		  	<div class="row">
		  		<h3>Resolved (<b  class="" id="solve">0</b>)</h3>
		  		<div class="col-sm-6" style="background-color: #41d42f">Won:
		  			<b class="commonClass2 " id="won">0</b>
		  		</div>
		  		<div class="col-sm-6" style="background-color: #f57341">Lost:
		  			<b class="commonClass2" id="lost">0</b>
		  		</div>
		  		
		  	</div>
		  		</div>
		  	</div>
		  	<hr>
		<table class="table table-bordered table-striped" id="dispute_list">
<thead>
<tr>
<th>S No.</th>
<th>Dispute Id</th>
<th>Reason</th>
<th>Status</th>
<th>Dispute Status</th>
<th>Dispute Amount</th>
<th>Created On</th>
</tr>
</thead>
<tbody>



</tbody>
</table>

<script src="code.js"></script>
		</body>
		
		
		</html>