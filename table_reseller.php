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

if (isset($_POST["submit"])) {

  $nama_instansi = htmlentities(strip_tags(trim($_POST["nama_instansi"])));

  $nama_instansi = mysqli_real_escape_string($conn,$nama_instansi);

  $query = "DELETE FROM reseller WHERE nama_instansi='$nama_instansi' ";
  $hasil_query = mysqli_query($conn, $query);

  if($hasil_query) {
    $pesan = "Reseller dengan Nama Instansi = \"<b>$nama_instansi</b>\" sudah berhasil di hapus";
    $pesan = urlencode($pesan);
      header("Location: table_reseller.php?pesan={$pesan}");
  }
  else {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
  }
}


//MENCARI DATA
if (isset($_GET["cari"])) {
  
  $nama_reseller = htmlentities(strip_tags(trim($_GET["cari"])));
  
  $nama_reseller = mysqli_real_escape_string($conn, $nama_reseller);
  
  
  $query  = "SELECT * FROM `reseller` WHERE nama_instansi LIKE '%$nama_reseller%' ORDER BY nama_instansi ASC";
  
  $pesan = "Hasil pencarian untuk nama <b>\"$nama_reseller\" </b>:";
  } 
  else {
  
  $query = "SELECT * FROM `reseller` ORDER BY nama_instansi ASC";
  }
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reseller</title>

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
      <form id="search" action="table_reseller.php" method="get">
          <input name="cari" placeholder="Search everywhere..." class="input" type="text">
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
      <li class="--set-active-index-html">
        <a href="dashboard_admin.php">
          <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
          <span class="menu-item-label">Dashboard</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">Menu</p>
    <ul class="menu-list">
      <li class="active">
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
      <li class="--set-active-forms-html">
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
      <li>Reseller</li>
    </ul>
  </div>
</section>

<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      Data Reseller
    </h1>
    <a href="input_data_reseller.php" class="button light">Input Data Reseller</a>
  </div>
</section>

  <section class="section main-section">
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
          Reseller
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
            <th>Instansi</th>
            <th>Nama Pemilik</th>
            <th>Username</th>
            <th>No Wa</th>
            <th>Client</th>
          </tr>
          </thead>
          <tbody>
          <tr>

            <?php
            //$query = "SELECT * FROM reseller ORDER BY nama_instansi ASC";
            $result = mysqli_query($conn, $query);
            $no = 1;

          
            if(!$result){
                die ("Query Error: ".mysqli_errno($conn).
                     " - ".mysqli_error($conn));
            }

            while($data = mysqli_fetch_assoc($result))
            {
              $data_client = mysqli_query($conn, "SELECT * FROM `client` WHERE client.id_reseller='$data[username]'");
              $jumlah_client = mysqli_num_rows($data_client);

              ?>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama_instansi']; ?></td>
            <td><?php echo $data['nama_pemilik']; ?></td>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['no_wa_reseller']; ?></td>
            <td><?php echo $jumlah_client; ?></td>


            
            <td class="actions-cell">
              <div class="buttons right nowrap">
                <a class="button small green" href="edit_data_reseller.php?username=<?php echo $data['username']?>">Edit</a>
              <form action="reseller_info.php" method="post" >
                <input type="hidden" name="username" value="<?php echo "$data[username]"; ?>" >
                <button class="button small green --jb-modal" data-target="sample-modal" type="submit" name="info">
                  <span class="icon"><i class="mdi mdi-eye"></i></span>
                </button>
                </form>
                &nbsp;
                <form action="table_reseller.php" method="post" >
                <input type="hidden" name="nama_instansi" value="<?php echo "$data[nama_instansi]"; ?>" >
                <button class="button small red --jb-modal" data-target="sample-modal" type="submit" name="submit">
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