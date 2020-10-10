<?php
include 'connection.php';

$siswa=$db->query("select * from siswa");
$data_siswa=$siswa->fetchAll();
// echo $data_siswa;

// foreach ($data_siswa as $key) {
//     // echo $key['nama']."  ".$key['sekolah']." ".$key['<br>";
// }

if(isset($_POST['search']))
{


    $filter=$db->quote($_POST['search']);
    

    $name=$_POST['search'];

    $search=$db->prepare("select * from siswa where nama_siswa=? or sekolah=? or motivasi=?");

    $search->bindValue(1,$name,PDO::PARAM_STR);
    $search->bindValue(2,$name,pdo::PARAM_STR);
    $search->bindValue(3,$name,pdo::PARAM_STR);

    $search->execute();

    $tampil_data=$search->fetchAll(); 

    $row = $search->rowCount();
    

}else{
    $data = $db->query("select * from siswa");

    $tampil_data = $data->fetchAll();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nama Siswa</title>
    <!-- <link rel="shortcut icon" href="gaming.png" type="image/x-icon"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/solid.css" integrity="sha384-yo370P8tRI3EbMVcDU+ziwsS/s62yNv3tgdMqDSsRSILohhnOrDNl142Df8wuHA+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/brands.css" integrity="sha384-/feuykTegPRR7MxelAQ+2VUMibQwKyO6okSsWiblZAJhUSTF9QAVR0QLk6YwNURa" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/fontawesome.css" integrity="sha384-ijEtygNrZDKunAWYDdV3wAZWvTHSrGhdUfImfngIba35nhQ03lSNgfTJAKaGFjk2" crossorigin="anonymous">
</head>
  
  <body>
    <h3 class="text-center">Daftar Nama Siswa</h3>
  <div class="container">
        <div class="row">
            <div class="col">

            <!-- Allert Massage -->
            <?php if(isset($row)):?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p class="lead "><?php echo $row;?> Data Ditemukan !</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            <form class="form-inline mt-4" action="index.php" method="POST">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="Nama atau Sekolah">
                    <button type="submit" class="btn btn-primary" value="Cari">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
      <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">Nama Siswa</th>
              <th scope="col">Sekolah</th>
              <th scope="col">Motivasi</th>
              <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($data_siswa as $key):?>
              <tr>
                  <td><?php echo $key['nama_siswa'];?></td>
                  <td><?php echo $key['sekolah'];?></td>
                  <td><?php echo $key['motivasi'];?></td>
                  <td><a class="btn btn-danger" data-toggle="modal" data-target="#siswa" href="delete.php?id_siswa=<?php echo $key['id_siswa']; ?>"><i class="fas fa-user-times"></i></a> | <a class="btn btn-warning" href="edit.php?id_siswa=<?php echo $key['id_siswa']; ?>"><i class="fas fa-user-edit"></i></a></td>
              </tr>
  <?php endforeach; ?>
      </tbody>
  </table>
  

<!-- Modal -->
<div class="modal fade" id="siswa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Attention</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary"><a class="text-light text-decoration-none" href="delete.php?id_siswa=<?php echo $key['id_siswa']; ?>">Yes</a></button>
      </div>
    </div>
  </div>
</div>

  <!-- from input daftar -->

  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
<i class="fas fa-user-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Masukan Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <div class="container">
      <div class="row">
          <div class="col">
          <form action="input.php" method="POST">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Siswa</label>
                      <input type="text" name="nama_siswa" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Sekolah</label>
                      <input type="text" name="sekolah" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Motivasi</label>
                      <input type="text" name="motivasi" class="form-control">
                  </div>

                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button>
              </form>
          </div>
      </div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>