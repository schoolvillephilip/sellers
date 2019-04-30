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
                            <img src="<?= base_url('assets/img/onitshamarket-logo.png'); ?>"
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
                    <h1 class="h3 text-2x">Create An Account</h1>
                    <p class="text-semibold">If you already have an account with onitshamarket.com please <a href="<?= base_url('login'); ?>">login</a> to apply as a seller.</p>
                    <?php $this->load->view('msg_view'); ?>
                </div>
                <?= form_open('register/create'); ?>
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First name" name="first_name" autofocus>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last name" name="last_name">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address" name="email">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone number" name="phone">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                        </div>
                    </div>
                    <div class="col-sm-10 col-sm-offset-1">
                        <div id="captcha" class="pad-all">
                            <?= $this->recaptcha->getWidget(); ?>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Create</button>
                </div>
                <?= form_close(); ?>

                <div class="pad-all">
                    <a href="<?= base_url('login'); ?>" class="btn-link mar-lft">Login</a>&nbsp;&nbsp;-
                    <a href="<?= base_url('reset'); ?>" class="btn-link mar-rgt">Forgot password ?</a>-
                    <a href="<?= base_url('pages/faq/'); ?>" class="btn-link mar-rgt">Read Sellers Frequently Asked Questions</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach ($scripts as $tag) : ?>
    <script src="<?= base_url('assets/') . $tag; ?>"></script>
<?php endforeach; ?>
<?= $this->recaptcha->getScriptTag(); ?>
</body>
</html>
