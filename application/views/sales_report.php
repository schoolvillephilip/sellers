<?php $this->load->view('templates/meta_tags'); ?>
<style>
    #sales_chart {
        height: 410px;
        border: 1px solid #dadada;
    }

    @media screen and (max-width: 991px) {
        #sales_chart {
            margin: 10px 0 10px;
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
                    <h1 class="page-header text-overflow">Sales Report</h1>
                </div>
                <ol class="breadcrumb">
                    <li><i class="demo-pli-home"></i></li>
                    <li>Reports</li>
                    <li class="active">Sales Report</li>
                </ol>
            </div>
            <div id="page-content">
                <div id="om-panel-order" class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reports</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-12 panel-bordered-default" style="height: 145px;">
                                        <h5 style="margin-top:35px;">Total Sales</h5>
                                        <h2><?= ngn($total_sales);?></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 panel-bordered-default"
                                         style="height: 145px;margin-top:7.5px;">
                                        <h5 style="margin-top:35px;">Total Commission</h5>
                                        <h2><?= ngn($commission); ?></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 panel-bordered-default"
                                         style="height: 145px;margin-top:7.5px;">
                                        <h5 style="margin-top:35px;">Total Earned</h5>
                                        <h2><?= ngn($total_sales - $commission); ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4"><h4 class="">Orders Chart</h4></div>
                                    <div class="col-md-8">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <select id="order_filter" class="col-lg-9 col-md-9 col-sm-9 col-xs-9 form-control" name="order_filter">
                                                    <option value="daily" selected>Filter By - Daily</option>
                                                    <option value="weekly">Filter By - Weekly</option>
                                                    <option value="monthly">Filter By - Monthly</option>
                                                    <option value="yearly">Filter By - Yearly</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="sales_chart"></div>
                            </div>
                            <div id="processing"
                                 style="display:none;position: center;top: 0;left: 0;width: auto;height: auto%;background: #f4f4f4;z-index: 99;">
                                <div class="text"
                                     style="position: absolute;top: 35%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
                                    <img src="<?= base_url('assets/img/load.gif'); ?>"
                                         alt="Processing...">
                                        Processing the data. Please Wait!
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-12 panel-bordered-default" style="height: 220px;">
                                        <h5 style="margin-top:70px;">Total Order This Year</h5>
                                        <h2><?= (int) $order_chart['total_yearly']; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-12">
                                <h5 class="text text-info">Your Top 20 Products Ordered.</h5>
                                <table id="top_selling_products" class="table table-striped table-bordered"
                                       cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th width="10%">S/N</th>
                                        <th width="40%" class="min-tablet">Product Name</th>
                                        <th width="20%" class="min-desktop">Orders Completed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $x = 1; foreach($top_orders as $order) :?>
                                        <tr>
                                            <td><?= $x; ?></td>
                                            <td>
                                                <a href="<?= base_url('manage/stat/' . $order->id); ?>" class="btn-link"><?= word_limiter($order->product_name, 20); ?></a>
                                            </td>
                                            <td><?= $order->no_of_sales; ?></td>
                                        </tr>
                                    <?php $x++; endforeach; ?>
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
</body>
<script>
    $(document).ready(function () {
        $("#top_selling_products").dataTable({
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
        let type = $('#order_filter').val();
        $.ajax({
            url : base_url + 'ajax/load_sales_data',
            type : 'GET',
            data : {'type' : type },
            success : function(response) {
                moris(response);
            }
        });

        $('#order_filter').on('change', function(){
            let type = $(this).val();
            $('#sales_chart').empty();
            $.ajax({
                url : base_url + 'ajax/load_sales_data',
                type: 'POST',
                data : {'type' : type },
                success : function( response ){
                    // response = JSON.parse(response);
                    if( response.length < 0) alert('No data available for the filter');
                    moris( response );
                }
            })
        });

        function moris( data ){

            Morris.Bar({
                element: 'sales_chart',
                data: data,
                xkey: "date",
                ykeys: "q",
                labels: ['Total Order'],
                gridEnabled: true,
                gridLineColor: 'rgba(0,0,0,.1)',
                gridTextColor: '#6b7880',
                gridTextSize: '11px',
                barColors: ['#179278'],
                resize:true,
                hideHover: 'auto'
            });
        }
    });


</script>
</html>
