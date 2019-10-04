<?php
$this->extend('layouts/layout_contato')
?>
<?php $this->section('conteudo') ?>
<div class="row">
   <div class="col-y ">
   </div>
   <div class="col-6">
      <p>Telefone: <strong>+55-11-999999999</strong></p>
      <p>Email : <strong>meuemail@hotmail.com</strong></p> <br>
   </div>
</div>
<div class="row">
   <div class="col-y "> </div>
   <div class=" col-6">
      <div class="row">
         <!-- <div class="col-1"></div> -->
         <div class="col-12 ml-5">
            <a href="<?php echo site_url('main') ?>" class=" btn btn-primary btn-150">Voltar </a>
         </div>
      </div>
   </div>
</div>
<?php $this->endSection() ?>