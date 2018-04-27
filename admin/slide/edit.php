<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner"> 
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa</h2>
            </div> 
        </div>
        <!-- /. ROW  -->
<?php  
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM slide WHERE ID = {$id}";
        $query = $conn->query($sql);
        $arSlide = mysqli_fetch_assoc($query);
        $image = $arSlide['filename'];
        $tentruyencu = $arSlide['tentruyen'];
        $hienthicu = $arSlide['hienthi'];

    }


    if(isset($_POST['submit'])) {
        $tentruyen = strip_tags($_POST['tentruyen']);
        $bienregex = "/[\"'`]/" ;
        $bienthaythe = '&quot;' ;
        $tentruyen = preg_replace($bienregex, $bienthaythe, $tentruyen);

        if(isset($_POST['checkbox'])){
            $hienthi = $_POST['checkbox'];
        }
        else $hienthi = 0;
        
        if(!empty($_FILES['hinhanh']['tmp_name'])) {
            $image_name = $_FILES['hinhanh']['name'];
            $arname = explode('.',$image_name);
            $duoifile = end($arname);
            $file_name = 'SLIDE-'.time().'.'.$duoifile;
            $filetmp = $_FILES['hinhanh']['tmp_name'];
            //echo "Đường dẫn lưu tạm: $filetmp<br>";
            $filePath = $_SERVER['DOCUMENT_ROOT'].'/files/slide/'.$file_name;
            $result = move_uploaded_file($filetmp,$filePath) or die("Upload không thành công"); 
            
            $sql = "UPDATE slide SET tentruyen = '{$tentruyen}',filename = '{$file_name}',hienthi= {$hienthi} WHERE ID = {$id}";  
            // Xóa hình ảnh cũ.
            if(!empty($image)){
               unlink($_SERVER['DOCUMENT_ROOT'].'/files/slide/'.$image);
            } else{
               echo ("Xóa hình ảnh củ THẤT BẠI") ;
            }
             
    
        }
        else { 
             $sql = "UPDATE slide SET tentruyen = '{$tentruyen}',hienthi= {$hienthi} WHERE ID = {$id}";  
      
        }
        $query = $conn->query($sql);
       if($query){
           
            header('location: /admin/slide/?p=slide&tb=Sửa thành công');
        } 
        else $tb = "Lỗi thêm thất bại";

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
                                <form role="form" method="post" enctype = 'multipart/form-data'>

                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh"  />
                                        <img src="/files/slide/<?php echo $image; ?>" alt="Ảnh SLide" width="250px" >
                                    </div>
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                         <input type="text" name="tentruyen" id="tentruyen" required="required" value="<?php echo $tentruyencu ; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Hiển thị ngay</label>
                                        <input type="checkbox" name="checkbox" id="checkbox"  value="1" <?php if($hienthicu == 1) echo 'checked' ; ?> >
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Lưu</button>
                                    <span style="color: green"><?php if(isset($tb)) echo $tb; ?></span>
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