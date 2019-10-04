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
<h2 class="text-center">Editar ID</h2>
<form action="<?php echo site_url('users/admin_edit_user/' . $user['id_user']) ?>" method="post" class="text-center">
    <p>Username: <b><?php echo $user['username']; ?></b></p>
    <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
    <input type="hidden" name="text_username" value="<?php echo $user['username'] ?>">
    <p><input type="text" name="text_name" required placeholder="Nome" size="45" value="<?php echo $user['name']; ?>"></p>
    <p><input type="email" name="text_email" required placeholder="Email" size="45" value="<?php echo $user['email']; ?>"></p>
    <div class="row">
        <div class="col-x"></div>
        <div class="col-6 form-group text-left ">
            <p><b>Profile</b></p>
            <input type="checkbox" name="check_admin" <?php echo $check_admin ?>>Admin<br>
            <input type="checkbox" name="check_moderator" <?php echo $check_moderator ?>>Moderator<br>
            <input type="checkbox" name="check_user" <?php echo $check_user ?>>User<br>
        </div>
    </div>

    <div>
        <a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-secondary">Cancelar</a>
        <button class="btn btn-primary">Atualizar</button>
    </div>
</form>


<?php $this->endSection() ?>