<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</head>
<body>
    <div class="row ">
    <div class="col-12 card p-2">
    <div class="card-body min-vh-100  align-items-center">
    <div class="card w-100 m-auto p-2">
    <table class="table  table-striped">
<thead>
<tr>
        <th scope="col">No </th>
        <th scope="col">Pemasukan </th>
        <th scope="col">Pengeluaran </th>
        <th scope="col">Aksi</th>
</tr>
</thead>
    <tbody>
    <?php $no = 0;foreach ($keuangan as $row) : $no++?>
<tr>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $no ?></td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    <?php echo $row->pemasukan ?>
                                    </td>

                                    </td>
                                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                        <?php echo $row->pengeluaran ?>
                                    </td>

                    <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        <a href="<?php echo base_url('admin/update_uang/') . $row->id ?>"
                            class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700">Ubah</a>
                        <button onclick="hapus(<?php echo $row->id ?>)"
                            class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700">Hapus</button>
                    </td>
                                </tr><?php endforeach ?>
                            </tbody>
                        </table>
                    </form>

                    </div>
                </div>
            </div>
        <br>
    </div>
</body>

</html>