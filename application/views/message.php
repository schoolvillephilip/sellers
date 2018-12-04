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
    <?php $this->load->view('templates/head_navbar'); ?>
    <div class="boxed">
        <div id="content-container">
            <div id="page-head">
                <div id="page-title">
                    <h1 class="page-header text-overflow">User</h1>
                </div>
                <ol class="breadcrumb">
                    <li><i class="demo-pli-home"></i></li>
                    <li>User</li>
                    <li class="active">Messages</li>
                </ol>
            </div>
            <div id="page-content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Showing all Messages</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-5">
                            <div class="fluid">
                                <div id="demo-email-list">
                                    <div class="row">
                                        <div class="col-sm-7 toolbar-left">
                                            <div class="btn-group">
                                                <label id="demo-checked-all-mail" for="select-all-mail"
                                                       class="btn btn-default">
                                                    <input id="select-all-mail" class="magic-checkbox" type="checkbox">
                                                    <label for="select-all-mail"></label>
                                                </label>
                                            </div>
                                            <button id="demo-mail-ref-btn" data-toggle="panel-overlay"
                                                    data-target="#demo-email-list" class="btn btn-default"
                                                    type="button">
                                                <i class="demo-psi-repeat-2"></i>
                                            </button>
                                            <div class="btn-group dropdown">
                                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"
                                                        type="button">
                                                    Action <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:;"><i class="demo-pli-mail-send"></i> Mark
                                                            as read</a></li>
                                                    <li><a href="javascript:;"><i class="demo-pli-mail-unread"></i> Mark
                                                            as unread</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="javascript:;"><i class="demo-pli-recycling"></i> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <ul id="demo-mail-list" class="mail-list pad-top bord-top">
                                        <?php if ($messages) : ?>
                                            <?php $mes = $messages->first_row('object'); ?>
                                            <?php foreach ($messages->result() as $message) : ?>
                                                <li class="<?php if ($message->is_read == 0) echo 'mail-list-unread'; ?> <?php if ($message->id == $mes->id) echo 'active-message' ?> message_item"
                                                    style="cursor: pointer" data-mid="<?= $message->id; ?>"
                                                    data-title="<?= $message->id; ?>_title">
                                                    <div class="mail-control">
                                                        <input id="<?= $message->id; ?>" class="magic-checkbox"
                                                               type="checkbox">
                                                        <label for="<?= $message->id; ?>"></label>
                                                    </div>
                                                    <div id="<?= $message->id; ?>_title"
                                                         class="mail-from <?php if ($message->is_read == 0) echo 'mail-list-unread'; ?>"><?= $message->title; ?></div>
                                                    <div class="mail-time"><?= ago($message->created_on); ?></div>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li> No Message</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="fluid message_read_view">
                                <div class="mar-btm pad-btm bord-btm">
                                    <h1 class="page-header text-overflow" id="message_title">
                                        <?= !empty($mes->title) ? $mes->title : ''; ?>
                                    </h1>
                                </div>
                                <div class="row">
                                    <div class="col-sm-7 toolbar-left">
                                        <div class="media">
                                            <div class="media-body text-left">
                                                <div class="text-bold">Admin</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 toolbar-right">
                                        <p class="mar-no">
                                            <small class="text-muted"
                                                   id="message_date"><?= !empty($mes->created_on) ? neatDate($mes->created_on) : ''; ?></small>
                                        </p>
                                    </div>
                                </div>
                                <div class="nano has-scrollbar" style="height: 350px;">
                                    <div class="nano-content" tabindex="0" style="right: -17px;">
                                        <div class="mail-message">
                                            Hey <?= ucfirst($profile->first_name); ?>,<br/><br/>
                                            <blockquote style="font-size:14px;text-align:justify;" id="message_detail">
                                                <?= !empty($mes->content) ? $mes->content : ''; ?>
                                            </blockquote>
                                            <div class="pull-right">
                                                <br><br> Regards,
                                                <br><br>
                                                <strong>Admin</strong><br>admin@onitshamarket.com<br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nano-pane">
                                        <div class="nano-slider"
                                             style="height: 20px; transform: translate(0px, 0px);"></div>
                                    </div>
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
    let all = $('#select-all-mail');
    all.click(function () {
        $('input:checkbox').prop('checked', this.checked);
    });

    $('.message_item').on('click', function () {
        $('.message_item').removeClass('active-message');
        $(this).addClass('active-message');
        let message_id = $(this).data('mid');
        let title_target = $(this).data('title');
        $(`#${title_target}`).removeClass('mail-list-unread').addClass('mail-list-read');
        $.ajax({
            url: "<?= base_url(); ?>message/message_detail",
            method: 'POST',
            data: {'mid': message_id},
            success: function (response) {
                response = JSON.parse(response);
                $('#message_title').html(`
					${response.title}
				`);
                $('#message_date').html(`
					${response.created_on}
				`);
                $('#message_detail').html(`
					${response.content}
				`);
            },
            error: response => console.log(response)

        });
    });
</script>
</body>
</html>
