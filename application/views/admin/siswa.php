<?php include'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>

<body class="min-vh-100 d-flex align-items-center">
   
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
         <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">SISTEM INFORMASI</span>
</a>
      <ul class="space-y-2 font-medium">
         <li>
            <a href="/codeigniter-3/admin/index" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="ml-3">Siswa</span>
            </a>
         </li>
         <li>

            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ml-3 whitespace-nowrap">Keuangan</span>
            </a>
         </li>

         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ml-3 whitespace-nowrap">Account</span>
            </a>
         </li>
      </ul>
   </div>
</aside>
   <div class="card w-70 m-auto p-3">
      <table class="table table-striped">
         <div class="d-flex p-3">
            <a href="<?php echo base_url('admin/tambah_siswa') ?>" class="btn btn-info">
            Tambah
         </a>
            <a href="<?php echo base_url('admin/export') ?>" class="btn btn-primary">
            Export
         </a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
   Import
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Import</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="mt-5" method="post" enctype="multipart/form-data" 
        action="<?= base_url('admin/import') ?>">
      <input type="file" name="file"/>
      <button type="submit" class="btn btn-outline-success">Tambah</button>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

   <thead>
      <th scope="col">Siswa</th>
      <th scope="col">Nama Siswa</th>
      <th scope="col">Foto Siswa</th>
      <th scope="col">NISN</th>
      <th scope="col">Gender</th>
      <th scope="col">Kelas</th>
      <th class="text-center">Aksi</th>
   </tr>
   </thead>

   <tbody class="table-group-divider">
   <?php $no=0; foreach($siswa as $row): $no++ ?>
   <tr>
      <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo$no ?></td>
         <td class="whitespace-nowrap px-4 py-2 text-gray-700">
            <?php echo $row->nama_siswa ?>
         </td>
         <td class="whitespace-nowrap px-4 py-2 text-gray-700">
         <img src="<?php echo base_url('images/siswa/'.$row->foto) ?>" width="50">
         </td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->nisn ?></td>
         <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row->gender ?>
         </td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
               <?php echo tampil_full_kelas_byid($row->id_kelas) ?>
         </td>
               <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                  <a href="<?php echo base_url('admin/ubah_siswa/').$row->id_siswa?>" class="btn btn-success">Ubah</a>
            <button onclick="hapus(<?php echo $row->id_siswa?>)" class="btn btn-warning">Hapus</button>
         
         </td>
      </tr><?php endforeach ?>
   </table>

</div>
   <script>
         function hapus(id) {
            var yes = confirm('Benarkah Demikian?');
            if (yes == true) {
               window.location.href = "<?php echo base_url('admin/hapus_siswa/')?>" + id;
            }
         }
   </script>
</tbody>
</html>
