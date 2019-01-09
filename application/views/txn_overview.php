<?php $this->load->view('templates/meta_tags'); ?>
</head>
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">
    <?php $this->load->view('templates/head_navbar'); ?>
    <div class="boxed">
        <div id="content-container">
            <div id="page-head">
                <div id="page-title">
                    <h1 class="page-header text-overflow">Transaction Overview</h1>
                </div>
                <ol class="breadcrumb">
                    <li><i class="demo-pli-home"></i></li>
                    <li>Reports</li>
                    <li>Sales Report</li>
                    <li class="active">Transaction overview</li>
                </ol>
            </div>
            <div id="page-content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Transaction Overview</h3>
                    </div>
                    <div class="panel-body">
                        <div id="om-panel-order" class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Payout Tracking</h3>
                                <?php if (!$transactions) : ?>
                                    <h3 class="text-danger text-center">No Data Available!</h3>
                                <?php endif; ?>
                            </div>
                            <div class="panel-body">
                                <div id="txn_chart" style="height: 350px; margin-bottom: 40px;"></div>
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
    $(document).ready(function() {
        $("#demo-dt-selection").dataTable({
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
<script>
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'txn_chart',
        data: [
            <?php foreach( $transactions as $chart) : ?>
            {month: '<?= $chart->omonth; ?>', value: <?= $chart->amount; ?>},
            <?php endforeach;?>
        ],
        xkey: 'month',
        ykeys: ['value'],
        xLabelFormat: function (x) {
            return months[x.getMonth()];
        },
        labels: ['Amount Received']
    });
</script>
</body>
</html>
