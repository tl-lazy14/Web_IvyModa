<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
    <title>Order Success</title>
</head>

<body>
<?php
    if (!empty($_POST["name"]) && !empty($_POST["phone-number"]) && !empty($_POST["email"]) && !empty($_POST["province"]) && !empty($_POST["district"]) 
        && !empty($_POST["ward"]) && !empty($_POST["address-detail"])) {
            $idDonHang = "";
            $tenKH = test_input($_POST["name"]);
            $sdt = test_input($_POST["phone-number"]);
            $email = test_input($_POST["email"]);
            $tinh = test_input($_POST["province"]);
            $huyen = test_input($_POST["district"]);
            $xa = test_input($_POST["ward"]);
            $diachi = test_input($_POST["address-detail"]);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $datetime = date('Y-m-d H:i:s');
            $tongTien = $_SESSION["tongTien"];
            $sqlDonHang = "INSERT INTO don_hang (hoTen, soDienThoai, email, tinhThanh, quanHuyen, phuongXa, diaChi, ngayDatHang, tongTienHang)
                           VALUES ('$tenKH', '$sdt', '$email', '$tinh', '$huyen', '$xa', '$diachi', '$datetime' , $tongTien)";
            if (mysqli_query($conn, $sqlDonHang)) {
                $idDonHang = mysqli_insert_id($conn);
            }
        
            foreach($_SESSION['giohang'] as $idsp => $sizesl) {
                foreach($_SESSION['giohang'][$idsp] as $size => $quantity) {
                    $sqlSP = "SELECT * FROM san_pham WHERE idSP = $idsp";
                    $querySP = mysqli_query($conn, $sqlSP);
                    $rowSP = mysqli_fetch_assoc($querySP);
                    $thanhTien = $quantity * $rowSP["giaSP"];
                    $sqlChitietDonHang = "INSERT INTO chi_tiet_hoa_don (idDonHang, idSanPham, size, soLuong, thanhTien)
                                          VALUES ($idDonHang, $idsp, '$size', $quantity, $thanhTien)";
                    mysqli_query($conn, $sqlChitietDonHang);
                }
            }
    }
    unset($_SESSION['giohang']);
    $_SESSION['maHoaDon'] = $idDonHang;
    $_SESSION['tongTien'] = 0;
    include_once 'giaodien/header.php';
?>

<section class="finish" style="background-image:url('images/background.jpg');">
    <div class="finish-content">
        <h1>?????T H??NG TH??NH C??NG</h1>
        <p>Ch??o <span style="text-transform:capitalize;color:#ac2f33;"><?php echo test_input($_POST["name"])?></span>, ????n h??ng c???a b???n ???? ???????c ?????t th??nh c??ng.</p>
        <p>????n h??ng c???a b???n ???? ???????c x??c nh???n t??? ?????ng.</p>
        <p>C???m ??n qu?? kh??ch ???? tin d??ng s???n ph???m c???a ch??ng t??i.</p>
        <button style="margin-right:30px;" onclick="window.location.assign('index.php')">V??? TRANG CH???</button>
        <button onclick="window.location.assign('index.php?page_layout=invoice')">XEM H??A ????N</button>
        <p>M???i th???c m???c qu?? kh??ch vui l??ng li??n h??? hotline <span style="font-size:24px;color:#ac2f33;"><b>0232 985 0375</b></span> ho???c chat v???i k??nh h??? tr??? ????? ???????c h??? tr??? nhanh nh???t.</p>
    </div>
</section>

<?php
    include_once 'giaodien/footer.php';
?>

</body>
</html>