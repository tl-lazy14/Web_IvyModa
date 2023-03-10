<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
    <title>Product</title>
</head>

<body>
<?php
    include_once 'giaodien/header.php';
?>

<section class="product">
    <div class="container">
        <div class="product-top row">
        <?php
            $idSP = $_GET["idSanPham"];
            $sql = "SELECT * FROM (danh_muc_san_pham INNER JOIN danh_muc ON danh_muc_san_pham.idDanhMuc = danh_muc.idDanhMuc)
                    INNER JOIN san_pham ON danh_muc_san_pham.idSP = san_pham.idSP
                    WHERE danh_muc_san_pham.idSP = $idSP";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>
            <p><?php echo $row["tenDanhMuc"]?></p> <span>&#10230; </span> <a href="index.php?page_layout=category&chucnang=showDM&idDanhMuc=<?php echo $row["idDanhMuc"]?>"><p><?php echo $row["loaiSanPham"]?></p></a> <span>&#10230;</span> <p><?php echo $row["tenSP"]?></p>
        </div>
        <div class="product-content row">
            <div class="product-content-left row">
                <div class="big-img">
                    <img src="images/<?php echo $row["anhSP1"]?>" alt="bigImage">
                </div>
                <div class="small-img">
                    <img src="images/<?php echo $row["anhSP1"]?>">
                    <img src="images/<?php echo $row["anhSP2"]?>">
                    <img src="images/<?php echo $row["anhSP3"]?>">
                <?php
                if ($row["anhSP4"] != null) {
                ?>
                    <img src="images/<?php echo $row["anhSP4"]?>">
                <?php } ?>
                </div>
            </div>
            <div class="product-content-right">
                <div class="product-name">
                    <h1 style="text-transform:uppercase;font-family:'Times New Roman', Times, serif;font-size:36px;line-height:1.2;"><?php echo $row["tenSP"]?></h1>
                    <p>SKU: <?php echo $row["maSP"]?></p>
                </div>
                <div class="product-price">
                    <p style="font-weight:bold;"><?php echo addDotPrice($row["giaSP"])?>??</p>
                </div>
                <div class="product-color">
                    <p style="font-weight:bold;">M??u s???c: <?php echo $row["mauSP"]?></p>
                    <div class="product-color-img">
                        <img src="images/colors/<?php echo $row["anhMauSP"]?>" alt="colorImage">
                    </div>
                </div>
                <div class="product-size">
                    <p style="font-weight:bold;">Size:</p>
                    <form id="product-form" method="post">
                    <div class="product-size-input">
                        <label>
                            <input type="radio" name="size" value="S" checked>
                            <span>S</span>
                        </label>
                        <label>
                            <input type="radio" name="size" value="M">
                            <span>M</span>
                        </label>
                        <label>
                            <input type="radio" name="size" value="L">
                            <span>L</span>
                        </label>
                        <label>
                            <input type="radio" name="size" value="XL">
                            <span>XL</span>
                        </label>
                        <label>
                            <input type="radio" name="size" value="XXL">
                            <span>XXL</span>
                        </label>
                    </div>
                    </form>
                </div>
                <div class="quantity">
                    <p><b>S??? l?????ng:</b></p>
                    <input type="number" name="quantity" form="product-form" min="1" oninput="(validity.valid)||(value=1);" value="1">
                </div>
                <div class="product-button">
                    <input type="submit" form="product-form" formaction="chucnang/addToCart.php?idSP=<?php echo $_GET['idSanPham']?>" class="addCart"  name="addCart" value="TH??M V??O GI???">
                    <input type="submit" form="product-form" formaction="chucnang/buyProduct.php?idSP=<?php echo $_GET['idSanPham']?>" class="buyProduct"  name="buyProduct" value="MUA H??NG">
                </div>
            <?php
            if (isset($_SESSION["added"]) && $_SESSION["added"] == true) {
            ?>
                <div class="notify-added" id="notify-added"><p>Th??m v??o gi??? h??ng th??nh c??ng!</p></div>
            <?php
            }
            $_SESSION["added"] = false;
            ?>
                <div class="product-icon">
                    <div class="product-icon-item">
                        <i class="fas fa-phone-alt"></i> <p>Hotline</p>
                    </div>
                    <div class="product-icon-item">
                        <i class="fas fa-comments"></i> <p>Chat</p>
                    </div>
                    <div class="product-icon-item">
                        <i class="fas fa-envelope"></i> <p>Mail</p>
                    </div>
                </div>
                <div class="product-detail-tab">
                    <div class="product-detail-tab-content">
                        <div class="product-detail-tab-content-header row">
                            <div class="tab-item" id="introduce">
                                <p class="tab-item-selected">GI???I THI???U</p>
                            </div>
                            <div class="tab-item" id="detail">
                                <p>CHI TI???T S???N PH???M</p>
                            </div>
                            <div class="tab-item" id="preserve">
                                <p>B???O QU???N</p>
                            </div>
                        </div>
                        <div class="product-detail-tab-content-body">
                            <div class="introduce-content">
                            <?php echo $row["gioithieuSP"]?>
                            </div>
                            <div class="detail-content">
                                <table>
                                    <tr>
                                        <th>D??ng s???n ph???m</th>
                                        <td><?php echo $row["dongSP"]?></td>
                                    </tr>
                                    <tr>
                                        <th>Ki???u d??ng</th>
                                        <td><?php echo $row["kieuDang"]?></td>
                                    </tr>
                                    <tr>
                                        <th>????? d??i</th>
                                        <td><?php echo $row["doDai"]?></td>
                                    </tr>
                                    <tr>
                                        <th>H???a ti???t</th>
                                        <td><?php echo $row["hoaTiet"]?></td>
                                    </tr>
                                    <tr>
                                        <th>Ch???t li???u</th>
                                        <td><?php echo $row["chatLieu"]?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="preserve-content">
                                Chi ti???t b???o qu???n s???n ph???m :<br>
<strong>* C??c s???n ph???m thu???c d??ng cao c???p (Senora) v?? ??o kho??c (d???, tweed, l??ng, phao) ch??? gi???t kh??, tuy???t ?????i kh??ng gi???t ?????t.</strong><br><br>
* V???i d???t kim: sau khi gi???t s???n ph???m ph???i ???????c ph??i ngang tr??nh bai d??n.<br><br>
* V???i voan, l???a, chiffon n??n gi???t b???ng tay.<br><br>
* V???i th??, tuytsy, kaki kh??ng c?? ph???i hay trang tr?? ???? c?????m th?? c?? th??? gi???t m??y.<br><br>
* V???i th??, tuytsy, kaki c?? ph???i m??u t?????ng ph???n hay trang tr?? voan , l???a , ???? c?????m th?? c???n gi???t tay.<br><br>
* ????? Jeans n??n h???n ch??? gi???t b???ng m??y gi???t v?? s??? l??m phai m??u jeans. N???u gi???t th?? n??n l???n tr??i s???n ph???m khi gi???t , ????ng khuy , k??o kh??a, kh??ng n??n gi???t chung c??ng ????? s??ng m??u , tr??nh d??nh m??u v??o c??c s???n ph???m kh??c.<br><br>
* C??c s???n ph???m c???n ???????c gi???t ngay kh??ng ng??m tr??nh b??? loang m??u , ph??n bi???t m??u v?? lo???i v???i ????? tr??nh tr?????ng h???p v???i phai. Kh??ng n??n gi???t s???n ph???m v???i x?? ph??ng c?? ch???t t???y m???nh , n??n gi???t c??ng x?? ph??ng pha lo??ng.<br><br>
* C??c s???n ph???m c?? th??? gi???t b???ng m??y th?? ch??? n??n ????? ch??? ????? gi???t nh???, v???t m???c trung b??nh v?? n??n ph??n c??c lo???i s???n ph???m c??ng m??u v?? c??ng lo???i v???i khi gi???t.<br><br>
* N??n ph??i s???n ph???m t???i ch??? tho??ng m??t, tr??nh ??nh n???ng tr???c ti???p s??? d??? b??? phai b???c m??u , n??n l??m kh?? qu???n ??o b???ng c??ch ph??i ??? nh???ng ??i???m gi?? s??? gi??? m??u v???i t???t h??n.<br><br>
* Nh???ng ch???t v???i 100% cotton, kh??ng n??n ph??i s???n ph???m b???ng m???c ??o m?? n??n v???t ngang s???n ph???m l??n d??y ph??i ????? tr??nh t??nh tr???ng r???n v???i.<br><br>
* Khi ???i s???n ph???m b???ng b??n l?? v?? s??? d???ng ch??? ????? h??i n?????c s??? l??m cho s???n ph???m d??? ???i ph???ng, m??t v?? kh??ng b??? ch??y, gi??? m??u s???n ph???m ???????c ?????p v?? b???n l??u h??n. Nhi???t ????? c???a b??n l?? t??y theo t???ng lo???i v???i.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include_once 'giaodien/footer.php';
?>

</body>
<script src="js/script.js"></script>
</html>