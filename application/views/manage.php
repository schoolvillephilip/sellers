<?php $this->load->view('templates/meta_tags'); ?>
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
                    <li><a href="#">Manage</a></li>
                    <li class="active"><?= cleanit($this->uri->segment(2)); ?> products</li>
                </ol>
            </div>
            <div id="page-content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Showing all products</h3>
                    </div>
                    <?php $this->load->view('msg_view'); ?>
                    <div class="panel-body">
                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th class="min-tablet">Created On</th>
                                <th class="min-tablet">Average Sale Price(N)</th>
                                <th class="min-tablet">Avg Discount Price(N)</th>
                                <th class="min-desktop">Status</th>
                                <th class="min-desktop min-tablet">Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td>
                                        <?= word_limiter($product['product_name'], 15); ?>
                                    </td>
                                    <td><?php if ($product['sku'] !== null) echo $product['sku']; ?></td>
                                    <td><?php if ($product['created_on']) echo neatDate($product['created_on']); ?></td>
                                    <td><?php if ($product['sale_price']) echo ngn($product['sale_price']); ?></td>
                                    <td><?php if ($product['sale_price']) echo ngn($product['discount_price']); ?></td>
                                    <td><?php if ($product['sale_price']) echo productStatus($product['product_status']); ?></td>
                                    <td><a class="btn-link" href="<?= base_url('manage/stat/' . $product['id']); ?>">View Product Detail</a></td>
                                    <?php if (in_array($product['product_status'], array('pending', 'missing_images'))): ?>
                                        <td>
                                            <a href="<?= base_url('product/edit/' . $product['id']); ?>">
                                                <i class="fa fa-plus" title="Edit"></i> Edit Product
                                            </a>
                                        </td>
                                    <?php elseif ($product['product_status']) : ?>
                                        <td>
                                            <a href="<?= base_url(urlify($product['product_name'], $product['id'])); ?>">
                                                <i class="fa fa-plus" title="Edit"></i> View Product Online
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
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
<script>
    $(document).ready(function (x) {
        $('#demo-dt-basic').dataTable({
            "responsive": true,
            "language": {
                "paginate": {
                    "previous": '<i class="demo-psi-arrow-left"></i>',
                    "next": '<i class="demo-psi-arrow-right"></i>'
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
</body>
</html>
