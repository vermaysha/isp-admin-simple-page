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


if (isset($_POST["info"])) {


    $username  = htmlentities(strip_tags(trim($_POST["username"] ?? '')));
    // filter data
    $username = mysqli_real_escape_string($conn,$username);

    $query = "SELECT * FROM `client` INNER JOIN `paket_reseller` ON (client.id_reseller=paket_reseller.id_reseller) INNER JOIN `login` ON (login.username=client.username) INNER JOIN `riwayat_pembayaran` ON (riwayat_pembayaran.id_reseller=client.id_reseller AND riwayat_pembayaran.username_client=client.username) WHERE client.paket_client=paket_reseller.paket AND client.username='$username'";
    $result = mysqli_query($conn, $query);

    while($data = mysqli_fetch_assoc($result))
            {

    $username         = $data['username'];
    $nama             = $data['nama_client'];
    $alamat           = $data['alamat_client'];
    $no_wa_client     = $data['no_wa_client'];
    $paket            = $data['paket_client'];
    $tagihan          = $data['harga'];
    $tanggal          = $data['tanggal'];
    $status           = $data['status_pembayaran'];
            }
  }
else {
  header("Location: table_client_reseller.php");

}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Client Information</title>

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

<style>
        .tab {
            display: inline-block;
            margin-left: 40px;
        }
        .tab2 {
            display: inline-block;
            margin-left: 119px;
        }
        .tab3 {
            display: inline-block;
            margin-left: 110px;
        }
        .tab4 {
            display: inline-block;
            margin-left: 113px;
        }
        .tab5 {
            display: inline-block;
            margin-left: 121px;
        }
        .tab6 {
            display: inline-block;
            margin-left: 104px;
        }
        .tab7 {
            display: inline-block;
            margin-left: 41px;
        }
        .tab8 {
            display: inline-block;
            margin-left: 47px;
        }
    </style>

</head>
<body>

<div id="app">

<nav id="navbar-main" class="navbar is-fixed-top">
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
      <li class="--set-active-tables-html">
        <a href="table_client_reseller.php">
          <span class="icon"><i class="mdi mdi-table"></i></span>
          <span class="menu-item-label">Client</span>
        </a>
      </li>
      <li class="--set-active-tables-htm">
        <a href="input_data_client.php">
          <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
          <span class="menu-item-label">Input Client</span>
        </a>
      </li>
      <li class="--set-active-forms-html">
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
      <li>Client Information</li>
    </ul>
  </div>
</section>

  <section class="section main-section">
    <div class="card mb-6">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-eye"></i></span>
          Data Client
        </p>
      </header>
      <div class="card-content">
        <form method="get">
            <p class="card-header-title">Username Client <span class="tab"></span> : &nbsp; <?php echo $username ?></p>
            <p class="card-header-title">Nama <span class="tab2"></span> : &nbsp; <?php echo $nama ?></p>
            <p class="card-header-title">Alamat <span class="tab3"></span> : &nbsp; <?php echo $alamat ?></p>
            <p class="card-header-title">NO HP <span class="tab4"></span> : &nbsp; <?php echo $no_wa_client ?></p>      
         </form>
      </div>
    </div>
  </section>

  <section class="section main-section">
    <div class="card mb-6">
    <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-wifi"></i></span>
          Paket Client
        </p>
      </header>
      <div class="card-content">
        <form method="get">
            <p class="card-header-title">Paket <span class="tab5"></span> : &nbsp; <?php echo $paket ?> Mbps</p>
            <p class="card-header-title">Tagihan <span class="tab6"></span> : &nbsp; Rp.<?php echo $tagihan ?></p>
            <p class="card-header-title">Tanggal Tagihan <span class="tab7"></span> : &nbsp; <?php echo $tanggal ?></p>
            <p class="card-header-title">Status Bulan Ini <span class="tab8"></span> : &nbsp; <?php echo $status ?></p>
        </form>
      </div>
    </div>
  </section>

  <section class="section main-section">
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-clock-outline"></i></span>
          Riwayat Tagihan
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
            <th>Tagihan</th>
            <th>Tanggal Pembayaran</th>
          </tr>
          </thead>
          <tbody>
          <tr>

            <?php
            //$query = "SELECT * FROM `riwayat_tagihan` INNER JOIN `client` ON (riwayat_tagihan.id_client=client.username) WHERE client.id_reseller='$_SESSION[username]' AND client.username='$username' ORDER BY tanggal_bayar ASC";
            $query = "SELECT * FROM `client` INNER JOIN `paket_reseller` ON (client.id_reseller=paket_reseller.id_reseller) INNER JOIN `riwayat_pembayaran` ON (riwayat_pembayaran.id_reseller=client.id_reseller AND riwayat_pembayaran.username_client=client.username) INNER JOIN `riwayat_tagihan` ON (riwayat_tagihan.id_reseller=client.id_reseller) WHERE client.paket_client=paket_reseller.paket AND client.username='$username'";
            $result = mysqli_query($conn, $query);
            $no = 1;
          
            if(!$result){
                die ("Query Error: ".mysqli_errno($conn).
                     " - ".mysqli_error($conn));
            }
          
            //buat perulangan untuk element tabel dari data mahasiswa
            while($data = mysqli_fetch_assoc($result))
            {
              
              ?>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama_client']; ?></td>
            <td><?php echo $data['paket_client']; ?>Mbps</td>
            <td>Rp.<?php echo $data['harga']; ?></td>
            <td><?php echo $data['tanggal_bayar']; ?></td>
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
        © 2022, PT. GMDP
      </div>
    </div>
  </div>
</footer>

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
