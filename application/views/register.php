<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.themeon.net/nifty/v2.9.1/forms-wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Jul 2018 07:32:32 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $page_title; ?> | Onitshamarket.com</title>
    <link rel="shortcut icon" href="<?= base_url('assets/landing/img/favicon.png'); ?>" type="image/png">
    <link rel="icon" href="<?= base_url('assets/landing/img/favicon.png'); ?>" type="image/png">
    <link rel="canonical" href="<?= current_url(); ?>"/>
    <meta name="robots" content="noindex,nofollow">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link href="<?= base_url('assets/seller/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/landing/css/font-awesome.css'); ?>">

    <link href="<?= base_url('assets/seller/css/nifty.min.css'); ?>" rel="stylesheet">


    <link href="<?= base_url('assets/seller/css/demo/nifty-demo-icons.min.css'); ?>" rel="stylesheet">


    <link href="<?= base_url('assets/seller/plugins/pace/pace.min.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('assets/seller/plugins/pace/pace.min.js'); ?>"></script>

    <link href="<?= base_url('assets/seller/css/demo/nifty-demo.min.css'); ?>" rel="stylesheet">

    <link href="<?= base_url('assets/seller/plugins/bootstrap-validator/bootstrapValidator.min.css'); ?>"
          rel="stylesheet">

    <style>
        .modal-dialog.cascading-modal.modal-avatar .modal-header {
            -webkit-box-shadow: none;
            box-shadow: none;
            margin: -6rem 0 -1rem;
        }

        .modal-dialog.cascading-modal.modal-avatar .modal-header {
            max-width: 100%;
            height: auto;
        }

        .modal-dialog.cascading-modal.modal-avatar {
            margin-top: 6rem;
        }
    </style>

</head>
<body>
<div id="container" class="cls-container" style="background-color: #fff !important;">

    <div id="bg-overlay"></div>

    <div class="container pad-all">
        <div class="cls-content-lg panel panel-colorful "
             style="border: 1px solid #26a69a !important;padding-top:10px;width:96%;margin-top:80px;">
            <div class="panel-title" style="background-color: transparent !important;">
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url(); ?>" title="<?= lang('app_name'); ?>"><img
                                    src="<?= base_url('assets/landing/img/onitshamarket-logo.png'); ?>"
                                    alt="<?= lang('app_name'); ?>"
                                    class="brand-title img-responsive"></a>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
            <div class="panel" style="padding:20px;">
                <div id="demo-bv-wz">
                    <div class="wz-heading pad-top">

                        <!--Nav-->
                        <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
                            <li class="col-xs-3">
                                <a data-toggle="tab" href="#sell_info">
                                    <span class="text-danger"><i class="demo-pli-male icon-2x"></i></span>
                                    <p class="text-semibold mar-no">Seller Information</p>
                                </a>
                            </li>
                            <li class="col-xs-3">
                                <a data-toggle="tab" href="#pro_info">
                                    <span class="text-warning"><i class="demo-pli-shopping-basket icon-2x"></i></span>
                                    <p class="text-semibold mar-no">Product Information</p>
                                </a>
                            </li>
                            <li class="col-xs-3">
                                <a data-toggle="tab" href="#acc_det">
                                    <span class="text-info"><i class="demo-pli-credit-card-2 icon-2x"></i></span>
                                    <p class="text-semibold mar-no">Bank Account Details</p>
                                </a>
                            </li>
                            <li class="col-xs-3">
                                <a data-toggle="tab" href="#comp_form">
                                    <span class="text-success"><i class="demo-pli-medal-2 icon-2x"></i></span>
                                    <p class="text-semibold mar-no">Complete Application</p>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!--progress bar-->
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-primary"></div>
                    </div>


                    <!--Form-->
                    <form id="demo-bv-wz-formc" class="form-horizontal">
                        <div class="panel-body">
                            <div class="tab-content">

                                <!--First tab-->
                                <div id="sell_info" class="tab-pane">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="legal_company_name">Business
                                                Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" placeholder="Business Name"
                                                       autofocus
                                                       id="legal_company_name" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="tin">Tax Identification
                                                Number</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" placeholder="TIN" id="tin"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">First Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="first_name" id="first_name"
                                                       placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Last Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="last_name" id="last_name"
                                                       placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Store Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="store_name"
                                                       placeholder="Store Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Phone Number</label>
                                            <div class="col-lg-7">
                                                <input type="text" placeholder="080XXXXXXXX" name="phone_number"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Email address</label>
                                            <div class="col-lg-7">
                                                <input type="email" class="form-control" name="email"
                                                       placeholder="example@gmail.com"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Store Address</label>
                                            <div class="col-lg-7">
                                                <input type="text" placeholder="Store Address" name="store_address"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label"></label>
                                            <div class="col-lg-7" style="text-align:left;">

                                                <div class="checkbox">
                                                    <input id="bus_reg" type='checkbox' name="has_reg"
                                                           title="Is Business Registered?"
                                                           class="magic-checkbox">
                                                    <label for="bus_reg">Is Business Registered?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6" id="reg_opt" style="display: none;">
                                            <label class="col-lg-4 control-label" for="rc_num">RC</label>
                                            <div class="col-lg-7">
                                                <input type="text" name="rc_num" class="form-control"
                                                       placeholder="00000"
                                                       id="rc_num"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h4 class="text-center">One Time Onitshamarket Agent login</h4>
                                        <form action="<?=base_url('register/form')?>" method="post">
                                            <div class="md-form mb-5">
                                                <div class="col-md-3 text-right">
                                                    <i class="fa fa-envelope prefix grey-text fa-2x"></i>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="email" id="is_user_email" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="md-form mb-4">
                                                <div class="col-md-3 text-right" style="margin-top:10px;margin-bottom:10px;">
                                                    <i class="fa fa-lock prefix grey-text fa-2x"></i>
                                                </div>
                                                <div class="col-md-7" style="margin-top:10px;margin-bottom:10px;">
                                                    <input type="password" id="is_user_password" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <input type="submit" class="btn btn-primary" id="login" value="Confirm User"/>
                                                <button class="btn btn-danger" data-dismiss="modal">
                                                    New User
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!--Second tab-->
                                <div id="pro_info" class="tab-pane fade">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="main_category">Main
                                                Category</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="main_category" required>
                                                    <option value="">-- Select Main Category --</option>
                                                    <?php foreach ($categories as $category) : ?>
                                                        <option value="<?= $category->name ?>"> <?= ucwords($category->name); ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="pro_cond">Product
                                                Condition</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="product_condition" required>
                                                    <option value="new">New</option>
                                                    <option value="refurbished">Refurbished</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label"></label>
                                            <div class="col-lg-7" style="text-align:left;">

                                                <div class="checkbox">
                                                    <input id="plat_reg" type='checkbox' name="has_reg"
                                                           title="Selling with another platform?"
                                                           class="magic-checkbox">
                                                    <label for="plat_reg">Do you sell with another platform?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6" id="plat_opt" style="display: none;">
                                            <label class="col-lg-4 control-label" for="platform">Platform</label>
                                            <div class="col-lg-7">
                                                <input type="text" name="rc_num" class="form-control"
                                                       placeholder="E.g: Jumia"
                                                       id="platform"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="no_of_products">Duration</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="no_of_products" required>
                                                    <option value="1year">1year</option>
                                                    <option value="1-5years">1 - 5years</option>
                                                    <option value="5years+">5years +</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="no_of_products">No of
                                                Products</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="no_of_products" required>
                                                    <option value="1-50">1 - 50</option>
                                                    <option value="51-100">51 - 100</option>
                                                    <option value="101-500">101 - 500</option>
                                                    <option value="501-more">501 +</option>
                                                    <option value="pack">Large Packaged Quantities</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Third tab-->
                                <div id="acc_det" class="tab-pane">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Bank Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="bankName"
                                                       placeholder="Bank Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Bank Location</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="bankLoc"
                                                       placeholder="Bank Location" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Account Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="accName"
                                                       placeholder="Account Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Swift/BI Code</label>
                                            <div class="col-lg-7">
                                                <input type="text" placeholder="XXXXXX" name="bankCode"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Account Number</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="accNum"
                                                       placeholder="XXXXXXXXXX"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="accType">Account Type</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="accType" required>
                                                    <option value="current">Current</option>
                                                    <option value="savings">Savings</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Fourth tab-->
                                <div id="comp_form" class="tab-pane  mar-btm text-center">
                                    <h4>Sellers Agreement</h4>
                                    <div class="nano has-scrollbar text-justify col-md-9"
                                         style="height: 150px;">
                                        <div class="nano-content read_here" tabindex="0" style="right: -17px;">
                                            When you say you want them to read it do you really mean that you want them
                                            to read it or that you want them to scroll to the bottom and press a button?
                                            – Steve Weet Apr 30 '10 at 16:09
                                            Is this on a web page? Why do you need a scrolling div? Keep it simple and
                                            put in a regular div with the Accept button at the bottom of the web page.
                                            EULAs in scrolling text boxes were used in old installers whose windows
                                            didn't natively scroll, but no reason to copy that design for a web page
                                            (unless you're using jQuery in a thick client installer somehow, you don't
                                            specify). – Marc Stober Apr 30 '10 at 16:34
                                            The EULA is within a scrollable window in a larger reg page. Users can print
                                            to see it alone/in a new window but my design requires it be nested in the
                                            reg page in a smaller view. I have thought about just hiding the button at
                                            the end of the scrollable window but it's not the route I want to take: I'll
                                            end up with lots of support queries saying "I can't find the button" and
                                            even though the answer is easy ("scroll to the bottom") it's less costly to
                                            deflect these kinds of user problems by making the button plain as day and
                                            erroring out if they haven't yet scrolled to the bottom. – buley Apr 30 '10
                                            at 16:39
                                            Sometimes the client wants something you may advise against, but in the end,
                                            they are the client, and they "know" what they want. sigh – Kumu Apr 30 '10
                                            at 16:40
                                            If it's good enough for blizzard... – NibblyPig Apr 30 '10 at 16:54
                                            When you say you want them to read it do you really mean that you want them
                                            to read it or that you want them to scroll to the bottom and press a button?
                                            – Steve Weet Apr 30 '10 at 16:09
                                            Is this on a web page? Why do you need a scrolling div? Keep it simple and
                                            put in a regular div with the Accept button at the bottom of the web page.
                                            EULAs in scrolling text boxes were used in old installers whose windows
                                            didn't natively scroll, but no reason to copy that design for a web page
                                            (unless you're using jQuery in a thick client installer somehow, you don't
                                            specify). – Marc Stober Apr 30 '10 at 16:34
                                            The EULA is within a scrollable window in a larger reg page. Users can print
                                            to see it alone/in a new window but my design requires it be nested in the
                                            reg page in a smaller view. I have thought about just hiding the button at
                                            the end of the scrollable window but it's not the route I want to take: I'll
                                            end up with lots of support queries saying "I can't find the button" and
                                            even though the answer is easy ("scroll to the bottom") it's less costly to
                                            deflect these kinds of user problems by making the button plain as day and
                                            erroring out if they haven't yet scrolled to the bottom. – buley Apr 30 '10
                                            at 16:39
                                            Sometimes the client wants something you may advise against, but in the end,
                                            they are the client, and they "know" what they want. sigh – Kumu Apr 30 '10
                                            at 16:40
                                            If it's good enough for blizzard... – NibblyPig Apr 30 '10 at 16:54
                                            When you say you want them to read it do you really mean that you want them
                                            to read it or that you want them to scroll to the bottom and press a button?
                                            – Steve Weet Apr 30 '10 at 16:09
                                            Is this on a web page? Why do you need a scrolling div? Keep it simple and
                                            put in a regular div with the Accept button at the bottom of the web page.
                                            EULAs in scrolling text boxes were used in old installers whose windows
                                            didn't natively scroll, but no reason to copy that design for a web page
                                            (unless you're using jQuery in a thick client installer somehow, you don't
                                            specify). – Marc Stober Apr 30 '10 at 16:34
                                            The EULA is within a scrollable window in a larger reg page. Users can print
                                            to see it alone/in a new window but my design requires it be nested in the
                                            reg page in a smaller view. I have thought about just hiding the button at
                                            the end of the scrollable window but it's not the route I want to take: I'll
                                            end up with lots of support queries saying "I can't find the button" and
                                            even though the answer is easy ("scroll to the bottom") it's less costly to
                                            deflect these kinds of user problems by making the button plain as day and
                                            erroring out if they haven't yet scrolled to the bottom. – buley Apr 30 '10
                                            at 16:39
                                            Sometimes the client wants something you may advise against, but in the end,
                                            they are the client, and they "know" what they want. sigh – Kumu Apr 30 '10
                                            at 16:40
                                            If it's good enough for blizzard... – NibblyPig Apr 30 '10 at 16:54
                                            When you say you want them to read it do you really mean that you want them
                                            to read it or that you want them to scroll to the bottom and press a button?
                                            – Steve Weet Apr 30 '10 at 16:09
                                            Is this on a web page? Why do you need a scrolling div? Keep it simple and
                                            put in a regular div with the Accept button at the bottom of the web page.
                                            EULAs in scrolling text boxes were used in old installers whose windows
                                            didn't natively scroll, but no reason to copy that design for a web page
                                            (unless you're using jQuery in a thick client installer somehow, you don't
                                            specify). – Marc Stober Apr 30 '10 at 16:34
                                            The EULA is within a scrollable window in a larger reg page. Users can print
                                            to see it alone/in a new window but my design requires it be nested in the
                                            reg page in a smaller view. I have thought about just hiding the button at
                                            the end of the scrollable window but it's not the route I want to take: I'll
                                            end up with lots of support queries saying "I can't find the button" and
                                            even though the answer is easy ("scroll to the bottom") it's less costly to
                                            deflect these kinds of user problems by making the button plain as day and
                                            erroring out if they haven't yet scrolled to the bottom. – buley Apr 30 '10
                                            at 16:39
                                            Sometimes the client wants something you may advise against, but in the end,
                                            they are the client, and they "know" what they want. sigh – Kumu Apr 30 '10
                                            at 16:40
                                            If it's good enough for blizzard... – NibblyPig Apr 30 '10 at 16:54
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-7" style="text-align:left;margin-top:40px;">

                                            <div class="checkbox">
                                                <input id="terms" type='checkbox' name="terms"
                                                       title="Terms and Conditions"
                                                       class="magic-checkbox" required disabled>
                                                <label for="terms">I have read and accepted the Terms and
                                                    Conditions?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Footer button-->
                        <div class="panel-footer text-center">
                            <div class="box-inline">
                                <button type="button" class="previous btn btn-primary">Previous</button>
                                <button type="button" class="next btn btn-primary">Next</button>
                                <button type="button" class="finish btn btn-warning" disabled>Finish</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="pad-all">
                <a href="<?= base_url(); ?>" class="btn-link mar-rgt">Go to Homepage</a>
            </div>
        </div>

    </div>

</div>
<script src="<?= base_url('assets/seller/js/jquery.min.js'); ?>"></script>

<script src="<?= base_url('assets/seller/js/bootstrap.min.js'); ?>"></script>

<script src="<?= base_url('assets/seller/js/nifty.min.js'); ?>"></script>


<script src="<?= base_url('assets/seller/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'); ?>"></script>

<script src="<?= base_url('assets/seller/plugins/bootstrap-validator/bootstrapValidator.min.js'); ?>"></script>

<script src="<?= base_url('assets/seller/js/demo/form-wizard.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('#bus_reg').change(function () {
            if (this.checked) {
                $('#reg_opt').fadeIn('slow');
                $('#rc_num').attr('required', true);
            } else {
                $('#reg_opt').fadeOut('slow');
                $('#rc_num').attr('required', false);
            }
        });
        $('#plat_reg').change(function () {
            if (this.checked) {
                $('#plat_opt').fadeIn('slow');
                $('#platform').attr('required', true);
            } else {
                $('#plat_opt').fadeOut('slow');
                $('#platform').attr('required', false);
            }
        });
    });
    $('.read_here').scroll(function () {
        if ($(this).scrollTop() + $(this).innerHeight() + 2 >= $(this)[0].scrollHeight) {
            $('#terms').removeAttr('disabled');
        }
    });
</script>
</body>
</html>

