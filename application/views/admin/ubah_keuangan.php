<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Daftar</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'>
</head>

<body class='min-vh-100 d-flex align-items-center'>
    <div class='card w-50 m-auto p-3'>
        <h3 class='text-center'>Document</h3>
        <?php foreach ($keuangan as $row) : ?>
            <form action="<?php echo base_url('admin/aksi_ubah_keuangan') ?>" method="post" enctype="multipart/from-data">
                <input type="hidden" name="id" value="<?php echo $row->id ?>">
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="pemasukan" class="form-label">Pemasukan</label>
                        <input type="number" class="form-control" id="pemasukan" name="pemasukan" value="<?php echo $row->pemasukan ?>">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="pengeluaran" class="form-label">Pengeluaran</label>
                        <input type="number" class="form-control" id="pengeluaran" name="pengeluaran" value="<?php echo $row->pengeluaran ?>">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $row->tanggal ?>">
                    </div>

                </div>
                <button style="margin-left: 35%; margin-top: 10px;" type="submit" class="btn btn-primary w-25" name="submit">Ubah</button>
            </form>
        <?php endforeach ?>
    </div>
</body>

</html>