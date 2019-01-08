<?php $this->load->view('templates/meta_tags'); ?>
<style>
    .list-group-item {
        border: 0 !important;
    }

    td p {
        margin: 12px;
    }
    table.modal_table td, table.modal_table th{
        padding:10px;
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
                    <h1 class="page-header text-overflow">Request Payout</h1>
                </div>
                <ol class="breadcrumb">
                    <li><i class="demo-pli-home"></i></li>
                    <li>Reports</li>
                    <li class="active">Request Payout</li>
                </ol>
            </div>
            <div id="page-content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Request Payout</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-bordered-dark panel-colorful">
                                    <div class="pad-all text-center">
                                        <span class="text-3x text-thin">&#8358; 0 </span>
                                        <p>INCOMING BALANCE</p>
                                        <i class="demo-pli-credit-card-2 icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-bordered-primary panel-colorful">
                                    <div class="pad-all text-center">
                                        <span class="text-3x text-thin"><?= ngn($profile->balance) ?></span>
                                        <p>AVAILABLE BALANCE</p>
                                        <i class="demo-pli-credit-card-2 icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-bordered-pink panel-colorful">
                                    <a href="<?= base_url('orders/?type=delivered')?>">
                                        <div class="pad-all text-center">
                                            <span class="text-3x text-thin"><?//= count($incoming_transactions) - 1;?>2</span>
                                            <p>INCOMING TRANSACTIONS</p>
                                            <i class="demo-pli-credit-card-2 icon-lg"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-bordered-purple panel-colorful">
                                    <div class="pad-all text-center">
                                        <span class="text-3x text-thin"><?= ngn($paid->amt); ?></span>
                                        <p>PAYOUT HISTORY - PAID</p>
                                        <i class="demo-pli-credit-card-2 icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $this->load->view('msg_view'); ?>
                        <div class="row">
                            <div class="col-md-5" style="padding:20px 10px 0;">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-control">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#demo-tabs2-box-2" id="inc_trig">Incoming
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="panel-title"></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="demo-tabs2-box-2" class="tab-pane fade in active">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <i class="demo-pli-thunder text-main icon-3x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="text-main text-lg mar-no">Incoming</p>
                                                        All Incoming Payments
                                                    </div>
                                                </div>
                                                <div class="txn nano has-scrollbar"
                                                     style="height:290px;margin-top:10px;">
                                                    <div class="list-group nano-content">
                                                        <?php if($orders) : foreach( $orders as $order ): ?>
                                                        <a href="#" class="list-group-item incoming_info" data-name="Order OMI-2100" data-order-id="<?= $order->order_code; ?>">
                                                            <h5 class="list-group-item-text">Order <?= $order->order_code; ?>
                                                                <i class="demo-pli-thunder"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                        <?php endforeach; else :?>
                                                        <p class="list-group-item-heading text-bold">No Pending Order Payment.</p>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="text-center">
                                    <h3>REQUEST PAYOUT</h3>
                                    <?= form_open('account/payout'); ?>
                                    <div id="acc_det" class="tab-pane"
                                         style="margin-top:20px;border:1px solid #35bbae;height:fit-content;padding:30px 0;">
                                        <h4>Confirm Payout Details</h4>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-lg-4 control-label">Bank Name</label>
                                                <div class="col-lg-7">
                                                    <select name="required" name="bank_name" class="form-control"
                                                            disabled>
                                                        <option value="">-- Select Bank Name--</option>
                                                        <?php $banks = explode(',', lang('banks'));
                                                        foreach ($banks as $bank) :
                                                            ?>
                                                            <option <?php if (trim($bank) == $profile->bank_name) echo 'selected'; ?>
                                                                    value="<?= trim($bank); ?>"><?= trim($bank); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-lg-4 control-label">Account Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control"
                                                           value="<?= $profile->account_name; ?>" name="account_name"
                                                           placeholder="Account Name" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-lg-4 control-label">Account Number</label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control"
                                                           value="<?= $profile->account_number; ?>"
                                                           name="account_number"
                                                           placeholder="XXXXXXXXXX"
                                                           required disabled>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-lg-4 control-label" for="account_type">Account
                                                    Type</label>
                                                <div class="col-lg-7">
                                                    <select class="form-control" name="account_type" required disabled>
                                                        <option <?php if ($profile->account_type == 'current') echo 'selected'; ?>
                                                                value="current">Current
                                                        </option>
                                                        <option <?php if ($profile->account_type == 'savings') echo 'selected'; ?>
                                                                value="savings">Savings
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-lg-4 control-label">Amount &#8358;</label>
                                                <div class="col-lg-7">
                                                    <input type="number" class="form-control" required
                                                           name="payout_amount"
                                                           placeholder="0.00"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-lg-4 control-label" for="payout_password">Confirm
                                                    Password</label>
                                                <div class="col-lg-7">
                                                    <input type="password" autocomplete="off" required
                                                           class="form-control" name="payout_password"
                                                           placeholder="Enter password"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary btn-rounded btn-labeled">
                                                    <i class="btn-label demo-psi-receipt-4"></i>Request Payout
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center">Payout History</h3>
                                <table id="dt-history" class="table table-striped table-bordered" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>Date Initiated</th>
                                        <th>Payout ID</th>
                                        <th class="min-tablet">Amount</th>
                                        <th class="min-desktop">Date Reconciled</th>
                                        <th class="min-desktop">Payment Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($histories as $history) : ?>
                                        <tr>
                                            <td><?= date('Y/m/d H:i:s', strtotime($history->date_requested)); ?></td>
                                            <td>PTX<?= $history->id; ?></td>
                                            <td><?= ngn($history->amount); ?></td>
                                            <td>
                                                <?php if($history->date_approved) : ?>
                                                    <?= date('l, F d', strtotime($history->date_approved)); ?>
                                                <?php else : ?>
                                                    <span class="text-info">No action yet.</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= paymentStatus($history->status); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
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
<div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table-responsive table-hover modal_table" width="100%" cellpadding="0" cellspacing="0">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Item
                                </th>
                                <th style="text-align: center;">
                                    Quantity
                                </th>
                                <th style="text-align: center;">
                                    Price
                                </th>
                                <th style="text-align: center;">
                                    Sub Total
                                </th>
                                <th style="text-align: center;">
                                    Commission (-)
                                </th>
                                <th style="text-align: right;">
                                    Total
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="font-size: 12px;">
                                <td>1</td>
                                <td>iPhone XS Max</td>
                                <td style="text-align: center;">2</td>
                                <td style="text-align: center;">&#8358; 320,000</td>
                                <td style="text-align: center;">&#8358; 640,000</td>
                                <td style="text-align: center;">&#8358; 32,000</td>
                                <td style="text-align: right;">&#8358; 608,000</td>
                            </tr>
                            </tbody>
                            <tfoot style="font-weight: bolder;">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;border-top: 1px solid #4f4f4f;border-bottom: 1px solid #4f4f4f;">Gross Total</td>
                                <td style="text-align: right;border-top: 1px solid #4f4f4f;border-bottom: 1px solid #4f4f4f;">&#8358; 608,000</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/scripts'); ?>
<script>
    $('.incoming_info').on('click', function () {
        let self = $(this);
        let title = self.data('name');
        let oid = self.data('order-id');

        $.ajax({
            url: base_url + 'account/get_order_detail',
            method: 'post',
            data: {ocode: oid},
            dataType: 'json',
            success: function (d) {
                $.each(d, function (k, value) {

                });
            },
        });
        $('#info_modal')
            .find('.modal-header > h5')
            .text(title).end()
            .modal('show');
    });
    $(document).ready(function () {
        $("#dt-history").dataTable({
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
