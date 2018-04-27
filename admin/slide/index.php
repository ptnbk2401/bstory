<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>



<div id="page-wrapper">
    <div id="page-inner">
        <div class="row"> 
            <div class="col-md-12"> 
                 <h2> Quản Lí Slide Hình Ảnh</h2>
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
                                    <a href="/admin/slide/add.php?p=slide" class="btn btn-success btn-md">Thêm</a>
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
                                        <th width="150px">Tên Truyện</th>
                                        <th width="60px">Hiển thị</th>
                                        <th width="300">Xem trước</th>
                                        <th width="150px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT * FROM slide";
                                        $query = $conn->query($sql);
                                        $link = $query->num_rows ;
                                        if($link > 0){
                                            $i=0;
                                            while ($arSlide = mysqli_fetch_assoc($query)) {
                                                if ($i % 2 == 0) { $cl = "even"; } else { $cl = "odd"; }
                                                $id = $arSlide['ID'];
                                                $tentruyen =   $arSlide['tentruyen'];
                                                $name =   $arSlide['filename'];
                                                $hienthi =   $arSlide['hienthi'];                                 
                                                $urldel = "/admin/slide/delete.php?p=slide&id={$id}&img={$name}";
                                                $urledit = "/admin/slide/edit.php?p=slide&id={$id}";
                                                
                                                

                                       ?>
                                        <tr class="<?php echo $cl?> gradeX">
                                            <td style="text-align: center;"> <?php echo $id ?> </td>
                                            <td><?php echo $tentruyen ?></td>
                                            <td style="text-align: center;"><?php if($hienthi == 1) echo 'Có'; else echo 'Không'; ?></td>
                                            <td style="text-align: center;">
                                                <img src="/files/slide/<?php echo $name; ?>" alt="Ảnh SLide" width="250px" >
                                            </td>
                                            <td class="center" style="text-align: center;">
                                                <a href="<?php echo $urledit ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
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