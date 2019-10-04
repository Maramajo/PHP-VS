<!DOCTYPE html>
<html lang="en">
<?php $s = session(); ?>
<?php $t = $_SERVER['PHP_SELF'];?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projeto Geral - Main</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css')?>">
</head>
<body onload="(teste('main'))">
<?php include 'header.php';?>
<div class="row  mb-5">
    <div class="col-12">
    <?php $this->renderSection('conteudo')?>    
    </div>
</div>
 
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js')?>"></script> 
<script src="<?php echo base_url('assets/js/popper.min.js')?>"></script> 
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script> 
<script src="<?php echo base_url('assets/js/teste.js')?>"></script> 
<?php include 'footer.php';?>
</body>
</html>