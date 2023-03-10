<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["keySearch"] = $_POST["search_product"];
    }
?>

<header class="header">
    <div class="logo">
        <a href="index.php"><img src="images/logo.png" alt="brand"></a>    
    </div>
    <div class="menu">

    <?php
        $sql1 = "SELECT DISTINCT tenDanhMuc FROM danh_muc";
        $tenDM = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($tenDM) > 0) {
            while ($row1 = mysqli_fetch_assoc($tenDM)) {
    ?>
        <li><b class="menu-items"><?php echo $row1["tenDanhMuc"]?></b>
            <ul class="sub-menu">
            <?php
                $tenDanhMuc = $row1["tenDanhMuc"];
                $sql2 = "SELECT DISTINCT nhomSanPham FROM danh_muc WHERE tenDanhMuc='$tenDanhMuc'";
                $nhomSP = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($nhomSP) > 0) {
                    while ($row2 = mysqli_fetch_assoc($nhomSP)) {
            ?>
                <li><b><?php echo $row2["nhomSanPham"]?></b>
                    <ul>
                    <?php
                        $nhomSanPham = $row2["nhomSanPham"];
                        $sql3 = "SELECT * FROM danh_muc WHERE tenDanhMuc='$tenDanhMuc' AND nhomSanPham='$nhomSanPham'";
                        $danhMuc = mysqli_query($conn, $sql3);
                        if (mysqli_num_rows($danhMuc) > 0) {
                            while ($row3 = mysqli_fetch_assoc($danhMuc)) {
                    ?>
                        <li><a href="index.php?page_layout=category&chucnang=showDM&idDanhMuc=<?php echo $row3["idDanhMuc"]?>"><?php echo $row3["loaiSanPham"]?></a></li>
                    <?php
                            }
                        }
                    ?>
                    </ul>
                </li>
                <?php
                    }
                }
                ?>
            </ul>
        </li>
        <?php
            }
        }
        ?>

        <li><b class="menu-items">LIFESTYLE</b></li>
        <li><b class="menu-items">V??? CH??NG T??I</b>
            <ul class="sub-menu">
                <li><b>V??? th????ng hi???u</b></li>
                <li><b>C??c ch??nh s??ch</b></li>
                <li><b>B???o h??nh tr???n ?????i</b></li>
                <li><b>H??? th???ng c???a h??ng</b></li>
                <li><b>Q&A</b></li>
            </ul>
        </li>
    </div>
    <div class="others">
        <form class="search_product" action="index.php?page_layout=category&chucnang=timkiem" method="post" autocomplete="off">
            <input type="text" name="search_product" placeholder="T??m ki???m" required> 
            <button type="submit" name="search_button" class="search_button"><i class="fas fa-search search-icon"></i></button>
        </form>
        <li><i class="fas fa-headphones others-item" style="cursor:pointer;"></i></li>
        <li><i class="fas fa-user others-item" style="cursor:pointer;"></i></li>
        <li class="cart-item">
            <a class="fas fa-shopping-cart others-item" href="index.php?page_layout=cart"></a>
            <span class="number-cart">
            <?php
            if(isset($_SESSION['giohang'])){
                $sl = 0;
                foreach($_SESSION['giohang'] as $idsp => $sizesl) {
                    foreach($_SESSION['giohang'][$idsp] as $size => $quantity) {
                        $sl++;
                    }
                }
                echo $sl;
            } else {
                echo 0;
            }
            ?>
            </span>
        </li>
    </div>
</header>