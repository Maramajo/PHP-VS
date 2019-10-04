<?php 
$s = session();
?>
<div class="text-right">
<?php if ($s->has('id_user')):?>
<div>
    <i class="fa fa-user mr-2"></i>
    <strong class="mr-2">
        <?php echo $s->name ?>
    </strong>
    <a href="<?php echo site_url('users/logout') ?>"><i class="fa fa-window-close" aria-hidden="true"></i></a>
</div>

<?php else:?>
<?php echo 'Ninguém logado' ?>
<!-- <spam class="text-muted">Ninguém logado</spam>  -->
<?php endif;?>


</div>