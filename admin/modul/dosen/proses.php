<?php 

if (isset($_POST['saveDosen'])) {

    // Hash password menggunakan NIP
    $pass = sha1($_POST['nip']);

    // Validasi input untuk memastikan data tidak kosong
    if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['email'])) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Sanitasi input untuk mencegah SQL Injection
    $nip = mysqli_real_escape_string($con, $_POST['nip']);
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Upload file foto
    $sumber = $_FILES['foto']['tmp_name'];
    $target = '../assets/img/user/';
    $nama_gambar = $_FILES['foto']['name'];

    // Validasi upload file
    if (!empty($nama_gambar)) {
        $ext = pathinfo($nama_gambar, PATHINFO_EXTENSION);
        $allowed_ext = ['jpg', 'jpeg', 'png'];
        
        if (!in_array(strtolower($ext), $allowed_ext)) {
            echo "<script>alert('Format file tidak valid! Hanya JPG, JPEG, dan PNG diperbolehkan.'); window.history.back();</script>";
            exit;
        }

        // Pindahkan file ke folder tujuan
        if (!move_uploaded_file($sumber, $target . $nama_gambar)) {
            echo "<script>alert('Gagal mengupload foto! Periksa izin folder.'); window.history.back();</script>";
            exit;
        }
    } else {
        $nama_gambar = 'default.png'; // Gunakan gambar default jika tidak ada file diunggah
    }

    // Insert data ke database
    $save = mysqli_query($con, "INSERT INTO tb_dosen (id_dosen, nip, nama_dosen, email, password, foto, status) 
                                VALUES (NULL, '$nip', '$nama', '$email', '$pass', '$nama_gambar', 'Y')");

    if ($save) {
        echo "
        <script>
            setTimeout(function () { 
                swal('{$nama}', 'Berhasil disimpan', {
                    icon: 'success',
                    buttons: { confirm: { className: 'btn btn-success' } },
                });    
            }, 10);  
            window.setTimeout(function(){ 
                window.location.replace('?page=dosen');
            }, 3000);   
        </script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['editDosen'])) {

    // Hash password menggunakan email (opsional)
    $pass = sha1($_POST['email']);

    // Validasi input untuk memastikan data tidak kosong
    if (empty($_POST['nama']) || empty($_POST['email'])) {
        echo "<script>alert('Nama dan Email wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Sanitasi input
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $id = (int) $_POST['id'];

    // Upload file foto jika ada
    $gambar = $_FILES['foto']['name'];
    if (!empty($gambar)) {
        $ext = pathinfo($gambar, PATHINFO_EXTENSION);
        $allowed_ext = ['jpg', 'jpeg', 'png'];
        
        if (!in_array(strtolower($ext), $allowed_ext)) {
            echo "<script>alert('Format file tidak valid! Hanya JPG, JPEG, dan PNG diperbolehkan.'); window.history.back();</script>";
            exit;
        }

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target . $gambar)) {
            mysqli_query($con, "UPDATE tb_dosen SET foto='$gambar' WHERE id_dosen='$id'");
        } else {
            echo "<script>alert('Gagal mengupload foto!'); window.history.back();</script>";
            exit;
        }
    }

    // Update data dosen
    $editDosen = mysqli_query($con, "UPDATE tb_dosen SET nama_dosen='$nama', email='$email' WHERE id_dosen='$id'");

    if ($editDosen) {
        echo "
        <script>
            setTimeout(function () { 
                swal('{$nama}', 'Berhasil diubah', {
                    icon: 'success',
                    buttons: { confirm: { className: 'btn btn-success' } },
                });    
            }, 10);  
            window.setTimeout(function(){ 
                window.location.replace('?page=dosen');
            }, 3000);   
        </script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
