<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>


<?php 
   $name = strip_tags( $_POST['aname']);
  	$sql = "SELECT * FROM cat WHERE name LIKE '{$name}'";
	  $query = $conn->query($sql);
	  if($query->num_rows > 0){
	    echo "Tên Danh mục đã tồn tại";
	  }


?>