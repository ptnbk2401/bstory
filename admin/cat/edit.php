<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner"> 
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa danh mục</h2>
            </div> 
        </div>
        <!-- /. ROW  -->
<?php 

    if(isset($_GET['idCat'])){
       $idCat = $_GET['idCat'];
       $sql = "SELECT * FROM cat WHERE cat_id= {$idCat}";
       $query = $conn->query($sql);
       $arDM = mysqli_fetch_assoc($query);
       $tencu = $arDM['name'];
    }

    if(isset($_POST['submit'])){
        if(empty($_POST['tendanhmuc'])){
            $tb="Nhập vào tên Danh mục!";
        }
        else {
            $name = strip_tags($_POST['tendanhmuc']);
            $bienregex = "/[\"'`]/" ;
            $bienthaythe = '&quot;' ;
            $name = preg_replace($bienregex, $bienthaythe, $name);
           

            $sql = "SELECT * FROM cat WHERE name = '{$name}' AND name != '{$tencu}' ";
            $query = $conn->query($sql);
            if($query->num_rows > 0){
                $tb = "Danh mục đã tồn tại";
            }
            else {
                $sql = "UPDATE cat SET name = '{$name}' WHERE cat_id= {$idCat} ";
                $query = $conn->query($sql);
                if($query){
                    header('location: /admin/cat/?p=cat&tb=Sửa danh mục thành công');
                } 
                else $tb = "Lỗi Sửa thất bại";
            }
        }
    }

?>
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
                                        <label>Tên Danh mục</label>
                                        <input type="text" name="tendanhmuc" id="tendanhmuc" class="form-control" value="<?php echo $tencu; ?>" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Lưu</button>
                                    <a class="btn btn-info btn-md" role="button" href="/admin/cat/?p=cat">Quay lại</a>
                                    <span id="Thongbao" style="color: green"><?php if(isset($tb)) echo $tb; ?></span>
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
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/footer.php'; ?>