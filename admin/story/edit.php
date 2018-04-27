<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner"> 
        <div class="row">
            <div class="col-md-12">
                <h2>Cập Nhật Truyện</h2>
            </div> 
        </div>
        <!-- /. ROW  -->
<?php  
   // function regex($tring){
   //      $Tenhople = "/^([\w]*[\s ! @ & , \. \? ; : _ = # \$ \| \+ - \* \/ % ^ \( \) \{ \} \[ \] \" ' < > ]*)+$/u";
   //      if(preg_match($Tenhople,$tring,$result)){
   //         return 1;
   //      }
   //      return 0;
   //  }
    if(isset($_GET['idStory'])){
        $image = $_GET['img'];
        $idStory = $_GET['idStory'];
        $sql = "SELECT * FROM story WHERE story_id = {$idStory}" ;
        $query = $conn->query($sql);
        $arStory = mysqli_fetch_assoc($query) ;
            $namecu = $arStory['name'];
            $motacu = $arStory['preview_text'];
            $chitietcu = $arStory['detail_text'];
            $idCatcu = $arStory['cat_id'];
            $image = $arStory['picture'];
            $publiccu = $arStory['public'];
            $tacgiacu = $arStory['Tacgia'];
            $slidecu = $arStory['slide_id'];
    }


    if(isset($_POST['submit'])){
        if(empty($_POST['tentruyen']) || empty($_POST['danhmuc']) || empty($_POST['tacgia']) || empty($_POST['anhslide']) || empty($_POST['mota']) || empty($_POST['chitiet'])){
            $tb="Nhập vào đầy đủ các trường trên!";
        } 
        else {
            $name    = $_POST['tentruyen'];
            $slideid = $_POST['anhslide'];
            $tacgia  = $_POST['tacgia']; 
            $Catid   = $_POST['danhmuc'];
            $mota    = $_POST['mota'];
            $chitiet = $_POST['chitiet'];
            if(isset($_POST['public'])){
                $public  = $_POST['public'];
            } else $public = 0;
           
            $name = strip_tags($name);
            $mota = strip_tags($mota);
            $bienregex = "/[\"'`]/" ;
            $bienthaythe = '&quot;' ;
            $name = preg_replace($bienregex, $bienthaythe, $name);
            $mota = preg_replace($bienregex, $bienthaythe, $mota);
                             
            if(!empty($_FILES['hinhanh']['tmp_name'])) {
                $image_name = $_FILES['hinhanh']['name'];
                $arname = explode('.',$image_name);
                $duoifile = end($arname);
                $file_name = 'VNE-'.time().'.'.$duoifile;
                $filetmp = $_FILES['hinhanh']['tmp_name'];
                //echo "Đường dẫn lưu tạm: $filetmp<br>";
                $filePath = $_SERVER['DOCUMENT_ROOT'].'/files/images/'.$file_name;
                $result = move_uploaded_file($filetmp,$filePath) or die("Upload không thành công"); //('đường dẫn tạm','đường dẫn lưu file');  
                $sql = "UPDATE story SET name = '{$name}', preview_text = '{$mota}',detail_text = '{$chitiet}', cat_id= {$Catid}, picture='{$file_name}', public='{$public}', Tacgia = '{$tacgia}',slide_id = '{$slideid}'    WHERE story_id = {$idStory} ";  

            }
            else { 
                $sql = "UPDATE story SET name = '{$name}', preview_text = '{$mota}',detail_text = '{$chitiet}', cat_id= {$Catid}, public='{$public}', Tacgia = '{$tacgia}',slide_id = '{$slideid}'  WHERE story_id = {$idStory} ";      
            }
         
            $query = $conn->query($sql);
            if($query){
                // Xóa hình ảnh cũ.
                if(!empty($image)){
                    if($image != "story-default.jpg") unlink($_SERVER['DOCUMENT_ROOT'].'/files/images/'.$image);
                 } 
                 header('location: /admin/story/?p=story&tb=Sửa truyện thành công!');
            } 
            else {
                header('location: /admin/story/?p=story&tb=Sửa truyện thất bại!');
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
                                
                                <form role="form" method="post" enctype = 'multipart/form-data'>
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="tentruyen" class="form-control" value="<?php echo $namecu ; ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select class="form-control" name ="danhmuc" >
                                                <option value="">-Chọn Danh Mục-</option>
                                                <?php 
                                                    $sql = "SELECT * FROM cat";
                                                    $query = $conn->query($sql);
                                                    while ($arCat = mysqli_fetch_assoc($query)){
                                                        $name = $arCat['name'];
                                                        $idCat = $arCat['cat_id'];
                                                        if($idCat == $idCatcu){
                                                ?>
                                                    <option selected value="<?php echo $idCat ;?>"><?php echo $name ;?></option>
                                                <?php      
                                                    } else {

                                                ?>
                                                    <option value="<?php echo $idCat ;?>"><?php echo $name ;?></option>
                                                <?php        
                                                    }
                                                    }
                                                ?>  
                                                
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tác Giả</label>
                                        <input type="text" name="tacgia" class="form-control" value="<?php echo $tacgiacu ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh" accept=".jpg, .jpeg, .png"/>
                                        <img src="/files/images/<?php echo $image ?>" alt="" height="80px" width="100px" >
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh Slide</label>
                                        <select class="form-control" name ="anhslide" >
                                                <option value="">-Chọn Ảnh Slide-</option>
                                                <?php 
                                                    $sql = "SELECT * FROM slide";
                                                    $query = $conn->query($sql);
                                                    while ($arCat = mysqli_fetch_assoc($query)){
                                                        $filename = $arCat['tentruyen'];
                                                        $idslide = $arCat['ID'];
                                                        if($slidecu == $idslide ) $slide = "selected";
                                                        else $slide = "";
                                                ?>
                                                    <option <?php echo $slide ;?>  value="<?php echo $idslide ;?>"><?php echo $filename ;?></option>
                                                <?php        
                                                    }
                                                ?>  
                                                
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="mota" ><?php echo  $motacu ;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea class="form-control ckeditor" rows="5" name="chitiet"><?php echo  $chitietcu ;?></textarea>
                                    </div>
                                     <div class="form-group">
                                        <label>Public</label>
                                        <input type="checkbox" name="public" value= '1' <?php if( $publiccu ) echo 'checked'; ?> />
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