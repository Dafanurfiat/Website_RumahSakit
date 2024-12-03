<?php 
session_start();
include 'function/function.php'; // Pastikan ini adalah file koneksi database Anda
$messages = "";

// Jika sudah login, redirect ke halaman yang sesuai
if (isset($_SESSION['login'])) {
    if ($_SESSION['is_admin']) {
        header("Location: admin/dashboard.php");
        exit();
    } else {
        header("Location: landingPage.php");
        exit();
    }
}

// Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = array();

    if (empty($username) || empty($password)) {
        array_push($errors, "Username dan password harus diisi!");
    }

    if (count($errors) == 0) {
        // Cek login di tabel admin
        $sqlAdmin = "SELECT * FROM admin WHERE username = ?";
        $stmtAdmin = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmtAdmin, $sqlAdmin)) {
            mysqli_stmt_bind_param($stmtAdmin, "s", $username);
            mysqli_stmt_execute($stmtAdmin);
            $resultAdmin = mysqli_stmt_get_result($stmtAdmin);

            if ($admin = mysqli_fetch_assoc($resultAdmin)) {
                if (password_verify($password, $admin['password'])) {
                    // Login sebagai admin
                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $admin['username'];
                    $_SESSION['is_admin'] = true; // Menandai sebagai admin
                    header("Location: admin/dashboard.php");
                    exit();
                } else {
                    array_push($errors, "Password salah!");
                }
            }
        }

        // Cek login di tabel pasien
        $sqlPasien = "SELECT * FROM pasien WHERE username = ?";
        $stmtPasien = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmtPasien, $sqlPasien)) {
            mysqli_stmt_bind_param($stmtPasien, "s", $username);
            mysqli_stmt_execute($stmtPasien);
            $resultPasien = mysqli_stmt_get_result($stmtPasien);

            if ($pasien = mysqli_fetch_assoc($resultPasien)) {
                if (password_verify($password, $pasien['password'])) {
                    // Login sebagai pasien
                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $pasien['username'];
                    $_SESSION['id_pasien'] = $pasien['id_pasien'];
                    $_SESSION['is_admin'] = false; // Menandai sebagai pasien
                    $_SESSION['no_ktp'] = $pasien['no_ktp'];
                    header("Location: landingPage.php");
                    exit();
                } else {
                    array_push($errors, "Password salah!");
                }
            }
        }

        // Jika tidak ditemukan di kedua tabel
        if (empty($errors)) {
            array_push($errors, "Akun tidak ditemukan!");
        }
    }

    // Menampilkan pesan error
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            $messages .= "<div class='alert-danger'>$error</div>";
        }
    }
}

// Proses registrasi pasien
if (isset($_POST["submit"])) {
    $nama_pasien = $_POST["nama_pasien"];
    $no_ktp = $_POST["no_ktp"];
    $username = trim($_POST["username"]);
    $tgl_lahir = $_POST["tgl_lahir"];
    $nama_wali = $_POST["nama_wali"];
    $no_kontak_pasien = $_POST["no_kontak_pasien"];
    $no_kontak_wali = $_POST["no_kontak_wali"];
    $password = trim($_POST["password"]);
    $passwordRepeat = $_POST["repeat_password"];
    
    $errors = array();

    if (empty($nama_pasien) || empty($username) || empty($no_ktp) || empty($password) || empty($passwordRepeat)) {
        array_push($errors, "Semua kolom harus diisi!");
    }
    if (!is_numeric($no_ktp)) {
        array_push($errors, "Nomor KTP tidak valid!");
    }
    if (!is_numeric($no_kontak_pasien)) {
        array_push($errors, "Nomor kontak pasien tidak valid!");
    }
    if (!is_numeric($no_kontak_wali)) {
        array_push($errors, "Nomor kontak wali tidak valid!");
    }
    if (strlen($password) < 4) {
        array_push($errors, "Password setidaknya harus 4 karakter!");
    }
    if ($password !== $passwordRepeat) {
        array_push($errors, "Password tidak sama!");
    }

    $sql = "SELECT * FROM pasien WHERE no_ktp = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        array_push($errors, "SQL error");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $no_ktp);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Nomor KTP sudah ada!");
        }
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            $messages .= "<div class='alert-danger'>$error</div>";
        }
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO pasien (nama_pasien, no_ktp, username, password, tgl_lahir, nama_wali, no_kontak_pasien, no_kontak_wali) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("Something went wrong");
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssss", $nama_pasien, $no_ktp, $username, $passwordHash, $tgl_lahir, $nama_wali, $no_kontak_pasien, $no_kontak_wali);
            mysqli_stmt_execute($stmt);
            $messages .= "<div class='alert-success'>Akun kamu berhasil teregistrasi.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Sign Up</title>
</head>
<body>

<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="index.php" method="POST">
            <h1>Membuat Akun</h1>
            <span>Daftarkan sesuai dengan data anda.</span><br>
            <input type="text" name="nama_pasien" id="nama_pasien" placeholder="Masukan nama lengkap anda">
            <input type="number" name= "no_ktp" id="no_ktp" placeholder="Masukan nomor KTP anda">
            <input type="text" name="username" id="username" placeholder="Masukan username anda">
            <input type="date" name="tgl_lahir" id="tgl_lahir" placeholder="Masukan tanggal lahir anda">
            <input type="text" name="nama_wali" id="nama_wali" placeholder="Masukan nama perwalian anda">
            <input type="number" name= "no_kontak_pasien" id="no_kontak_pasien" placeholder="Masukan nomor kontak anda">
            <input type="number" name= "no_kontak_wali" id="no_kontak_wali" placeholder="Masukan nomor kontak perwalian anda">
            <input type="password" name="password" id="password" placeholder="Masukkan password anda">
            <input type="password" name="repeat_password" id="repeat_password" placeholder="Ulangi password anda">
            <button type="submit" name="submit" value="Daftar Akun">Buat Akun</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="" method="POST">
            <h1>Login</h1>
            <span>Masukkan akun anda</span>
            <p><?php echo $messages; ?></p>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit" name="login" value="Masuk Ke Sistem">Login</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Tana Luwu Medical Center</h1>
                <p>Akun sudah ada? silahkan login.</p>
                <button class="hidden" id="signin">Login</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Tana Luwu Medical Center</h1>
                <p>Belum punya akun? Daftar dulu.</p>
                <button class="hidden" id="signup">Daftar</button>
            </div>
        </div>
    </div>
</div>

<script src="scripts/script.js"></script>
</body>
</html>