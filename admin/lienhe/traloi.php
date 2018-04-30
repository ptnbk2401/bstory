<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner"> 
        <div class="row">
            <div class="col-md-12">
                <h2>Trả lời</h2>
            </div> 
        </div>
        <!-- /. ROW  -->
        <?php 
            if(isset($_GET['id'])){
                 $id =$_GET['id'];
                 $sql = "SELECT * FROM contact WHERE contact_id = {$id}";
                 $query = $conn->query($sql);
                 $arLienhe = mysqli_fetch_assoc($query);
                 $email =   $arLienhe['email']; 
            }
            if(isset($_POST['submit'])){
                $sql = "UPDATE contact  SET traloi = 1 WHERE contact_id = {$id}";
                $query = $conn->query($sql);
                if($query){
                    header('location: /admin/lienhe?p=lienhe&tb=Gửi trả lời thành công!');
                }
                else die('Gửi trả lời thất bại!');
            }


        ?>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-11">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Người nhận:</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo  $email; ?>"  style="width: 500px"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung trả lời:</label>
                                        <textarea type="text" name="noidungthu" class="form-control" required  style="width: 500px"></textarea>
                                    </div>
                            
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Gửi</button>
                                    <a class="btn btn-info btn-md" role="button" href="/admin/lienhe/?p=lienhe">Quay lại</a>
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