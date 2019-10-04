<?php
$this->extend('layouts/layout_stocks')
?>
<?php $this->section('conteudo1') ?>
<div class="row">
    <div class="col-6 text-right">
        <p><b>Famílias</b></p>
    </div>
    <div class="col-6"></div>
</div>
<div class="row">
    <?php if (isset($success)) : ?>
        <div class="alert alert-success text-center mt-2" id="error-message">
            <?php echo $success ?>
        </div>
    <?php endif; ?>

    <div class=" col-12 ml-5 text-center">
        <div>
            <div class="row">
                <div class="col-6">
                    <h5 class="text-left">Famílias de produtos registrados</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="<?php echo site_url('stocks/familia_adicionar')  ?>" class="btn btn-primary">Adicionar Familia</a> <br>

                </div>
            </div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>Id</th>
                    <th>Família</th>
                    <th>Ancestral</th>
                    <th class="text-center">Ações</th>




                </thead>
                <tbody>
                    <?php foreach ($familias as $familia) : ?>
                        <tr>
                            <td><?php echo $familia['id_familia'] ?></td>
                            <td class="text-left"><?php echo $familia['designacao'] ?></td>
                            <td><?php echo $familia['ancestral'] != '' ? $familia['ancestral'] : '-' ?></td>
                            <td class="text-center">
                                <a href="<?php echo site_url('stocks/familia_editar/' . $familia['id_familia']) ?>" class="btn btn-primary btn-sm btn-100">
                                    <i class="fa fa-pencil mr-2"></i>Editar
                                </a>
                                <a href="<?php echo site_url('stocks/familia_eliminar/' . $familia['id_familia']) ?>" class="btn btn-danger btn-sm btn-100">
                                    <i class="fa fa-trash mr-2"></i>Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?> </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endSection() ?>