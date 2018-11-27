<?php $this->load->view('templates/meta_tags.php'); ?>
<style>
    li h3 {
        color: #1cbb86;
    }

    li h3:hover {
        color: #0e0e0e;
    }

    aside h3 {
        background: #1cbb86;
        padding: 10px;
        color: #fff;
    }

    aside h3:hover {
        background: #fff;
        color: #1cbb86;
    }

    aside p {
        padding: 20px;
    }

    aside h4 {
        background: #697940;
        padding: 10px;
        color: #fff;
    }

    aside h4:hover {
        background: #fff;
        color: #697940;
    }

    .nav-tabs > li > a {
        border-radius: 4px 4px 0 0;
    }

    .nav-tabs > li.active, .nav-tabs > li.active:focus > a{
        background: #35bbae;
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

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
<div id="container" class="container text-center" style="background-color: #fff !important;">


    <!-- BACKGROUND IMAGE -->
    <!--===================================================-->
    <div id="bg-overlay"></div>


    <!-- REGISTRATION FORM -->
    <!--===================================================-->
    <div id="container">
        <div class="row" style="text-align: center;"><br/>
            <h2 style="color:#736455;">Reach Over 200 million Customers</h2>
            <hr style=" width: 100%;border:1px solid #35bbae;"/>
        </div>
        <p class="title1 title1-pos" style=" font-size: 54px; font-weight: 500; line-height: 60px;">
            SELL NOW ON ONITSHAMARKET.COM AND<br/>START MAKING MONEY</p>
        <ul class="nav nav-tabs">
            <li class="active col-md-4"><a data-toggle="tab" href="#home"><h3>Sell on Onitshamarket.com</h3></a>
            </li>
            <li class="col-md-4"><a data-toggle="tab" href="#menu1"><h3>Seller Support</h3></a></li>
            <li class="col-md-4"><a data-toggle="tab" href="#menu2"><h3>FAQS</h3></a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div id="cnt1">
                    <div class="row">
                        <p class="sub-title1" style="margin-top:20px;">Grow your business with Onitshamarket.com</p>

                        <div class="col-md-4 text-center">

                            <img src="<?= base_url('assets/seller/img/sell_visits.png'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">Reach 200,000,000+</p>
                            <p class="glegend">Potential Buyers</p>
                        </div>

                        <div class="col-md-4 text-center">
                            <img src="<?= base_url('assets/seller/img/sell_satisfy.png'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">95% Satisfied customers</p>
                            <p class="glegend">Recommend us to friends</p>
                        </div>

                        <div class="col-md-4 text-center">
                            <img src="<?= base_url('assets/seller/img/sell_rep.png'); ?>"
                                 style="width: 140px;" alt=""/>
                            <p class="gnumbers">Marketing &amp; data analytics </p>
                            <p class="glegend">Support to grow your business</p>
                        </div>
                    </div>

                    <div class="grey_wrap">
                        <p class="sub-title1">How it works?</p>
                        <div class="row">
                            <div class="col-md-5 text-right">
                                <img src="<?= base_url('assets/seller/img/TAB1-STEP1n1.png'); ?>"
                                     style="width: 150px; float: right;" alt=""/>
                            </div>
                            <div class="col-md-7 text-left" style="top:20px;"><br/>
                                <p class="txt1" style="font-size: 15px; color: #35bbae;">Step 1: Register in
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
                            <div class="col-md-5 text-right">
                                <img src="<?= base_url('assets/seller/img/TAB1-STEP2n1.png'); ?>"
                                     style="width: 150px; float: right;" alt=""/>
                            </div>
                            <div class="col-md-7 text-left" style="top:30px;">
                                <p class="txt1" style="font-size: 15px; color: #35bbae;">Step 2 : Become an
                                    ecommerce
                                    expert</p>
                                <p class="txt1">Complete the dedicated training session for new sellers.<br/>Activate
                                    your
                                    Seller Center account to manage your shop on the go.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 text-right">
                                <img src="<?= base_url('assets/seller/img/TAB1-STEP3n1.png'); ?>"
                                     style="width: 150px; float: right;" alt=""/>
                            </div>
                            <div class="col-md-7 text-left" style="top:40px;">
                                <p class="txt1" style="font-size: 15px; color: #35bbae;">Step 3 : List your
                                    Products
                                    and start
                                    selling!</p>
                                <p class="txt1">Upload more than five products to start selling.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade text-justify">
                <div id="cnt2" style="padding-top:40px;">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <img src="<?= base_url('assets/seller/img/1_n.png'); ?>"
                                 style="width: 95px;"
                                 alt=""/>
                        </div>

                        <div class="col-md-10 text-left" style="top:20px;">
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
                            <div class="col-md-2 text-center">
                                <img src="<?= base_url('assets/seller/img/2_.png'); ?>"
                                     style="width: 95px;" alt=""/>
                            </div>

                            <div class="col-md-10 text-left" style="top:20px;">
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
                        <div class="col-md-2 text-center">
                            <img src="<?= base_url('assets/seller/img/3_n.png'); ?>"
                                 style="width: 95px;"
                                 alt=""/>
                        </div>

                        <div class="col-md-10 text-left" style="top:20px;">
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
                        <div class="col-md-2 text-center">
                            <img src="<?= base_url('assets/seller/img/4_n.png'); ?>"
                                 style="width: 95px;" alt=""/>
                        </div>

                        <div class="col-md-10 text-left" style="top:40px;">
                            <p class="txt3"><strong style="font-size: 14px;">Your Payments</strong> - There are
                                no costs
                                involved to list your products on Onitshamarket.com. You are not required to pay for
                                anything until
                                your items are sold.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade text-justify">
                <div class="wpb_wrapper" style="padding:20px;">
                    <aside class="accordion" style="padding:20px;">
                        <div class="row">
                            <div class="col-md-6">

                                <h3 style="border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">Getting
                                    Started on Onitshamarket.com</h3>
                                <div style="display: none;">
                                    <h4 style="border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">What
                                        does "selling on Onitshamarket.com mean?" </h4>
                                    <p style="display: none;">On Onitshamarket.com you can create your own shop online and
                                        start to
                                        sell your products across Nigeria thanks to our marketing and logistic
                                        expertise.</p>
                                    <h4 style="border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">I want
                                        to start selling my products on Onitshamarket.com. How do I Register?</h4>
                                    <p style="display: none;"> To start selling on Onitshamarket.com.com is very easy. You
                                        do not
                                        have to pay anything to register. Just visit the website <a
                                                href="https://www.sellercenter.Onitshamarket.com.com.ng">HERE.</a> and click
                                        on
                                        "Register to sell". Once the registration details has been filled. &nbsp;You are
                                        required to watch the short training videos and take the quiz. An email will be
                                        sent with a link to create password.</p>
                                    <h4 style="border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">What
                                        Products can I sell on Onitshamarket.com?</h4>
                                    <p style="display: none;">You can sell products among the following categories:
                                        Phones and Tablets, Fashion products, Home and Office, Computing, Cameras,
                                        Electronics, Watches, Sunglasses, Baby and kids products, Toys, Health and
                                        Beauty, Automobile, Sport and Fitness, Games and Consoles, Service Deals, Books,
                                        Movies and Music, Weddings, Groceries.</p>
                                    <h4>What are the products I cannot sell on Onitshamarket.com?</h4>
                                    <p style="">Onitshamarket.com's reputation is only as good as that of our vendors,
                                        consequently,
                                        should any listed item breach&nbsp;trust, it poses&nbsp;risks to our entire
                                        marketplace. The sale of illegal articles is forbidden (below list is non
                                        exhaustive):

                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Currency, valid
                                        invoices from any country. Fake money and every product which counterfeit
                                        financial instruments.Every financial instrument disapproved by applicable
                                        financial controlling authorities
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Stolen or
                                        counterfeit goods
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Illegal
                                        substances and products sold to produce, modify or consume illegal substances.
                                        Drugs, medicines, steroids…
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Any explosive
                                        material
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Flammable
                                        material
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Fireworks,
                                        ammunitions and every manual which would explain how to build bombs and
                                        explosives
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Articles
                                        considered as being part of the historic patrimony
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Every article
                                        related to hacking
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Weapons and
                                        items related to ammunitions, bullets…
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Fake IDS, fake
                                        birth certificate, driving license… Or any fake document
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Organs
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Items related
                                        to pedophilia, pornography, naked children...
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Therapies
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Every item
                                        which contravene to intellectual property
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; Products with
                                        shelf life of less than 3 months </p>
                                    <h4>What information is/are required to create a shop on Onitshamarket.com?</h4>
                                    <p style="">To register as a seller, you need to give the following information:
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Email address
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Phone number
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Bank account
                                        details
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; To sell on
                                        Onitshamarket.com, You will need a laptop with printer and Internet service</p>

                                    <h4>What is Onitshamarket.com Seller Center?</h4>
                                    <p style="">Onitshamarket.com Seller Center is an online platform that allows sellers to
                                        manage
                                        their products and operations on their e-Commerce shop.</p>
                                    <h4>How to use Onitshamarket.com Seller Center?</h4>
                                    <p style="">Our platform is user-friendly and you will be able to check our complete
                                        guide online on <a href="https://vendorhub.Onitshamarket.com.com.ng/university/">Onitshamarket.com
                                            University.</a></p>
                                    <h4>How do I Login?</h4>
                                    <p style=""> Click <a href="https://www.sellercenter.Onitshamarket.com.com.ng">HERE.</a>
                                        to
                                        login and use the email address used to register as email and the password
                                        created as password.</p>
                                </div>

                                <h3 style="border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                                    Onitshamarket.com
                                    University</h3>

                                <div style="display: none;"><h4>What is Onitshamarket.com University? </h4>

                                    <p style="">Onitshamarket.com university offers different offline and online classes for
                                        everyone, from selling basics to perfectly running your store on Onitshamarket.com.
                                        Find a
                                        class taught by our Onitshamarket.com Trainer Specialist. Start making money now
                                        It's FREE*
                                        and easy to schedule. Onitshamarket.com university has also made available training
                                        materials online on Vendor hub, Youtube. so that in case you missed the offline
                                        classes for any reasons, you can find all you need on online.</p>

                                    <h4>What is Onitshamarket.com Vendor hub?</h4>

                                    <p style="">Onitshamarket.com Vendor hub is a platform designed especially for our
                                        vendor
                                        partners. New and existing vendors will definitely find something suiting their
                                        needs. Whether you want to create your products or understand the importance of
                                        Seller score and how it improves your store image or new information regarding
                                        drop-off stations, you can find all of this and more on the vendor hub.</p>

                                    <h4>What is Sellercenter Assistant?</h4>

                                    <p style="">A tool designed to help you navigate seller center. It guides you while
                                        providing information about anything you need on seller center.</p>

                                    <h4>How do I schedule training at Onitshamarket.com?</h4>

                                    <p style="">We have the basic training and advanced trainings. Please click&nbsp;<a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/training-calendar/">here</a>&nbsp;to
                                        view the training calendar for the month </p>

                                    <h4>Does Onitshamarket.com University provide training to improve my sales performance
                                        on
                                        Onitshamarket.com?</h4>

                                    <p style="">Onitshamarket.com University provides a suite training programs targeted to
                                        enhance
                                        the proficiency of our sellers.<br>
                                        Attend any of our training classes online or offline to find out how you can
                                        improve your performance or click <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/training-calendar/">here</a>
                                        to
                                        view the training calendar.</p></div>
                                <h3 style="border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">Product
                                    Listing and Content Creation</h3>
                                <div style="display: none;">
                                    <h4>How to list my products and start to sell them?</h4>
                                    <p style="">Listing your product is done via our Seller Center platform. The process
                                        will be slightly different depending on whether or not your product already
                                        exists on Onitshamarket.com.
                                        <br><br><span class="bold-text">If your product(s) already exist(s) in the Onitshamarket.com catalog:</span>
                                        <br>You can easily add these products to your store one by using the <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/2017/03/30/create-product-using-sell-yours-feature/">Sell
                                            Yours feature</a>. All you have to do is add the SKU, the price and the
                                        quantity of the product.
                                        <br><br><span class="bold-text">If your product(s) don’t/doesn’t exist in the Onitshamarket.com catalog:</span>
                                        <br>You can create new offers one by one or massively with file upload via our
                                        Seller Center platform. To create new offers you will need the following
                                        information:
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Name of the
                                        product.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Detailed
                                        description of the product and specifications.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;High quality
                                        pictures of the product.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Price.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Available
                                        Stock.
                                        <br><br>Find the tutorials about product creation for each category <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/product-creation/"
                                                target="_blank">here</a>.
                                        <br><br>Find the content and images guidleines about product creation for each
                                        category <a href="https://guidescontentOnitshamarket.comng.wordpress.com/"
                                                    target="_blank">here</a>.
                                    </p>
                                    <h4>What are the methods to upload products?</h4>
                                    <p style=""><span
                                                class="bold-text">There are currently four methods to upload products:</span>
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;<a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/product-creation/in-less-than-30-seconds/"
                                                target="_blank">Copy an already existing product</a> from another seller
                                        on Onitshamarket.com.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Add an <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/product-creation/from-our-templates/"
                                                target="_blank">already existing products</a> from our database to your
                                        shop.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Upload your
                                        products <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/product-creation/one-by-one/"
                                                target="_blank">individually</a>.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Upload <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/product-creation/massive/"
                                                target="_blank">multiple products</a> at once.
                                    </p>
                                    <h4>What are the information required when uploading the products?</h4>
                                    <p style="">You will be required to fill in a list of mandatory attributes specific
                                        to your product category, design an informative product description and upload
                                        attractive pictures for your product.
                                        <br>All information and training resources relating to content creation are
                                        available on Onitshamarket.com University.
                                        <br>Click <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/product-creation/"
                                                target="_blank">here</a> to find out more now.</p>

                                    <h4>Why is my new product not online? </h4>

                                    <p style="">Your product might be put on hold due to following : <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;It takes 24 working
                                        hours for new product to be online as new products undergoes quality check.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; The product does
                                        not satisfy minimum quality requirements.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; Incomplete
                                        description of the product.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; Low resolution of
                                        the image of the product.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; For FMCG products,
                                        NAFDAC Registration number is required.</p>
                                </div>


                                <h3>All about Shipping and Fulfillment</h3>

                                <div style="display:none;">

                                    <h4>How to manage orders?</h4>
                                    <p style="">You can fulfill your orders directly from the Seller Center platform.
                                        <br><br>You will find tutorials to guide you through order management <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/ship-orders/order-management/"
                                                target="_blank">here</a></p>
                                    <h4>How will I be informed when I have an order?</h4>
                                    <p style="">Once you receive an order, you will get an email notification via your
                                        Onitshamarket.com Sellercenter registered email. For instant updates on orders, we
                                        urge you
                                        to download our app to get a mobile notification with each new order.
                                        <br><br>Click <a
                                                href="https://play.google.com/store/apps/details?id=com.sc.Onitshamarket.com&amp;hl=en"
                                                target="_blank">here</a> for Android version.
                                        <br><br>All your orders will appear under “Orders” &gt; “Manage Orders”. Once an
                                        order is placed by a customer, it will land under “Pending”.</p>
                                    <h4>What should I do when I receive an order?</h4>
                                    <p style="">Once an order is received, you can fulfill your order in few steps:
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Update your
                                        order status to ready to ship within 24 hours
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Print the
                                        courier manifests and shipping labels
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Pick your order
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Drop off your
                                        order at the closest drop off center to you within the next 24 hours
                                        <br><br>Please click <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/ship-orders/order-management/ "
                                                target="_blank">here</a> for full order-fulfillment guide on
                                        Onitshamarket.com
                                        University.</p>
                                    <h4>Where can I see my orders?</h4>
                                    <p style="">You will be able to view your order summary in Onitshamarket.com Seller
                                        Center’s
                                        home page under the Orders tab.</p>
                                    <h4>How long am I given to respond to an order?</h4>
                                    <p style="">You will be given 48 hours, excluding Sunday and Public Holidays, to
                                        prepare your order and drop off at our centers before your order is cancelled.
                                        Abiding to the 48-hour timeline will increase your <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/seller-score-and-product-ratings/"
                                                target="_blank">seller score</a> and your customer satisfaction.</p>
                                    <h4>How should I pack my products ?</h4>

                                    <p style="">To pack your order correctly, make sure to follow the below:<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>1</strong>&nbsp;&nbsp;Your
                                        order must be packed carefully to ensure that it is delivered to your customer
                                        in its' original condition. Click<a
                                                href="https://sellercenter.Onitshamarket.com.com.ng/packaging_materials_online">
                                            here </a> to find out what packaging materials to use based on the category,
                                        and subcategory of the item. <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>2</strong>&nbsp;&nbsp;Order
                                        the packaging materials in advance. Click<a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/how-to-order-packaging-materials/">
                                            here </a>to know how.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>3</strong>&nbsp;&nbsp;Click
                                        <a href="https://www.Onitshamarket.com.com.ng/j-pack/">Here</a> to order</p>

                                    <h4>How can I order packaging materials?</h4>

                                    <p style=""> Click <a href="https://www.Onitshamarket.com.com.ng/j-pack/">here</a> to
                                        order.</p>
                                </div>


                                <h3>Smart QC (quality check)</h3>

                                <div style="display:none;"><h4>What is the Smart QC (Quality Check)?</h4>

                                    <p style="">The Quality Control (QC) process is based on checking your products
                                        before being shipped and delivered to the customer. This is done to avoid
                                        packaging mistakes, wrong item size or color, counterfeit products, and items
                                        not matching the product description on Onitshamarket.com website, which will affect
                                        your
                                        store reputation, and increase the percentage of the returns and declined
                                        products.</p>

                                    <h4>How can I be prepared for the smart QC process?</h4>

                                    <p style="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Pack the
                                        order halfway through (Do not seal the package) to avoid consuming more
                                        packaging materials.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Prepare extra
                                        packaging material incase needed.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;The quality check
                                        will be done randomly on some items.</p>

                                    <h4>Are all my products going to undergo the smart QC process?</h4>

                                    <p style="">For new sellers, all orders will undergo the smart QC for 1 month.<br>
                                        For older sellers, smart QC will be conducted randomly and on specific items
                                        with a higher returns rate.</p>

                                    <h4>Why is the Smart QC important?</h4>

                                    <p style="">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;To encourage you to
                                        deliver the orders successfully, on time.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;To decrease the
                                        percentage of the returns and the declined products.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;To gain customers
                                        trust and build your store reputation.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;To achieve higher
                                        seller score and get a Gold Badge.</p>

                                    <h4>Why will I be charged for orders that are not correctly packed with the correct
                                        items?</h4>

                                    <p style="">If you deliver a different product to your customer, they will be very
                                        unhappy, return the item, never shop from your store again, and also tell their
                                        friends and family about it.</p>

                                    <h4>How much will I be charged if I deliver a different product to the customer than
                                        what was actually ordered?</h4>

                                    <p style="">Charges are to be applied in the following cases:<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Wrong item or
                                        different size: 3,000 NGN <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Defective item:
                                        3,000 NGN <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Used/Refurbished:
                                        50,000 NGN.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Counterfeit: 50,000
                                        NGN</p>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <h3>Onitshamarket.com Drop-off stations &amp; QC</h3>

                                <div style="display:none;"><h4>Where&nbsp; are the available drop off stations?</h4>

                                    <p style="">Please click&nbsp;<a
                                                href="https://sellercenter.Onitshamarket.com.com.ng/drop_off_hub_details">here</a>&nbsp;to
                                        find out all the available drop off stations.</p>

                                    <h4>What are the working hours of the drop off stations?</h4>

                                    <p style="">Please click&nbsp;<a
                                                href="https://sellercenter.Onitshamarket.com.com.ng/drop_off_hub_details">here</a>&nbsp;to
                                        find out the working hours for all of our available drop off stations.</p>

                                    <h4>Can I use more than one drop off station?</h4>

                                    <p style="">Yes, you can drop off at any drop off center, as long as it is selected
                                        at the point of setting to "ready to ship" on sellercenter.</p>

                                    <h4>Why do we QC your product at the drop-off station?</h4>

                                    <p style="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;To make
                                        sure the quality of the items matches our customer’s expectation.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; To avoid returns
                                        based on quality.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; To increase
                                        delivered sales.</p></div>


                                <h3>Better sales performance</h3>
                                <div style="display:none;">
                                    <h4>What are the tools I can use to boost my sales on Onitshamarket.com?</h4>
                                    <p style="">Whether you are an old partner or a newly joiner, you are eligible to
                                        start boosting your sales on Onitshamarket.com by joining our weekly promotional
                                        campaigns.
                                        <!--<br><br>For more info, click <a href=" " target="_blank">here</a>.</p>-->
                                    </p>
                                    <h4>How can I join Onitshamarket.com Promotions?</h4>
                                    <p style="">Onitshamarket.com Promotions increase your opportunities to grow your orders
                                        and
                                        revenues providing more customer visibility.
                                        <br><br>Click <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/grow-your-sales/join-promotions/"
                                                target="_blank">here</a> for subscription steps.</p>
                                    <h4>Can the customers give ratings and comments? And why are these important?</h4>
                                    <p style="">Yes, the customers give detailed comments and ratings. These are very
                                        important for your sales on Onitshamarket.com. This is the best way for the
                                        customers to
                                        know that you are a reliable vendor. The customers look at the ratings of the
                                        product before buying it in most cases. The customers will be more willing to
                                        buy a product with good ratings. The ratings of your products are one of the
                                        most used criteria to evaluate your performance as a vendor on
                                        Onitshamarket.com.<br><br><img
                                                src="https://3cv9ak2ajf5r17hu9d2d3jsa-wpengine.netdna-ssl.com/wp-content/uploads/2016/07/EN-Seller-Score-and-Product-Ratings-Copy.png"
                                                id="img1"></p>
                                </div>

                                <h3>Services for sellers</h3>
                                <div style="display:none;">
                                    <h4>What is Onitshamarket.com Express?</h4>
                                    <p style="">Onitshamarket.com Express is a value added services for the vendors that
                                        will boost
                                        the visibility of your products and ease the fulfilment of your orders.
                                        <br><br>With Onitshamarket.com Express, you sell more with less efforts:
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>1</strong>&nbsp;&nbsp;You
                                        store your products in our warehouse: you save warehousing costs and operational
                                        costs. We guarantee you a very competitive storage cost and save you time and
                                        money.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>2</strong>&nbsp;&nbsp;Your
                                        products are seen first by the customers: every Onitshamarket.com Express products
                                        are
                                        tagged and boosted at the top of catalog pages and product pages.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>3</strong>&nbsp;&nbsp;We
                                        deliver your products first to the customers: the products will be delivered
                                        faster because we have them in our warehouse. It will make your customers happy,
                                        and they will come back to shop your items.
                                        <br><br>Find details about Onitshamarket.com Express <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/Onitshamarket.com-express//"
                                                target="_blank">here</a>.
                                        <br><br>You can subscribe to this service by filling the raise a claim form <a
                                                href="https://Onitshamarket.com_form.formstack.com/forms/vendor_claims_nigeria">Here</a>.
                                    </p>

                                    <h4>Can I cancel my value added services?</h4>
                                    <p style="">You can cancel your Value Added Services whenever you want. Contact us
                                        by sending an email to <a href="mailto:seller.support@Onitshamarket.com.com.ng">seller.support@Onitshamarket.com.com.ng&nbsp;</a>.
                                    </p></div>


                                <h3>Commissions and Shipping fees</h3>
                                <div style="display:none;">
                                    <h4>What are the commissions on Onitshamarket.com ?</h4>
                                    <p style="">As a basic vendor, you will only pay the commissions on each item you
                                        sell. The commission depends on the category of your item and is a percentage of
                                        the selling price. However, our minimum commission level was revised to 100NGN
                                        For items sold in fashion, Health and beauty, Groceries, Baby Toys and kids. All
                                        other categories aside the ones stated are 300 NGN per item sold. This means
                                        that if the commission to be charged on a delivered item is less than 100NGN or
                                        300 NGN as previously mentioned, we will apply a flat rate of 100 NGN or 300
                                        NGN. The commissions can be found below and also on the Seller Center.
                                        <img class="aligncenter size-full wp-image-27236"
                                             src="https://173yny3qy1vx2x7ylx1ung1d-wpengine.netdna-ssl.com/wp-content/uploads/2018/10/commission.png"
                                             alt="" width="888" height="3143"></p>

                                    <h4>When do I have to pay for commissions and services ?</h4>
                                    <p style="">Both the commission and the value added services fees will be deducted
                                        from your payment.
                                        <br><br>You can always check your payment in your <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/university/account-statement/"
                                                target="_blank">account statement</a>.</p>
                                    <h4>What is shipping Fee? </h4>

                                    <p style="">Shipping fees are service charges which will be deducted from your
                                        account statement for the final delivered orders only.

                                    </p>
                                    <h4>Is the shipping fee charged based on order level or item level?</h4>

                                    <p style="">The shipping fee is charged based on item level:
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; For items in
                                        Fashion, Health and Beauty, Groceries, Baby Toys and kids category: 100NGN
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Small items:
                                        200NGN
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;MEDIUM items:
                                        400NGN
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Large items:
                                        600NGN
                                    </p>
                                    <h4>I don’t know whether my product is considered small or medium or large sized
                                        products?</h4>

                                    <p style="">Click <a
                                                href="https://vendorhub.Onitshamarket.com.com.ng/item-category-vs-sizes/">here</a>
                                    </p>

                                    <h4>Where can I find Onitshamarket.com’s Terms and Conditions for sellers?</h4>
                                    <p style="">Sellers Terms and Conditions are to be found on Seller Center. Click <a
                                                href="https://docs.google.com/document/d/1nacWSAEY9L1Ii15Yso18F7dWws6fiEsHEx7eswgXwdg/edit"
                                                target="_blank">HERE</a> to view it.</p>
                                    <h4>What is Onitshamarket.com Return Policy with Sellers?</h4>
                                    <p style="">On Onitshamarket.com, customers are given option to return the product due
                                        to the
                                        below reasons:
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Damaged or
                                        defective product.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Product not as
                                        advertised.
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;Wrong product
                                        or missing items.
                                    </p>
                                </div>


                                <h3 style="border-radius: 0px;">About Payments</h3>
                                <div style="display:none;">
                                    <h4>How and when do I get paid?</h4>
                                    <p style="">Your payment will be made via bank transfer to the bank details
                                        maintained in your Seller Center Account.
                                        <br><br>Onitshamarket.com pays every 7 days for the items that are delivered. Please
                                        make
                                        sure you have entered your exact bank details on Seller Center to avoid any
                                        delays.</p>
                                    <h4>How can I check my Payment on Seller Center?</h4>
                                    <p style="">You can always check your payment statement on your account on Seller
                                        Center by clicking on Reports &gt; Account Statement.

                                    </p>
                                    <h4>Why is my payment transfer delayed?</h4>

                                    <p style="">Reasons :<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; Bank account
                                        details are missing.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; Bank account
                                        details given are incorrect.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp; Your payment date
                                        falls on a public holiday</p>
                                </div>
                            </div>
                        </div>

                    </aside>
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
            <a class="btn btn-primary btn-lg" style="border-radius: 0;" href="<?= base_url(); ?>">Contact Seller Support
                <i
                        class="fa fa-headphones"></i></a>
        </div>
    </div>
    </main>
</div>
</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


<!--JAVASCRIPT-->
<!--=================================================-->
<?php foreach ($scripts as $tag) : ?>
    <script src="<?= base_url('assets/seller/') . $tag; ?>"></script>
<?php endforeach; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script>
    var headers = ["H1", "H2", "H3", "H4", "H5", "H6"];

    $(".accordion").click(function (e) {
        var target = e.target,
            name = target.nodeName.toUpperCase();

        if ($.inArray(name, headers) > -1) {
            var subItem = $(target).next();

            var depth = $(subItem).parents().length;
            var allAtDepth = $(".accordion p, .accordion div").filter(function () {
                if ($(this).parents().length >= depth && this !== subItem.get(0)) {
                    return true;
                }
            });
            $(allAtDepth).slideUp("fast");

            subItem.slideToggle("fast", function () {
                $(".accordion :visible:last").css("border-radius", "0 0 0 0");
            });
            $(target).css({
                "border-bottom-right-radius": "0",
                "border-bottom-left-radius": "0"
            });
        }
    });
</script>
</body>
</html>
