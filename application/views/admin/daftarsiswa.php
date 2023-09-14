
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>


<body class="min-vh-100 d-flex align-items-center">
    <div class="card w-50 m-auto p-3">
        <h3 class="text-center">DATA</h3>
        <table class="table table-striped">
  <thead>
      <th scope="col">Nama</th>
      <th scope="col">NISN</th>
      <th scope="col">Gender</th>
      <th class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <td>
      </td>
    <td>324425657
      </td>
    <td>Laki-Laki
      </td>
    <td>
      <a href="detail.php?id=1" class="btn btn-sm btn-primary">Detail</a>
      <button onclick="hapus(1)"class="btn btn-sm btn-danger">Delete</button>
      </td>
  </tr>
  <td class="text-center">
      </table>
    </div>
    <script>
        function hapus(id) {
            var yes = confirm('Benarkah Demikian?');
            if (yes == true) {
                window.location.href = "delete.php?id=" + id;
            }
        }
    </script>
</body>
</html>