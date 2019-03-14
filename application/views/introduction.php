<?php $this->load->view('templates/meta_tags.php'); ?>
<style>
    li h3 {
        color: #2BA27D;
    }

    li h3:hover {
        color: #0e0e0e;
    }

    .nav-tabs > li > a {
        border-radius: 4px 4px 0 0;
    }

    .nav-tabs > li.active, .nav-tabs > li.active:focus > a {
        background: #2BA27D;
        color: #fff;
    }

    .grey_wrap {
        padding: 20px;
        margin-top: 10px;
    }

    .sub-title1 {
        color: #805b2b;
        font-size: 18px;
        font-weight: bold;
        margin: 10px;
    }

    #container{
        min-height: 0px;
    }

    .gnumbers {
        color: red;
        top: 20px;
    }
</style>
</head>
<body>
<div id="container" class="container text-center" style="background-color: #fff !important;">
    <div id="bg-overlay"></div>
    <div id="container">
        <div class="row" style="text-align: center;"><br/>
            <h2 style="color:#736455;">Reach Over 140 million Customers</h2>
            <hr style=" width: 100%;border:1px solid #2BA27D;"/>
        </div>
        <?php $this->load->view('msg_view'); ?>
        <p class="title1 title1-pos" style=" font-size: 46px; font-weight: 500; line-height: 58px;">
            START SELLING ON ONITSHAMARKET.COM TODAY</p>
        <ul class="nav nav-tabs">
            <li class="active col-xs-12 col-md-4"><a data-toggle="tab" href="#sell"><h3>Sell on Onitshamarket.com</h3>
                </a>
            </li>
            <li class="col-xs-12 col-md-4"><a data-toggle="tab" href="#support"><h3>Seller Support</h3></a></li>
            <li class="col-xs-12 col-md-4"><a href="<?= base_url('pages/faq') ?>" target="_blank"><h3>FAQS</h3></a></li>
        </ul>

        <div class="tab-content">
            <div id="sell" class="tab-pane fade in active">
                <div id="cnt1">
                    <div class="row">
                        <p class="sub-title1" style="margin-top:20px;">Grow your business with Onitshamarket.com</p>

                        <div class="col-xs-12 col-md-4 text-center">

                            <img src="<?= base_url('assets/img/soe.jpg'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">Sell to over 140 millions of customers</p>
                            <p class="glegend">Reach a wide sphere of onishamarket.com customers’ buying across Nigeria.</p>
                        </div>

                        <div class="col-xs-12 col-md-4 text-center">
                            <img src="<?= base_url('assets/img/upp.jpg'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">We want to give consistent leap to your business</p>
                            <p class="glegend">Connect with our always increasing customers’ size on our growth driven platform for your business. We also provide you with regular sales analysis and marketing insights.</p>
                        </div>

                        <div class="col-xs-12 col-md-4 text-center">
                            <img src="<?= base_url('assets/img/rel.png'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">You can count on us</p>
                            <p class="glegend">We take and carry any size of good(s), and keep a customer-centric relationship with buyers on your behalf.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="support" class="tab-pane fade text-justify">
                <div id="cnt2" style="padding-top:40px;">
                    <div class="row">
                        <div class="col-xs-12 col-md-2 text-center">
                            <img src="<?= base_url('assets/img/1_n.png'); ?>"
                                 style="width: 95px;"
                                 alt=""/>
                        </div>

                        <div class="col-xs-12 col-md-10 text-left" style="top:20px;">
                            <p class="txt3"><strong style="font-size: 14px;">List Your Products</strong> - Creating
                                good
                                content as you list your products is the first important step to getting more sales.
                                Good
                                quality images and detailed product description encourage customers to click on your
                                products and buy them.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div style="background: #f4f5f5;">
                            <div class="col-xs-12 col-md-2 text-center">
                                <img src="<?= base_url('assets/img/2_.png'); ?>"
                                     style="width: 95px;" alt=""/>
                            </div>

                            <div class="col-xs-12 col-md-10 text-left" style="top:20px;">
                                <p class="txt3"><strong style="font-size: 14px;">Grow Your Sales</strong> - There
                                    are many
                                    ways to maximize your sales. Apart from offering products at competitive prices,
                                    you can
                                    join Onitshamarket.com’s promotions to gain more exposure for your shop. Optimizing
                                    keywords
                                    in your
                                    products’ names and ensuring that you have listed them in the right product
                                    category are
                                    other ways to sell more.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-2 text-center">
                            <img src="<?= base_url('assets/img/3_n.png'); ?>"
                                 style="width: 95px;"
                                 alt=""/>
                        </div>

                        <div class="col-xs-12 col-md-10 text-left" style="top:20px;">
                            <p class="txt3"><strong style="font-size: 14px;">All About Shipping</strong> - There are
                                many
                                ways to maximize your sales. Apart from offering products at competitive prices, you
                                can
                                join Onitshamarket.com’s promotions to gain more exposure for your shop. Optimizing
                                keywords in
                                your
                                products’ names and ensuring that you have listed them in the right product category
                                are
                                other ways to sell more.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-2 text-center">
                            <img src="<?= base_url('assets/img/4_n.png'); ?>"
                                 style="width: 95px;" alt=""/>
                        </div>

                        <div class="col-xs-12 col-md-10 text-left" style="top:40px;">
                            <p class="txt3"><strong style="font-size: 14px;">Your Payments</strong> - There are
                                no costs
                                involved to list your products on Onitshamarket.com. You are not required to pay for
                                anything until
                                your items are sold.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row" style="margin:20px;">
            <p class="lead custom-text">Are You Ready To Start Selling?</p>
            <a class="btn btn-primary btn-lg" style="border-radius: 0;" href="<?= base_url('register/create'); ?>">Create An Account <i
                        class="fa fa-cart-plus"></i></a>
            <a class="btn btn-primary btn-lg" style="border-radius: 0;" href="<?= base_url('login'); ?>">Login <i
                        class="fa fa-sign-in"></i></a>
            <a class="btn btn-primary btn-lg" style="border-radius: 0;" href="<?= base_url(); ?>">Contact Seller Support
                <i
                        class="fa fa-headphones"></i></a>
        </div>
    </div>
    </main>
</div>
</div>
<?php foreach ($scripts as $tag) : ?>
    <script src="<?= base_url('assets/') . $tag; ?>"></script>
<?php endforeach; ?>
</body>
</html>
