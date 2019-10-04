<?php $s = session(); ?>
<?php $t = $_SERVER['PHP_SELF']; ?>
<div class="text-right">
    <div class="navbar">
        <a id="home" href="<?php echo site_url('main')  ?>"><i class="fa fa-fw fa-home"></i> Home</a>
        <a href="#"><i class="fa fa-fw fa-search"></i> Search</a>
        <a id="cont" href="<?php echo site_url('main/contato')  ?>"><i class="fa fa-fw fa-envelope"></i> Contact</a>
        <div id="inout">
            <?php if ($s->has('id_user')) : ?>
                <a href="<?php echo site_url('users/logout') ?>"><i class="fa fa-fw fa-window-close text-danger"></i>
                    <strong><?php echo $s->name ?></strong></a>
            <?php else : ?>
                <a href="<?php echo site_url('users')  ?>"><i class="fa fa-fw fa-user text-success"></i> Login</a>
            <?php endif; ?>

        </div>

    </div>
</div>
<!-- <h1>users</h1> -->
<div class="container-fluid ">
    <div class="row">
        <div class="col-2">
        <a href="http://www.php.net" target="_blank"><img src="<?php echo base_url('assets/img/apache.png') ?>" 
            class="img-fluid  mt-2" width="200" height="100" alt="php"></a>
        </div>
        <div class="col-8 rounded-circle text-center bg-warning text-info p-3">
            <h3>Stocks</h3>
        </div>
        <div class="col-2">
        <a href="https://codeigniter.com" target="_blank"><img src="<?php echo base_url('assets/img/ci.png') ?>" 
            class="img-fluid float-right" width="150" height="50" alt="codei"></a>
        </div>
        
    </div>

</div>