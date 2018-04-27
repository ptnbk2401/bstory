<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>
 
 <?php 
	$idStory = $_POST['Aid'];
?>
<a href="javascript:void(0)" onclick="return changePL(<?php echo $idStory; ?>)">
<?php	
	$sql = "SELECT * FROM story WHERE story_id = {$idStory}" ;
	$query = $conn->query($sql);
	$arST = mysqli_fetch_assoc($query);
	$public = $arST['public']; 
?>
<?php
    if($public == 1){
    	$sql1 = "UPDATE story SET public = 0 WHERE story_id = {$idStory}" ;
		$query = $conn->query($sql1);
		echo 'private';
    } else {
		$sql2 = "UPDATE story SET public = 1 WHERE story_id = {$idStory}" ;
		$query = $conn->query($sql2);
		echo 'public';
    }
?>

 </a>