<?php
$this->extend('layouts/layout_users');
$s = session();
//profile
$str = strtolower($user['profile']);
$profile = explode(',', $str);
$check_admin = '';
$check_moderator = '';
$check_user = '';
if (in_array('admin', $profile)) {
    $check_admin = "checked";
}
if (in_array('moderator', $profile)) {
    $check_moderator = "checked";
}
if (in_array('user', $profile)) {
    $check_user = "checked";
}


?>
<?php $this->section('conteudo1') ?>

<?php if (isset($error)) : ?>
    <div class="alert alert-danger text-center mt-2" id="error-message">
        <?php echo $error ?>
    </div>
<?php endif; ?>
<form action="<?php echo site_url('users/admin_delete_user/' . $user['id_user']) ?>" method="post" class="  bg-light">
    <div class="row">
        <div class="col-y"></div>
        <div class="col-6 ">
            <h2>Deletar ID</h2>
            <p>Username: <b><?php echo $user['username']; ?></b></p>
            <p>Nome : <b><?php echo $user['name']; ?></b></p>
            <p>Email : <b><?php echo $user['email']; ?></b></p>
            <p><b>Profile</b></p>
            <p>Profile: <b><?php echo $user['profile']; ?></b></p>
            <a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-secondary">Cancelar</a>
        <button class="btn btn-primary">Deveja remover mesmo?</button>
        </div>
    </div>
    <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
    <input type="hidden" name="text_username" value="<?php echo $user['username'] ?>">
    <input type="hidden" name="text_name" placeholder="Nome" size="45" value="<?php echo $user['name']; ?>">
    <input type="hidden" name="text_email" placeholder="Email" size="45" value="<?php echo $user['email']; ?>">

    <input type="hidden" name="check_admin" <?php echo $check_admin ?>>
    <input type="hidden" name="check_moderator" <?php echo $check_moderator ?>>
    <input type="hidden" name="check_user" <?php echo $check_user ?>>
   
</form>


<?php $this->endSection() ?>