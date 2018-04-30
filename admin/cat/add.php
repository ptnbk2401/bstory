<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">  
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm danh mục</h2>
            </div> 
        </div>
        <!-- /. ROW  --> 
<?php 

    if(isset($_POST['submit'])){
        if(empty($_POST['tendanhmuc'])){
            $tb="Nhập vào tên Danh mục cần thêm!";
        }
        else {
            $name = $_POST['tendanhmuc'];
            $name = strip_tags($name);
            $bienregex = "/[\"'`]/" ;
            $bienthaythe = '&quot;' ;
            $name = preg_replace($bienregex, $bienthaythe, $name);
            
            $sql = "SELECT * FROM cat WHERE name = '{$name}'";
            $query = $conn->query($sql);
            if($query->num_rows > 0){
                $tb = "Danh mục đã tồn tại";
            }
            else {
                $sql = "INSERT INTO cat(name) VALUES ('{$name}') ";
                $query = $conn->query($sql);
                if($query){
                    header('location: /admin/cat/?tb=Thêm danh mục thành công');
                } 
                else $tb = "Lỗi thêm thất bại";
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
                                        <input type="text" name="tendanhmuc" id="tendanhmuc" value="<?php if(isset($name)) echo  $name ;?>" class="form-control" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
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
     