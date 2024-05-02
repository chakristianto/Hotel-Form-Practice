<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pemesanan Hotel</title>

  <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
  <!-- Navigation-->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
    </div>
  </header><!-- End Header -->
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#page-top">Data Pemesanan Hotel</a>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item" style="font-size:20px ;">
                    <a class="nav-link" aria-current="page" href="index.html">Home</a>
                    </li>
                    <li class="nav-item" style="font-size:20px ;">
                    <a class="nav-link" href="book.html">Book</a>
                    </li>
                    <li class="nav-item" style="font-size:20px ;">
                    <a class="nav-link active" href="hasil.php">hasil</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav> -->

  <?php
  // membuat koneksi ke database
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'db_hotel';

  $koneksi = mysqli_connect($host, $username, $password, $database);

  // mengambil data dari tabel
  $sql = "SELECT * FROM data_pesanan";
  $result = mysqli_query($koneksi, $sql);

  if (mysqli_num_rows($result) > 0) {
    // menampilkan data pada halaman hasil
    echo '<table>';
    echo '<tr><th>Nama Pemesan</th><th>Jenis Kelamin</th><th>Nomor Identitas</th><th>Tipe Kamar</th><th>Tanggal Pesan</th><th>Durasi Menginap</th><th>Breakfast</th><th>Total Bayar</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['namaPemesan'] . '</td>';
      echo '<td>' . $row['jenisKelamin'] . '</td>';
      echo '<td>' . $row['nomorIdentitas'] . '</td>';
      echo '<td>' . $row['tipeKamar'] . '</td>';
      echo '<td>' . $row['tanggalPesan'] . '</td>';
      echo '<td>' . $row['durasiMenginap'] . '</td>';
      // Check if breakfast value is 1 or 0 and display accordingly
      echo '<td>' . ($row['breakfast'] == 1 ? 'Yes' : 'No') . '</td>';
      echo '<td>' . $row['totalBayar'] . '</td>';

      echo '</tr>';
    }
    echo '</table>';
  } else {
    echo "Data tidak ditemukan";
  }
  ?>
<!-- menambah chart -->
  <div style="width: 800px;margin: 0px auto;">
    <canvas id="myChart"></canvas>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Standar", "Deluxe", "Family"],
        datasets: [{
          label: '',
          data: [
            <?php
            $jumlah_standar = mysqli_query($koneksi, "select * from data_pesanan where tipeKamar='Standar'");
            echo mysqli_num_rows($jumlah_standar);
            ?>,
            <?php
            $jumlah_deluxe = mysqli_query($koneksi, "select * from data_pesanan where tipeKamar='Deluxe'");
            echo mysqli_num_rows($jumlah_deluxe);
            ?>,
            <?php
            $jumlah_family = mysqli_query($koneksi, "select * from data_pesanan where tipeKamar='Family'");
            echo mysqli_num_rows($jumlah_family);
            ?>,
          ],
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>

</html>