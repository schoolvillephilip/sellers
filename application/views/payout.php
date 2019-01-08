<?php $this->load->view('templates/meta_tags'); ?>
<style>
    .list-group-item {
        border: 0 !important;
    }

    td p {
        margin: 12px;
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
                                    <a href="javascript:;" onclick="trigger('#inc_trig');">
                                        <div class="pad-all text-center">
                                            <span class="text-3x text-thin">5</span>
                                            <p>INCOMING TRANSACTIONS</p>
                                            <i class="demo-pli-credit-card-2 icon-lg"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-bordered-purple panel-colorful">
                                    <div class="pad-all text-center">
                                        <span class="text-3x text-thin">&#8358; 0</span>
                                        <p>PAYOUT HISTORY</p>
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
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018
                                                                <i class="demo-pli-thunder"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018
                                                                <i class="demo-pli-thunder"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018
                                                                <i class="demo-pli-thunder"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018
                                                                <i class="demo-pli-thunder"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018
                                                                <i class="demo-pli-thunder"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
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
                                                <button class="btn btn-primary btn-rounded btn-labeled"
                                                        onclick="PrintElem('acc_state_table');">
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
                                        <th class="min-tablet">Fee</th>
                                        <th class="min-desktop">Date Reconciled</th>
                                        <th class="min-desktop">Payment Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>06/01/2019</td>
                                        <td>PTX12039</td>
                                        <td>&#8358; 320,800</td>
                                        <td>&#8358; 62.70</td>
                                        <td>12/01/2019</td>
                                        <td>Paid</td>
                                    </tr>
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
<?php $this->load->view('templates/scripts'); ?>
<script>
    function trigger(e) {
        $(e).click();
    }
    $(document).ready(function() {
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
