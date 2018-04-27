<?php require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConnectDBUtil.php' ?>
<?php 
// Begin Tìm kiếm Danh mục
if(isset($_POST['aCat'])){
	  $Catname = $_POST['aCat'];
	  $sql = "SELECT * FROM cat WHERE name LIKE '%{$Catname}%'";
	  $query = $conn->query($sql);
	  	
	?>			<span style="color: #09ACC9;">Kết quả tìm kiếm: <?php echo $query->num_rows ; ?></span>
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	                <thead>
	                    <tr>
	                        <th>ID</th>
	                        <th>Tên Danh mục</th>
	                        <th width="160px">Chức năng</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php 
	                        $sql = "SELECT * FROM cat WHERE name LIKE '%{$Catname}%' ORDER BY cat_id DESC";
	                        $query = $conn->query($sql);
	                        $link = $query->num_rows ;
	                        if($link > 0){
	                            $i=0;
	                            while ($arCat = mysqli_fetch_assoc($query)) {
	                                if ($i % 2 == 0) { $cl = "even"; } else { $cl = "odd"; }
	                                $idCat = $arCat['cat_id'];
	                                $name = $arCat['name'];
	                                $urldel = "/admin/cat/delete.php?idCat={$idCat}";
	                                $urledit = "/admin/cat/edit.php?p=cat&idCat={$idCat}";

	                       ?>
	                        <tr class="<?php echo $cl?> gradeX">
	                            <td><?php echo $idCat ?></td>
	                            <td><?php echo $name ?></td>
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
	          

<?php 
	} // END Tìm kiếm Danh mục
	// Begin Tìm kiếm Truyện

if(isset($_POST['aStory'])){
	  $Search = $_POST['aStory'];
	  $sql    = "	SELECT *,cat.name as Catname, story.name as Stoname 
	  			    FROM story LEFT JOIN cat ON cat.cat_id = story.cat_id 
	  			    WHERE story.name LIKE '%{$Search}%' OR cat.name LIKE '%{$Search}%'" ;
	 // echo $sql; die();
	  $query  = $conn->query($sql);
	  $link   = $query->num_rows ;

?>		<span style="color: #09ACC9;">Kết quả tìm kiếm: <?php echo $link ; ?></span>
 		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>ID</th>
                    <th width="370px">Tiêu đề</th>
                    <th width="150px">Danh mục</th>
                    <th>Lượt đọc</th>
                    <th>Tình trạng</th>
                    <th>Hình ảnh</th>
                    <th width="160px">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($link > 0){
                        $i=0;
                        while ($arStory = mysqli_fetch_assoc($query)) {
                            if ($i % 2 == 0) { $cl = "even"; } else { $cl = "odd"; }
                            $Catname = $arStory['Catname'];
                            $name = $arStory['Stoname'];
                            $idStory = $arStory['story_id'];
                            $image = $arStory['picture'];
                            $counter = $arStory['counter'];
                            $public = $arStory['public'];
                            $urldel = "/admin/story/delete.php?p=story&idStory={$idStory}";
                            $urledit = "/admin/story/edit.php?p=story&idStory={$idStory}";

                   ?>
                    <tr class="<?php echo $cl?> gradeX">
                        <td class="center"><?php echo $idStory ?></td>
                        <td><?php echo $name ?></td>
                        <td class="center"><?php echo $Catname ?></td>
                        <td class="center"><?php echo $counter ?></td>
                        <td class="center"><?php if($public == 1) echo 'public'; else echo 'private';  ?></td>
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

<?php 
	}
?>