<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>
<?php 
    $sql    = "SELECT * FROM slide WHERE hienthi = 1";
    $query  = $conn->query($sql);
    $link   = $query->num_rows ;


?>
<div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php for($i=0;$i<$link;$i++){ 
                            if($i==0){
                        ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="active" ></li>
                        <?php } else { ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>"></li>
                        
                       <?php } } ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php $j = 0;
                            while($arSlide = mysqli_fetch_assoc($query)){
                            $tentruyen = $arSlide['tentruyen'];
                            $tenfile   = $arSlide['filename'];
                            if($j==0){
                        ?>
                        <div class="item active">
                            <img class="slide-image" src="/files/slide/<?php echo $tenfile; ?>" alt="">
                        </div>
                        <?php } else { ?>
                        <div class="item">
                            <img class="slide-image" src="/files/slide/<?php echo $tenfile; ?>" alt="">
                        </div>
                        <?php } $j++; } ?>
                       
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>