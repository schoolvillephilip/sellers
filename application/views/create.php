<?php $this->load->view('templates/meta_tags'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<style>
    .note-group-image-url{
        display: none;
    }
    .help_text {
        color: #ffffff;
        background-color: #252525;
        border-radius: 100%;
        margin-top: 10px;
        cursor: help;
    }

    .help_text:hover {
        color: #ffffff;
        background-color: #49a251;
        cursor: help;
    }

    .form-horizontal .control-label {
        font-weight: 600;
    }

    @media (min-width: 768px) {
        .form-horizontal .control-label {
            text-align: left !important;
        }
    }

    .help_text:hover {
        color: #ffffff;
        background-color: #49a251;
        cursor: help;
    }

    @media (min-width: 768px) {
        .form-horizontal .control-label {
            text-align: left !important;
        }
    }

    .fav_drop_ico {
        margin: 15px;
    }

    .bootstrap-select > .dropdown-toggle {
        z-index: unset !important;
    }

    .control-label {
        color: #4b4b4b !important;
    }
    .img_load .loader,
    .img_load .loader:before,
    .img_load .loader:after {
        border-radius: 50%;
        width: 1.5em;
        height: 1.5em;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation: img_load 1.8s infinite ease-in-out;
        animation: img_load 1.8s infinite ease-in-out;
    }

    .img_load .loader {
        color: #177bbb;
        font-size: 7px;
        margin: 40px auto;
        position: relative;
        text-indent: -9999em;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    .img_load .loader:before, .img_load .loader:after {
        content: '';
        position: absolute;
        top: 0;
    }

    .img_load .loader:before {
        left: -2.5em;
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .img_load .loader:after {
        left: 2.5em;
    }
    @-webkit-keyframes img_load {
        0%,
        80%,
        100% {
            box-shadow: 0 2.5em 0 -1.3em;
        }
        40% {
            box-shadow: 0 2.5em 0 0;
        }
    }
    @keyframes img_load {
        0%,
        80%,
        100% {
            box-shadow: 0 2.5em 0 -1.3em;
        }
        40% {
            box-shadow: 0 2.5em 0 0;
        }
    }
</style>
</head>
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">
    <?php $this->load->view('templates/head_navbar'); ?>
    <div class="boxed">
        <div id="content-container">

            <div id="page-head">
                <div id="page-title">
                    <h1 class="page-header text-overflow">Product</h1>
                </div>

                <ol class="breadcrumb">
                    <li><a href="javascript:;"><i class="demo-pli-home"></i>&nbsp; You're posting under</a></li>
                    <?php foreach ($categories_name as $name) : ?>
                        <li><?= $name ?></li>
                    <?php endforeach; ?>
                    <li><a href="<?= base_url('product/'); ?>">Change Category ?</a></li>
                </ol>
            </div>
            <div id="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <?php $this->load->view('msg_view'); ?>
                        <div class="panel">
                            <div id="demo-bv-wz">
                                <div class="wz-heading pad-top">
                                    <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
                                        <li class="col-xs-3">
                                            <a data-toggle="tab" href="#tab1">
                                                <span class="text-danger text-2x"><i class="fas fa-bookmark"></i></span>
                                                <p class="text-semibold mar-no">Basic Information</p>
                                            </a>
                                        </li>
                                        <li class="col-xs-3">
                                            <a data-toggle="tab" href="#product-description-tab">
                                                <span class="text-warning text-2x"><i class="fab fa-product-hunt"
                                                                                      aria-hidden="true"></i></span>
                                                <p class="text-semibold mar-no">Product Description & Attributes</p>
                                            </a>
                                        </li>
                                        <li class="col-xs-3">
                                            <a data-toggle="tab" href="#product-variation-tab">
                                                <span class="text-info text-2x"><i
                                                        class="fas fa-money-check"></i></span>
                                                <p class="text-semibold mar-no">Product Pricing</p>
                                            </a>
                                        </li>
                                        <li class="col-xs-3">
                                            <a data-toggle="tab" href="#image-upload-tab">
                                                <span class="text-success text-2x"><i class="fas fa-images"></i></span>
                                                <p class="text-semibold mar-no">Image</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="status"></div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-primary"></div>
                                </div>
                                <form id="demo-bv-wz-form" class="form-horizontal add_product_form "
                                      method="POST" action=""
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="csrf_carrito"
                                           value="<?= $this->security->get_csrf_hash(); ?>"/>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="tab1" class="tab-pane">
                                                <div class="panel-group accordion" id="accordion">
                                                    <div class="panel">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-parent="#accordion" data-toggle="collapse"
                                                                   href="#general-info">
                                                                    General information
                                                                    <span
                                                                        class="glyphicon glyphicon-chevron-down pull-right fav_drop_ico"></span>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div class="panel-collapse collapse in" id="general-info">
                                                            <div class="panel-body">
                                                                <div class="form-group">
                                                                    <label class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Product Name</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <input type="text" class="form-control"
                                                                               autofocus required name="product_name"
                                                                               value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : ''; ?>"
                                                                               placeholder="Product name">
                                                                        <span class="text-sm text-dark">Name of the product. For a better listing quality, the name should consist the actual product name, if available colour, edition, speciality</span>
                                                                        <span class="text-sm text-dark">Wide Angle Camera 10 MP - Black, Galaxy Tab A Leather Flip Case - Red</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Product Name"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Name of the product. For a better listing quality, the name should consist the actual product name, if available colour, edition, speciality">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                            class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Brand
                                                                        Name</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <select class="form-control select2"
                                                                                name="brand_name"
                                                                                data-width="100%">
                                                                            <option value="">-- Select Brand Name --
                                                                            </option>
                                                                            <?php foreach ($brands as $brand) : ?>
                                                                                <option
                                                                                    value="<?= ucwords($brand->brand_name); ?>"><?= ucwords($brand->brand_name); ?></option>
                                                                            <?php endforeach; ?>
                                                                            <option value="others">Others</option>
                                                                        </select>
                                                                        <span class="text-sm text-dark">If you can't find a brand, <a target="_blank" href="<?=base_url("request/brand");?>" style="cursor: pointer;color:#009ee1;text-decoration: underline;">Click Here</a> to add new brand</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Brand Name"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="What is the maker of the product, e.g Sansung, Apple, Toshiba etc.">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Model</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <input type="text" class="form-control"
                                                                               name="model"
                                                                               placeholder="Eg:  iPhone 4S Samsung TV 4T">
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:void(0);" title="Model"
                                                                           data-placement="top" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Product Model e.g Samsung S9+, iPhone XR etc.">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Main
                                                                        Colour</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <select name="main_colour"
                                                                                class="form-control select2"
                                                                                title="Choose main colour"
                                                                                data-width="100%">
                                                                            <option value="">-- Select main colour--</option>
                                                                            <?php
                                                                            $colours = explode(',', lang('colours'));
                                                                            foreach ($colours as $colour):
                                                                                ?>
                                                                                <option value="<?= trim($colour); ?>">
                                                                                    <?= trim(ucfirst($colour)); ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:void(0);" title="Main Color"
                                                                           data-placement="top" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Main color is the primary color of the product, e,g Blue, Green, etc.">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Colour
                                                                        Family</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <select name="colour_family[]"
                                                                                class="form-control select2" multiple
                                                                                title="Select colour family..."
                                                                                data-width="100%">
                                                                            <?php
                                                                            $colours = explode(',', lang('colours'));
                                                                            foreach ($colours as $colour):
                                                                                ?>
                                                                                <option
                                                                                    value="<?= trim($colour); ?>"><?= trim(ucfirst($colour)); ?> </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <span class="text-sm text-dark">Add a generalisation of the main color, to help customers find the product using the provided color-filter in the shop</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:void(0);"
                                                                           title="Color Family"
                                                                           data-placement="top" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Add as many colors as you have for the different types of the product">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Main
                                                                        Material</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <select name="main_material"
                                                                                class="form-control select2"
                                                                                title="Choose type..."
                                                                                data-width="100%">
                                                                            <option value="">-- Select --</option>
                                                                            <?php
                                                                            $materials = explode(',', lang('main_material'));
                                                                            foreach ($materials as $material) :
                                                                                ?>

                                                                                <option
                                                                                    value="<?= trim($material); ?>"> <?= trim(ucwords($material)); ?> </option>
                                                                            <?php endforeach; ?>
                                                                            <option value="other">Other</option>
                                                                        </select>
                                                                        <span
                                                                            class="text-sm text-dark">Eg: Leather</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:void(0);"
                                                                           title="Main Material"
                                                                           data-placement="top" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Material used to manufacture product, e.g Aluminium, Plastic, etc.">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                            class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Is this product from overseas?</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <div class="radio">
                                                                            <input id="no" class="magic-radio" type="radio" name="from_overseas" checked>
                                                                            <label for="no">No</label>

                                                                            <input id="yes" class="magic-radio" type="radio" name="from_overseas">
                                                                            <label for="yes">Yes</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:void(0);"
                                                                           title="Overseas"
                                                                           data-placement="top" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Please check if this product is not from Nigeria.">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="product-description-tab" class="tab-pane fade">
                                                <div class="panel-group accordion" id="accordion">
                                                    <div class="panel">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-parent="#accordion" data-toggle="collapse"
                                                                   href="#description-tab">
                                                                    Product Description<span
                                                                        class="glyphicon glyphicon-chevron-down pull-right fav_drop_ico"></span>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div class="panel-collapse" id="description-tab">
                                                            <div class="panel-body">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Product
                                                                        Description </label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <textarea class="product_description" name="product_description" placeholder="Give a detailed product description" id="product_description"></textarea>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:void(0);"
                                                                           title="Product Description"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="The full product description including specs and advert images from manufacturer if available">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div id="product_description_image" style="display: none;">
                                                                    <div class="img_load">
                                                                        <div class="loader"></div>
                                                                        <h3 class="img_text text-center text-semibold"></h3>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">YouTube
                                                                        ID</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <input type="text" class="form-control"
                                                                               name="youtube_id"
                                                                               placeholder="YouTube ID">
                                                                        <span class="text-sm text-dark">Example: http://www.youtube.com/watch?v=abcdef it is: abcdf</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Youtube ID"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Enter the youtube link to product video if available">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                            class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Highlights</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <textarea title="A brief highlight of what is in the box?" class="half_description" name="highlights" id="highlights"></textarea>
                                                                        <span class="text-sm text-dark">Enter short major highlights of the product, to make the purchase decision for the customer easier.</span>
                                                                        <span class="text-sm text-dark">Example: Best expierience ever - super fast and easy navigation - better control</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Highlights"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Enter short major highlights of the product, to make the purchase decision for the customer easier, e.g  Best expierience ever - super fast and easy navigation - better control">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">What's
                                                                        in the
                                                                        box?</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <textarea title="What is in the box?" class="half_description" name="in_the_box" id="in_the_box"></textarea>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;"
                                                                           title="What's in the box?"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="All information about unboxing the product and contents in the box">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title text-dark">
                                                                <a data-parent="#accordion" data-toggle="collapse"
                                                                   href="#measurement">Measurement<span
                                                                        class="glyphicon glyphicon-chevron-down pull-right fav_drop_ico"></span></a>
                                                            </h4>
                                                        </div>
                                                        <div class="panel-collapse " id="measurement">
                                                            <div class="panel-body">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Dimension</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <input type="text"
                                                                               placeholder="Example: 18 x 5 x 80"
                                                                               name="dimensions" class="form-control">
                                                                        <span class="text-sm text-dark">Measurement of the product</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Dimension"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Height, Width, &amp; Depth dimensions of the product">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Weight
                                                                        * (in
                                                                        Kg)</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <input type="text" required
                                                                               placeholder="Weight of the product. eg 10"
                                                                               name="weight" class="form-control">
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Weight (kg)"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Provide the weight of the product as specified by manufacturer">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($features)):
                                                        $y = 1;
                                                        foreach ($features as $feature) :
                                                            ?>
                                                            <div class="panel">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title text-dark">
                                                                        <a data-parent="#accordion"
                                                                           data-toggle="collapse"
                                                                           href="#<?= $y; ?>"><?= $feature['category_name']; ?>
                                                                            Attribute<span
                                                                                class="glyphicon glyphicon-chevron-down pull-right fav_drop_ico"></span></a>
                                                                    </h4>
                                                                </div>
                                                                <div class="panel-collapse " id="<?= $y; ?>">
                                                                    <div class="panel-body">
                                                                        <?php $x = 1;
                                                                        foreach ($feature['specifications'] as $specification) : ?>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label"><?= ucwords($specification['spec_name']); ?></label>
                                                                                <div
                                                                                    class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                                    <?php if (!empty($specification['spec_options'])) :
                                                                                        $options = json_decode($specification['spec_options']);
                                                                                        ?>
                                                                                        <select class="form-control select2"
                                                                                            <?php if ($specification['multiple_options']) {
                                                                                                echo 'name="attribute_' . str_replace(' ', '-', $specification["spec_name"]) . '[]"';
                                                                                                echo ' multiple';
                                                                                            } else {
                                                                                                echo 'name="attribute_' . str_replace(' ', '-', $specification["spec_name"]) . '"';
                                                                                            } ?>
                                                                                                title="<?= $specification['spec_description']; ?>"
                                                                                                data-width="100%">
                                                                                            <option value=""> -- Select --</option>
                                                                                            <?php foreach ($options as $key => $value) : ?>
                                                                                                <option
                                                                                                    value="<?= trim($value); ?>"><?= ucwords(trim($value)); ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>
                                                                                    <?php else: ?>
                                                                                        <input type="text"
                                                                                               placeholder="<?= $specification['spec_name']; ?>"
                                                                                               name="attribute_<?= str_replace(' ', '-', $specification['spec_name']); ?>"
                                                                                               class="form-control">
                                                                                    <?php endif; ?>
                                                                                    <span
                                                                                        class="text-sm text-dark"><?= $specification['spec_description']; ?></span>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                                    <a href="javascript:;"
                                                                                       title="<?= ucwords($specification['spec_name']); ?>"
                                                                                       data-placement="bottom"
                                                                                       data-toggle="popover"
                                                                                       tabindex="-1"
                                                                                       data-trigger="focus"
                                                                                       data-content="<?= $specification['spec_description']; ?>">
                                                                                        <i class="demo-pli-question help_text"
                                                                                           title="Help Text"></i> </a>
                                                                                </div>
                                                                            </div>
                                                                            <?php $x++; endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach;
                                                        $y++; endif; ?>
                                                    <div class="panel">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title text-dark">
                                                                <a data-parent="#accordion" data-toggle="collapse"
                                                                   href="#additional_product_attribute">Additional
                                                                    Product Attribute <span
                                                                        class="glyphicon glyphicon-chevron-down pull-right fav_drop_ico"></span></a>
                                                            </h4>
                                                        </div>
                                                        <div class="panel-collapse " id="additional_product_attribute">
                                                            <div class="panel-body">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Certification</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <select name="certifications[]"
                                                                                class="form-control select2" multiple
                                                                                title="Example: Organic, Suitable for Allergies Fair Trade..."
                                                                                data-width="100%">
                                                                            <option name="AFRDI Leather">AFRDI Leather
                                                                            </option>
                                                                            <option
                                                                                name="AFRDI - Australian Furnishing Research & Development Institute">
                                                                                AFRDI - Australian Furnishing Research &
                                                                                Development Institute
                                                                            </option>
                                                                            <option name="ASTM Certified">ASTM
                                                                                Certified
                                                                            </option>
                                                                            <option name="Australian Made">Australian
                                                                                Made
                                                                            </option>
                                                                            <option name="Eco Friendly">Eco Friendly
                                                                            </option>
                                                                            <option
                                                                                name="FSC - Forest Stewardship Council">
                                                                                FSC - Forest Stewardship Council
                                                                            </option>
                                                                            <option name="Fair Trade">Fair Trade
                                                                            </option>
                                                                            <option
                                                                                name="GECA - Good Environmental Choice Australia">
                                                                                GECA Good Environmental Choice Australia
                                                                            </option>
                                                                            <option name="Organic">Organic</option>
                                                                            <option
                                                                                name="PEFC - Programme for the Endorcement of Forest Certification">
                                                                                PEFC -Programme for the Endorcement of
                                                                                Forest Certification
                                                                            </option>
                                                                            <option name="PEFC">Timber Certificate
                                                                            </option>
                                                                            <option name="Suitable for Allergic">
                                                                                Suitable For Allergic
                                                                            </option>
                                                                        </select>
                                                                        <span class="text-sm text-dark">Select different certifications, that the product owns, or with which certifications the product was marked</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Certification"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Select product owned certifications and product test certificates ">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Product
                                                                        Warranty</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <textarea title="Product warranty (if any)" name="product_warranty" class="half_description" id="product_warranty"></textarea>
                                                                        <span class="text-sm text-dark">Example: 1 Year Warranty, leave blank if you the item does not have.</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Product Warranty"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Provide the warranty validity period eg. 1 Year Warranty, leave blank if you the item does not have.">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Waranty
                                                                        Type</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <select name="warranty_type[]"
                                                                                class="form-control select2" multiple
                                                                                title="Choose warranty type..."
                                                                                data-width="100%">
                                                                            <option name="service center">Service
                                                                                Center
                                                                            </option>
                                                                            <option name="Repair by vendor">Repair by
                                                                                vendor
                                                                            </option>
                                                                            <option name="replacement by vendor">
                                                                                Replacement by vendor
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Warranty Type"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Select the type of warranty service you want to offer">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-lg-3 col-md-3 col-sm-12 col-xs-12 control-label">Warranty
                                                                        address</label>
                                                                    <div class="col-lg-7 col-md-7 col-sm-11 col-xs-11">
                                                                        <textarea title="Warranty address" name="warranty_address" class="half_description" id="warranty_address"></textarea>
                                                                        <span class="text-sm text-dark">Example: 530A Aina Akingbala Street, Ikeja; Repair by vender: 39, Ajah road, Isheri, Lagos state.</span>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                                                        <a href="javascript:;" title="Warranty Address"
                                                                           data-placement="bottom" data-toggle="popover"
                                                                           tabindex="-1"
                                                                           data-trigger="focus"
                                                                           data-content="Address of warranty shop: e.g Our service center : 530A Aina Akingbala Street, Ikeja; Repair by vender: 39, Ajah road, Isheri, Lagos state.">
                                                                            <i class="demo-pli-question help_text"
                                                                               title="Help Text"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="product-variation-tab" class="tab-pane">
                                                <div class="table-responsive">
                                                    <table class="table table-center mar-top pricing_table">
                                                        <thead>
                                                        <tr>
                                                            <th>SKU *</th>
                                                            <?php if (empty($variation_name)) : ?>
                                                                <th class="min-w-td">Variation *</th>
                                                            <?php else: ?>
                                                                <th class="min-w-td"><?= ucfirst($variation_name); ?>
                                                                    *
                                                                </th>
                                                            <?php endif; ?>
                                                            <th>Quantity *</th>
                                                            <th>Unit Price *</th>
                                                            <th>Discounted Price</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="variation_body">
                                                        <tr data-row-id="1">
                                                            <td>
                                                                <div class="form-group-sm col-md-12">
                                                                    <input title="Seller SKU" type="text"
                                                                           class="form-control" name="sku[]" required/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group-sm col-md-12">
                                                                    <?php if (!empty($variation_name) && !empty($variation_options)) : ?>
                                                                        <select class="form-control" required
                                                                                name="variation[]" title="variation">
                                                                            <?php
                                                                            foreach ($variation_options as $option_name) : ?>
                                                                                <option value="<?= trim($option_name) ?>"><?= trim($option_name); ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    <?php else : ?>
                                                                        <input title="variation" type="text"
                                                                               class="form-control" autocomplete="off"
                                                                               name="variation[]"
                                                                               required/>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group-sm col-md-12">
                                                                    <input title="Quantity" type="number" min="1"
                                                                           max="100" class="form-control"
                                                                           name="quantity[]" required/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group-sm col-md-12">
                                                                    <input title="Price" type="text"
                                                                           class="form-control number amount" required
                                                                           name="sale_price[]"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group-sm">
                                                                    <input title="Discounted price" type="text"
                                                                           class="form-control number amount"
                                                                           name="discount_price[]"/>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group-sm">
                                                                    <div class="input-group date">
                                                                        <input data-provide="datepicker"
                                                                               class="form-control datepicker"
                                                                               data-date-format="mm/dd/yyyy"
                                                                               placeholder="mm/dd/yyyy"
                                                                               name="start_date[]"
                                                                               title="Starting date for this discount">
                                                                        <div class="input-group-addon">
                                                                            <i class="demo-pli-calendar-4"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group-sm">
                                                                    <div class="input-group date">
                                                                        <input data-provide="datepicker"
                                                                               class="form-control datepicker"
                                                                               data-date-format="mm/dd/yyyy"
                                                                               placeholder="mm/dd/yyyy"
                                                                               name="end_date[]"
                                                                               title="End date for this discount">
                                                                        <div class="input-group-addon">
                                                                            <i class="demo-pli-calendar-4"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="">
                                                                <div class="btn-group">
                                                                    <a class="btn btn-sm btn-default btn-hover-success demo-psi-add add-tooltip add_more"
                                                                       href="javascript:void(0);"
                                                                       data-original-title="Add Another Variation"
                                                                       data-container="body"></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div id="image-upload-tab" class="tab-pane mar-btm">
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Upload Images<span
                                                                class="glyphicon glyphicon-chevron-down pull-right fav_drop_ico"></span>
                                                        </h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <p>You can upload images up-to 6.</p>
                                                        <div class="dz-max-files-reached"></div>
                                                        <div class="bord-top pad-ver">
															<span class="btn btn-success fileinput-button dz-clickable">
                                                                    <i class="fa fa-plus"></i>
                                                                    <span>Add files...</span>
                                                                </span>
                                                            <div class="btn-group pull-right">
                                                                <button id="dz-remove-btn" class="btn btn-danger cancel"
                                                                        type="reset" disabled="">
                                                                    <i class="demo-psi-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div id="dz-previews">
                                                            <div id="dz-template" class="pad-top bord-top">
                                                                <div class="media">
                                                                    <div class="media-body">
                                                                        <div class="media-block">
                                                                            <div class="media-left">
                                                                                <img class="dz-img" data-dz-thumbnail>
                                                                            </div>
                                                                            <div class="media-body">
                                                                                <p class="text-main text-bold mar-no text-overflow"
                                                                                   data-dz-name></p>
                                                                                <span
                                                                                    class="dz-error text-danger text-sm"
                                                                                    data-dz-errormessage></span>
                                                                                <p class="text-sm" data-dz-size></p>
                                                                                <div id="dz-total-progress"
                                                                                     style="opacity:0">
                                                                                    <div
                                                                                        class="progress progress-xs active"
                                                                                        role="progressbar"
                                                                                        aria-valuemin="0"
                                                                                        aria-valuemax="100"
                                                                                        aria-valuenow="0">
                                                                                        <div
                                                                                            class="progress-bar progress-bar-success"
                                                                                            style="width:0%;"
                                                                                            data-dz-uploadprogress></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="media-right">
                                                                        <button data-dz-remove
                                                                                class="btn btn-xs btn-danger dz-cancel">
                                                                            <i class="demo-psi-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="panel-footer text-center">
                                        <input type="hidden" name="category_id" value="<?= $this->session->userdata('category_id'); ?>" />
                                        <input type="hidden" name="product_line" value="<?= $store_name; ?>" />
                                        <div class="box-inline">
                                            <button type="button" class="previous btn btn-primary">Previous</button>
                                            <button type="button" class="next btn btn-primary">Next</button>
                                            <!--                                            <button type="button" class="preview btn btn-primary">Preview</button>-->
                                            <button type="submit" class="finish btn btn-warning">Finish</button>
                                        </div>
                                    </div>
                                    <div id="processing"
                                         style="display:none;position: center;top: 0;left: 0;width: auto;height: auto%;background: #f4f4f4;z-index: 99;">
                                        <div class="text"
                                             style="position: absolute;top: 35%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
                                            <img src="<?= base_url('assets/img/load.gif'); ?>"
                                                 alt="Processing...">
                                            Processing the data. Please Wait! <Br>Meanwhile Please <b
                                                style="color: rgba(2.399780888618386%,61.74193548387097%,46.81068368248487%,0.843);">BE
                                                ONLINE</b>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="pad-btm" style="margin-bottom: 30px;"></div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php $this->load->view('templates/menu'); ?>
    </div>
    <?php $this->load->view('templates/footer'); ?>
    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script src="<?= base_url('assets/js/nifty.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/demo/nifty-demo.min.js'); ?>"></script>
<script type="text/javascript"> base_url = '<?= base_url(); ?>';</script>
<script src="<?= base_url('assets/plugins/dropzone/dropzone.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/demo/form-wizard.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>

<script type="text/javascript">
    $('.datepicker').datepicker({
        startDate: '0d'
    });

    $(document).on('nifty.ready', function () {
        Dropzone.autoDiscover = false;
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        let previewNode = document.querySelector("#dz-template");
        previewNode.id = "";
        let previewTemplate = previewNode.parentNode.innerHTML;

        previewNode.parentNode.removeChild(previewNode);
        let uplodaBtn = $('.finish');
        let removeBtn = $('#dz-remove-btn');
        let maxImageWidth = 1000,
            maxImageHeight = 1000,
            minImageWidth = 400,
            minImageHeight = 400;
        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: base_url + "product/process", // Set the url
            autoProcessQueue: false,
            addRemoveLinks: true,
            autoDiscover: false,
            paramName: 'file',
            maxFiles: 8,
            thumbnailWidth: 50,
            thumbnailHeight: 50,
            maxFilesize: 1000,
            previewTemplate: previewTemplate,
            previewsContainer: "#dz-previews", // Define the container to display the previews
            clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
            acceptedFiles: "image/*",
            uploadMultiple: true,
            parallelUploads: 100,
            accept: function (file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function () {
                    done(`Invalid file dimension, atleast 400 X 400 and maximum of 1000 X 1000. But image is having ${file.width} X ${file.height}. File won't be uploaded.`);
                };
            }
        });


        myDropzone.on("addedfile", function (file) {
            // Hookup the button
            uplodaBtn.prop('disabled', false);
            removeBtn.prop('disabled', false);
            file._captionLabel = Dropzone.createElement("<span class='text-sm text-dark'> &nbsp; Make this the featured Image &nbsp; </span>");
            file._captionBox = Dropzone.createElement(`<input id="${file.name}" type='radio' name='featured_image' checked value="${file.name}">`);
            file.previewElement.appendChild(file._captionBox);
            file.previewElement.appendChild(file._captionLabel);
            $('input[type="radio"]').first().prop('checked', true);
        });

        myDropzone.on("sendingmultiple", function (file, xhr, formData) {
            // Show the total progress bar when upload starts
            let formDataArray = $('.add_product_form').serializeArray();
            for (let i = 0; i < formDataArray.length; i++) {
                let formDataItem = formDataArray[i];
                formData.append(formDataItem.name, formDataItem.value);
            }
        });

        uplodaBtn.on('click', function (e) {
            $('#processing').show();
            e.preventDefault();
            if (myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            } else {
                $('#processing').hide();
                alert('Please select an image');
            }
        });
        myDropzone.on("successmultiple", function (files, response) {
            // Gets triggered when the files have successfully been sent.
            // Redirect user or notify of success.
            $('#processing').hide();
            if (response.status == 'error') {
                $('#processing').hide();
                $('#status').html(`<p class="alert alert-error">There was an error posting the product. <br /> ${response.message} </p>`).slideDown('fast').delay(4000).slideUp('slow');
            } else {
                $('#processing').hide();
                $('.add_product_form').trigger('reset');
                window.location.href = base_url + 'manage/?type=pending';
            }
        });
        myDropzone.on("errormultiple", function (files, response) {
            // Gets triggered when there was an error sending the files.
            $('#processing').hide();
            alert('There was an error sending the images' + response);
        });

        myDropzone.on('thumbnail', function (file) {
            if ((file.width > maxImageWidth || file.height > maxImageHeight) || (minImageWidth > file.width || minImageHeight > file.height)) {
                file.rejectDimensions();
            } else {
                file.acceptDimensions();
            }
        });
        removeBtn.on('click', function () {
            myDropzone.removeAllFiles(true);
            uplodaBtn.prop('disabled', true);
            removeBtn.prop('disabled', true);
        });

    });
    $.fn.rowCount = function () {
        return $('tr', $(this).find('tbody')).length;
    };
    let variation_name = `<td><div class="form-group-sm"><input title="variation" type="text" class="form-control" name="variation[]" /></div></td>`;
    <?php if( !empty($variation_options)) : ?>
    variation_name = `<td><div class="form-group-sm"><select class="form-control" required name="variation[]" title="variation">
    <?php foreach( $variation_options as $option) :?>
        <option value="<?= $option; ?>"><?= $option; ?></option>
    <?php endforeach; ?>
        </select></div></td>`;
    <?php endif; ?>
    $('.add_more').on('click', add_new_row);

    function add_new_row() {
        let row_id = $('.pricing_table').rowCount() * 1;
        let new_id = row_id + 1;
        $('.pricing_table tbody').append(`<tr id = "${new_id}_field">
				<td>
					<div class="form-group-sm col-md-12">
						<input title="Seller SKU" type="text" class="form-control" name="sku[]"  required/>
					</div>
				</td>
				${variation_name}

				<td>
					<div class="form-group-sm col-md-12">
						<input title="Quantity" type="number" min="1" max="100" class="form-control" name="quantity[]" required />
					</div>
				</td>
				<td>
					<div class="form-group-sm col-md-12">
							<input title="Sale Price" type="text" class="form-control number amount" required name="sale_price[]" required />
					</div>
				</td>
				<td>
					<div class="form-group-sm">
						<input title="Discounted price" type="text" class="form-control number amount" name="discount_price[]" />
					</div>
				</td>
				<td>
					<div class="form-group-sm">
								<div class="input-group date">
								<input data-provide="datepicker"
									   class="form-control datepicker"
									   data-date-format="mm/dd/yyyy"
									   placeholder="mm/dd/yyyy"
									   name="start_date[]"
									   title="Starting date for this variation">
								<div class="input-group-addon">
									<i class="demo-pli-calendar-4"></i>
								</div>
							</div>
					</div>
				</td>
				<td>
					<div class="form-group-sm">
					<div class="input-group date">
						<input data-provide="datepicker"
						   class="form-control datepicker"
						   data-date-format="mm/dd/yyyy"
						   placeholder="mm/dd/yyyy" name="end_date[]"
						   title="End date for this variation">

						   <div class="input-group-addon">
								<i class="demo-pli-calendar-4"></i>
							</div>
					</div>
					</div>
				</td>
				<td class="">
					<div class="btn-group">
						<a class="btn btn-sm btn-default btn-hover-success demo-psi-add add-tooltip add_more" href="javascript:void(0);" data-original-title="Add Another Variation" data-container="body" onclick="add_new_row()"></a>
						<a class="btn btn-sm btn-default btn-hover-danger demo-pli-trash delete_row" href="javascript:void(0);" data-target="${new_id}_field" data-original-title="Delete This Variation" data-container="body"></a>
					</div>
				</td>
                            </tr>`);

        $('.delete_row').on('click', function () {
            let target = $(this).data('target');
            $(`#${target}`).remove();
        });
        $('.datepicker').datepicker({
            startDate: '0d'
        });
    }

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({animation: true});

        $(".number").inputFilter(function (value) {
            return /^-?\d*$/.test(value);
        });

        $('.amount').on('keyup', function () {
            let n = $(this).val();
            let resp = addCommas(n);
            $(this).val( resp );
        });

        $('.product_description').summernote({
            tabsize: 2,
            height: '150px',
            disableDragAndDrop: true,
            shortcuts: false,
            popatmouse: false,
            toolbar: [
                ['style', ['bold', 'italic']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture']],
                ['view', ['fullscreen', 'help']]
            ],
            popover: {
                image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            },
            callbacks: {
                onImageUpload: function(files) {
                    sendFile(files[0]);
                },
                onMediaDelete: function(target) {
                    deleteFile(target[0].src);
                }
            }
        });

        function sendFile(file){
            data = new FormData();
            data.append("file", file);
            $('#product_description_image').css('display', 'block');
            $('.img_text').text('Please hold on. Image is under processing...');
            $.ajax({
                url: base_url + 'product/description_image_upload',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {
                    var image = $('<img>').attr('src', data);
                    $('#product_description').summernote("insertNode", image[0]);
                    $('#product_description_image').css('display', 'none');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus+" "+errorThrown);
                    $('#product_description_image').css('display', 'none');
                }
            });
        }

        function deleteFile(src) {
            $.ajax({
                data: {src : src},
                type: "POST",
                url: base_url + "product/decription_image_remove",
                cache: false,
                success: function(resp) {
                    console.log(resp);
                }
            });
        }

        $('.half_description').summernote({
            placeholder: 'Write here...',
            height: '150px',
            focus: true,
            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["view", ["fullscreen"]]
            ],
        });
    });

    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        };
    }(jQuery))

</script>
</body>
</html>
