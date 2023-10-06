<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
</head>

<body>
    <h1>DATA PEMBAYARAN</h1>
    <table style="font-size: 14px; font-weight: bold;">
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $this->session->userdata('email') ?></td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><?php echo $this->session->userdata('username') ?></td>
        </tr>
    </table>
    <hr>
    <br>
    <table border="1">
        <tr style="font-weight: bold;">
            <td>No</td>
            <td>Jenis Pembayaran</td>
            <td>Total Pembayaran</td>
        </tr>
        <?php $no= 1; 
		foreach ($data_pembayaran as $key) { ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $key->jenis_pembayaran ?></td>
            <td><?php echo $key->total_pembayaran ?></td>
        </tr>
        <?php } ?>
    </table>


</body>

</html>