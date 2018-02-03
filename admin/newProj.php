<script>
	function checkStartDate(x){
		var selectedDate = document.getElementById("startDate").value;
		switch(x){
			case 1:
				var d = new Date();
				var date = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
				var currentTime = new Date(date).getTime();
				var ddate = new Date(selectedDate).getTime();
				if(ddate >= currentTime){
					document.getElementById('endDate').disabled=false;
				}else{
					document.getElementById('createBtn').disabled=true;
				}
				break;
			case 2:
				var endDate = new Date(document.getElementById("endDate").value).getTime();
				var ddate = new Date(selectedDate).getTime();
				if(endDate > ddate){
					document.getElementById('createBtn').disabled=false;
				}else{
					document.getElementById('endDate').disabled=true;
				}
				break;
			default: break;
		}
		
	}
	
	
	function newProjectSubmit(){
		var projectCode = document.getElementById("projectCode").value;
		var projectName = document.getElementById("projectName").value;
		var projectLoc = document.getElementById("projectLoc").value;
		var projectInCharge = document.getElementById("projectInCharge").value;
		var startDate = document.getElementById("startDate").value;
		var endDate = document.getElementById("endDate").value;
		var projectPass = document.getElementById("projectPass").value;
		var projectInitBudget = document.getElementById("initBudget").value;
		var projectCost = document.getElementById("projectCost").value;
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  document.getElementById("status").innerHTML=this.responseText;
			  console.log(this.responseText);
			}
		  };
		  xhttp.open("GET", "process.php?projectCode="+projectCode+"&projectName="+projectName+"&projectLoc="+projectLoc+"&projectInCharge="+projectInCharge+"&startDate="+startDate+"&endDate="+endDate+"&projectPass="+projectPass+'&initBudget='+projectInitBudget+'&projectCost='+projectCost, true);
		  xhttp.send();
	}
</script>
<div class="w3-row">
	<h2 class="" style="margin-bottom:0px;margin-top:20px"><i class="fa fa-road fa-fx"></i> Project Information</h2><hr style="margin-top:0px;"/>
	<form class="" onsubmit="return newProjectSubmit()" action="javascript:void(0);" method="post">
		<div id="status"></div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">Project Code</span></div>
			<div class="w3-rest">
				<input type="text" class="w3-input w3-border" id="projectCode" required />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">Project Name</span></div>
			<div class="w3-rest">
				<input type="text" class="w3-input w3-border" id="projectName" required />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">Project Location</span></div>
			<div class="w3-rest">
				<input type="text" class="w3-input w3-border" id="projectLoc" required />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">In-Charge</span></div>
			<div class="w3-rest">
				<input type="text" class="w3-input w3-border" id="projectInCharge" required />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">Start Date</span></div>
			<div class="w3-rest">
				<input type="date" class="w3-input w3-border" id="startDate" onblur="return checkStartDate(1)" required />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">End Date</span></div>
			<div class="w3-rest">
				<input type="date" class="w3-input w3-border" id="endDate" onblur="checkStartDate(2)" required disabled />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">Initial Budget</span></div>
			<div class="w3-rest">
				<input type="number" class="w3-input w3-border" id="initBudget" required />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">Project Cost</span></div>
			<div class="w3-rest">
				<input type="number" class="w3-input w3-border" id="projectCost" required />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-quarter w3-padding"><span class="">Password</span></div>
			<div class="w3-rest">
				<input type="password" class="w3-input w3-border" id="projectPass" required />
			</div>
		</div>
		<div class="w3-row-padding w3-padding-8">
			<div class="w3-rest w3-right">
				<button class="w3-button w3-green" id="createBtn" disabled>Create</button>
				<button class="w3-button w3-white">Cancel</button>
			</div>
		</div>
	</form>
</div>


