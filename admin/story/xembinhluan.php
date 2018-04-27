<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="container"> 
            <div class="col-md-12"> 
                <ul class="nav nav-tabs">
                    <li ><a  href="/admin/story/?p=story"  >Danh Sách Truyện</a></li>
                    <li class="active"><a href="/admin/story/quanlibaidang.php?p=story" >Quản lí Bài Đăng</a></li>
                </ul>
            </div>
        <!-- /. ROW  -->
        </div>
        <?php 
            if(isset($_GET['id'])){
                $idStory = $_GET['id'];
                $sql = "SELECT * FROM comment WHERE story_id = {$idStory}";
                // echo $sql; die();
                $query = $conn->query($sql);
            }
            else {
                header('location: /admin/story/quanlibaidang.php?p=story');
            }

        ?>
        <div class="table-responsive">
            <div class="row">
                
            </div>
            <div>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Người comment</th>
                        <th>Nội dung</th>
                        <th>Email</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                            while($arCmt = mysqli_fetch_assoc($query)){
                                $id =  $arCmt['id'];
                                $name =  $arCmt['fullname'];
                                $email =  $arCmt['email'];
                                $noidung =  $arCmt['noidung'];


                        ?>
                        <tr class="<?php echo $cl?> gradeX">
                            <td style="text-align: center;"><?php echo $id?></td>
                            <td><?php echo $name ?></td>
                            <td ><?php echo $noidung ?></td>
                            <td><?php echo $email ?></td>
                            <td class="text-center"> <a href=" /admin/story/xoabinhluan.php?id=<?php echo $id?>&idStory=<?php echo $idStory?>"  onclick="return confirm('Bạn có chắc muốn xóa!!')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a></td>
                        </tr>                    
                  <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/footer.php'; ?>