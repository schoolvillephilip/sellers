<?php $this->load->view('templates/meta_tags'); ?>
<style>
    .q_meta {
        font-style: italic;
    }

    .product_name {
        color: #8fa1b5;
        font-size: 14px;
        font-weight: 600;
    }

    .active-question {
        border-left: 2px solid green;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .image_link:hover {
        color: #048a70;
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
                    <h1 class="page-header text-overflow">Customer Questions</h1>
                </div>
                <ol class="breadcrumb">
                    <li><i class="demo-pli-home"></i></li>
                    <li>Notifications</li>
                    <li class="active">Questions</li>
                </ol>
            </div>
            <div id="page-content">
                <?php $this->load->view('msg_view'); ?>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">All Questions</h3>
                    </div>
                    <div class="panel-body row">
                        <div class="panel col-sm-7">
                            <div class="panel-heading">
                                <h4>Questions</h4>
                            </div>
                            <div class="panel-body">
                                <div class="nano has-scrollbar" style="height: 450px;">
                                    <div class="nano-content" tabindex="0">
                                        <?php if (count($questions)): ?>
                                            <?php foreach ($questions as $question): ?>
                                                <div class="col-sm-12">
                                                    <a href="javascript:;" class="question-link"
                                                       data-question="<?= $question->question; ?>"
                                                       data-product-name="<?= word_limiter($question->product_name, 5); ?>"
                                                       data-qid="<?= $question->id; ?>">
                                                        <h4>
                                                            <i class="demo-pli-question"></i>&nbsp;<?= $question->question; ?>
                                                            <small>from</small>
                                                        </h4>
                                                        <p class="product_name"><a class="image_link"
                                                                                   href="<?= base_url('manage/stat/' . $question->pid); ?>"><?= word_limiter($question->product_name, 5); ?></a>
                                                        </p>
                                                        <p class="q_meta">asked by <?= $question->display_name; ?>
                                                            on <?= date('l, F d', strtotime($question->qtimestamp)); ?></p>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="col-sm-12">
                                                <h3 class="product_name">No questions for you yet...</h3>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel col-sm-5">
                            <div class="panel-heading">
                                <h4 class="text-center">Answer Questions</h4>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12" style="display: none;" id="answer_panel">
                                    <h5 id="question_here">Your Question will go here...</h5>
                                    <h5>Product: <span class="product_name" id="product_name_here">Product Name</span>
                                    </h5>
                                    <form method="post" action="<?= base_url('message/answer_question'); ?>">
                                        <input type="hidden" value="" name="qid" id="qid"/>
                                        <textarea rows="8" name="answer" id="answer" placeholder="Enter Answer Here..."
                                                  class="form-control" required></textarea>
                                        <input type="submit" value="Answer" class="btn btn-block btn-primary"/>
                                    </form>
                                </div>
                                <div class="col-sm-12" id="no_question_answer_panel">
                                    <h4 class="mar-top text-center"><span class="product_name">Please select a question to answer</span>
                                    </h4>
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
    $('.question-link').on('click', function () {
        $('.question-link').parent('div').removeClass('active-question');
        $(this).parent('div').addClass('active-question');
        $('#answer_panel').show();
        $('#no_question_answer_panel').hide();
        let product_name = $(this).data('product-name');
        let qid = $(this).data('qid');
        let question = $(this).data('question');
        $('#question_here').text(question);
        $('#qid').val(qid);
        $('#product_name_here').text(product_name);
    });
</script>
</body>
</html>
