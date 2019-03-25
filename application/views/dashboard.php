<?php $this->load->view('templates/meta_tags'); ?>
<style>
    .draft_notification { 
        transition: all 1.2s ease-in-out; 
        color:#f03426;
        -webkit-transition: all 1.2s ease-out;
        -moz-transition: all 1.2s ease-out;
        -o-transition: all 1.2s ease-out;
        transition: all 1.2s ease-out;
        animation: color-me-in 10s infinite;
    }
    .draft_notification:hover { 
        color:green;
        font-size:14px;
    }
    @keyframes color-me-in {
        0% {
            color: orange;
        }
        20%{
            color: yellow;
        }
        40% {
            color: whitesmoke;
        }
        60%{
            color: orange;
        }
        80% {
            color: yellow;
        }
        100% {
            color: whitesmoke;
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
				<div class="pad-all text-center">
                <?php $uid = $this->session->userdata('logged_id');?>
					<h3>Hello <?= ucwords($profile->first_name) . ' ' . ucwords($profile->last_name); ?></h3>
					<?php $draft_count = count($this->seller->get_product($uid, "draft"));?>
					<?php if($draft_count > 0):?>
                    <a href="<?= base_url('manage/?type=draft'); ?>" class="draft_notification">You have <?= $draft_count?> Unfinished Products in your draft.</a>
<?php else:?>
                    <p>Welcome back to your dashboard!</p>
<?php endif;?>
				</div>
			</div>
			<div id="page-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-bordered-info panel-colorful media middle pad-all">
                            <div class="media-left">
                                <div class="pad-hor">
                                    <i class="demo-psi-cart-coin icon-3x"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <p class="text-2x mar-no text-semibold">Top Viewed Products</p>
                                <div>
                                    <div class="pad-all text-center">
                                        <?php if($top_views) : foreach( $top_views as $top_view ) : ?>
                                            <p class="mar-no">
                                                <span class="pull-right text-bold"><?= $top_view->views; ?></span> <?= character_limiter($top_view->product_name, 20);?>
                                            </p>
                                        <?php  endforeach; else: ?>
                                        <h5 class="text-dark">You don't have any product listed yet!</h5>
                                            <span><a href="<?= base_url('product/create');?>">Create Product Now</a> </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-bordered-mint panel-colorful media middle pad-all">
                            <div class="media-left">
                                <div class="pad-hor">
                                    <i class="demo-psi-credit-card-2 icon-3x"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <p class="text-2x mar-no text-semibold"><?= $completed_orders->total + $other_orders->total;?></p>
                                <p class="mar-no">Items</p>
                                <div>
                                    <div class="pad-all">
                                        <p class="mar-no">
                                            <span class="pull-right text-bold"><?= $completed_orders->total; ?></span> Completed Sales
                                        </p>
                                        <p class="mar-no">
                                            <span class="pull-right text-bold"><?= $other_orders->total; ?></span> Total (Pending , Failed, Cancelled, Returned)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-bordered-purple panel-colorful media middle pad-all">
                            <div class="media-left">
                                <div class="pad-hor">
                                    <i class="demo-psi-refresh icon-3x"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <p class="text-2x mar-no text-semibold"><?= $dispute->total; ?></p>
                                <p class="mar-no">Disputes</p>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div id="demo-panel-network" class="panel">
                            <div class="row">
                                <br />
                                <div class="col-md-6 col-md-offset-3">
                                    <select id="order_filter" class="col-lg-9 col-md-9 col-sm-9 col-xs-9 form-control" name="order_filter">
                                        <option value="daily" selected>Filter By - Daily</option>
                                        <option value="weekly">Filter By - Weekly</option>
                                        <option value="monthly">Filter By - Monthly</option>
                                        <option value="yearly">Filter By - Yearly</option>
                                    </select>
                                </div>
                            </div>

                            <br />
                            <div class="panel-heading">
								<h3 class="panel-title">Sales Track</h3>
							</div>
							<div class="panel-body">
                                <div class="alert alert-dark" id="alert" style="display: none;">No data available for the selection</div>
								<div id="sellerchart" style="height: 250px; margin-bottom: 40px;"></div>

								<div class="row">
									<div class="col-lg-3">
										<p class="text-semibold text-uppercase text-main">Today</p>
										<div class="row">
											<div class="col-xs-12">
												<div class="media">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="col-xs-12 text-sm" style="margin-top:5px;">
											<p>
												<span>Min Sale :</span>
												<span class="pad-lft text-semibold">
					                                        <span class="text-lg"><?= ngn($sales->min_sale); ?></span>
					                                        </span>
											</p>
											<p>
												<span>Max Sale :</span>
												<span class="pad-lft text-semibold">
					                                        <span class="text-lg"><?= ngn($sales->max_sale); ?></span>
					                                        </span>
											</p>
										</div>
									</div>
									<div class="col-lg-3">
										<p class="text-uppercase text-semibold text-main">Total Sales</p>
										<ul class="list-unstyled">
											<li>
												<div class="media pad-btm">
													<div class="media-left">
														<span class=" text-thin text-main text-bold"
															  style="font-size: 18px;"><?= ngn($sales->total_amount); ?></span>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Quick Order Status</h3>
							</div>
                            <div class="panel-body">
                                <table id="order-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                        <th class="min-tablet">Ordered On</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($orders as $order) : ?>
                                        <tr>
                                            <td><a href="<?= base_url('manage/stat/' . $order->product_id); ?>" class="btn-link"><?= '#'.$order->order_code; ?></a></td>
                                            <td><a href="<?= base_url('manage/stat/' . $order->product_id); ?>"><?= character_limiter($order->product_name, 20)?></a></td>
                                            <td><?= $order->qty; ?></td>
                                            <td><?= ngn( $order->amount); ?></td>
                                            <td><?= neatDate($order->order_date); ?></td>
                                        </tr>
                                    <?php endforeach;?>
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
    $(document).ready(function (x) {
        $('#order-table').dataTable( {
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
        } );
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
            $('#alert').css({'display':'none'});
            let type = $(this).val();
            $('#sellerchart').empty();
            $.ajax({
                url : base_url + 'ajax/load_sales_data',
                type: 'POST',
                data : {'type' : type },
                success : function( response ){
                    if( response.length == 0) {
                        $('#alert').css({'display':'block'});
                    }
                    moris( response );
                }
            })
        });

        function moris( data ){

            Morris.Line({
                element: 'sellerchart',
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
</body>
</html>
