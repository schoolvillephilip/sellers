<?php $this->load->view('templates/meta_tags'); ?>
<style>
    .list-group-item{
        border:0 !important;
    }

</style>
</head>
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">
    <!--NAVBAR-->
    <!--===================================================-->
    <?php $this->load->view('templates/head_navbar'); ?>
    <!--===================================================-->
    <!--END NAVBAR-->

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">
            <div id="page-head">
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow">Account Statement</h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->
                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
                    <li><i class="demo-pli-home"></i></li>
                    <li>Reports</li>
                    <li class="active">Account Statement</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
            </div>
            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Account Statement</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-bordered-dark panel-colorful">
                                    <div class="pad-all text-center">
                                        <span class="text-3x text-thin">&#8358; 0</span>
                                        <p>DUE AND UNPAID</p>
                                        <i class="demo-pli-credit-card-2 icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-bordered-primary panel-colorful">
                                    <div class="pad-all text-center">
                                        <span class="text-3x text-thin">&#8358; 0</span>
                                        <p>OPEN STATEMENT</p>
                                        <i class="demo-pli-credit-card-2 icon-lg"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="panel panel-bordered-pink panel-colorful">
                                    <div class="pad-all text-center">
                                        <span class="text-3x text-thin">&#8358; 0</span>
                                        <p>MY DASHBOARD</p>
                                        <i class="demo-pli-credit-card-2 icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-bordered-purple panel-colorful">
                                    <div class="pad-all text-center">
                                        <span class="text-3x text-thin">&#8358; 0</span>
                                        <p>PAID IN LAST 3 MONTHS</p>
                                        <i class="demo-pli-credit-card-2 icon-lg"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-5 panel-bordered-default" style="height:450px;border-right:none !important;padding:20px 10px 0;">
                                <!--Panel with Tabs (Icon)-->
                                <!--===================================================-->
                                <div class="panel panel-default">

                                    <!--Panel heading-->
                                    <div class="panel-heading">
                                        <div class="panel-control">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#demo-tabs2-box-1">All
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#demo-tabs2-box-2">Open
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#demo-tabs2-box-3">Paid
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#demo-tabs2-box-4">Unpaid
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="panel-title">Statement</h3>
                                    </div>

                                    <!--Panel Body-->
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div id="demo-tabs2-box-1" class="tab-pane fade in active">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <i class="demo-pli-monitor-2 text-main icon-3x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="text-main text-lg mar-no">All</p>
                                                        All Transaction
                                                    </div>
                                                </div>
                                                <div class="txn nano has-scrollbar" style="height:290px;margin-top:10px;">
                                                    <!--Custom Content-->
                                                    <!--===================================================-->
                                                    <div class="list-group nano-content">
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018 <i class="demo-pli-thunder"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018 <i class="demo-pli-credit-card-2"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018 <i class="demo-pli-information"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                    </div>
                                                    <!--===================================================-->


                                                </div>
                                            </div>
                                            <div id="demo-tabs2-box-2" class="tab-pane fade">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <i class="demo-pli-thunder text-main icon-3x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="text-main text-lg mar-no">Open</p>
                                                        All Open Transactions
                                                    </div>
                                                </div>
                                                <div class="txn nano has-scrollbar" style="height:290px;margin-top:10px;">
                                                    <!--Custom Content-->
                                                    <!--===================================================-->
                                                    <div class="list-group nano-content">
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018 <i class="demo-pli-thunder"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                    </div>
                                                    <!--===================================================-->


                                                </div>
                                            </div>
                                            <div id="demo-tabs2-box-3" class="tab-pane fade">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <i class="demo-pli-credit-card-2 text-main icon-3x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="text-main text-lg mar-no">Paid</p>
                                                        All Paid Transactions
                                                    </div>
                                                </div>
                                                <div class="txn nano has-scrollbar" style="height:290px;margin-top:10px;">
                                                    <!--Custom Content-->
                                                    <!--===================================================-->
                                                    <div class="list-group nano-content">
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018 <i class="demo-pli-credit-card-2"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                    </div>
                                                    <!--===================================================-->


                                                </div>
                                            </div>
                                            <div id="demo-tabs2-box-4" class="tab-pane fade">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <i class="demo-pli-information text-main icon-3x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="text-main text-lg mar-no">Unpaid</p>
                                                        All Unpaid Transactions
                                                    </div>
                                                </div>
                                                <div class="txn nano has-scrollbar" style="height:290px;margin-top:10px;">
                                                    <!--Custom Content-->
                                                    <!--===================================================-->
                                                    <div class="list-group nano-content">
                                                        <a href="#" class="list-group-item">
                                                            <h5 class="list-group-item-text">26 Nov 2018 - 02 Dec 2018 <i class="demo-pli-information"></i></h5>
                                                            <p class="list-group-item-heading">&#8358; 0</p>
                                                        </a>
                                                    </div>
                                                    <!--===================================================-->


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--===================================================-->
                                <!--End Panel with Tabs (Icon)-->

                            </div>
                            <div class="col-md-7 panel-bordered-default" style="height:550px;border-left:none !important;">
                                <div class="panel">
                                    <div class=" row text-center">
                                        <h6 class="col-md-6">Period<br/>26 Nov 2018 – 02 Dec 2018</h6><h6    class="col-md-6">Status<br/><i class="demo-pli-thunder"></i>Open</h6>
                                    </div>

                                    <!--Hover Rows-->
                                    <!--===================================================-->
                                    <div class="panel-body">
                                        <table class="table table-hover table-vcenter">
                                            <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <span class="text-main text-semibold">Opening Balance</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Negative closing balance from previous statements.</span>
                                                </td>
                                                <td class="text-center"><span class="text-danger text-semibold">- &#8358; 0.00</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><i class="demo-pli-laptop icon-2x"></i></td>
                                                <td>
                                                    <span class="text-main text-semibold">Laptop</span>
                                                    <br>
                                                    <small class="text-muted">Last 7 days : 3,876k</small>
                                                </td>
                                                <td class="text-center"><span class="text-warning text-semibold">- 8.55%</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><i class="demo-pli-tablet-2 icon-2x"></i></td>
                                                <td>
                                                    <span class="text-main text-semibold">Tablet</span>
                                                    <br>
                                                    <small class="text-muted">Last 7 days : 45,678k</small>
                                                </td>
                                                <td class="text-center"><span class="text-success text-semibold">+ 58.56%</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><i class="demo-pli-smartphone-3 icon-2x"></i></td>
                                                <td>
                                                    <span class="text-main text-semibold">Smartphone</span>
                                                    <br>
                                                    <small class="text-muted">Last 7 days : 34,553k</small>
                                                </td>
                                                <td class="text-center"><span class="text-success text-semibold">+ 35.76%</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--===================================================-->
                                    <!--End Hover Rows-->

                                </div>

                            </div>
                            <div class="col-md-5 panel-bordered-default" style="margin-top:-100px;height:100px;border-left:none !important;border-top:none !important;border-bottom:none !important;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--===================================================-->
            <!--End page content-->

        </div>
        <?php $this->load->view('templates/menu'); ?>
        <!--===================================================-->
        <!--END MAIN NAVIGATION-->

    </div>


    <!-- FOOTER -->
    <!--===================================================-->
    <?php $this->load->view('templates/footer'); ?>
    <!--===================================================-->
    <!-- END FOOTER -->
    <!-- SCROLL PAGE BUTTON -->
    <!--===================================================-->
    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>
    <!--===================================================-->
</div>
<!--===================================================-->
<!-- END OF CONTAINER -->
<!--JAVASCRIPT-->
<!--=================================================-->
<?php $this->load->view('templates/scripts'); ?>
</body>
</html>
