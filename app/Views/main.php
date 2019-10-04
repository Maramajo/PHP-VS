<?php
$this->extend('layouts/layout_main')
?>
<?php $this->section('conteudo') ?>
<!-- <div class="row mt-5 mb-5"></div> -->
<div class="row mt-5 mb-5">
   <div class="col-z"></div>
   <div class="col-6 mb-5 mt-5">
      <a href="<?php echo site_url('users') ?>" class=" btn btn-primary btn-150 ">Users </a>
      <a href="<?php echo site_url('cripto') ?>" class=" btn btn-primary btn-150 ">Criptografia </a>
      <a href="<?php echo site_url('stocks') ?>" class=" btn btn-primary btn-150 ">Stocks </a>


   </div>
</div>
<?php $this->endSection() ?>