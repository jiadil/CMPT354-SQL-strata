
<?php

	$k = $_POST['id'];
	$k = trim($k);
	include '../connect.php';
	$conn = OpenCon();
	
	if($k == "All"){
		$sql = "SELECT * FROM owner ";
		$result = $conn->query($sql);
	}
	else{
	$sql = "SELECT * FROM owner where name='{$k}'";
	$result = $conn->query($sql);
	}

	while($row = $result->fetch_assoc()) { 
	?>
	
	<tr>
		<td scope="row"><?php echo $row['ownerID']; ?></td>
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['phoneNum']; ?></td>
		<td><?php echo $row['emailAddress']; ?></td>
	</tr>
	<?php
}
?>