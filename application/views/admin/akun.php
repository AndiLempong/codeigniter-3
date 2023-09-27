<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Document</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 

</head> 
<body class="min-vh-100 d-flex align-items-center"> 
    <?php foreach($user as $users) : ?>
    <div class="card w-50 m-auto p-3"> 
        <h3 class="text-center"><b>Akun</b></h3> 
        <hr>
        <form action= "<?php echo base_url('admin/aksi_ubah_akun') ?>" enctype="multipart/form-data" method="post" class="row">
            <div class="mb-3 col-6"> 
                <label for="email" class="form-label"><b>Email</b></label> 
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $users->email?>"> 
            </div> 

            <div class="mb-3 col-6"> 
                <label for="username" class="form-label"><b>Username</b></label> 
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $users->username?>"> 
            </div>

            <div class="mb-3 col-6"> 
                <label for="password_baru" class="form-label"><b>Password Baru</b></label> 
                <input type="text" class="form-control" id="password_baru" name="password_baru"> 
            </div>

                <div class="mb-3 col-6"> 
                <label for="password_baru" class="form-label"><b>Konfirmasi Password</b></label> 
                <input type="text" class="form-control" id="password_baru" name="password_baru"> 
            <br>
                <button class="btn btn-primary" type="submit">Confirm</button>              
            </div> 
        </form> 
    </div> 
    <?php endforeach ?>
</body> 
</html>