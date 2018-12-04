<?php $this->load->view('templates/meta_tags'); ?>
</head>
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">
    <?php $this->load->view('templates/head_navbar') ?>
    <div class="boxed">
        <div id="content-container">
            <div id="page-head">
                <div id="page-title">
                    <h1 class="page-header text-overflow">Category</h1>
                </div>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="demo-pli-home"></i></a></li>
                    <li><a href="#">Sellers</a></li>
                    <li class="active">Category</li>
                </ol>
            </div>
            <div id="page-content">

                <hr class="new-section-sm bord-no">
                <div class="row">
                    <div class="col-lg-12">
                        <?php $this->load->view('msg_view'); ?>
                        <div class="panel panel-body text-center">
                            <div class="panel-heading">
                                <h3>Select A Product Category</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4" style="margin-bottom: 20px;">
                                        <h5 style="color: #232323;">Select Root Category</h5>
                                        <select class="rootcat form-control" name="state">
                                            <option value="el">Electronics</option>
                                            <option value="WY">Fashion</option>
                                            <option value="WY">Cars</option>
                                            <option value="WY">Gadgets and accessories</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4" style="margin-bottom: 20px;">
                                        <h5 style="color: #232323;">Select Category</h5>
                                        <select class="subcat form-control" name="state">
                                            <option value="AL">Mobile Phones</option>
                                            <option value="WY">Smart Phones</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4" style="margin-bottom: 20px;">
                                        <h5 style="color: #232323;">Select Sub Category</h5>
                                        <select class="cat form-control" name="state">
                                            <option value="AL">Apple Phones</option>
                                            <option value="WY">Andriod Phones</option>
                                            <option value="WY">Symbian phones</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" style="margin-top: 40px;">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/menu'); ?>
    </div>
    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>
</div>
<?php foreach ($scripts as $tag) : ?>
    <script src="<?= base_url('assets/') . $tag; ?>"></script>
<?php endforeach; ?>
</body>
</html>
