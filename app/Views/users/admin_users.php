<?php
$this->extend('layouts/layout_users');
$s = session();

?>
<?php $this->section('conteudo1') ?>
<div class="row">
    <div class="col-6 mb-1">
        <a href="<?php echo site_url('users/admin_new_user') ?>" class="btn btn-primary">Novo Usuário...</a>
    </div>
    <div class="col-6 text-right ">
        <a href="<?php echo site_url('users') ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>

    </div>
</div>
<div>
    <table class="table table-striped">
        <thead class="thead-dark">
            <th></th>
            <th>Usuário</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Último login</th>
            <th>Profile</th>
            <th>Ativo</th>
            <th>Eliminado</th>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <!--edita e elimina -->
                    <?php if ($s->id_user == $user['id_user']) : ?>
                        <td>
                            <spam class="btn btn-secondary btn-sm"><i class="fa fa-pencil"></i></spam>
                            <spam class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></spam>
                        </td>
                    <?php else : ?>
                        <td>
                            <a href="<?php echo site_url('users/admin_edit_user/'.$user['id_user'])?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                            
                            <?php if ($user['deleted'] == 0) : ?>
                                <a href="<?php echo site_url('users/admin_delete_user/'.$user['id_user'])?>"
                                 class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                             <?php else : ?>   
                                <a href="<?php echo site_url('users/admin_recover_user/'.$user['id_user'])?>"
                                class="btn btn-danger btn-sm"><i class="fa fa-recycle"></i></a>

                                <?php endif; ?>
                        </td>
                    <?php endif; ?>
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['last_login'] ?></td>
                    <!--manuseia tipo de usuário -->

                    <?php if (preg_match("/admin/", $user['profile'])) : ?>
                        <td class="text-center"><i class="fa fa-user" title=<?php echo $user['profile'] ?>></i></td>
                    <?php else : ?>
                        <td class="text-center"><i class="fa fa-user-o" title=<?php echo $user['profile'] ?>></i></td>

                    <?php endif; ?>
                    <!--manuseia ativo/inativo -->

                    <?php if ($user['active'] == 1) : ?>
                        <td class="text-center"><i class="fa fa-check text-success" title="Ativo"></i></td>
                    <?php else : ?>
                        <td class="text-center"><i class="fa fa-times text-danger" title="Inativo"></i></td>

                    <?php endif; ?>
                    <!-- manuseia de o usuário está deletado ou não -->
                    <?php if ($user['deleted'] != 0) : ?>
                        <td class="text-center"><i class="fa fa-check text-success" title="Deletado"></i></td>
                    <?php else : ?>
                        <td class="text-center"><i class="fa fa-times text-danger" title="Não deletado"></i></td>

                    <?php endif; ?>



                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div>Total:<strong> <?php echo count($users) ?></strong></div>
<?php $this->endSection() ?>