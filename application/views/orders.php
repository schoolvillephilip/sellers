<?php $this->load->view('templates/meta_tags'); ?>
</head>
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">
    <?php $this->load->view('templates/head_navbar'); ?>
    <div class="boxed">
        <div id="content-container">
            <div id="page-head">
                <div id="page-title">
                    <h1 class="page-header text-overflow">Orders</h1>
                </div>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="demo-pli-home"></i></a></li>
                    <li><a href="#">Manage</a></li>
                    <li class="active"><?= ucfirst($this->input->get('type')) ?> Orders</li>
                </ol>
            </div>
            <div id="page-content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Showing all <?= ucfirst($this->input->get('type')) ?></h3>
                    </div>
                    <div class="panel-body">
                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th class="min-tablet">Variation Ordered.</th>
                                <th class="min-tablet">Qty / Amount</th>
                                <th class="min-tablet">OM Commission</th>
                                <?php
                                $type = $this->input->get('type');
                                if (empty($type)) : ?>
                                    <th class="min-tablet">Order Status</th>
                                <?php endif; ?>
                                <th class="min-tablet">Ordered Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td>
                                        <span>
                                            <img width="55"
                                                   src="<?= PRODUCTS_IMAGE_PATH . $order->image_name; ?>" />
                                            <a href="<?= base_url('manage/stat/' . $order->pid); ?>" class="btn-link"><?= character_limiter($order->product_name, 30); ?></a>
                                        </span>
                                    </td>
                                    <td><?= $order->variation; ?></td>

                                    <td><?= $order->qty . ' Item (s) - <span class="text text-info"> / ' . ngn($order->amount) . '</span>'; ?></td>
                                    <td><?= ngn($order->commission); ?></td>

                                    <?php
                                    $type = $this->input->get('type');
                                    if (empty($type)) :
//                                        $json = json_decode($order->status);
//                                        $last = array_keys((array)$json);
//                                        $last =  $last[0];
                                    ?>
                                        <td class="min-tablet"><?= productStatus($order->active_status); ?></td>
                                    <?php endif; ?>
                                    <td><?= neatDate($order->order_date) .' ' . neatTime($order->order_date); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-2">
                                    <?= $pagination; ?>
                                </div>
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
<script>
    $(document).ready(function () {
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
