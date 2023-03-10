<?php
	session_start();

  if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
  }
  
  $level=$_SESSION["level"];
  
  if ($level!="reseller") {
      echo "Anda tidak punya akses pada halaman reseller";
      exit;
  }

include("koneksidb.php");

//MENGHAPUS DATA
if (isset($_POST["hapus"])) {

  $username = htmlentities(strip_tags(trim($_POST["username"])));

  $username = mysqli_real_escape_string($conn, $username);

  $query = "DELETE client, login, riwayat_pembayaran FROM client JOIN login ON (login.username = client.username) JOIN riwayat_pembayaran ON (riwayat_pembayaran.username_client = login.username) WHERE  client.username='$username'";
  $hasil_query = mysqli_query($conn, $query);


  if($hasil_query) {

      header("Location: table_client_reseller.php");
  }
  else {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
  }
}

if (isset($_GET["pesan"])) {
  $pesan = $_GET["pesan"];
}

//UPDATE STATUS PEMBAYARAN
if (isset($_POST["check"])) {

  $username = htmlentities(strip_tags(trim($_POST["username"])));

  $username = mysqli_real_escape_string($conn, $username);

  $query = "UPDATE `riwayat_pembayaran` SET `status_pembayaran`='Lunas' WHERE username_client='$username'";
  $hasil_query = mysqli_query($conn, $query);
  $tanggal = date("Y-m-d");

  $result = mysqli_query($conn, "SELECT * FROM `client` INNER JOIN `paket_reseller` ON (client.id_reseller=paket_reseller.id_reseller) WHERE client.paket_client=paket_reseller.paket AND client.username='$username'");
  $no = 1;
          
  if(!$result){
    die ("Query Error: ".mysqli_errno($conn).
        " - ".mysqli_error($conn));
  }
          
  while($data = mysqli_fetch_assoc($result))
  {


  if($hasil_query) {
    $query2 = "INSERT INTO `riwayat_tagihan`(`id_reseller`, `id_client`, `paket`, `harga`, `tanggal_bayar`) VALUES ";
    $query2 .= "('$_SESSION[username]','$data[username]','$data[paket]', '$data[harga]', '$tanggal')";
    $result2 = mysqli_query($conn, $query2);
      header("Location: tagihan_client.php");
  }
  else {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
  }
  }
}

//UPDATE STATUS PEMBAYARAN
if (isset($_POST["edit"])) {

  $username = htmlentities(strip_tags(trim($_POST["username"])));

  $username = mysqli_real_escape_string($conn, $username);

  $query = "UPDATE `riwayat_pembayaran` SET `status_pembayaran`='Belum' WHERE username_client='$username'";
  $hasil_query = mysqli_query($conn, $query);


  if($hasil_query) {
    $query2 = "INSERT INTO `login`(`username`, `password`, `level`, `parent`) VALUES ";
    $query2 .= "('$username','$password','client', '$_SESSION[username]')";
    $result2 = mysqli_query($conn, $query2);
      header("Location: tagihan_client.php");
  }
  else {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
  }
}

//RESET STATUS
if (isset($_POST["reset"])) {

  $username = htmlentities(strip_tags(trim($_POST["id_reseller"])));

  $username = mysqli_real_escape_string($conn, $username);

  $query = "UPDATE `riwayat_pembayaran` SET `status_pembayaran`='Belum' WHERE id_reseller='$_SESSION[username]'";
  $hasil_query = mysqli_query($conn, $query);


  if($hasil_query) {
      header("Location: tagihan_client.php");
  }
  else {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
  }
}
 
//MENCARI DATA
if (isset($_GET["cari"])) {
  
  $nama_client = htmlentities(strip_tags(trim($_GET["cari"])));
  
  $nama_client = mysqli_real_escape_string($conn, $nama_client);
  
  
  $query  = "SELECT * FROM client INNER JOIN riwayat_pembayaran ON client.username = riwayat_pembayaran.username_client WHERE nama_client LIKE '%$nama_client%' AND client.id_reseller='$_SESSION[username]' ORDER BY client.nama_client ASC";
  
  $pesan = "Hasil pencarian untuk nama <b>\"$nama_client\" </b>:";
  } 
  else {
  
  $query = "SELECT * FROM `client` WHERE id_reseller='$_SESSION[username]' ORDER BY nama_client ASC";
  }
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tagihan</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="css/main.css?v=1628755089081">

  <link rel="apple-touch-icon" sizes="180x180" href="image/logo.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="image/logo.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="image/logo.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>

  <meta name="description" content="Admin One - free Tailwind dashboard">

  <meta property="og:url" content="https://justboil.github.io/admin-one-tailwind/">
  <meta property="og:site_name" content="JustBoil.me">
  <meta property="og:title" content="Admin One HTML">
  <meta property="og:description" content="Admin One - free Tailwind dashboard">
  <meta property="og:image" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1920">
  <meta property="og:image:height" content="960">

  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="Admin One HTML">
  <meta property="twitter:description" content="Admin One - free Tailwind dashboard">
  <meta property="twitter:image:src" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="twitter:image:width" content="1920">
  <meta property="twitter:image:height" content="960">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-130795909-1');
  </script>

</head>
<body>

<div id="app">

<nav id="navbar-main" class="navbar is-fixed-top">
  <div class="navbar-brand">
    <a class="navbar-item mobile-aside-button">
      <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
    </a>
    <div class="navbar-item">
      <div class="control">
        <form id="search" action="table_client_reseller.php" method="get">
        <input name="cari" placeholder="Search everywhere..." class="input" type="cari">
        </form>
      </div>
    </div>
  </div>
  <div class="navbar-brand is-right">
    <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
      <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
    </a>
  </div>
  <div class="navbar-menu" id="navbar-menu">
    <div class="navbar-end">
      <div class="navbar-item dropdown has-divider has-user-avatar">
          <div class="is-user-name"><span>Anda masuk sebagai <b><?php echo $_SESSION['username']; ?></b></span></div>
      </div>
      <a title="Log out" class="navbar-item desktop-icon-only" href="logout.php">
        <span class="icon"><i class="mdi mdi-logout"></i></span>
        <span>Log out</span>
      </a>
    </div>
  </div>
</nav>

<aside class="aside is-placed-left is-expanded">
<div class="aside-tools">
    <div>
      <table>
      <td style="background-color: rgba(0, 0, 0, 0);">
          <img src="image/logo.png" alt="gmdp" width="40" height="40">
      </td> 
      <td style="background-color: rgba(0, 0, 0, 0);">
        GMDP <b class="font-black">Billing</b>
      </td>
      </table>
    </div>
  </div>
  <div class="menu is-menu-main">
    <p class="menu-label">General</p>
    <ul class="menu-list">
      <li class="--set-active-forms-html">
        <a href="dashboard_reseller.php">
          <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
          <span class="menu-item-label">Dashboard</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">Menu</p>
    <ul class="menu-list">
      <li class="--set-active-forms-html">
        <a href="table_client_reseller.php">
          <span class="icon"><i class="mdi mdi-table"></i></span>
          <span class="menu-item-label">Client</span>
        </a>
      </li>
      <li class="--set-active-forms-html">
        <a href="input_data_client.php">
          <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
          <span class="menu-item-label">Input Client</span>
        </a>
      </li>
      <li class="active">
        <a href="tagihan_client.php">
          <span class="icon"><i class="mdi mdi-coins"></i></span>
          <span class="menu-item-label">Tagihan Client</span>
        </a>
      </li>
      <li class="--set-active-forms-html">
        <a href="paket_reseller.php">
          <span class="icon"><i class="mdi mdi-wifi"></i></span>
          <span class="menu-item-label">Paket Internet</span>
        </a>
      </li>
      <li class="--set-active-forms-html">
        <a href="riwayat_tagihan_client.php">
          <span class="icon"><i class="mdi mdi-clock"></i></span>
          <span class="menu-item-label">Riwayat Tagihan</span>
        </a>
      </li>
      <li class="--set-active-profile-html">
        <a href="profile_reseller.php"> 
          <span class="icon"><i class="mdi mdi-account-circle"></i></span>
          <span class="menu-item-label">Profile</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">About</p>
    <ul class="menu-list">
      <li>
        <a href="https://gmdp.net.id/" class="has-icon">
          <span class="icon"><i class="mdi mdi-help-circle"></i></span>
          <span class="menu-item-label">PT. GMDP</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

<section class="is-title-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <ul>
      <li>Menu</li>
      <li>Table Data</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Data Client
    </h1>
      <form action="tagihan_client.php" method="post" >
              <button class="button red --jb-modal" data-target="sample-modal" type="submit" name="reset"> RESET STATUS</button>
      </form>
  </div>
</section>

  <section class="section main-section">
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
          Client
        </p>
        <a href="<?php $_SERVER['PHP_SELF']; ?>" class="card-header-icon">
          <span class="icon"><i class="mdi mdi-reload"></i></span>
        </a>
      </header>
      <div class="card-content">
        <table>
          <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Paket</th>
            <th>No Wa</th>
            <th>Tagihan</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
          <tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM client INNER JOIN (riwayat_pembayaran INNER JOIN paket_reseller ON riwayat_pembayaran.id_reseller = paket_reseller.id_reseller) ON client.username = riwayat_pembayaran.username_client WHERE client.id_reseller='$_SESSION[username]' AND paket_reseller.paket=client.paket_client ORDER BY client.nama_client ASC");
            $no = 1;
          
            if(!$result){
                die ("Query Error: ".mysqli_errno($conn).
                     " - ".mysqli_error($conn));
            }

            while($data = mysqli_fetch_assoc($result))
            {
              ?>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama_client']; ?></td>
            <td><?php echo $data['paket_client']; ?>Mbps</td>
            <td><?php echo $data['no_wa_client']; ?></td>
            <td>Rp.<?php echo $data['harga']; ?></td>
            <td><?php echo $data['status_pembayaran']; ?></td>


            
            <td class="actions-cell">
              <div class="buttons right nowrap">
              <form action="tagihan_client.php" method="post" >
                <input type="hidden" name="username" value="<?php echo "$data[username]"; ?>" >
                <button class="button small green --jb-modal" data-target="sample-modal" type="submit" name="check">
                  <span class="icon"><i class="mdi mdi-check"></i></span>
                </button>
                </form>
                &nbsp;
                <form action="tagihan_client.php" method="post" >
                <input type="hidden" name="username" value="<?php echo "$data[username]"; ?>" >
                <button class="button small blue --jb-modal" data-target="sample-modal" type="submit" name="edit">
                  <span class="icon"><i class="mdi mdi-minus"></i></span>
                </button>
                </form>
                &nbsp;
                <form action="table_client_reseller.php" method="post" >
                <input type="hidden" name="username" value="<?php echo "$data[username]"; ?>" >
                <button class="button small red --jb-modal" data-target="sample-modal" type="submit" name="hapus">
                  <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                  </form>
              </div>
            </td>
          </tr>
            <?php
            }
              ?>
          </tbody>  
        </table>
      </div>
    </div>
  </section>

<footer class="footer">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
    <div class="flex items-center justify-start space-x-3">
      <div>
        ?? 2022, PT. GMDP
      </div>
    </div>
  </div>
</footer>
</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '658339141622648');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=658339141622648&ev=PageView&noscript=1"/></noscript>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>
</html>