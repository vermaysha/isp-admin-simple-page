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

  $paket = htmlentities(strip_tags(trim($_POST["paket"])));

  $paket = mysqli_real_escape_string($conn, $paket);

  $query = "DELETE FROM `paket_reseller` WHERE paket='$paket';";
  $hasil_query = mysqli_query($conn, $query);


  if($hasil_query) {

      header("Location: paket_reseller.php");
  }
  else {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
  }
}



//try {
  //INPUT PAKET
  if (isset($_POST["submit"])) {

    

    $paket    = htmlentities(strip_tags(trim($_POST["paket"] ?? '')));
    $harga    = htmlentities(strip_tags(trim($_POST["harga"] ?? '')));

    $pesan_error="";

      $paket       = mysqli_real_escape_string($conn, $paket);
      $query       = "SELECT * FROM `paket_reseller` WHERE paket='$paket' AND id_reseller='$_SESSION[username]'";
      $hasil_query = mysqli_query($conn, $query);


  
  
    $jumlah_data = mysqli_num_rows($hasil_query);
     if ($jumlah_data >= 1 ) {
       $pesan_error .= "Paket yang sama sudah digunakan <br>";
    }

    // jika tidak ada error, input ke database
    if ($pesan_error === "") {
  
      $paket   = mysqli_real_escape_string($conn,$paket);
      $harga   = mysqli_real_escape_string($conn,$harga);
  
      
      //buat dan jalankan query INSERT
      $query = "INSERT INTO `paket_reseller`(`id_reseller`, `paket`, `harga`) VALUES ";
      $query .= "('$_SESSION[username]','$paket','$harga')";
    
      $result = mysqli_query($conn, $query);

      //periksa hasil query
      if($result) {
        header("Location: paket_reseller.php");
      }
      else {
        die ("Query Error: ".mysqli_errno($conn).
        " - ".mysqli_error($conn));
      }
    }
    
  }

// }
// catch (Exception $e) {
//   echo $e->getMessage();
// }

//orm belum disubmit atau halaman ini tampil untuk pertama kali
    // berikan nilai awal untuk semua isian form
   //$pesan_error        = "";
   //$paket        = "";
   //$harga        = "";
///}


?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Paket Internet</title>

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
      <li class="--set-active-forms-html">
        <a href="tagihan_client.php">
          <span class="icon"><i class="mdi mdi-coins"></i></span>
          <span class="menu-item-label">Tagihan Client</span>
        </a>
      </li>
      <li class="active">
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
      <li>Paket Internet</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Daftar Paket Internet
    </h1>
  </div>
</section>

  <section class="section main-section">
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-wifi"></i></span>
          Table Paket
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
            <th>Paket</th>
            <th>Harga</th>
          </tr>
          </thead>
          <tbody>
          <tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM `paket_reseller` WHERE id_reseller='$_SESSION[username]' ORDER BY paket ASC");
            $no = 1;
          
            if(!$result){
                die ("Query Error: ".mysqli_errno($conn).
                     " - ".mysqli_error($conn));
            }
          
            while($data = mysqli_fetch_assoc($result))
            {
              ?>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['paket']; ?>Mbps</td>
            <td>Rp.<?php echo $data['harga']; ?></td>
            
            <td class="actions-cell">
              <div class="buttons right nowrap">    
              <form action="edit_paket.php" method="post" >
                <input type="hidden" name="username" value="<?php echo "$data[paket]"; ?>" >
                <button class="button small blue --jb-modal" data-target="sample-modal" type="submit" name="edit">
                  <span class="icon"><i class="mdi mdi-pencil"></i></span>
                </button>
                </form>
                &nbsp;
                <form action="paket_reseller.php" method="post" >
                <input type="hidden" name="paket" value="<?php echo "$data[paket]"; ?>" >
                <button class="button small red --jb-modal" data-target="sample-modal" type="hapus" name="hapus">
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


  <section class="section main-section">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
      <div class="card">
        <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-plus"></i></span>
          Tambah Paket Internet
        </p>
        </header>
        <div class="card-content">
        <form method="post">
          <div class="field">
            <label class="label">Paket</label>
            <div class="control">
              <input type="number" placeholder="10" name="paket" class="input" value="<?php  echo $paket ?>" step="5">
            </div>
            <p class="help">Hanya Masukkan Angka. Format Mbps</p>
          </div>
          <div class="field">
            <label class="label">Harga Paket</label>
            <div class="control">
              <input type="number" placeholder="200000" name="harga" class="input" value="<?php echo $harga ?>" step="5000">
            </div>
            <p class="help">Harap Masukkan Nilai Dengan Benar</p>
          </div>
          <hr>
          <div class="field">
            <div class="control">
              <button type="submit" name="submit" class="button green">
                Submit
              </button>
            </div>
          </div>
        </form>
        </div>
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