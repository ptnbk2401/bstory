<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM contact WHERE contact_id = {$id}";
        $query = $conn->query($sql);
        if($query){
            header('location: /admin/lienhe/?p=lienhe&tb=Xóa thành công!');
        }
        else {
            header('location: /admin/lienhe/?p=lienhe&tb=Xóa thất bại!');
        }

    }


?>