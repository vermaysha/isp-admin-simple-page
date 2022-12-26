<?PHP

//membuat koneksi ke database phpmyadmin
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$link = mysqli_connect($dbhost, $dbuser, $dbpass);

$nomor = 13;
$huruf = C;
$paket = 15;


if(!$link){
    die ("koneksi database gagal : ".mysqli_connect_errno().
    " - ".mysqli_connect_error());
            }

$result = mysqli_select_db($link, "sample_billing");


if(!$result){
    die ("Query Error : ".mysqli_errno($link).
    " - ".mysqli_error($link));
                }
    else{
    echo "Database berhasil digunakan... </br>";
        }

echo "</br>";
echo "Database selesai, menuju input data client";
echo "</br>";
echo "</br>";

        $query = "INSERT INTO `client`(`username`, `id_reseller`, `nama_client`, `alamat_client`, `no_wa_client`, `paket_client`) VALUES ('cr$huruf$nomor','reseller$huruf','Client Reseller $huruf $nomor','Jl P Jayakarta 141, Dki Jakarta','+62883267426572','$paket')";

		$hasil_query = mysqli_query($link, $query);


if(!$hasil_query){
    die ("Query Error : ".mysqli_errno($link).
    " - ".mysqli_error($link));
                    }
    else{
    echo "Tabel client selesai diinput... </br>";
        }

echo "</br>";
echo "tabel client selesai, menuju tabel login";
echo "</br>";
echo "</br>";

		$query = "INSERT INTO `login`(`username`, `password`, `level`, `parent`) VALUES ('cr$huruf$nomor','123','client','reseller$huruf')";

		$hasil_query = mysqli_query($link, $query);


if(!$hasil_query){
    die ("Query Error : ".mysqli_errno($link).
    " - ".mysqli_error($link));
                    }
    else{
    echo "Tabel login selesai diinput... </br>";
        }

echo "</br>";
echo "tabel login selesai, menuju tabel riwayat pembayaran";
echo "</br>";
echo "</br>";


		$query = "INSERT INTO `riwayat_pembayaran`(`id_reseller`, `username_client`, `tanggal`, `status_pembayaran`) VALUES ('reseller$huruf','cr$huruf$nomor','0000-00-00','Belum')";

		$hasil_query = mysqli_query($link, $query);


if(!$hasil_query){
    die ("Query Error : ".mysqli_errno($link).
    " - ".mysqli_error($link));
                    }
    else{
    echo "Tabel riwayat selesai diinput... </br>";
        }
		
		

?>