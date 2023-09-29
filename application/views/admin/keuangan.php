<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</head>
<body>

<!-- tab -->
    <div class="row">
        <div class="col-12 card p-2">
            <div class="card-body min-vh-100 align-items-center">
                <div class="card w-100 m-auto p-2">
                    <table class="table table-striped">
                        <thead>
                            <a href="<?php echo base_url('admin/tambah_keuangan') ?>">
                            <button type="submit" class="btn btn-info" name="submit">Tambah</button></a>    
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pemasukan</th>
                                <th scope="col">Pengeluaran</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach ($keuangan as $row) : $no++ ?>
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $no ?></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->pemasukan ?></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->pengeluaran ?></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->tanggal ?></td>  

                            <td>
                                <a href="<?php echo base_url('admin/ubah_keuangan/') . $row->id ?>" class="btn btn-primary">Ubah</a>
                                <button onclick="hapus(<?php echo $row->id ?>)" class="btn btn-danger">
                                Hapus
                                </button>
                            </td>
                            </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    function hapus(id) {
                var yes = confirm('Yakin Di Hapus?');
                if (yes == true) {
                window.location.href = "<?php echo base_url('admin/hapus_keuangan/') ?>" + id;
                }
            }
                </script>
            </div>
        </div>
    </div>
</body>

</html>