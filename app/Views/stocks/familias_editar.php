<?php
// $arr = implode(',', $familias);
$this->extend('layouts/layout_stocks')
?>
<?php $this->section('conteudo1') ?>

<div class="row">
    <div class="col-6 text-right">
        <p><b>Editar Famílias</b></p>
    </div>
    <div class="col-6"></div>
</div>
<div class="cols-12 mt-3">
    <form action="<?php echo site_url('stocks/familia_editar/' . $familia['id_familia'])  ?>" method="post">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger text-center mt-2" id="error-message">
                <?php echo $error ?>
            </div>
        <?php endif; ?>
        <?php if (isset($success)) : ?>
            <div class="alert alert-success text-center mt-2" id="error-message">
                <?php echo $success ?>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label>Ancestral:</label>
            <select name="select_parent" class="form-control">
                <option value="0">Sem família</option>
                <?php foreach ($familias as $fam) : ?>
                    <option value="<?php echo $fam['id_familia'] ?>" <?php echo $fam['selected'] ?>><?php echo $fam['designacao'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="form-group">
                <label>Designação:</label>

                <input type="text" value = "<?php echo $familia['designacao']; ?>" name="text_designacao" required class="form-control">
                <input type="hidden" name="txt_id_familia" value="<?php echo $familia['id_familia'] ?>">



            </div>
        </div>
        <div class="form-group">
            <a href="<?php echo site_url('stocks/familias')  ?>" class="btn btn-secondary btn-150">Cancelar</a>
            <button class="btn btn-primary btn-150">Salvar</button>
        </div>

    </form>
</div>
<?php $this->endSection() ?>