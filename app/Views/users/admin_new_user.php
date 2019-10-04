<?php
$this->extend('layouts/layout_users');
$s = session();

?>
<?php $this->section('conteudo1') ?>

<?php if (isset($error)) : ?>
    <div class="alert alert-danger text-center mt-2" id="error-message">
        <?php echo $error ?>
    </div>
<?php endif; ?>
<h2 class="text-center">Adicionar novo ID</h2>
<form action="<?php echo site_url('users/admin_new_user') ?>" method="post" class="text-center">
    <p><input type="text" name="text_username" required placeholder="Nome do usuário"></p>
    <p><input type="text" name="text_password" required placeholder="Senha"></p>
    <p><input type="text" name="text_password_repetir" required placeholder="Repetir a senha"></p>
    <div class="text-center mb-2">
    <button type="button" id="btn_senha" class="btn btn-primary btn-sm">Gerar senha</button>
    <button type="button" id="btn_limpar" class="btn btn-secondary btn-sm">Limpar</button>
    </div>

    <p><input type="text" name="text_name" required placeholder="Nome"></p>
    <p><input type="email" name="text_email" required placeholder="Email"></p>
    <p><b>Profile</b></p>
    <input type="checkbox" name="check_admin">Admin<br>
    <input type="checkbox" name="check_moderator">Moderator<br>
    <input type="checkbox" name="check_user" checked>User<br>

    <div>
        <a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-secondary">Cancelar</a>
        <button class="btn btn-primary">Adicionar</button>
    </div>
</form>


<?php $this->endSection() ?>