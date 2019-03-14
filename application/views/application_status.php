<?php $this->load->view('templates/meta_tags.php'); ?>
</head>
<body>
<div id="container" class="cls-container" style="background-color: #fff !important;">
    <div id="bg-overlay"></div>
    <div class="cls-content ">
        <div class="cls-content-lg panel panel-colorful "
             style="border: 1px solid #26a69a !important;padding-top:10px;">
            <div class="panel-title" style="background-color: transparent !important;">
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url(); ?>" title="<?= lang('app_name'); ?>"><img
                                    src="<?= base_url('assets/onitshamarket-logo.png'); ?>"
                                    alt="<?= lang('app_name'); ?>"
                                    class="brand-title img-responsive"></a>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h1 class="h3 text-2x">Application Status</h1>
                    <p class="text text-dark">
                        <strong>Hello <?= ucwords($status->first_name . ' ' . $status->last_name) ?>, your seller
                            account is on <span
                                    clas="text-text-info"><?= ($status->is_seller == 'false') ? 'Review' : ucfirst($status->is_seller); ?></span></strong>
                    </p>

                    <?php $this->load->view('msg_view'); ?>
                </div>
            </div>

            <div class="pad-all">
                <a href="<?= base_url('logout'); ?>" class="btn-link mar-rgt">Go to Homepage</a>
            </div>
        </div>
    </div>

</div>
<?php foreach ($scripts as $tag) : ?>
    <script src="<?= base_url('assets/js/') . $tag; ?>"></script>
<?php endforeach; ?>
</body>
</html>
