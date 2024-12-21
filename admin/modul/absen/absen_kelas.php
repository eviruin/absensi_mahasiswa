<?php 
// tampilkan data mengajar
$kelasMengajar = mysqli_query($con,"SELECT * FROM tb_mengajar 

INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas

INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
WHERE tb_mengajar.id_dosen='$data[id_dosen]' AND tb_mengajar.id_mengajar='$_GET[pelajaran]'  AND tb_thajaran.status=1  ");

foreach ($kelasMengajar as $d) 

	?>

<div class="page-inner">

    <div class="page-header">
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">KELAS (<?=strtoupper($d['nama_kelas']) ?> )</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?=strtoupper($d['mapel']) ?></a>
            </li>
        </ul>

    </div>


    <div class="row">

        <div class="col-md-12 col-xs-12">
            <?php 
							// tampilkan jika da yg izin hari ini
								// tampilkan sataurs izin
							$today = date('Y-m-d'); // tanggal sekarang
							$queryIzin = mysqli_query($con,"SELECT * FROM tb_izin 
								INNER JOIN tb_mahasiswa ON tb_izin.id_mahasiswa=tb_mahasiswa.id_mahasiswa

								-- INNER JOIN tb_mengajar ON tb_izin.id_mengajar=tb_mengajar.id_mengajar

								WHERE tb_izin.tgl_izin='$today' AND tb_izin.ket_izin='0' AND tb_izin.persetujuan='0' AND tb_mahasiswa.id_mkelas='$d[id_mkelas]' ");
								foreach ($queryIzin as $si) { ?>

            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong class="text-warning">( <?=$si['nama_mahasiswa'] ?> )</strong> Mengajukan permintaan izin pada
                hari ini <b> <a href="?page=absen&act=surat_view&izin=<?=$si['id_izin'];?>"> Lihat permintaan ?</a></b>
            </div>

            <?php } ?>



            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="card-title fw-mediumbold text-info">DAFTAR HADIR MAHASISWA</div>
                        <div class="card-list">
                            <!-- KETERANGAN :   -->

                            <input type="date" name="tgl" class="form-control">
                            <?php 

										// tampilakan data mahasiswa berdasarkan kelas yang dipilih

										$mahasiswa = mysqli_query($con,"SELECT * FROM tb_mahasiswa WHERE id_mkelas='$d[id_mkelas]' ORDER BY id_mahasiswa ASC ");
										$jumlahMahasiswa = mysqli_num_rows($mahasiswa);
										foreach ($mahasiswa as $i =>$s) {?>

                            <div class="item-list">
                                <div class="avatar">
                                    <img src="../assets/img/user/<?=$s['foto'] ?>" class="avatar-img rounded-circle">
                                </div>
                                <div class="info-user">
                                    <div class="username">
                                        <b><?=$s['nama_mahasiswa'] ?></b>
                                        <input type="hidden" name="id_mahasiswa-<?=$i;?>"
                                            value="<?=$s['id_mahasiswa'] ?>">
                                        <input type="hidden" name="pelajaran" value="<?=$_GET['pelajaran'] ?>">
                                    </div>
                                    <div class="status">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input name="ket-<?=$i;?>" class="form-check-input" type="checkbox"
                                                    value="H">
                                                <span class="form-check-sign">H</span>
                                            </label>
                                            <label class="form-check-label">
                                                <input name="ket-<?=$i;?>" class="form-check-input" type="checkbox"
                                                    value="I">
                                                <span class="form-check-sign">I</span>
                                            </label>
                                            <label class="form-check-label">
                                                <input name="ket-<?=$i;?>" class="form-check-input" type="checkbox"
                                                    value="S">
                                                <span class="form-check-sign">S</span>
                                            </label>
                                            <label class="form-check-label">
                                                <input name="ket-<?=$i;?>" class="form-check-input" type="checkbox"
                                                    value="A">
                                                <span class="form-check-sign">A</span>
                                            </label>
                                            <label>
                                                <?php 

								$now = date('Y-m-d'); // tanggal sekarang
								$status = mysqli_query($con,"SELECT * FROM tb_izin
								-- INNER JOIN tb_mengajar ON tb_izin.id_mengajar=tb_mengajar.id_mengajar
								 -- AND tb_izin.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_dosen='$data[id_dosen]'
								WHERE tb_izin.id_mahasiswa='$s[id_mahasiswa]' AND tb_izin.tgl_izin='$now' ");
								foreach ($status as $izin) 

								// echo $izin['alasan_izin']."<br>";
								if ($izin['ket_izin']=='0') {
								echo "<span class='badge badge-danger'>Permohonan izin belum dikonfirmasi</span>";
								}elseif ($izin['ket_izin']=='1') {
								if ($izin['kat']=='I') {
								echo "<span class='badge badge-info'>Izin</span>";
								}elseif ($izin['kat']=='S') {
								echo "<span class='badge badge-warning'>Sakit</span>";									
								}else{
								echo "<span class='badge badge-danger'>Alfa</span>";
								}



								}


								?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                        <center>
                            <button type="submit" name="absen" class="btn btn-success btn-sm">
                                <i class="fa fa-check"></i> Selesai
                            </button>
                            <a href="javascript:history.back()" class="btn btn-danger btn-sm">
                                <i class="fa fa-arrow-left"></i> Batal
                            </a>
                        </center>
                </div>
                </form>

                <?php 
									if (isset($_POST['absen'])) {
										
										$total = $jumlahMahasiswa-1;
										$today = $_POST['tgl'];

										for ($i =0; $i <=$total ; $i++) {

											$id_mahasiswa = $_POST['id_mahasiswa-'.$i];
											$pelajaran = $_POST['pelajaran'];
											$ket = $_POST['ket-'.$i];


											$cekAbsesnHariIni = mysqli_num_rows(mysqli_query($con,"SELECT * FROM _logabsensi WHERE tgl_absen='$today' AND id_mengajar='$pelajaran' AND id_mahasiswa='$id_mahasiswa' "));

											if ($cekAbsesnHariIni > 0) {


													echo "
													<script type='text/javascript'>
													setTimeout(function () { 

													swal('Sorry!', 'Absen Hari ini sudah dilakukan', {
													icon : 'error',
													buttons: {        			
													confirm: {
													className : 'btn btn-danger'
													}
													},
													});    
													},10);  
													window.setTimeout(function(){ 
													window.location.replace('?page=absen&pelajaran=$_GET[pelajaran]');
													} ,3000);   
													</script>";
							
											}else{

												$insert = mysqli_query($con,"INSERT INTO _logabsensi VALUES (NULL,'$pelajaran','$id_mahasiswa','$today','$ket')");

										if ($insert) {


											echo "
											<script type='text/javascript'>
											setTimeout(function () { 

											swal('Berhasil', 'Data absen hari ini telah tersimpan ke database !', {
											icon : 'success',
											buttons: {        			
											confirm: {
											className : 'btn btn-success'
											}
											},
											});    
											},10);  
											window.setTimeout(function(){ 
											window.location.replace('?page=absen&pelajaran=$_GET[pelajaran]');
											} ,3000);   
											</script>";


											}


										



										}



											
										}


									}

								 ?>

            </div>
        </div>
        <ul>
            Keterangan
            <li style="display: block;" class="text-primary">H : (Hadir)</li>
            <li style="display: block;" class="text-info">I : (Izin)</li>
            <li style="display: block;" class="text-warning">S : (Sakit)</li>
            <li style="display: block;" class="text-danger">A : (Alfa)</li>
        </ul>

    </div>

</div>