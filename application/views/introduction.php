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
            <h2 style="color:#736455;">Reach Over 200 million Customers</h2>
            <hr style=" width: 100%;border:1px solid #2BA27D;"/>
        </div>
        <?php $this->load->view('msg_view'); ?>
        <p class="title1 title1-pos" style=" font-size: 54px; font-weight: 500; line-height: 60px;">
            SELL NOW ON ONITSHAMARKET.COM AND<br/>START MAKING MONEY</p>
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

                            <img src="<?= base_url('assets/seller/img/sell_visits.png'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">Reach 200,000,000+</p>
                            <p class="glegend">Potential Buyers</p>
                        </div>

                        <div class="col-xs-12 col-md-4 text-center">
                            <img src="<?= base_url('assets/seller/img/sell_satisfy.png'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">95% Satisfied customers</p>
                            <p class="glegend">Recommend us to friends</p>
                        </div>

                        <div class="col-xs-12 col-md-4 text-center">
                            <img src="<?= base_url('assets/seller/img/sell_rep.png'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">Marketing &amp; data analytics </p>
                            <p class="glegend">Support to grow your business</p>
                        </div>
                    </div>

                    <div class="grey_wrap">
                        <p class="sub-title1">How it works?</p>
                        <div class="row">
                            <div class="col-xs-12 col-md-5 text-right">
                                <img src="<?= base_url('assets/seller/img/TAB1-STEP1n1.png'); ?>"
                                     style="width: 150px; float: right;" alt=""/>
                            </div>
                            <div class="col-xs-12 col-md-7 text-left" style="top:20px;"><br/>
                                <p class="txt1" style="font-size: 15px; color: #2BA27D;">Step 1: Register in
                                    under 5
                                    minutes</p>
                                <p class="txt1">Fill the Registration Form.<br/>Submit the required documents –
                                    Business
                                    registration and bank account details.<br/>Read and accept our Seller
                                    Agreement.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-5 text-right">
                                <img src="<?= base_url('assets/seller/img/TAB1-STEP2n1.png'); ?>"
                                     style="width: 150px; float: right;" alt=""/>
                            </div>
                            <div class="col-xs-12 col-md-7 text-left" style="top:30px;">
                                <p class="txt1" style="font-size: 15px; color: #2BA27D;">Step 2 : Become an
                                    ecommerce
                                    expert</p>
                                <p class="txt1">Complete the dedicated training session for new sellers.<br/>Activate
                                    your
                                    Seller Center account to manage your shop on the go.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-5 text-right">
                                <img src="<?= base_url('assets/seller/img/TAB1-STEP3n1.png'); ?>"
                                     style="width: 150px; float: right;" alt=""/>
                            </div>
                            <div class="col-xs-12 col-md-7 text-left" style="top:40px;">
                                <p class="txt1" style="font-size: 15px; color: #2BA27D;">Step 3 : List your
                                    Products
                                    and start
                                    selling!</p>
                                <p class="txt1">Upload more than five products to start selling.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="support" class="tab-pane fade text-justify">
                <div id="cnt2" style="padding-top:40px;">
                    <div class="row">
                        <div class="col-xs-12 col-md-2 text-center">
                            <img src="<?= base_url('assets/seller/img/1_n.png'); ?>"
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
                                <img src="<?= base_url('assets/seller/img/2_.png'); ?>"
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
                            <img src="<?= base_url('assets/seller/img/3_n.png'); ?>"
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
                            <img src="<?= base_url('assets/seller/img/4_n.png'); ?>"
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
            <a class="btn btn-primary btn-lg" style="border-radius: 0;" href="<?= base_url('register/form'); ?>">Become
                A Seller <i
                        class="fa fa-cart-plus"></i></a>
            <a class="btn btn-primary btn-lg" style="border-radius: 0;" href="<?= base_url('register/form'); ?>">Login <i
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
    <script src="<?= base_url('assets/seller/') . $tag; ?>"></script>
<?php endforeach; ?>
</body>
</html>
