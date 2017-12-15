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
			  document.getElementById("status").innerHTML=this.responseText;
			}
		}
	}
	var data = "loginUser="+us+"&loginPw="+pw;
	xhttp.open("POST","js/actions.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(data);
}