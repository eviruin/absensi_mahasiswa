<div class="panel-header" data-background-color="bg2">
    <div class="page-inner py-5" data-background-color="bg2">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-blue pb-2 fw-bold">Administrator</h2>
                <h5 class="text-blue op-7 mb-2">Selamat Datang, <b
                        class="text-warning"><?=$data['nama_lengkap']; ?></b> | Aplikasi Absensi Mahasiswa</h5>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">
                        <center>
                            <img src="../assets/img/logo1.png" width="100">
                            <br>
                            <b>UNIVERSITAS PAMULANG</b>
                        </center>
                    </div>
                    <div class="card-category">
                        <center>
                            Jl. Raya Puspitek, Buaran, Kec. Pamulang, Kota Tangerang Selatan, Banten 15310
                        </center>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <div class="col-sm-6 col-md-6">
                            <div class="card card-stats card-secondary card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-users"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Mahasiswa</p>
                                                <h4 class="card-title"><?php echo $jumlahMahasiswa; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="card card-stats card-default card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-user-tie"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Dosen</p>
                                                <h4 class="card-title"><?php echo $jumlahDosen; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>






                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

</div>

</div>