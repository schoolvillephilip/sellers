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
                        <a href="<?= base_url(); ?>">
                            <img src="<?= base_url('assets/landing/img/onitshamarket-logo.png'); ?>"
                                 alt="<?= lang('app_name'); ?>"
                                 class="brand-title img-responsive">
                        </a>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h1 class="h3 text-2x">Reset Password</h1>
                    <p class="text-semibold">Please provide your email below</p>
                    <?php $this->load->view('msg_view'); ?>
                </div>
                <?= form_open('reset/process'); ?>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Please enter your seller's email" name="email" autofocus>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Reset Password</button>
                <?= form_close(); ?>
            </div>
            <div class="pad-all">
                <a href="<?= base_url('login'); ?>" class="btn-link mar-lft">Already have an account? </a> |
                <a href="<?= base_url('register'); ?>" class="btn-link mar-rgt">Become a Seller.</a>
            </div>
        </div>
    </div>
</div>
<?php foreach ($scripts as $tag) : ?>
    <script src="<?= base_url('assets/') . $tag; ?>"></script>
<?php endforeach; ?>
</body>
</html>
