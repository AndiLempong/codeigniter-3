<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body class="p-5 align-items-center">
    <div class="container-fluid">
        <div class="row">
                    <a href="<?php echo base_url('keuangan/pembayaran') ?>">
                    </a>
                </div>
            </div>
                    </div>
                </div>

                <div class="card w-50 m-auto p-5 shadow">
                    <div class="card-body">
                        <?php foreach ($pembayaran as $data_pembayaran): ?>
                        <form action="<?php echo base_url('keuangan/aksi_ubah_pembayaran') ?>"
                            enctype="multipart/form-data" method="POST">
                            <input name="id" type="hidden" value="<?php echo $data_pembayaran->id ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="siswa">Siswa</label>
                                        <select id="siswa" name="siswa" class="form-control">
                                            <option selected value="<?php $data_pembayaran->id_siswa ?>">
                                                <?php echo tampil_full_siswa_byid($data_pembayaran->id_siswa) ?>
                                            </option>
                                            <?php foreach ($siswa as $row): ?>
                                            <option value="<?php echo $row->id_siswa ?>">
                                                <?php echo $row->nama_siswa ?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pembayaran">Jenis Pembayaran</label>
                                        <select class="form-control" id="pembayaran" name="pembayaran">
                                            <option selected value="<?php echo $data_pembayaran->jenis_pembayaran ?>">
                                                <?php echo $data_pembayaran->jenis_pembayaran ?>
                                            </option>
                                            <option value="Pembayaran SPP">Pembayaran SPP</option>
                                            <option value="Pembayaran Uang Gedung">Pembayaran Uang Gedung</option>
                                            <option value="Pembayaran Uang Seragam">Pembayaran Uang Seragam</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total">Total Pembayaran</label>
                                        <input type="text" class="form-control" id="total" name="total"
                                            placeholder="Masukkan Total"
                                            value="<?php echo $data_pembayaran->total_pembayaran ?>">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>