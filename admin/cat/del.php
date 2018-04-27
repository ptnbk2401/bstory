<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php 
    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
        $sql = "DELETE FROM cat WHERE cat_id = {$cid}";
        $query = $mysqli->query($sql);
        if($query){
            header('location: index.php?tb=Xóa thành công.');
        }
        else die("ERROR");
    }


?>