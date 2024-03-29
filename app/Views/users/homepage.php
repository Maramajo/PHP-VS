<?php
$this->extend('layouts/layout_users');
$session = session();
?>
<?php $this->section('conteudo1') ?>


<div class=" text-center ">Olá, <b><?php echo $session->name ?></b> </div>
<div class=" text-center ">O seu perfil é de: <?php echo $session->profile ?></div>
<div>
        <?php if (isset($admin)): ?>
        <h4 class="text-center bg-info text-white     ">O administrador está online</h4>
        <?php endif; ?>
</div>

<div class="row align-content-around ">
    <div class="col-4 text-center "><a href="<?php echo site_url('users/op1') ?>" 
         class="btn btn-primary">Operação 1</a></div>
    <div class="col-4 text-center"><a href="<?php echo site_url('users/op2') ?>" 
         class="btn btn-primary">Operação 2</a></div>
    <?php if (isset($admin)): ?>
    <div class="col-4 text-center"><a href="<?php echo site_url('users/admin_users') ?>" 
         class="btn btn-primary">Gerir contas</a></div>
    <?php endif; ?>
</div>
<!-- <div>

<a href="<?php echo site_url('users/logout') ?>"><i class="fa fa-window-close" aria-hidden="true"></i></a>
</div> -->

<?php $this->endSection() ?>