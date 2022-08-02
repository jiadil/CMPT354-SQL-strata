function selectOwner(){
	
	var x = document.getElementById("owner").value;
	$.ajax({
		url:"showOwner.php",
		method:"POST",
		data:{
			id : x
		},
		success:function(data){
			$("#ans").html(data);
		}
	})
}