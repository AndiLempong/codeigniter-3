<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
</head>
<body class="card p-5 align-items-center">
<aside id="separator-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
               </svg>
               <span class="ml-3">SISTEM INFORMASI</span>
               <hr>
            </a>
         </li>
         <li>
         <a href="<?php echo base_url('keuangan/dashboard') ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <ul>
               <li>Dashboard</li>
               </ul>
            </a>
         </li>
         <li>
            <a href="<?php echo base_url('keuangan/pembayaran') ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               Pembayaran
            </a>
         </li>
         <li>
            <a href=""class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               Log out
            </a>
            
         </li>
         </ul>
      </div>
</aside>
      </div>
        </div>

  <div class="row">
        <div class="col-16">
                <div class="card m-auto p-15">
                    <table class="table table-striped">
                        <thead>
                          <div class="d-flex p-3">
                            <a href="<?php echo base_url('keuangan/tambah_pembayaran') ?>">
                              <button type="submit" class="btn btn-outline-danger" name="submit">Tambah</button></a>
                            <a href="<?php echo base_url('keuangan/export') ?>"> 
                              <button type="submit" class="btn btn-outline-success" name="submit">Export</button></a>
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Modal</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        
      </div>
      <div class="modal-body">
        <form class="mt-5" method="post" enctype="multipart/form-data" 
        action="<?= base_url('keuangan/import') ?>">
      <input type="file" name="file"/>
      <button type="submit" class="btn btn-outline-success" name="submit">Tambah</button>
      <button type="button" class="btn btn-outline-warning~" data-bs-dismiss="modal">Close</button>
      <div class="d-grid gap-2 d-md-block"></div>
      </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
    </div>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Siswa</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jenis Pembayaran</th>
                                <th scope="col">Total Pembayaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach ($pembayaran as $row) : $no++ ?>
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $no ?></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo tampil_full_siswa_byid($row->id_siswa )?></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo tampil_full_kelas_byid($row->id_kelas) ?></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->jenis_pembayaran ?></td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->total_pembayaran ?></td> 

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <a href="<?php echo base_url('keuangan/ubah_pembayaran/') . $row->id ?>" class="btn btn-info">Ubah</a>
                                <button onclick="hapus(<?php echo $row->id ?>)" class="btn btn-light">
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
                window.location.href = "<?php echo base_url('keuangan/hapus_pembayaran/') ?>" + id;
                }
            }
                </script>
            </div>
        </div>
    </div>
</body>
</html>
</body>
</html>
