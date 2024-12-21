<div class="page-inner">
          <div class="page-header">
            <h4 class="page-title">Mahasiswa</h4>
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
                <a href="#">Data Mahasiswa</a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="#">Tambah Mahasiswa</a>
              </li>
            </ul>
          </div>
          <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Form Entry Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                 <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Kelas</th>
                            <th>Tahun Masuk</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>  
                    <tbody>
                        <?php 
                        $no=1;
			$mahasiswa = mysqli_query($con,"SELECT * FROM tb_mahasiswa
                 INNER JOIN tb_mkelas ON tb_mahasiswa.id_mkelas=tb_mkelas.id_mkelas
                 ORDER BY id_mahasiswa ASC
                ");
                        foreach ($mahasiswa as $g) {?>
                        <tr>
                            <td><?=$no++;?>.</td>                          
                            <td><?=$g['nis'];?></td>
                            <td><?=$g['nama_mahasiswa'];?></td>
                            <td><?=$g['nama_kelas'];?></td>
                            <td><?=$g['th_angkatan'];?></td>
                            <td><?php if ($g['status']==1) {
                                echo "<span class='badge badge-success'>Aktif</span>";
                                
                            }else {
                                echo "<span class='badge badge-danger'>Off</span>";
                            } ?></td>
                            <td><img src="../assets/img/user/<?=$g['foto'] ?>" width="45" height="45"></td>
                              <td>
                              <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=mahasiswa&act=del&id=<?=$g['id_mahasiswa'] ?>"><i class="fas fa-trash"></i></a>
                            <a class="btn btn-info btn-sm" href="?page=mahasiswa&act=edit&id=<?=$g['id_mahasiswa'] ?>"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>                        
                </table>
</div>
</div>
</div>
</div>
</div>
