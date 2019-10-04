<!DOCTYPE html>
<html lang="en">
<?php $s = session(); ?>
<?php $t = $_SERVER['PHP_SELF']; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stocks</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css') ?>">

</head>

<body onload="(teste('stocks'))">
    <?php include 'heades.php'; ?>
    <div class="row  mb-5 ">
        <div class="sidenav col-2">
            <div class="text-left mb-2 mt-2">
                <a href="<?php echo site_url('stocks/familias')  ?>">Familias</a> <br>
                <a href="<?php echo site_url('stocks/movimentos')  ?>">Movimentos</a> <br>
                <a href="<?php echo site_url('stocks/produtos')  ?>">Produtos</a> <br>
                <a href="<?php echo site_url('stocks/taxas')  ?>">Taxas</a> <br>
            </div>

        </div>
        <div class="main col-10">
            <?php $this->renderSection('conteudo1') ?>
        </div>
    </div>
        <?php include 'footer.php'; ?>

    <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/app.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/teste.js') ?>"></script>


</body>

</html>