<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row"> 
            <div class="col-md-12">
				<div class="alert alert-info h3 text-center">
					<strong>Quản lý danh mục</strong>
				</div>
            </div>
        </div> 
        <!-- /. ROW  -->
        <hr />

<?php   
  
    $hienthi = 5;
    if(isset($sql1)){
        $query = $conn->query($sql1);
        echo $sql1;
    }
    else {
        $sql = "SELECT * FROM cat";
        $query = $conn->query($sql);
    }
    $sotruyen = $query->num_rows ;
    $sotrang = ceil($sotruyen / $hienthi) ;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else $page = 1;
    if($page > $sotrang) $page = $sotrang;
    if($page < 1) $page = 1;

?>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="/admin/cat/add.php?p=cat" class="btn btn-success btn-md">Thêm</a>
                                    <?php 
                                        if(isset($_GET['tb'])){

                                            echo "<span style='color: green'> {$_GET['tb']}</span>";
                                        }   

                                    ?>

                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="javascript:void(0)">
                                        <input type="submit" name="submit" id="submit" value="Tìm kiếm" onclick="return searchCat()" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" name="tendanhmuc" id="tendanhmuc" class="form-control input-sm" placeholder="Nhập tên danh mục" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                    <script type="text/javascript">
                                      
                                          function searchCat(){
                                            var tendanhmuc = $("#tendanhmuc").val();    
                                                if(tendanhmuc != ""){
                                                    $.ajax({
                                                    url: '/templates/admin/ajax/search.php',
                                                    type: 'POST',
                                                    cache: false,
                                                    data: {aCat: tendanhmuc},
                                                    success: function(data){
                                                        if(data != 'false'){
                                                           $('#Dataajax').html(data);
                                                        }
                                                        
                                                    }, 
                                                    error: function() {
                                                       alert("Có lỗi");
                                                    }


                                                  }); 
                                                }
                                                   return false;
                                            }
                                           

                                          
                                    </script>
                                </div>
                            </div>
                            <div id="Dataajax">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên Danh mục</th>
                                            <th>Số Truyện</th>
                                            <th width="160px">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT * FROM cat ORDER BY cat_id DESC LIMIT ". $hienthi*($page -1) .", ". $hienthi;
                                            $query = $conn->query($sql);
                                            $link = $query->num_rows ;
                                            if($link > 0){
                                                $i=0;
                                                while ($arCat = mysqli_fetch_assoc($query)) {
                                                    if ($i % 2 == 0) { $cl = "even"; } else { $cl = "odd"; }
                                                    $idCat      = $arCat['cat_id'];
                                                    $name       = $arCat['name'];
                                                    $urldel     = "/admin/cat/delete.php?idCat={$idCat}";
                                                    $urledit    = "/admin/cat/edit.php?p=cat&idCat={$idCat}";
                                                // Truy vấn lấy số truyện: 
                                                    $sqlSelect   = "SELECT COUNT(story_id) as sotruyen FROM story WHERE cat_id = {$idCat} ";
                                                    $querySelect = $conn->query($sqlSelect);
                                                    $tongtruyen    = mysqli_fetch_assoc($querySelect);

                                           ?>
                                            <tr class="<?php echo $cl?> gradeX">
                                                <td class="text-center"><?php echo $idCat ?></td>
                                                <td><?php echo $name ?></td>
                                                <td class="text-center"><?php echo $tongtruyen['sotruyen'] ?></td>
                                                <td class="center">
                                                    <a href="<?php echo $urledit ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                                    <a href="<?php echo $urldel ?>" title="" onclick="return confirm('Bạn có chắc muốn xóa Danh mục <?=$name ?> Và <?=$tongtruyen['sotruyen'] ?> Truyện thuộc Danh mục này!!')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                                </td>
                                            </tr>

                                           <?php             

                                                }
                                            }

                                            ?>
                                    </tbody>
                                </table>
                               <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ <?php echo $hienthi*($page -1) + 1 ; ?> đến  <?php echo $hienthi*($page -1)  + $hienthi  ; ?>  của <?php echo $sotruyen; ?> Danh mục</div>
                                    </div>
                                    <div class="col-sm-6" style="text-align: right;">
                                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button previous <?php if($page < 2) echo 'disabled' ?>" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="/admin/cat/?p=cat&page=<?php echo $page -1 ?>">Trang trước</a></li>
                                            <?php 
                                                    for($i= 1 ; $i<= $sotrang ; $i++) {
                                                        if($page == $i){
                                            ?>         
                                                <li class="paginate_button active " aria-controls="dataTables-example" tabindex="0"><a href="/admin/cat/?p=cat&page=<?php echo $i ?>"><?php echo $i ?></a></li>


                                            <?php
                                                        } else {

                                            ?>  
                                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="/admin/cat/?p=cat&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                            <?php 

                                                        }
                                                    }
                                                

                                            ?>
                                                <li class="paginate_button next <?php if($page == $sotrang) echo 'disabled' ?> " aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="/admin/cat/?p=cat&page=<?php if($page < $sotrang) echo $page + 1 ; else $page = $sotrang; ?>">Trang tiếp</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>  
                
                            </div><!--Dataajax-->
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