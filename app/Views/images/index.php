<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <section class="jumbotron text-center bg-white">
        <div class="container">
            <h1 class="jumbotron-heading">Image Gallery</h1>
            <p class="lead text-muted">
                Collection of high quality images and pictures.
            </p>
            <p>
                <a href="<?php echo base_url('image/create'); ?>" class="btn btn-primary btn-sm my-2">
                    Upload New Image
                </a>
            </p>
        </div>
    </section>

    <section class="gallery py-5 bg-light">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">

                    <?php if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <?php if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-danger">
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php } ?>

                </div>

                <?php if (!empty($images) && is_array($images)) { ?>
                    <?php foreach ($images as $row) { ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow">
                                <img src="<?php echo base_url('uploads/' . $row['path']); ?>" class="card-img-top" style="height: 300px; width:100%; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text">
                                        <?php echo $row['caption']; ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-secondary">Like</button>
                                        </div>
                                        <small class="text-muted">
                                            <?php echo $row['created_at']; ?>
                                        </small>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted text-center">
                                    No image found
                                </h2>
                                <p class="text-center">
                                    <a href="<?php echo base_url('image/create'); ?>" class="btn btn-secondary btn-sm my-2">
                                        Ready to add some images?
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <div class="col-md-12">
                    <?= $pager->links(); ?>
                </div>
            </div>
        </div>

    </section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
    <script>
        $(document).ready(function() {
            $('.pagination li').addClass('page-item');
            $('.pagination li a').addClass('page-link');
        })
    </script>
<?= $this->endSection() ?>