	<?php 

$edit = mysqli_query($con,"SELECT * FROM tb_dosen WHERE id_dosen='$_GET[id]' ");
foreach ($edit as $d)?>
<div class="page-inner">
          <div class="page-header">
            <h4 class="page-title">Dosen</h4>
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
                <a href="#">Data Dosen</a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="#">Edit Dosen</a>
              </li>
            </ul>
          </div>
          <div class="row">
                <div class="col-lg-8">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Form Edit Dosen</h3>
                    </div>
                    <div class="card-body">
						<form action="?page=dosen&act=proses" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>NIP/NUPTK</label>
								<input type="hidden" name="id" value="<?=$d['id_dosen'] ?>">
								<input name="nip" type="text" class="form-control" value="<?=$d['nip'] ?>" readonly>								
							</div>

							<div class="form-group">
								<label>Nama Dosen</label>
								<input name="nama" type="text" class="form-control" value="<?=$d['nama_dosen'] ?>">								
							</div>

							<div class="form-group">
								<label>Email</label>
								<input name="email" type="text" class="form-control" value="<?=$d['email'] ?>">
							</div>
							<div class="form-group">
								<p>
									<img src="../assets/img/user/<?=$d['foto']; ?>" class="img-fluid rounded-circle kotak" style="height: 65px; width: 65px;">
								</p>
								<label>Foto</label>
								<input type="file" name="foto">
							</div>

							

							<div class="form-group">
								<button name="editDosen" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
								<a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
							</div>


						</form>
			
					
</div>
</div>
</div>
</div>
</div>
