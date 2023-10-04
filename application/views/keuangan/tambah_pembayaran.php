<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Daftar</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'>
</head>

<body class="min-vh-100 d-flex align-items-center">
    <div class="card w-50 m-auto p-3">
        <h3 class="text-center">Add Payment</h3>
        <br>
        <form action="<?php echo base_url('keuangan/aksi_tambah_pembayaran') ?>" method="post" class="row">
            <div class="mb-3 col-6">
                <label for="siswa" class="form-label">Siswa</label>
                <select name="id_siswa" class="form-select">
                    <option selected>Pilih Siswa</option>
                    <?php foreach ($siswa as $row) : ?>
                    <option value="<?php echo $row->id_siswa ?>">
                        <?php echo $row->nama_siswa ?>
                    </option>
                    <?php endforeach ?>
                </select>
                <br>
            </div>

            <div class="mb-3 col-6">
            <label for="kelas" class="form-label">Kelas</label>
            <select name="id_kelas" class="form-select">
            <option selected>Pilih Kelas</option>
            <?php foreach ($kelas as $row) : ?>
                <option value="<?php echo $row->id ?>">
                <?php echo tampil_full_kelas_byid($row->id) ?>
            </option>
            <?php endforeach ?>
            </select>
            <br>
            </div>
            

            <div class="mb-3 col-6">
                <label for="jenis_pembayaran" class="form-label"><b>Jenis Pembayaran</b></label>

                <select name="jenis_pembayaran" class="form-select">
                    <option selected >Pilih Jenis Pembayaran</option>
                    <option value="Pembayaran SPP">Pembayaran SPP</option>
                    <option value="Pembayaran Uang Gedung">Pembayaran Uang Gedung</option>
                    <option value="Pembayaran Seragam">Pembayaran Seragam</option>
                </select>
            </div>
            <div class="mb-3 col-6 ">
            <label for="total_pembayaran" class="form-label"><b>Total Pembayaran</b></label>
            <input type="text" class="form-control" id="total_pembayaran" placeholder="Total Pembayaran" name="total_pembayaran">
        </div>
    <button type="submit" class="btn btn-sm btn-secondary">Tambah</button>
        </form>
    </div>
</body>

</html>