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

$query = mysqli_query($conn, "SELECT * FROM paket_reseller WHERE id_reseller = '$_SESSION[username]'");
$paketReseller = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_POST["edit"])) {

  if ($_POST["edit"]=="edit") {

    $username  = htmlentities(strip_tags(trim($_POST["username"] ?? '')));
    // filter data
    $username = mysqli_real_escape_string($conn,$username);

    $query = "SELECT * FROM `client` INNER JOIN `login` ON (client.username=login.username) WHERE client.username='$username'";
    $result = mysqli_query($conn, $query);

    if(!$result){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
    }

    $data = mysqli_fetch_assoc($result);


    $username   = $data['username'];
    $nama             = $data['nama_client'];
    $alamat           = $data['alamat_client'];
    $no_wa_client     = $data['no_wa_client'];
    $paket            = $data['paket_client'];
    $password         = $data['password'];

  // bebaskan memory
  mysqli_free_result($result);
  }

  else if ($_POST["edit"]=="Update Data") {
    // ambil semua nilai form
    $username       = htmlentities(strip_tags(trim($_POST["username"] ?? '')));
    $nama                 = htmlentities(strip_tags(trim($_POST["nama_client"] ?? '')));
    $alamat               = htmlentities(strip_tags(trim($_POST["alamat_client"] ?? '')));
    $no_wa_client         = htmlentities(strip_tags(trim($_POST["no_wa_client"] ?? '')));
    $paket                = htmlentities(strip_tags(trim($_POST["paket_client"] ?? '')));
    $password             = htmlentities(strip_tags(trim($_POST["password"] ?? '')));
  }

  $pesan_error="";

  if (empty($username)) {
    $pesan_error .= "Username belum diisi <br>";
  }

  // jika tidak ada error, input ke database
  if (($pesan_error === "") AND ($_POST["update"]=="Update Data")) {

    // buka koneksi dengan MySQL
    include("koneksidb.php");

    // filter semua data
    $username       = mysqli_real_escape_string($conn,$username);
    $nama                 = mysqli_real_escape_string($conn,$nama);
    $alamat               = mysqli_real_escape_string($conn,$alamat);
    $no_wa_client         = mysqli_real_escape_string($conn,$no_wa_client);
    $paket                = mysqli_real_escape_string($conn,$paket);
    $password             = mysqli_real_escape_string($conn,$password);


    //buat dan jalankan query UPDATE
    $query = "UPDATE `client` SET `username`='$username',`id_reseller`='$_SESSION[username]',`nama_client`='$nama',`alamat_client`='$alamat',`no_wa_client`='$no_wa_client',`paket_client`='$paket'";
    $query .= "WHERE client.username='$username'";

    $result = mysqli_query($conn, $query);

    //periksa hasil query
    if($result) {

      header("Location: client_info.php");
    }
    else {
    die ("Query gagal dijalankan: ".mysqli_errno($conn).
         " - ".mysqli_error($conn));
    }
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
  <title>Edit Data Client</title>

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
      <li class="--set-active-tables-html">
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
      <li>Client</li>
    </ul>
  </div>
</section>


  <section class="section main-section">
    <div class="card mb-6">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-ballot"></i></span>
          Edit Data Client
        </p>
      </header>
      <div class="card-content">
        <form method="post">
          <div class="field">
            <label class="label">Nama</label>
            <div class="field-body">
              <div class="field">
                <div class="control icons-left">
                  <input class="input" name="nama" type="text" placeholder="Budi" value="<?php echo $nama ?>">
                  <span class="icon left"><i class="mdi mdi-account"></i></span>
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
                    <input class="input" type="number"  name="no_wa_client" placeholder="Your phone number" value="<?php echo $no_wa_client ?>">
                  </div>
                </div>
                <p class="help">Mohon masukkan mulai dari 8123xxx</p>
              </div>
            </div>
          </div>
          <div class="field">
                <label class="label">Alamat</label>
                  <input class="input" type="text" name="alamat_client" placeholder="Madegondo Kec. Grogol, Kab. Sukoharjo, Jawa Tengah" value="<?php echo $alamat ?>">
              </div>
              <div class="field">
                <div class="field-body">
                  <div class="field">
                    <label class="label">Paket</label>
                      <div class="field addons">
                        <select class="input" name="paket_client">
                          <?php foreach ($paketReseller as $paket) {
                            echo '<option name="'.$paket['paket'].'">'.$paket['paket'].' Mbps</option>';
                          } ?>
                        </select>
                        </div>
                    <p class="help">Format Mbps</p>
                  </div>
              </div>
            </div>
          <hr>
          <header class="card-header">
            <p class="card-header-title">
          Akun Sistem Client
        </p>
      </header>
          <div class="field">
            <label class="label">Username</label>
            <div class="control">
              <input class="input" type="text" name="username" placeholder="Email" value="<?php echo $username ?>">
            </div>
          </div>

          <div class="field">
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="text" name="password" placeholder="12345678" value="<?php echo $password ?>">
            </div>
          </div>
          <hr>

          <div class="field grouped">
            <div class="control">
              <button type="submit" class="button green" name="update" value="Update Data">
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
