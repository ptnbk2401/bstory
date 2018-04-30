<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
    <div class="row"> 
            <div class="col-md-12"> 
                <ul class="nav nav-tabs">
                    <li ><a href="/admin/story/?p=story"  >Danh Sách Truyện</a></li>
                    <li class="active"><a  href="/admin/story/quanlibaidang.php?p=story" >Quản lí Bài Đăng</a></li>
                </ul>
            </div>
        </div>
        <!-- /. ROW  -->

<?php   
    $hienthi = 5;
    $sql = "SELECT * FROM story";
    $query = $conn->query($sql);
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
			<div class="col-md-12" style="margin: 20px 0">
				<?php 
					if(isset($_GET['tb'])){
						
				?>
				
					<div class="alert alert-success">
						<a href="" class="close" title="Close" data-dismiss="alert" aria-label="close">&times;</a>				
					<?php
							echo "<strong>Success!</strong> {$_GET['tb']}";
						}   

					?>
					</div>
			</div>
				
			
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                
                            </div>
                            <div>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="370px">Tiêu đề</th>
                                        <th width="100px">Truyện Hot</th>
                                        <th>Đổi trạng thái</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT *,cat.name as Catname, story.name as Storyname FROM story LEFT JOIN cat USING(cat_id) ORDER BY story_id DESC LIMIT ". $hienthi*($page -1) .", ". $hienthi ;
                                        $query = $conn->query($sql);
                                        $link = $query->num_rows ;
                                        if($link > 0){
                                            $i=0;
                                            while ($arStory = mysqli_fetch_assoc($query)) {
                                                if ($i % 2 == 0) { $cl = "even"; } else { $cl = "odd"; }
                                                $Catname = $arStory['Catname'];
                                                $name    = $arStory['Storyname'];
                                                $idStory = $arStory['story_id'];
                                                $image   = $arStory['picture'];
                                                $counter = $arStory['counter'];
                                                $public  = $arStory['public'];
                                                $cmt     = $arStory['so_comment'];
                                                

                                       ?>
                                        <tr class="<?php echo $cl?> gradeX">
                                            <td style="text-align: center;"><?php echo $idStory ?></td>
                                            <td><?php echo $name ?></td>
                                            <td style="text-align: center;"></td>
                                            <td class="center" style="text-align: center;">
                                                <div id="changePL-<?php echo $idStory ;?>">
                                                    <a href="javascript:void(0)" onclick="return changePL(<?php echo $idStory; ?>)">
                                                    <?php
                                                        if($public == 1) echo 'public' ; else echo 'private';
                                                    ?>

                                                     </a>
                                                </div>
                                                
                                            </td>
                                            <td class="center" style="text-align: center;"> <a class="text-dark" href="/admin/story/xembinhluan.php?p=story&id=<?php echo $idStory ?>"> <?php echo $cmt; ?></a></td>
                                            
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
                                            <li class="paginate_button previous <?php if($page < 2) echo 'disabled' ?>" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="/admin/story/quanlibaidang.php?p=story&page=<?php echo $page -1 ?>">Trang trước</a></li>
                                        <?php 
                                                for($i= 1 ; $i<= $sotrang ; $i++) {
                                                    if($page == $i){
                                        ?>         
                                            <li class="paginate_button active " aria-controls="dataTables-example" tabindex="0"><a href="/admin/story/quanlibaidang.php?p=story&page=<?php echo $i ?>"><?php echo $i ?></a></li>


                                        <?php
                                                    } else {

                                        ?>  
                                            <li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="/admin/story/quanlibaidang.php?p=story&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php 

                                                    }
                                                }
                                            
                                        ?>
                                            <li class="paginate_button next <?php if($page == $sotrang) echo 'disabled' ?> " aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="/admin/story/quanlibaidang.php?p=story&page=<?php if($page < $sotrang) echo $page + 1 ; else $page = $sotrang; ?>">Trang tiếp</a></li>
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
    <script type="text/javascript">
                                          
      function changePL(idStory){
            var idData = '#changePL-'+idStory;
                $.ajax({
                url: '/templates/admin/ajax/changePL.php',
                type: 'POST',
                cache: false,
                data: {Aid: idStory },
                success: function(data){
                    $(idData).html(data);
                   
                    
                }, 
                error: function() {
                   alert("Có lỗi");
                }


              }); 
            
               return false;
        }

    </script>
</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/footer.php'; ?>