<?php
	session_start();


  if (!isset($_SESSION["username"])) {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
  }
  
  $level=$_SESSION["level"];
  
  if ($level!="admin") {
      echo "Anda tidak punya akses pada halaman admin";
      exit;
  }

include("koneksidb.php");

if (empty($uname = $_GET['username'])) {
    echo 'Data Kosong';
    exit('');
}

if (isset($_POST["submit"])) {

  $nama_instansi        = htmlentities(strip_tags(trim($_POST["nama_instansi"] ?? '')));
  $nama_pemilik         = htmlentities(strip_tags(trim($_POST["nama_pemilik"] ?? '')));
  $email_reseller       = htmlentities(strip_tags(trim($_POST["email_reseller"] ?? '')));
  $no_wa_reseller       = htmlentities(strip_tags(trim($_POST["no_wa_reseller"] ?? '')));
  $alamat_instansi      = htmlentities(strip_tags(trim($_POST["alamat_instansi"] ?? '')));
  $tanggal_pembayaran_bulanan = htmlentities(strip_tags(trim($_POST["tanggal_pembayaran_bulanan"] ?? '0000-00-00')));
  $username             = htmlentities(strip_tags(trim($_POST["username"] ?? '')));
  $password             = htmlentities(strip_tags(trim($_POST["password"] ?? '')));
  $level                = htmlentities(strip_tags(trim($_POST["level"] ?? '')));


  $pesan_error="";

    // filter semua data
    $nama_instansi          = mysqli_real_escape_string($conn,$nama_instansi);
    $nama_pemilik           = mysqli_real_escape_string($conn,$nama_pemilik );
    $email_reseller         = mysqli_real_escape_string($conn,$email_reseller);
    $no_wa_reseller         = mysqli_real_escape_string($conn,$no_wa_reseller);
    $alamat_instansi        = mysqli_real_escape_string($conn,$alamat_instansi);
    $tanggal_pembayaran_bulanan = mysqli_real_escape_string($conn,$tanggal_pembayaran_bulanan);
    $username               = mysqli_real_escape_string($conn,$username);
    $password               = mysqli_real_escape_string($conn,$password);
    $level                  = mysqli_real_escape_string($conn,$level);

    //buat dan jalankan query INSERT
    $query = "UPDATE `reseller` SET `nama_instansi` = '$nama_instansi', `nama_pemilik` = '$nama_pemilik', `email_reseller` = '$email_reseller', `alamat_instansi` = '$alamat_instansi', `no_wa_reseller` = '$no_wa_reseller', `tanggal_pembayaran_bulanan` = '0000-00-00' WHERE `username` = '$uname'";

    $result = mysqli_query($conn, $query);  

    header("Location: table_reseller.php");
  
}
else {
    $result = mysqli_query($conn, "SELECT reseller.*, login.password, login.level FROM reseller JOIN login ON login.username=reseller.username where reseller.username = '$uname' ");

$data = mysqli_fetch_assoc($result);
  // form belum disubmit atau halaman ini tampil untuk pertama kali
  // berikan nilai awal untuk semua isian form
  $pesan_error        = "";
  $nama_instansi      = $data['nama_instansi'];
  $nama_pemilik       = $data['nama_pemilik'];
  $email_reseller     = $data['email_reseller'];
  $alamat_instansi    = $data['alamat_instansi'];
  $no_wa_reseller     = $data['no_wa_reseller'];
  $tanggal_pembayaran_bulanan  = $data['tanggal_pembayaran_bulanan'];
  $username           = $data['username'];
  $password           = $data['password'];
  $level              = $data['level'];
}
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Input Data Reseller</title>

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
      <li class="--set-active-index-html">
        <a href="dashboard_admin.php">
          <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
          <span class="menu-item-label">Dashboard</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">Menu</p>
    <ul class="menu-list">
      <li class="--set-active-tables-html">
        <a href="table_reseller.php">
          <span class="icon"><i class="mdi mdi-table"></i></span>
          <span class="menu-item-label">Reseller</span>
        </a>
      </li>
      <li class="--set-active-tables-html">
        <a href="table_client_admin.php">
          <span class="icon"><i class="mdi mdi-table"></i></span>
          <span class="menu-item-label">Client</span>
        </a>
      </li>
      <li class="active">
        <a href="input_data_reseller.php">
          <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
          <span class="menu-item-label">Input Data</span>
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
      <li>Input Data</li>
    </ul>
  </div>
</section>


  <section class="section main-section">
    <div class="card mb-6">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-ballot"></i></span>
          Input Data Reseller
        </p>
      </header>
      <div class="card-content">
        <form method="post" >
          <div class="field">
            <label class="label">Nama Instansi</label>
            <div class="field-body">
              <div class="field">
                <div class="control icons-left">
                  <input class="input" name="nama_instansi" type="text" placeholder="Global Media Data Prima" value="<?php echo $nama_instansi ?>">
                  <span class="icon left"><i class="mdi mdi-account"></i></span>
                </div>
              </div>
              <div class="field">
                <label class="label">Nama Reseller</label>
                <div class="control icons-left icons-right">
                  <input class="input" name="nama_pemilik" type="text" placeholder="Nama Pemilik" value="<?php echo $nama_pemilik ?>">
                  <span class="icon left"><i class="mdi mdi-account"></i></span>
                </div>
              </div>
              <div class="field">
                <label class="label">Email</label>
                <div class="control icons-left icons-right">
                  <input class="input" type="email" name="email_reseller" placeholder="info@gmdp.net.id" value="<?php echo $email_reseller ?>"> 
                  <span class="icon left"><i class="mdi mdi-mail"></i></span>
                  <span class="icon right"><i class="mdi mdi-check"></i></span>
                </div>
              </div>
            </div>
          </div>
          <div class="field">
            <div class="field-body">
              <div class="field">
              <label class="label">No HP</label>
                <div class="field addons">
                  <div class="control">
                    <input class="input" value="+62" size="3" readonly>
                  </div>
                  <div class="control expanded">
                    <input class="input" type="tel" name="no_wa_reseller" placeholder="Your phone number" value="<?php echo $no_wa_reseller ?>">
                  </div>
                </div>
                <p class="help">Mohon masukkan mulai dari 85xxx</p>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label">Alamat </label>
              <div class="control">
                <input class="input" type="text" name="alamat_instansi" placeholder="Madegondo, Kec. Grogol, Kabupaten Sukoharjo, Jawa Tengah" value="<?php echo $alamat_instansi ?>">
              </div>
          </div>

          <!-- <hr> -->
          <!-- <header class="card-header">
            <p class="card-header-title">
          Akun Sistem Reseller
        </p>
      </header> -->
          <!-- <div class="field">
            <label class="label">Username</label>
            <div class="control">
              <input class="input" type="text" name="username" placeholder="budi123" readonly value="<?php echo $username ?>">
            </div>
          </div>

          <div class="field">
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="text" name="password" placeholder="12345678" value="<?php echo $password ?>">
            </div>
          </div> -->
          <hr>

          <div class="field grouped">
            <div class="control">
              <button type="submit" class="button green" name="submit">
                Submit
              </button>
            </div>
            <div class="control">
              <button type="reset" class="button red">
                Reset
              </button>
            </div>
          </div>
        </form>
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
