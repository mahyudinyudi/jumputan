<?php
include '../config.php';

$page_admin = 'dashboard';

if (isset($_COOKIE['login_admin'])) {
    if ($akun_adm == 'false') {
        header("location: " . $url . "system/admin/logout");
    }
} else {
    header("location: " . $url . "admin/login/");
}

$time_today = date("Y-m-d");

// JUMLAH USER
$sj_user_adm = $server->query("SELECT * FROM `akun`");
$jumlah_user_adm = mysqli_num_rows($sj_user_adm);

// JUMLAH USER HARI INI
$sj_user_today_adm = $server->query("SELECT * FROM `akun` WHERE `waktu` LIKE '$time_today%' ORDER BY `akun`.`id` DESC");
$jumlah_user_today_adm = mysqli_num_rows($sj_user_today_adm);

// JUMLAH TRANSAKSI
$sj_transaksi_adm = $server->query("SELECT * FROM `invoice` WHERE `transaction`='settlement'");
$jumlah_transaksi_adm = mysqli_num_rows($sj_transaksi_adm);

// JUMLAH TRANSAKSI HARI INI
$sj_transaksi_today_adm = $server->query("SELECT * FROM `akun`, `iklan`, `invoice` WHERE invoice.id_iklan=iklan.id AND invoice.id_user=akun.id AND `transaction`='settlement' AND `waktu_transaksi`LIKE'$time_today%' ORDER BY `invoice`.`idinvoice` DESC");
$jumlah_transaksi_today_adm = mysqli_num_rows($sj_transaksi_today_adm);

// JUMLAH TRANSAKSI
$sj_produk_adm = $server->query("SELECT * FROM `iklan`");
$jumlah_produk_adm = mysqli_num_rows($sj_produk_adm);

// JUMLAH KATEGORI
$sj_kategori_adm = $server->query("SELECT * FROM `kategori`");
$jumlah_kategori_adm = mysqli_num_rows($sj_kategori_adm);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="icon" href="../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link rel="stylesheet" href="../assets/css/admin/index.css">
</head>

<body>
    <div class="admin">
        <?php include './partials/menu.php'; ?>
        <div class="content_admin">
            <h1 class="title_content_admin">Dashboard</h1>
            <div class="isi_content_admin">
                <!-- CONTENT -->
                <div class="menu_jumlah_adm">
                    <div class="isi_menu_jumlah_adm">
                        <i class="ri-user-3-fill"></i>
                        <div class="box_text_menu_jumlah_adm">
                            <p>Jumlah User</p>
                            <h1><?php echo number_format($jumlah_user_adm, 0, ".", "."); ?></h1>
                        </div>
                    </div>
                    
                    <div class="isi_menu_jumlah_adm">
                        <i class="ri-archive-fill"></i>
                        <div class="box_text_menu_jumlah_adm">
                            <p>Jumlah Produk</p>
                            <h1><?php echo number_format($jumlah_produk_adm, 0, ".", "."); ?></h1>
                        </div>
                    </div>
                    <div class="isi_menu_jumlah_adm">
                        <i class="ri-file-list-2-fill"></i>
                        <div class="box_text_menu_jumlah_adm">
                            <p>Jumlah Kategori</p>
                            <h1><?php echo number_format($jumlah_kategori_adm, 0, ".", "."); ?></h1>
                        </div>
                    </div>
                </div>

              
                <!-- CONTENT -->
            </div>
        </div>
    </div>
</body>

</html>