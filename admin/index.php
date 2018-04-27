<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12"> 
                <h2>TRANG QUẢN TRỊ VIÊN</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <?php 
            $sql1 = "SELECT * FROM cat";
            $sql2 = "SELECT * FROM story";
            $sql3 = "SELECT * FROM users";

            $query1 = $conn->query($sql1);
            $query2 = $conn->query($sql2);
            $query3 = $conn->query($sql3);
            $soDM       = $query1->num_rows;
            $sotruyen   = $query2->num_rows;
            $souser     = $query3->num_rows;


        ?>
        <hr />
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/cat/?p=cat" title="">Quản lý danh mục</a></p>
                        <p class="text-muted">Có <?php echo $soDM; ?> danh mục</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-bell-o"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/story/?p=story" title="">Quản lý <br/>truyện</a></p>
                        <p class="text-muted">Có <?php echo $sotruyen; ?>  truyện</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/user/?p=user" title="">Quản lý người dùng</a></p>
                        <p class="text-muted">Có <?php echo $souser; ?>  người dùng</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/templates/admin/inc/footer.php'; ?>