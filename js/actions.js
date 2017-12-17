function search() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("toSearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("searchTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}



function login(){
	var us = document.getElementById("usName").value;
	var pw = document.getElementById("pWord").value;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			if(this.responseText == "1"){
				window.open('admin','_parent');
			}else if(this.responseText == '2'){
				window.open('admin','_parent');
			}else if(this.responseText == '3'){
				window.open('project','_parent')
			}else{
				document.getElementById("status").innerHTML="<div class='w3-panel w3-red'>"+this.responseText+"</div>";
				setTimeout(function(){ 
					document.getElementById("status").innerHTML="";
					document.getElementById("loginForm").reset();
					}, 3000);
			}
		}
	}
	var data = "loginUser="+us+"&loginPw="+pw;
	xhttp.open("POST","js/actions.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(data);
}