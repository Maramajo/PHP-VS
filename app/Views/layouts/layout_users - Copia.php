<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projeto Geral - Users</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css') ?>">
</head>

<body>
<div class="navbar">
  <a href="<?php echo site_url('main')  ?>"><i class="fa fa-fw fa-home"></i> Home</a> 
  <a href="#"><i class="fa fa-fw fa-search"></i> Search</a> 
  <a href="#"><i class="fa fa-fw fa-envelope"></i> Contact</a> 
  <a href="<?php echo site_url('users')  ?>"><i class="fa fa-fw fa-user"></i> Login</a>
</div>
    <!-- <h1>users</h1> -->
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12 text-center bg-dark text-light p-3">
                <h3>Projeto Geral - Users</h3>
            </div>
        </div>
        <div class="row ">
            
            
            <div class="col-6">
            <img src="<?php echo base_url('assets/img/rafa.jpg') ?>"  
            class="img-fluid  rounded-circle" width="108" height="80" alt="Familia">
            </div>
            <div class="col-6">
             <img src="<?php echo base_url('assets/img/paris.jpg') ?>"  
             class="img-fluid float-right rounded-circle" width="108" height="80" alt="Paris" >
            </div>
        </div>
    </div>
    <div class="row  mb-5 ">
        <div class="col-12 ">
            <?php $this->renderSection('conteudo1') ?>
        </div>
    </div>





    <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/app.js') ?>"></script>
    <?php include 'footer.php';?>
    
</body>

</html>