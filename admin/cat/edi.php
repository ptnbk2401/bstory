<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>

<?php 
    $cid = $_GET['cid'];   
    $sql = "SELECT * FROM cat WHERE cat_id = {$cid}";
    $query = $mysqli->query($sql);
    $arCat = mysqli_fetch_assoc($query);
    $cname = $arCat['name'];

    if(isset($_POST['submit'])){
        $new_name = $_POST['tendm'];
        $sql = "UPDATE cat SET name = '{$new_name}' WHERE cat_id={$cid}";
        $query = $mysqli->query($sql);
        if($query){
            header('location: index.php?tb=Sửa OK');
        }
}
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm danh mục</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Tên Danh Mục</label>
                                        <input type="text" name="tendm" value= "<?php echo  $cname ;?>" class="form-control" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Lưu</button>
                                </form>



                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
            
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/footer.php'; ?>