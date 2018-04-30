<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>



<div id="page-wrapper">
    <div id="page-inner">
        <div class="row"> 
            <div class="col-md-12">
				<div class="alert alert-info h3 text-center">
					<strong>Quản lý Liên Hệ</strong>
				</div>
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
                                    <!-- <a href="/admin/user/add.php?p=user" class="btn btn-success btn-md">Thêm</a> -->
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
                                        <th width="120px">Name</th>
                                        <th width="80px">Email</th>
                                        <th width="80px">Website</th>
                                        <th width="170px">Nội dung</th>
                                        <th width="100px">Trả lời</th>
                                        <th width="200px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT * FROM contact ORDER BY traloi ASC";
                                        $query = $conn->query($sql);
                                        $link = $query->num_rows ;
                                        if($link > 0){
                                            $i=0;
                                            while ($arContact = mysqli_fetch_assoc($query)) {
                                                if ($i % 2 == 0) { $cl = "even"; } else { $cl = "odd"; }
                                                $id         = $arContact['contact_id'] ;
                                                $name       = $arContact['name'] ;
                                                $email      = $arContact['email'] ;  
                                                $website    = $arContact['website'] ;
                                                $noidung    = $arContact['content'] ;
                                                $traloi    = $arContact['traloi'] ;                                            
                                                $urldel    = "/admin/lienhe/delete.php?id={$id}";
                                                $urlTraloi = "/admin/lienhe/traloi.php?p=lienhe&id={$id}";

                                       ?>
                                        <tr class="<?php echo $cl?> gradeX">
                                            <td style="text-align: center;"><?php echo $id ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $email ?></td>
                                            <td><?php echo $website ?></td>
                                            <td><?php echo $noidung ?></td>
                                            <td><?php if($traloi == 1) echo "OK" ; else echo "Chưa"; ?></td>
                                            <td class="center">
                                                <a href="<?php echo $urlTraloi ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Trả lời</a>
                                                <a href="<?php echo $urldel ?>" title="" onclick="return confirm('Bạn có chắc muốn xóa!!')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
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

</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/footer.php'; ?>