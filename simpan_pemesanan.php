<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_hotel";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['simpan'])) {
    // Check if all required fields are filled
    if (empty($_POST['namaPemesan']) || empty($_POST['jenisKelamin']) || empty($_POST['nomorIdentitas']) || empty($_POST['tipeKamar']) || empty($_POST['tanggalPesan']) || empty($_POST['durasiMenginap']) || empty($_POST['totalBayar'])) {
        // If any required field is empty, show an alert using JavaScript
        echo '<script>alert("Please fill in all fields."); window.history.back();</script>';
    } else {
        // Additional validation for nomorIdentitas field
        $nomorIdentitas = $_POST['nomorIdentitas'];
        if (strlen($nomorIdentitas) < 16) {
            // If nomorIdentitas is less than 16 characters, prompt the user to refill the form
            echo '<script>alert("Nomor Identitas must be at least 16 characters long."); window.history.back();</script>';
        } else {
            // If all required fields are filled and nomorIdentitas meets the criteria, proceed with data insertion
            $namaPemesan = $_POST['namaPemesan'];
            $jenisKelamin = $_POST['jenisKelamin'];
            $tipeKamar = $_POST['tipeKamar'];
            $tanggalPesan = $_POST['tanggalPesan'];
            $durasiMenginap = $_POST['durasiMenginap'];
            $breakfast = isset($_POST['breakfast']) ? 1 : 0;
            $totalBayar = $_POST['totalBayar'];
            
            $diskon = ($durasiMenginap >= 3) ? 10 : 0;
            
            // Insert data into the database
            $sql = "INSERT INTO data_pesanan (namaPemesan, jenisKelamin, nomorIdentitas, tipeKamar, tanggalPesan, durasiMenginap, breakfast, diskon, totalBayar) 
                    VALUES ('$namaPemesan', '$jenisKelamin', '$nomorIdentitas', '$tipeKamar', '$tanggalPesan', '$durasiMenginap', '$breakfast', '$diskon','$totalBayar' )";

            // Execute the SQL query
            if ($conn->query($sql) === TRUE) {
                // Output the inserted data
                echo "<p>Nama Pemesan      : $namaPemesan</p>";
                echo "<p>Nomor Identitas   : $nomorIdentitas</p>";
                echo "<p>Jenis Kelamin     : $jenisKelamin</p>";
                echo "<p>Tipe Kamar        : $tipeKamar</p>";
                echo "<p>Durasi Menginap   : $durasiMenginap hari</p>";
                echo "<p>Discount          : $diskon%</p>";
                echo "<p>Total Pembayaran  : $totalBayar</p>";

                // Add a button to return to index.html
                echo '<a href="index.html" class="btn btn-primary">Back to Home</a>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close the database connection
$conn->close();
?>
