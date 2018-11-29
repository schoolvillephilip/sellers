<?php $this->load->view('templates/meta_tags'); ?>
<style>
    .mail-list-unread {
        font-weight: 800;
    }

    .mail-list-read {
        font-weight: 100 !important;
    }

    .mail-from {
        width: 61% !important;
    }

    .active-message {
        border-left: 3px solid #2BA27D;
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
                    <h1 class="page-header text-overflow">Sales Report</h1>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->
                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
                    <li><i class="demo-pli-home"></i></li>
                    <li>Reports</li>
                    <li class="active">Sales Report</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
            </div>
            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sales Report</h3>
                    </div>
                    <div class="panel-body">

                        <div id="om-panel-order" class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Total Order Count</h3>
                                <?php if(!$order_chart) : ?>
                                    <h3 class="text-danger text-center">No Data Available!</h3>
                                <?php endif; ?>
                            </div>
                            <!--Chart information-->
                            <div class="panel-body">
                                <div id="sellerchart" style="height: 350px; margin-bottom: 40px;"></div>
                            </div>
                        </div>

                        <div id="om-panel-gross" class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Gross Sales Sum</h3>
                                <?php if(!$gross_chart) : ?>
                                    <h3 class="text-danger text-center">No Data Available!</h3>
                                <?php endif; ?>
                            </div>
                            <!--Chart information-->
                            <div class="panel-body">
                                <div id="sellerchart" style="height: 350px; margin-bottom: 40px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--===================================================-->
            <!--End page content-->

        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->

        <!--ASIDE-->
        <!--===================================================-->
        <?php $this->load->view('templates/aside_menu'); ?>
        <!--===================================================-->
        <!--END ASIDE-->
        <!--MAIN NAVIGATION-->
        <!--===================================================-->
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