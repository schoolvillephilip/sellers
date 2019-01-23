<?php $this->load->view('templates/meta_tags'); ?>
<link href="<?= base_url('assets/plugins/unitegallery/css/unitegallery.min.css'); ?>" rel="stylesheet">
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
                    <li><a href="#"><i class="demo-pli-home"></i></a></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="<?= base_url('manage');?>">Products</a></li>
                    <li class="active"><?= ucwords($product->product_name); ?></li>
                </ol>
            </div>
            <div id="page-content">
                <div class="row">
                    <?php $this->load->view('msg_view'); ?>
                    <div class="col-md-3">
                        <p>
                            <img class="pad-all"
                                 src="<?= PRODUCTS_IMAGE_PATH . $product->image_name; ?>"
                                 alt="<?= $product->product_name; ?>"
                                 title="<?= $product->product_name; ?>" style="max-width: 330px;">
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title text-bold"><?= ucwords($product->product_name); ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td><strong>Posted On</strong></td>
                                            <td><?= neatDate($product->created_on) . ', ' . neatTime($product->created_on); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Product ID:</strong></td>
                                            <td><?= $product->sku; ?></td>
                                        </tr>
                                        <tr>
                                            <?php $category = $this->seller->get_row('categories', 'name', "( id = {$product->category_id} )"); ?>
                                            <td><strong>Category Name:</strong></td>
                                            <td><?= !empty($category->name) ? $category->name : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Product Brand Name:</strong></td>
                                            <td><?= $product->brand_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Model:</strong></td>
                                            <td><?= $product->model; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Main Color</strong></td>
                                            <td><?= $product->main_colour; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Main Material:</strong></td>
                                            <td><?= $product->main_material; ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel bg-mint panel-colorful">
                            <div class="pad-all text-center">
                                <span class="text-3x text-thin"><?= is_null($product->quantity_sold) ? 0 : $product->quantity_sold; ?></span>
                                <p>Sales</p>
                                <i class="demo-pli-shopping-bag icon-lg"></i>
                            </div>
                        </div>
                        <div class="panel media middle">
                            <div class="media-left bg-mint pad-all">
                                <i class=" demo-pli-bag-coin icon-3x"></i>
                            </div>
                            <div class="media-body pad-all">
                                <p class="text-2x mar-no text-semibold text-main"><?= ($product->quantity_sold > 0) ? ngn($product->amount/$product->quantity_sold) : 0; ?></p>
                                <p class="text-muted mar-no">Total Amount Sold</p>
                            </div>
                        </div>
                        <div class="panel media middle">
                            <div class="media-left bg-purple pad-all">
                                <i class="demo-pli-bag-coin icon-3x"></i>
                            </div>
                            <div class="media-body pad-all">
                                <p class="text-2x mar-no text-semibold text-main"><?= is_null($product->views) ? 0 : $product->views; ?></p>
                                <p class="text-muted mar-no">Product Views</p>
                            </div>
                        </div>
                        <div class="panel media pad-all bg-info">
                            <div class="media-left">
					                        <span class="icon-wra icon-wap-sm bg-ifo">
					                        <i class=" demo-pli-add-cart icon-3x"></i>
					                        </span>
                            </div>
                            <div class="media-body">
                                <p class="text-2x mar-no text-semibold"><?= $product->variation_qty - (is_null($product->quantity_sold) ? 0 : $product->quantity_sold) ?></p>
                                <p class="mar-no">Items Available In Stock</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($product->attributes)) : ?>
                    <div class="panel" id="pr-spec">
                    <div class="panel-heading">
                        <h3 class="panel-title">Product Specifications</h3>
                    </div>
                    <div class="panel-body">
                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $attributes = json_decode($product->attributes);
                            foreach ($attributes as $key => $value) :
                                ?>
                                <tr>
                                    <td><?= $key ?></td>
                                    <td><?= $value; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                <div class="panel" id="pr-detail">
                    <div class="panel-heading">
                        <div class="panel-control">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#demo-tabs-box-1" data-toggle="tab">Overview</a></li>
                            </ul>
                        </div>
                        <h3 class="panel-title">Full Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="demo-tabs-box-1">
                                <p class="text-main text-semibold">Product Frontline</p>
                                <p><?= $product->product_line; ?></p>
                                <p class="text-main text-semibold">Product Description</p>
                                <p><?= $product->product_description; ?></p>
                                <p class="text-main text-semibold">Certifications</p>
                                <p>
                                    <?php

                                    if (!empty($product->certifications)) {
                                        $certifications = json_decode($product->certifications);
                                        foreach ($certifications as $certification) echo $certification . ',';
                                    } else {
                                        echo 'No certification';
                                    }

                                    ?>
                                </p>
                                <p class="text-main text-semibold">Warranty Type</p>
                                <p>
                                    <?php if (!empty($product->warranty_type)) {
                                        $warranty = json_decode($product->warranty_type);
                                        foreach ($warranty as $type) echo $type . ', ';
                                    } ?>
                                </p>
                                <p class="text-main text-semibold">Product Warranty</p>
                                <p><?= $product->product_warranty; ?></p>
                                <p class="text-main text-semibold">Warranty Address</p>
                                <p><?= $product->warranty_address; ?></p>
                            </div>
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

<?php $this->load->view('templates/scripts'); ?>
<script src="<?= base_url('assets/plugins/unitegallery/js/unitegallery.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/unitegallery/themes/slider/ug-theme-slider.js'); ?>"></script>
<script>
    $('#demo-dt-basic').dataTable({
        "responsive": true,
        "language": {
            "paginate": {
                "previous": '<i class="demo-psi-arrow-left"></i>',
                "next": '<i class="demo-psi-arrow-right"></i>'
            }
        }
    });
</script>
<script>
    $(document).on('nifty.ready', function () {
        $("#demo-gallery").unitegallery();
        $("#demo-gallery-2").unitegallery({
            slider_transition: "fade"
        });
        $("#demo-gallery-3").unitegallery({
            slider_enable_text_panel: true,
            slider_enable_bullets: false
        });
        $("#demo-gallery-4").unitegallery({
            slider_progress_indicator_type: "bar"
        });
    });
</script>
</body>
</html>
