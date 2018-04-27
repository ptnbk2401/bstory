<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>



<?php   
    $hienthi = 5;
    $sql = "SELECT * FROM story";
    $query = $conn->query($sql);
    $sotruyen = $query->num_rows ;
    if($sotruyen % $hienthi == 0) {
        $sotrang = $sotruyen / $hienthi ;
    }
    else {
         $sotrang = (int)($sotruyen / $hienthi) + 1;
    }

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
                                    <a href="/admin/story/add.php?p=story" class="btn btn-success btn-md">Thêm</a>
                                    <?php 
                                        if(isset($_GET['tb'])){

                                            echo "<span style='color: green'> {$_GET['tb']}</span>";
                                        }   

                                    ?>

                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="javascript:void(0)">
                                        <input type="submit" name="submit" id="submit" value="Tìm kiếm" onclick="return searchStory()" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" name="tentruyen" id="tentruyen" class="form-control input-sm" placeholder="Nhập tên Truyện" style="float:right; width: 300px;" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                    <script type="text/javascript">
                                      
                                          function searchStory(){
                                            var tentruyen = $("#tentruyen").val();    
                                                if(tentruyen != ""){
                                                    $.ajax({
                                                    url: '/templates/admin/ajax/search.php',
                                                    type: 'POST',
                                                    cache: false,
                                                    data: {aStory: tentruyen},
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
                                        <th width="370px">Tiêu đề</th>
                                        <th width="150px">Danh mục</th>
                                        <th>Lượt đọc</th>
                                        <th>Hình ảnh</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT story_id,cat.name as Catname, story.name as name,picture,counter FROM story LEFT JOIN cat ON cat.cat_id = story.cat_id ORDER BY story_id DESC LIMIT ". $hienthi*($page -1) .", ". $hienthi ;
                                        $query = $conn->query($sql);
                                        $link = $query->num_rows ;
                                        if($link > 0){
                                            $i=0;
                                            while ($arStory = mysqli_fetch_assoc($query)) {
                                                if ($i % 2 == 0) { $cl = "even"; } else { $cl = "odd"; }
                                                $Catname = $arStory['Catname'];
                                                $name = $arStory['name'];
                                                $idStory = $arStory['story_id'];
                                                $image = $arStory['picture'];
                                                $counter = $arStory['counter'];
                                                $urldel = "/admin/story/delete.php?p=story&idStory={$idStory}";
                                                $urledit = "/admin/story/edit.php?p=story&idStory={$idStory}";

                                       ?>
                                        <tr class="<?php echo $cl?> gradeX">
                                            <td><?php echo $idStory ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $Catname ?></td>
                                            <td class="center"><?php echo $counter ?></td>
                                            <td class="center">
                                                <img src="/files/images/<?php echo $image;?>" alt="Thumbnail" height="80px" width="100px" />
                                            </td>
                                            <td class="center">
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ <?php echo $hienthi*($page -1) + 1 ; ?> đến  <?php echo $hienthi*($page -1)  + $hienthi  ; ?>  của <?php echo $sotruyen; ?> truyện</div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous <?php if($page < 2) echo 'disabled' ?>" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="/admin/story/?p=story&page=<?php echo $page -1 ?>">Trang trước</a></li>
                                        <?php 
                                                for($i= 1 ; $i<= $sotrang ; $i++) {
                                                    if($page == $i){
                                        ?>         
                                            <li class="paginate_button active " aria-controls="dataTables-example" tabindex="0"><a href="/admin/story/?p=story&page=<?php echo $i ?>"><?php echo $i ?></a></li>


                                        <?php
                                                    } else {

                                        ?>  
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="/admin/story/?p=story&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php 

                                                    }
                                                }
                                            

                                        ?>
                                            <li class="paginate_button next <?php if($page == $sotrang) echo 'disabled' ?> " aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="/admin/story/?p=story&page=<?php if($page < $sotrang) echo $page + 1 ; else $page = $sotrang; ?>">Trang tiếp</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>   <!--End Data ajax -->
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