<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="/templates/admin/img/find_user.png" class="user-image img-responsive" />
            </li>

            <li>
                <a <?php if(isset($_GET['p'])){$p = $_GET['p']; if($p=='trangchu') echo "class='active-menu'" ; } else echo "class='active-menu'";  ?> href="/admin/?p=trangchu"><i class="fa fa-home fa-3x"></i> Trang chủ</a>
            </li>
            <li>
                <a <?php if(isset($_GET['p'])){$p = $_GET['p']; if($p=='cat') echo "class='active-menu'" ; }?> href="/admin/cat/?p=cat"><i class="fa fa-tasks fa-3x"></i> Quản lý danh mục</a>
            </li>
            <li>
                <a <?php  if(isset($_GET['p'])){$p = $_GET['p']; if($p=='story') echo "class='active-menu'" ; }?> href="/admin/story/?p=story"><i class="fa fa-book fa-3x"></i> Quản lý truyện</a>
            </li>
            <li>
                <a <?php  if(isset($_GET['p'])){$p = $_GET['p']; if($p=='lienhe') echo "class='active-menu'" ; }?> href="/admin/lienhe/?p=lienhe"><i class="fa fa-phone-square fa-3x"></i>Quản lý Liên hệ</a>
            </li>
            <li>
                <a <?php  if(isset($_GET['p'])){$p = $_GET['p']; if($p=='slide') echo "class='active-menu'" ; }?> href="/admin/slide/?p=slide"><i class="fa fa-picture-o fa-3x"></i>Quản lý Slide Images</a>
            </li>
            <li>
                <a <?php  if(isset($_GET['p'])){$p = $_GET['p']; if($p=='user') echo "class='active-menu'" ; }?> href="/admin/user/?p=user"><i class="fa fa-user fa-3x"></i> Quản lý người dùng</a>
            </li>

        </ul>

    </div>
 
</nav>
<!-- /. NAV SIDE  -->