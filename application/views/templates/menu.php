<nav id="mainnav-container">
    <div id="mainnav">
        <div class="mainnav-brand">
            <a href="javascript:;" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
        </div>
        <?php
        // Count Query

        $uid = $this->session->userdata('logged_id');
		$draft_count = count($this->seller->get_product($uid, "draft"));
        $order_count = $this->seller->run_sql("SELECT * FROM orders WHERE seller_id = {$uid} AND active_status = 'pending'")->num_rows();
        $message_count = $this->seller->get_unread_message($uid);
        $questions_count = count($this->seller->get_questions($uid));
        ?>
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img src="<?= base_url('assets/img/onitshamarket-logo.png'); ?>"
                                     alt="<?= lang('app_name'); ?>" class="brand-title img-responsive">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                <p class="mnp-name"><?= ucwords($profile->first_name . ' ' . $profile->last_name); ?></p>
                                <span class="mnp-desc"><?= $profile->email; ?></span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="<?= base_url('settings') ?>" class="list-group-item">
                                <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                            </a>
                            <a href="<?= base_url('help') ?>" class="list-group-item">
                                <i class="demo-pli-information icon-lg icon-fw"></i> Help
                            </a>
                            <a href="<?= base_url('logout') ?>" class="list-group-item">
                                <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                            </a>
                        </div>
                    </div>
                    <ul id="mainnav-menu" class="list-group">
                        <li class="list-header">Navigation</li>
                        <li <?php if ($pg_name == 'overview') echo 'class="active"' ?>>
                            <a href="<?= base_url('overview') ?>">
                                <i class="demo-pli-home"></i>
                                <span class="menu-title">Overview</span>
                            </a>
                        </li>
                        <li <?php if ($pg_name == 'product' || $pg_name == 'manage_product') echo 'class="active"' ?>>
                            <a href="javascript:;">
                                <i class="demo-pli-idea-2"></i>
                                <span class="menu-title">Products</span>
                                <i class="arrow"></i>
                            </a>
                            <ul class="collapse <?php if ($pg_name == 'product' || $pg_name == 'manage_product') echo 'in'; ?>">
                                <li <?php if ($sub_name == 'add_product') echo 'class="active-link"' ?>><a
                                            href="<?= base_url('product/create'); ?>">
                                        <i class="demo-pli-star"></i>Add new product</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="demo-pli-remove-user"></i>Manage Products<i class="arrow"></i></a>
                                    <ul class="collapse">
                                        <li><a href="<?= base_url('manage/'); ?>">
                                                <i class="demo-pli-list-view"></i>All Products</a></li>
                                        <li><a href="<?= base_url('manage/?type=draft'); ?>">
                                                <i class="demo-pli-pen-5"></i>Draft  <?php if ($draft_count) echo '(' . $draft_count . ')'; ?></a></li>
                                        <li><a href="<?= base_url('manage/?type=pending'); ?>">
                                                <i class="demo-pli-file-add"></i>Pending</a></li>
                                        <li><a href="<?= base_url('manage/?type=suspended'); ?>">
                                                <i class="demo-pli-data-storage"></i>Suspended</a></li>
                                        <li><a href="<?= base_url('manage/?type=missing_images'); ?>">
                                                <i class="demo-pli-file-text-image"></i>Missing Images</a></li>
                                        <li><a href="<?= base_url('manage/?type=out_of_stock'); ?>">
                                                <i class="demo-pli-repair"></i>Out Of Stock</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="list-divider"></li>
                        <li <?php if ($pg_name == 'orders') echo 'class="active"' ?>>
                            <a href="javascript:;">
                                <i class="demo-pli-cart-coin"></i>
                                <span class="menu-title">Orders <?php if ($order_count) echo '(' . $order_count . ')'; ?></span>
                                <i class="arrow"></i>
                            </a>
                            <ul class="collapse <?php if ($pg_name == 'orders') echo 'in'; ?>">
                                <li <?php if ($sub_name == 'all') echo 'class="active-link"' ?>><a
                                            href="<?= base_url('orders/') ?>">
                                        <i class="demo-pli-shopping-cart"></i>All Orders</a></li>
                                <li <?php if ($sub_name == 'order_pending') echo 'class="active-link"' ?>><a
                                            href="<?= base_url('orders/?type=pending') ?>">
                                        <i class="demo-pli-file-add"></i>Pending Orders</a></li>
                                <li <?php if ($sub_name == 'order_shipped') echo 'class="active-link"' ?>><a
                                            href="<?= base_url('orders/?type=shipped') ?>">
                                        <i class="demo-pli-monitor-2"></i>Shipped Orders</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="demo-pli-folder-with-document"></i>Completed Orders<i
                                                class="arrow"></i></a>
                                    <ul class="collapse">
                                        <li <?php if ($sub_name == 'order_cancelled') echo 'class="active-link"' ?>><a
                                                    href="<?= base_url('orders/?type=cancelled'); ?>">
                                                <i class="demo-pli-remove"></i>Cancelled</a></li>
                                        <li <?php if ($sub_name == 'order_delivered') echo 'class="active-link"' ?>><a
                                                    href="<?= base_url('orders/?type=delivered') ?>">
                                                <i class="demo-pli-data-storage"></i>Delivered</a></li>
                                        <li <?php if ($sub_name == 'order_failed_delievery') echo 'class="active-link"' ?>>
                                            <a href="<?= base_url('orders/?type=failed_delivery'); ?>">
                                                <i class="demo-pli-mail-remove"></i>Failed Delivery</a></li>
                                        <li <?php if ($sub_name == 'order_retured') echo 'class="active-link"' ?>><a
                                                    href="<?= base_url('orders/?type=returned'); ?>">
                                                <i class="demo-pli-refresh"></i>Returned</a></li>
                                        <li <?php if ($sub_name == 'order_successful') echo 'class="active-link"' ?>><a
                                                    href="<?= base_url('orders/?type=success') ?>"><i class="demo-pli-data-storage"></i>Completed</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="list-divider"></li>
                        <li <?php if ($pg_name == 'message' || $pg_name == 'questions') echo 'class="active"' ?>>
                            <a href="javascript:;">
                                <i class="demo-pli-clock"></i>
                                <span class="menu-title">Notifications (<?= $questions_count + ($message_count - 1); ?>)</span>
                                <i class="arrow"></i>
                            </a>
                            <ul class="collapse <?php if ($pg_name == 'message') echo 'in'; ?>">
                                <li class="<?php if ($pg_name == 'message') echo 'active-link' ?>">
                                    <a href="<?= base_url('message'); ?>">
                                        <i class="demo-pli-mail"></i>
                                        <span class="menu-title">Messages <?= $message_count < 1 ? '' : '(' . count($message_count) . ' new)'; ?></span>
                                    </a>
                                </li>
                                <li class="<?php if ($pg_name == 'questions') echo 'active-link' ?>">
                                    <a href="<?= base_url('message/questions'); ?>">
                                        <i class="demo-pli-question"></i>
                                        <span class="menu-title">Questions <?= $questions_count < 1 ? '' : '(' . $questions_count . ')'; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-divider"></li>
                        <li <?php if ($pg_name == 'report') echo 'class="active"' ?>>
                            <a href="javascript:;">
                                <i class="demo-pli-bar-chart"></i>
                                <span class="menu-title">Reports</span>
                                <i class="arrow"></i>
                            </a>
                            <ul class="collapse <?php if ($pg_name == 'report') echo 'in'; ?>">
                                <li <?php if ($sub_name == 'sales_report') echo 'class="active-link"' ?>><a
                                            href="<?= base_url('account/sales_report'); ?>">
                                        <i class="demo-pli-star"></i>Sales Report</a></li>
                               <li <?php if ($sub_name == 'statement') echo 'class="active"' ?>><a
                                            href="<?= base_url('account/statement'); ?>">
                                        <i class="demo-pli-star"></i>Account Statement</a></li>
                                <li <?php if ($sub_name == 'payout') echo 'class="active-link"' ?>><a
                                            href="<?= base_url('account/payout'); ?>">
                                        <i class="demo-pli-star"></i>Request Payout</a></li>
                            </ul>
                        </li>
                        <li class="list-divider"></li>
                        <li class="<?php if ($pg_name == 'settings') echo 'class="active"' ?>">
                            <a href="javascript:;">
                                <i class="demo-pli-gear"></i>
                                <span class="menu-title">Settings</span>
                                <i class="arrow"></i>
                            </a>
                            <ul class="collapse <?php if ($pg_name == 'settings') echo 'in'; ?>">
                                <li <?php if ($sub_name == 'profile') echo 'class="active-link"' ?>><a
                                            href="<?= base_url('settings') ?>">
                                        <i class="demo-pli-add-user-star"></i>Profile</a></li>
                                <li <?php if ($sub_name == 'change_password') echo 'class="active-link"' ?>><a
                                            href="<?= base_url('settings/change_password'); ?>">
                                        <i class="demo-pli-lock-2"></i>Change Password</a></li>
                            </ul>
                        </li>
                        <li <?php if ($pg_name == 'help') echo 'class="active"' ?>>
                            <a href="<?= base_url('pages/faq'); ?>">
                                <i class="demo-pli-information"></i>
                                <span class="menu-title">Help & Guidelines</span>
                            </a>
                        </li>
                        <li <?php if ($pg_name == 'sellers_connect') echo 'class="active"' ?>>
                            <a target="_blank" href="https://chat.whatsapp.com/GsYeA2PKbDKBdXMDDU4mL0">
                                <i class="demo-pli-bell"></i>
                                <span class="menu-title">OM Seller's Connect</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('logout'); ?>">
                                <i class="demo-pli-lock-user"></i>
                                <span class="menu-title">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>