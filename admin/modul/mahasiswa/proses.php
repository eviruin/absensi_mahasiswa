<?php 

if (isset($_POST['saveMahasiswa'])) {

    // Hash password menggunakan NIM
    $pass = sha1($_POST['nim']);

    // Validasi input untuk memastikan data tidak kosong
    if (empty($_POST['nim']) || empty($_POST['nama']) || empty($_POST['tempat']) || empty($_POST['tgl']) || empty($_POST['jk']) || empty($_POST['alamat']) || empty($_POST['th_masuk']) || empty($_POST['kelas'])) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Sanitasi input
    $nim = mysqli_real_escape_string($con, $_POST['nim']);
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $tempat = mysqli_real_escape_string($con, $_POST['tempat']);
    $tgl = mysqli_real_escape_string($con, $_POST['tgl']);
    $jk = mysqli_real_escape_string($con, $_POST['jk']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $th_masuk = mysqli_real_escape_string($con, $_POST['th_masuk']);
    $kelas = mysqli_real_escape_string($con, $_POST['kelas']);

    // Upload file foto
    $sumber = $_FILES['foto']['tmp_name'];
    $target = '../assets/img/user/';
    $nama_gambar = $_FILES['foto']['name'];

    if (!empty($nama_gambar)) {
        $ext = pathinfo($nama_gambar, PATHINFO_EXTENSION);
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        if (!in_array(strtolower($ext), $allowed_ext)) {
            echo "<script>alert('Format file tidak valid! Hanya JPG, JPEG, dan PNG diperbolehkan.'); window.history.back();</script>";
            exit;
        }

        if (!move_uploaded_file($sumber, $target . $nama_gambar)) {
            echo "<script>alert('Gagal mengupload foto! Periksa izin folder.'); window.history.back();</script>";
            exit;
        }
    } else {
        $nama_gambar = 'default.png'; // Gambar default jika tidak ada file diunggah
    }

    // Insert data ke database
    $save = mysqli_query($con, "INSERT INTO tb_mahasiswa (id_mahasiswa, nim, nama_mahasiswa, tempat_lahir, tgl_lahir, jk, alamat, password, foto, status, th_angkatan, id_mkelas) 
                                VALUES (NULL, '$nim', '$nama', '$tempat', '$tgl', '$jk', '$alamat', '$pass', '$nama_gambar', '1', '$th_masuk', '$kelas')");

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
                window.location.replace('?page=mahasiswa');
            }, 3000);   
        </script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} elseif (isset($_POST['editMahasiswa'])) {

    // Validasi input
    if (empty($_POST['nama']) || empty($_POST['tempat']) || empty($_POST['tgl']) || empty($_POST['jk']) || empty($_POST['alamat']) || empty($_POST['th_masuk']) || empty($_POST['kelas'])) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Sanitasi input
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $tempat = mysqli_real_escape_string($con, $_POST['tempat']);
    $tgl = mysqli_real_escape_string($con, $_POST['tgl']);
    $jk = mysqli_real_escape_string($con, $_POST['jk']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $th_masuk = mysqli_real_escape_string($con, $_POST['th_masuk']);
    $kelas = mysqli_real_escape_string($con, $_POST['kelas']);
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

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target . $gambar)) {
            mysqli_query($con, "UPDATE tb_mahasiswa SET foto='$gambar' WHERE id_mahasiswa='$id'");
        } else {
            echo "<script>alert('Gagal mengupload foto!'); window.history.back();</script>";
            exit;
        }
    }

    // Update data mahasiswa
    $editMahasiswa = mysqli_query($con, "UPDATE tb_mahasiswa 
                                         SET nama_mahasiswa='$nama', tempat_lahir='$tempat', tgl_lahir='$tgl', jk='$jk', alamat='$alamat', th_angkatan='$th_masuk', id_mkelas='$kelas' 
                                         WHERE id_mahasiswa='$id'");

    if ($editMahasiswa) {
        echo "
        <script>
            setTimeout(function () { 
                swal('{$nama}', 'Berhasil diubah', {
                    icon: 'success',
                    buttons: { confirm: { className: 'btn btn-success' } },
                });    
            }, 10);  
            window.setTimeout(function(){ 
                window.location.replace('?page=mahasiswa');
            }, 3000);   
        </script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
