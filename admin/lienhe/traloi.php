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
                                    <span style="color: green"><?php if(isset($tb)) echo $tb; ?></span>
                                </form>
                            </div>

                            <!-- Vùng javascript -->
                            <script ype="text/javascript" >
                                function checkpass(){
                                    
                                    if($("#password").val() == $("#repassword").val()){
                                         //alert("ok");
                                         $("#check").html("&nbsp; <img src='/templates/admin/img/ok.png' width='20px;'/>");
                                    }
                                    else { 
                                         //alert("Chưa OK");
                                          $("#check").text("Mật khẩu chưa khớp");
                                    }

                                }

                                function hienpass(){
                                    if($("#password").attr('type')=='password'){
                                        $("#password").attr('type','text');
                                        $("#repassword").attr('type','text');
                                        $("#hienpass").attr('src','/templates/admin/img/an.png' );
                                        $("#apass").attr('title','Ẩn mật khẩu');
                                    } else {
                                        $("#password").attr('type','password');
                                        $("#repassword").attr('type','password');
                                        $("#hienpass").attr('src','/templates/admin/img/hien.png' );
                                        $("#apass").attr('title','Hiện mật khẩu');
                                    }                                  

                                }
                                function changepass(){
                                    $("#span-password").html('<input type="password" name="password" id="password" class="form-control" style="width: 500px"/>');        
                                    $("#form-repassword label").text('Nhập Lại Mật Khẩu');   
                                    $("#repassword").attr('type','password');  
                                    $("#hidden-a").html('<a href="javascript:void(0)" onclick="return hienpass()" title="Hiện mật khẩu" id="apass"><img id="hienpass" width="40px" src="/templates/admin/img/hien.png" ></a>');      

                                }
                                function kiemtrafullname(){
                                    var fullname = $("#fullname").val();
                                    $.ajax({
                                        url: '/templates/admin/ajax/kiemtrafullname.php',
                                        type: 'POST',
                                        cache: false,
                                        data: {aFullname: fullname },
                                        success: function(data){
                                         // alert(data);
                                         $('#span-fullname').html(data);
                                         if(data == 1){
                                             $('#span-fullname').html("<img src='/templates/admin/img/ok.png' width='20px;'/>");
                                         }
                                         else {
                                             $('#fullname').val("");
                                         }
                                        
                                        },
                                        error: function(){
                                          alert('Có lỗi xảy ra');
                                        }
                                        });
                                        return false;
                                }

                                


                            </script>

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