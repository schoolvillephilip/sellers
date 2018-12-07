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
                    <li class="active"><?= ucfirst($this->input->get('type')) ?>Orders</li>
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
                                <th colspan="2">Product Name</th>
                                <th class="min-tablet">Ordered Date</th>
                                <th class="min-tablet">Qty (Amount)</th>
                                <td class="min-tablet">Ordered.</td>
                                <?php $type = $this->input->get('type');
                                if (empty($type)) : ?>
                                    <td class="min-tablet">Order Status</td> <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td colspan="2">
                                        <span><img width="65"
                                                   src="<?= base_url('data/products/' . $order->pid . '/' . $order->image_name); ?>"></span>
                                        <?= character_limiter($order->product_name, 30); ?>
                                        <a href="<?= base_url('order/detail/' . $order->orid); ?>"></a>
                                    </td>
                                    <td><?= neatDate($order->order_date); ?></td>
                                    <td><?= $order->qty . ' Item (s) - <span class="text text-danger"> ( ' . ngn($order->amount) . ' )</span>'; ?></td>
                                    <td><?= $order->variation; ?></td>
                                    <?php $type = $this->input->get('type');
                                    if (empty($type)) : ?>
                                        <td class="min-tablet"><?= productStatus($order->status); ?></td> <?php endif; ?>
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
            }
        });
    });
</script>
</body>
</html>
