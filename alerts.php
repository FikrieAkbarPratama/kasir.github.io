<?php 
session_start();

$alert = isset($_SESSION['alert']) ? $_SESSION['alert'] : null;

?>

<?php if ($alert == 'success_add') : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil menambah!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif ($alert == 'failure_add') : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal menambah!</strong> mohon memasukkan nilai yang valid.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif ($alert == 'failure_pay') : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Uang anda kurang Rp. <?= checkNominal() ?>!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
