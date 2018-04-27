<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>



<div id="page-wrapper">
    <div id="page-inner">
        <div class="row"> 
            <div class="col-md-12"> 
                <?php 
                    $adminlogin =  $arUserLogin['admin'];
                    if($adminlogin == 0){

                ?>
                    <h2>Bạn không có quyền truy cập Trang Quản Lí User</h2>
                    <img src="/files/hot-girl.jpg" alt="hot-girl.jpg" title="Người yêu Em đẹp không!!" width=100%>
            </div>
        </div>
                <?php 
                    }
                    else{

                ?>
                 <h2>Trang Quản Lí User</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
<!--  -->
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="/admin/user/add.php?p=user" class="btn btn-success btn-md">Thêm</a>
                                    <?php 
                                        if(isset($_GET['tb'])){

                                            echo "<span style='color: green'> {$_GET['tb']}</span>";
                                        }   

                                    ?>

                                </div>

                            </div>
                            <hr>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="50px">ID</th>
                                        <th width="250px">Username</th>
                                        <th width="300px">Fullname</th>
                                        <th width="150px">Quyền hạn</th>
                                        <th width="150px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT * FROM users";
                                        $query = $conn->query($sql);
                                        $link = $query->num_rows ;
                                        if($link > 0){
                                            $i=0;
                                            while ($arUser = mysqli_fetch_assoc($query)) {
                                                if ($i % 2 == 0) { $cl = "even"; } else { $cl = "odd"; }
                                                $idUser = $arUser['id'] ;
                                                $username = $arUser['username'] ;
                                                $fullname = $arUser['fullname'] ;  
                                                $admin = $arUser['admin'] ;                                              
                                                $urldel = "/admin/user/delete.php?idUser={$idUser}";
                                                $urledit = "/admin/user/edit.php?p=user&idUser={$idUser}";

                                       ?>
                                        <tr class="<?php echo $cl?> gradeX">
                                            <td><?php echo $idUser ?></td>
                                            <td><?php echo $username ?></td>
                                            <td><?php echo $fullname ?></td> 
                                            <td><?php if($admin==1) echo "Admin"; else echo "Nhân viên" ; ?></td>
                                            <td class="center">
                                                <a href="<?php echo $urledit ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                                <?php if($username != 'admin'){ ?>
                                                <a href="<?php echo $urldel ?>" title="" onclick="return confirm('Bạn có chắc muốn xóa!!')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                                <?php } ?>
                                                
                                            </td>
                                        </tr>

                                       <?php             

                                            }
                                        }

                                        ?>
                                    
                                  
                                </tbody>
                            </table>
                           
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
<?php  } ?>
</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/footer.php'; ?>