<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/header.php'; ?>
      
<?php 
    if(isset($_GET['id'])){
        $idtruyen = $_GET['id'];
        $sql = "SELECT * FROM story 
                INNER JOIN slide ON story.slide_id = slide.ID 
                WHERE story_id = {$idtruyen} AND public = 1";
        // echo $sql; die();        
        $query      = $conn->query($sql);
        if($query->num_rows < 1) {
         header('location: /trang-chu');
        }
        $arStory    = mysqli_fetch_assoc($query);
        $idtruyen = $arStory['story_id'];
        $tentruyen  = $arStory['name'];
        $tentacgia  = $arStory['Tacgia'];
        $fileSlide  = $arStory['filename'];
        $noidung    = $arStory['detail_text'];
        $mota       = $arStory['preview_text']; 
        $ngaydang   = date("l, d-m-Y  | h:m A", strtotime($arStory['created_at']));
        $cat_id     = $arStory['cat_id']; 
        $luotdoc    = $arStory['counter']; 
        $sobinhluan	= $arStory['so_comment']; 
                 
       
       // Lượt đọc
            if(isset($_SESSION["luotdoc"][$idtruyen])){
                $luotdoc = $_SESSION["luotdoc"][$idtruyen];
            }
            else {
                $_SESSION["luotdoc"][$idtruyen] = ++$luotdoc;
            }
            $sql = "UPDATE  story SET counter = {$luotdoc} WHERE story_id = {$idtruyen} ";
            $query = $conn->query($sql);
        }
        else {
        header('location: /trang-chu');
        }


?>  <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1 class="h1 text-primary"> <?php echo $tentruyen ?></h1>

                <!-- Author -->
                <p class="lead text-danger">
                    Tác giả: <?php echo $tentacgia ?>
                </p>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $ngaydang;   ?></p>
                <!-- Preview Image -->
                <img class="img-responsive" src="/files/slide/<?php echo $fileSlide;  ?>" alt="">

                
                <hr>

                <!-- Post Content -->
                <p> <?php echo $noidung  ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" method="post" action="javascript:void(0)">
                        <div class="form-group">
                            <textarea class="form-control"  id="noidung" rows="3"></textarea>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary" data-toggle="modal"
    data-target="#myModal" >Gửi</button>
    					<span class="text-center" id="thongbaocmt"></span>
                    </form>
                </div>
                <hr>


                 <!-- modal -->
                <div id="myModal" class="modal fade" role="dialog">
			        <div class="modal-dialog">
			            <!-- Modal content-->
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal">&times;</button>
			                    <h4 class="modal-title">Vui lòng cho biết Tên và Email của bạn để tiếp tục</h4>
			                </div>
			                <div class="modal-body text-center" width="150px">
			                    <form method="post" action="javascript:void(0)">
				                    <input  class="form-control" type="text" id="fullnamecmt"  value="" autofocus placeholder="Họ Tên"><br/>
				                    <input  class="form-control"  type="email" id="emailcmt"  value="" placeholder="Email"><br/>
				                    <input type="submit" name="login" value="Tiếp tục" class="btn btn-default " onclick="return guicmt(<?php echo $idtruyen;?>,<?php echo $sobinhluan;?>)" data-dismiss="modal" >
				                </form>    
			                </div>
			            </div>
			        </div>
			    </div>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div id="cmt">                
	                <div class="well" >
	                	<h4>Bình luận: (<?php echo $sobinhluan;?>) </h4>
	                </div>
	                  <?php 
				        $sql = "SELECT * FROM comment WHERE story_id = {$idtruyen} ORDER BY id DESC LIMIT 5";
				        $query = $conn->query($sql);

				      ?>
				       <?php 
				        while($arCmt = mysqli_fetch_assoc($query)){
				        	$idcmt = $arCmt['id'];
				            $fullname = $arCmt['fullname'];
				            $noidung = $arCmt['noidung'];
				            $ngaybl   = date("l, d-m-Y  | h:m A", strtotime($arCmt['thoigian']));
                            $img = "/files/avt/".$arCmt['avt'];
				      ?>
				    <div class="media">
	                    <a class="pull-left" href="#">
	                        <img class="media-object" src="<?php echo  $img ;?>" width="64px" height="64px" >
	                    </a>
	                    <div class="media-body">
	                        <h4 class="media-heading"><?php echo $fullname; ?>
	                            <small><?php echo $ngaybl; ?></small>
	                        </h4>
	                        <p><?php echo $noidung; ?></p>
	                    </div>
	                </div>
					<?php }  ?>
				</div>


            </div>
            <script type="text/javascript">
			  function guicmt(idStory,socmt){
			     var name    = $("#fullnamecmt").val();
			     var email   = $("#emailcmt").val();
			     var noidung = $("#noidung").val();
                 if(name != ""){
                    $.ajax({
			        url: '/templates/bstory/ajax/comment.php',
                    type: 'POST',
                    cache: false,
                    data: {aname: name, aemail: email, amessage: noidung, aid: idStory,socmt: socmt},
                    success: function(data){
                    
                    if(data){
                        $("#cmt").html(data);
                        $("#fullnamecmt").val("");
                        $("#emailcmt").val("");
                        $("#noidung").val("");
                        
                    }
                    else alert("Rỗng");
                    //alert($("#cmt").html())
                    
                    },
                    error: function (){
                    alert('Có lỗi xảy ra');
                    }
                    });
                 }
                 else {
                    $("#fullnamecmt").attr("placeholder","Không để trống trường này");
                 }

			   
			    return false;
			  }
			</script>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                <?php 
                $sql = "SELECT * FROM story WHERE story_id != {$idtruyen} AND cat_id = {$cat_id} ORDER BY counter DESC LIMIT 4";
                 // echo $sql; die();
                $query = $conn->query($sql);
                while ($arSOther = mysqli_fetch_assoc($query)) {
                    $idSother  = $arSOther['story_id'];
                    $tenSother  = $arSOther['name'];
                    $hinhanh    = $arSOther['picture'];     
                    $tentruyen = utf8ToLatin($tenSother);
                    $urltruyen = "/baiviet/".$tentruyen."-".$idSother.".html";                         


                ?>
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="<?php echo  $urltruyen ; ?>">
                                    <img class="img-circle" src="/files/images/<?php echo $hinhanh; ?>" width="70px" height="70px">
                                </a>
                            </div>
                            <div class="col-md-7 h5">
                                <a href="<?php echo  $urltruyen ; ?>" class="text-warning" ><b><?php echo $tenSother; ?></b></a>
                            </div>
                            <!-- <p><?php echo $mota; ?>...</p> -->
                            <div class="break"></div>
                        </div>
                        <!-- end item -->

                        <?php } ?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                <?php 
                    $sql = "SELECT * FROM story WHERE story_id != {$idtruyen} ORDER BY counter  DESC ,story_id  DESC LIMIT 4";
                     // echo $sql; die();
                    $query = $conn->query($sql);
                    while ($arSHot = mysqli_fetch_assoc($query)) {
                        $idSHot  = $arSHot['story_id'];
                        $tenSHot  = $arSHot['name'];
                        $hinhanhSHot    = $arSHot['picture'];       
                        $tentruyen = utf8ToLatin($tenSHot);
                        $urltruyen = "/baiviet/".$tentruyen."-".$idSHot.".html";                      


                ?>  
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="<?php echo  $urltruyen ; ?>">
                                    <img class="img-circle" src="/files/images/<?php echo $hinhanhSHot; ?>" width="70px" height="70px">
                                </a>
                            </div>
                            <div class="col-md-7">
                                  <a href="<?php echo  $urltruyen ; ?>" class="text-warning" ><b><?php echo $tenSHot; ?></b></a>
                            </div>
                          <!--   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="break"></div>
                        </div>
                        <!-- end item -->

                      <?php } ?>  
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Footer -->
    <hr>
<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/bstory/inc/footer.php'; ?>