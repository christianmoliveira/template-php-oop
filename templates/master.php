<?php $this->insert('includes/_partials/_header') ?>

<div class="container mt-5">
    <?php \App\Support\Flash::flash(); ?>
</div>

<div class="container">
    <?= $this->section('content') ?>
</div>

<?php $this->insert('includes/_partials/_scripts') ?>
<?php $this->insert('includes/_partials/_footer') ?>
