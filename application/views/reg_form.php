<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $page_title; ?> | Onitshamarket.com</title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/png">
    <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/png">
    <link rel="canonical" href="<?= current_url(); ?>"/>
    <meta name="robots" content="index,follow">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600|Oxygen' rel='stylesheet' type='text/css'>
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.css'); ?>">
    <link href="<?= base_url('assets/css/nifty.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/demo/nifty-demo-icons.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/pace/pace.min.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('assets/plugins/pace/pace.min.js'); ?>"></script>
    <link href="<?= base_url('assets/css/demo/nifty-demo.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.css'); ?>"
          rel="stylesheet">
    <style>
        body { color: #000000; }
    </style>
</head>
<body>
<div id="container" class="cls-container" style="background-color: #fff !important;">
    <div id="bg-overlay"></div>
    <div class="container pad-all">
        <div class="cls-content-lg panel panel-colorful "
             style="border: 1px solid #26a69a !important;padding-top:10px;width:96%;margin-top:80px;">
            <div class="panel-title" style="background-color: transparent !important;">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <a href="<?= base_url(); ?>" title="<?= lang('app_name'); ?>"><img
                                    src="<?= base_url('assets/img/onitshamarket-logo.png'); ?>"
                                    alt="<?= lang('app_name'); ?>"
                                    class="brand-title img-responsive"></a>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
            <div class="panel" style="padding:20px;">
                <?php $this->load->view('msg_view'); ?>
                <div id="demo-bv-wz">
                    <div class="wz-heading pad-top">
                        <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
                            <li class="col-xs-3">
                                <a data-toggle="tab" href="#sell_info">
                                    <span class="text-danger"><i class="demo-pli-male icon-2x"></i></span>
                                    <p class="text-semibold mar-no">Seller Information</p>
                                </a>
                            </li>
                            <li class="col-xs-3">
                                <a data-toggle="tab" href="#pro_info">
                                    <span class="text-warning"><i class="demo-pli-shopping-basket icon-2x"></i></span>
                                    <p class="text-semibold mar-no">Product Information</p>
                                </a>
                            </li>
                            <li class="col-xs-3">
                                <a data-toggle="tab" href="#acc_det">
                                    <span class="text-info"><i class="demo-pli-credit-card-2 icon-2x"></i></span>
                                    <p class="text-semibold mar-no">Bank Account Details</p>
                                </a>
                            </li>
                            <li class="col-xs-3">
                                <a data-toggle="tab" href="#comp_form">
                                    <span class="text-success"><i class="demo-pli-medal-2 icon-2x"></i></span>
                                    <p class="text-semibold mar-no">Complete Application</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-primary"></div>
                    </div>

                    <form method="post" action="<?= base_url('temp/process/');?>" id="demo-bv-wz-form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="tab-content">
                                <div id="sell_info" class="tab-pane">
                                    <h4 class="text-center"></h4>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="legal_company_name">Business
                                                Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" placeholder="Your legal business name"
                                                       autofocus
                                                       id="legal_company_name" name="legal_company_name" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="tin_number">Tax Identification Number</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" placeholder="Tax Identification Number" id="tin_number"
                                                       name="tin">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label"></label>
                                            <div class="col-lg-7" style="text-align:left;">
                                                <div class="checkbox">
                                                    <input id="bus_reg" type='checkbox' name="has_reg"
                                                           title="Is Your Business Registered?"
                                                           class="magic-checkbox">
                                                    <label for="bus_reg">Is Your Business Registered?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6" id="reg_opt" style="display: none;">
                                            <label class="col-lg-4 control-label" for="reg_no">Registration Number</label>
                                            <div class="col-lg-7">
                                                <input type="text" name="reg_no" class="form-control"
                                                       placeholder="Enter your registration number"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Store Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="store_name"
                                                       placeholder="This is seller name on OM" required>
                                                <?= form_error('store_name'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Store Address</label>
                                            <div class="col-lg-7">
                                                <input type="text" placeholder="Store Address" name="store_address"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Email address</label>
                                            <div class="col-lg-7">
                                                <input type="email" class="form-control" name="email" readonly
                                                       placeholder="<?= $this->session->userdata('email'); ?>"
                                                       >
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Phone Number</label>
                                            <div class="col-lg-7">
                                                <input type="text" placeholder="080XXXXXXXX" name="phone_number"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="pro_info" class="tab-pane fade">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="main_category">Main
                                                Category</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="main_category" required>
                                                    <option value="">-- Select Main Category --</option>
                                                    <?php foreach ($categories as $category) : ?>
                                                        <option value="<?= $category->name ?>"> <?= ucwords($category->name); ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="pro_cond">Product
                                                Condition</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="product_condition" required>
                                                    <option value="new">New</option>
                                                    <option value="refurbished">Refurbished</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="no_of_products">Duration</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="no_of_products">
                                                    <option value="1year">1year</option>
                                                    <option value="1-5years">1 - 5years</option>
                                                    <option value="5years+">5years +</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="no_of_products">No of
                                                Products</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="no_of_products">
                                                    <option value="1-50">1 - 50</option>
                                                    <option value="51-100">51 - 100</option>
                                                    <option value="101-500">101 - 500</option>
                                                    <option value="501-more">501 +</option>
                                                    <option value="pack">Large Packaged Quantities</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-lg-4 control-label"></label>
                                                <div class="col-lg-7" style="text-align:left;">
                                                    <div class="checkbox">
                                                        <input id="plat_reg" type='checkbox' name="has_reg"
                                                               title="Selling with another platform?"
                                                               class="magic-checkbox">
                                                        <label for="plat_reg">Do you sell advertise on any social media?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6" id="plat_opt" style="display: none;">
                                                <label class="col-lg-4 control-label" for="platform">Platform</label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="platform" class="form-control"
                                                           placeholder="E.g: facebook.com, twitter.com, others"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-lg-4 control-label"></label>
                                                <div class="col-lg-7" style="text-align:left;">
                                                    <div class="checkbox">
                                                        <input id="license" type='checkbox' name="license_to_sell"
                                                               title="Do you have license to sell this products"
                                                               class="magic-checkbox">
                                                        <label for="license">Do you have license to sell?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6" id="plat_opt" style="display: none;">
                                                <label class="col-lg-4 control-label" for="platform">Platform</label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="rc_num" class="form-control"
                                                           placeholder="E.g: Kara.com.ng, jiji.ng, Jumia.com.ng, konga.com..."
                                                           id="platform"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="acc_det" class="tab-pane">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Bank Name</label>
                                            <div class="col-lg-7">
                                                <select name="bank_name" required class="form-control">
                                                    <option value="">-- Select Bank Name--</option>
                                                    <?php $banks = explode(',', lang('banks'));
                                                    foreach ($banks as $bank) :
                                                        ?>
                                                        <option value="<?= trim($bank); ?>"><?= trim($bank); ?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Account Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="account_name"
                                                       placeholder="Account Name" required>
                                                <span class="text-danger">*This should be same as your personal or business name on OM</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">Account Number</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" name="account_number"
                                                       placeholder="XXXXXXXXXX"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label" for="account_type">Account Type</label>
                                            <div class="col-lg-7">
                                                <select class="form-control" name="account_type" required>
                                                    <option value="current">Current</option>
                                                    <option value="savings">Savings</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="comp_form" class="tab-pane  mar-btm text-center">
                                    <h4>Sellers Agreement</h4>
                                    <div class="nano has-scrollbar text-justify col-md-9"
                                         style="height: 200px;">
                                        <div class="nano-content read_here" tabindex="0" style="right: -17px;">
                                            <p><b>User Agreement</b></p>

                                            The following describes the terms on which onitshamarket.com offers you access to our services.

                                            Introduction


                                            Welcome to onitshamarket.com. By using the onitshamarket.com website including its related sites, services and tools (the "Website"), you agree to the following terms, including those available by hyperlink, with Internet Onitshamarketing Limited, and its affiliates (together "onitshamarket.com " or the "Company"), and the general principles for this Website. If you have any questions, please refer to our Help section.

                                            This Agreement is effective on January 1, 2015 for current users, and immediately upon acceptance by new users.

                                            Scope

                                            Before you become a member of the Website, you must read and accept all of the terms and conditions in, and linked to, this User Agreement and Privacy Policy. We strongly recommend that, as you read this User Agreement, you also access and read the linked information. By accepting this User Agreement, you agree that this User Agreement and Privacy Policy will apply whenever you use our Website and services, or when you use the tools we make available to interact with our Website and services.

                                            Your Account

                                            If you use this Website, you are responsible for maintaining the confidentiality of your buyer or seller account with onitshamarket.com ("Account") and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. If you are under 18 years old, you may use this Website only with authorization from a parent or legal guardian.

                                            The Company reserves the right to refuse service, terminate accounts, remove or edit content, or cancel orders at its sole discretion.

                                            Using this Website

                                            While using this Website, you will not:

                                            post content or items in an inappropriate category or areas on our Website or services;

                                            violate any laws, third party rights, or our policies such as the Prohibited and Restricted Items policies;

                                            use our Website or services if you are not able to form legally binding contracts, are under the age of 18, or are temporarily or indefinitely suspended from our Website;

                                            manipulate the price of any item or interfere with other user's listings;

                                            circumvent or manipulate our fee structure, the billing process, or fees owed to the Company;

                                            post false, inaccurate, misleading, defamatory, or libelous content (including personal information);

                                            take any action that may undermine the feedback or ratings systems;

                                            transfer your Account to another party without the Company's consent;

                                            distribute or post spam, chain letters, or pyramid schemes;

                                            distribute viruses or any other technologies that may harm the Website, or the interests or property of users of the Website;

                                            copy, modify, or distribute content from the Website and the Company's copyrights and trademarks; or

                                            harvest or otherwise collect information about users, including email addresses, without their consent; or

                                            use existing user accounts or create new user accounts in order to circumvent or avoid buying or selling limits, restrictions, holds or other policy consequences


                                            Violations of this policy may result in a range of actions, including:

                                            - Cancellation of Item Listing(s)

                                            - Loss of Settlement Amount

                                            - Limits placed on account privileges

                                            - Loss of "Power Seller" status

                                            - Account suspension / termination

                                            - Criminal charges / claim for damages

                                            Abusing our Website

                                            We keep our Website and services safe and working properly. Please report problems, offensive content and policy violations to us.

                                            Our Brand Protection Program (BPP) works to ensure that listed items do not infringe upon the copyright, trademark or other intellectual property rights of third parties. If you believe that your intellectual property rights have been violated, please notify our BPP team and we will investigate.

                                            Without limiting other remedies, we may limit, suspend, or terminate our service and user accounts, prohibit access to our sites and their content, delay or remove hosted content, and take technical and legal steps to keep users off the sites if we think that they are creating problems or possible legal liabilities, infringing the intellectual property rights of third parties, or acting inconsistently with the letter or spirit of our policies (for example, and without limitation, policies related to shill bidding, conducting off-site transactions, feedback manipulation, circumventing temporary or permanent suspensions or users who we believe are harassing our employees or other users). Additionally, we may, in appropriate circumstances and at our discretion, suspend or terminate accounts of users who may be repeat infringers of intellectual property rights of third parties. We also reserve the right to cancel unconfirmed accounts or accounts that have been inactive for a long time.

                                            Purchase and Payment

                                            You should carefully read the item detail page and review information such as price, option price, shipping charges, etc. and terms and conditions for sales before purchasing an item.

                                            We take no responsibility and assume no liability for any loss or damages to a buyer arising from shipping information and/or payer information entered by the buyer or wrong remittance by the buyer in connection with the payment for the items purchased. We reserve the right to check whether a buyer is duly authorized to use certain payment method, and may suspend the transaction until such authorization is confirmed or cancel the relevant transaction where such confirmation is not available.

                                            Delivery

                                            On receipt of the payment from the buyer, the Company shall instruct the seller to take necessary actions for delivery and the seller should ship and enter delivery information including the name of the delivery company, the tracking number, etc. through onitshamarket.com Sales Manager within 3 business days from the date of the delivery instruction. If the seller fails to do so, the Company may cancel the transaction and shall not be responsible or liable for any loss or damages to the seller due to such cancellation.

                                            Sellers shall take all reasonable actions for buyers to receive purchased items within the time period specified by the seller on the item detail page. If a seller fails to deliver the purchased item within such period or the item was not received by the buyer due to a reason not attributable to the buyer (such as delivering to the wrong address), the seller shall bear all liabilities relating thereto. If any transaction is cancelled due to a reason attributable to the seller (e.g. non-delivery of the purchased items), the Company may take actions against the seller.

                                            The Company may at its option provide overseas delivery service and other services related to delivery in association with third-party service providers.

                                            Cancellation, Return and Refund

                                            Buyers may cancel purchases at any time before shipment. Once shipped, purchases will be subject to return process rather than cancellation process.

                                            Buyers may request for return of purchased items at any time within 7 days from the date of receipt. With respect to return-related matters, relevant laws and regulations shall prevail over the terms and conditions suggested by sellers.

                                            Return costs shall be borne by the party attributable to the return request, such as:

                                            the buyer, where the return is due to his/her change of mind; and

                                            the seller, where the return is due to the defects in the item, delivery delay or delivery of the wrong or different item


                                            Upon completion of the cancellation or the return process, the Company shall refund the purchase by immediately canceling the debit card transaction authorization in the case of payment by debit card or by depositing the amount paid by the buyer in the onitshamarket.com account of the buyer in the case of payment by cash. Buyers may at any time request to withdraw from the onitshamarket.com account of the buyer and the request amount shall be remitted to the buyer's bank account within 2 business days.

                                            Pricing and Seller Activities

                                            Sellers shall properly manage and ensure that relevant information such as the price and the details of items, inventory amount and terms and conditions for sales is updated through onitshamarket.com Sales Manager and shall not post inaccurate information.

                                            The price of items and option items for sale will be determined by the seller at his/her own discretion. Sellers may wish to take into consideration all relevant factors including, but without limitation, Basic Fees, Option Item Fees, Shipping Charge Fees and other service fees. Also the settlement amount (before deducting other service fees there from) payable to a seller for a sale will be determined by the seller at his/her own discretion based on the price of the items and Basic Fees.

                                            The price of an item and Shipping Charge shall include the entire amount to be charged to buyers such as sales tax, value-added tax, tariffs, etc. and sellers shall not charge buyers such amount additionally and separately.

                                            Sellers agree that the Company may at its discretion engage in promotional activities for and on behalf of sellers to induce transactions between buyers and sellers by reducing, discounting or refunding Basic Fees and other service fees, or in other ways. In no event, such adjustment of Basic Fees and other service fees will affect the originally determined settlement amount payable to sellers. The final actual price that buyers will pay will be the price that such adjustment is applied to.

                                            For the purpose of promoting the sales of the items listed by sellers, the Company may post such items (at adjusted price) on third-party websites (such as portal sites and price comparison sites) and other websites operated by the Company.

                                            Sellers shall issue receipts, debit card slips or tax invoices to buyers on request, if such issuance is required under the laws of Nigeria, and sellers agree that the Company may issue such receipts or tax invoice under the name of the seller for and on behalf of the seller.

                                            Service Fees

                                            Joining this Website is free, we do not charge buyers any fees for purchasing and bidding on listed items and we do not charge sellers any insertion or listing fees. We do charge sellers fees for completed transactions such as Basic Fees, Option Item Fees and Shipping Charge Fees and other service fees for marketing and promotion features. When you list an item or use a service that has a fee you have an opportunity to review and accept the fees that you will be charged based on our Fees Schedule.

                                            All service fees are subject to taxes by applicable laws and regulations and the Company will charge sellers such taxes additionally. Sellers agree that service fees and taxes may be paid by deducting from the purchase price paid by buyers. The Company shall issue receipts or tax invoices for service fees paid by sellers on a monthly basis.

                                            Settlement

                                            Sellers shall submit personal/business identification information such as a copy of National Identity Card (NIC), passport or the certificate of incorporation and bank account information together with a document evidencing that the bank account is owned by and in the name of the seller within 2 weeks from the date of seller registration. Sellers shall not claim against the Company for damages, including outstanding payment of settlement amounts, resulting from delay of submission of such identification and bank account information.

                                            The amount payable by the Company to the seller for any transactions through our Website (the "Settlement Amount") will be calculated by subtracting all service fees from the amount paid by the buyers. The Settlement Amount shall be deposited into the onitshamarket.com account of the seller in 2 weeks in principle after the date on which delivery is completed, together with Shipping Charge (after deducting Shipping Charge Fee), if any, paid by buyers. The Company may at its discretion curtail the term based on seller's performance.

                                            Sellers may at any time request to withdraw from the onitshamarket.com account of the seller and the request amount shall be remitted to the seller's bank account within 2 business days.

                                            Holds

                                            We may deduct from the Settlement Amount any expenses or loss to the Company due to sellers. To protect against the risk of liability, payments of the Settlement Amount may be subject to holds at our discretion.

                                            Content

                                            You may post reviews, comments, photos and other content; submit suggestions, ideas, comments, questions, or other information, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings or any form of "spam." You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of a card or other content. The Company reserves the right (but not the obligation) to remove or edit such content, but does not regularly review posted content.

                                            If you do post content or submit material, and unless we indicate otherwise, you are deemed to have granted the Company a nonexclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media. You are deemed to have granted the Company and sub licensees the right to use the name that you submit in connection with such content, if they choose. You represent and warrant that you own or otherwise control all of the rights to the content that you post; that the content is accurate; that use of the content you supply does not violate this policy and will not cause injury to any person or entity; and that you will indemnify the Company for all claims resulting from content you supply. The Company has the right but not the obligation to monitor and edit any activity or content. The Company takes no responsibility and assumes no liability for any content posted by you or any third party.

                                            Other Businesses

                                            Parties other than the Company operate stores, provide services, sell products or list advertisement on this Website, and this site may link to sites of affiliated companies and certain other companies. The Company is not responsible for examining or evaluating, and does not warrant the products of such business or individual or the content of their web sites. The Company does not assume any responsibility or liability for the actions, product and content of all these and any other third parties. You should carefully review their privacy statements and other conditions of use.

                                            Release

                                            If you have a dispute with one or more users, you release us (and our officers, directors, agents, subsidiaries, joint ventures and employees) from claims, demands and damages (actual and consequential) of every kind and nature, known and unknown, arising out of or in any way connected with such disputes.

                                            Access and Interference

                                            Our Website contains robot exclusion headers. Much of the information on the sites is updated on a real-time basis and is proprietary or is licensed to the Company by our users or third parties. You agree that you will not use any robot, spider, scraper or other automated means to access the sites for any purpose without our express written permission.

                                            Additionally, you agree that you will not:

                                            take any action that imposes or may impose (in our sole discretion) an unreasonable or disproportionately large load on our infrastructure;

                                            copy, reproduce, modify, create derivative works from, distribute, or publicly display any content (except for Your Information) from the Website without the prior expressed written permission of the Company and the appropriate third party, as applicable;

                                            interfere or attempt to interfere with the proper working of the Website or any activities conducted on the Website; or

                                            bypass our robot exclusion headers or other measures we may use to prevent or restrict access to the Website.

                                            Privacy

                                            We do not sell or rent your personal information to third parties for their marketing purposes without your explicit consent. We use your information only as described in our Privacy Policy. We view protection of users' privacy as a very important community principle. We store and process your information on computers that are protected by physical as well as technological security devices. You can access and modify the information you provide us and choose not to receive certain communications by signing-in to your account. We use third parties to verify and certify our privacy principles. For a complete description of how we use and protect your personal information, see our Privacy Policy. If you object to your Information being transferred or used in this way please do not use our services. For the avoidance of doubt, If onitshamarket.com has reasonable grounds to believe that any User is in breach of any of the terms of this Agreement, onitshamarket.com reserves the right, in its sole and absolute discretion, to cooperate fully with governmental authorities, private investigators, all the rightful owner(s) or interest holder(s) and/or injured third parties in the investigation of any potential or ongoing criminal or civil wrongdoing. Further, onitshamarket.com may disclose the User's identify and contact information, or such other transaction-related data, if requested by a government or law enforcement body, private investigator, rightful owner or interest holder and/or any injured third party or as a result of a subpoena or other legal action, or if onitshamarket.com is of the view, in its sole and absolute discretion, that it would be in its best interest to do so. Onitshamarket.com shall not be liable for damages or results arising from such disclosure, and the User(s) agrees not to bring action or claim against onitshamarket.com for such disclosure.

                                            Indemnity

                                            You will indemnify and hold us (and our officers, directors, agents, subsidiaries, joint ventures and employees), harmless from any claim or demand, including reasonable attorneys' fees, made by any third party due to or arising out of your breach of this Agreement, or your violation of any law or the rights of a third party.

                                            No Warranties

                                            You will not hold the Company responsible for other users' content, actions or inactions, or items they list, including things they post. You acknowledge that we are not a traditional online shopping service provider or auctioneer. Instead, we provide an electronic marketplace for buyers and sellers and arranges transactions between such buyers and sellers. The Company is responsible for operating and managing its Website and makes reasonable efforts in order to maintain efficient services. We are not involved in the actual transaction between buyers and sellers. We have no control over and do not guarantee the quality, safety or legality of items advertised, the truth or accuracy of users' content or listings, the ability of sellers to sell items, the ability of buyers to pay for items, or that a buyer or seller will actually complete a transaction.

                                            We do not transfer legal ownership of items from the seller to the buyer. Unless the buyer and the seller agree otherwise, the buyer will become the item's lawful owner upon physical receipt of the item from the seller. We cannot guarantee continuous or secure access to our services, and operation of the Website may be interfered with by numerous factors outside of our control. Accordingly, to the extent legally permitted, we exclude all implied warranties, terms and conditions. We are not liable for any loss of money, goodwill, or reputation, or any special, indirect, or consequential damages arising out of your use of our Website and services.

                                            ALL MATERIALS, INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND OTHER CONTENT CONTAINED IN THIS WEBSITE, OR OBTAINED FROM A LINKED SITE IS PROVIDED TO THE USER "AS IS" WITHOUT WARRANTY OR CONDITIONS OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OR CONDITIONS OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE, TITLE, NON-INFRINGEMENT, SECURITY OR ACCURACY. THE COMPANY HAS MADE REASONABLE EFFORTS TO POST CURRENT AND ACCURATE INFORMATION ON THIS WEBSITE; HOWEVER, THE COMPANY ASSUMES NO RESPONSIBILITY FOR ANY ERRORS, OMISSIONS OR INACCURACIES WHATSOEVER IN THE INFORMATION PROVIDED IN THIS WEBSITE. UNDER NO CIRCUMSTANCES WILL THE COMPANY BE LIABLE FOR ANY LOSS OR DAMAGE CAUSED BY THE USER'S RELIANCE ON INFORMATION OBTAINED THROUGH THIS WEBSITE. IT IS THE USER'S RESPONSIBILITY TO EVALUATE THE ACCURACY, COMPLETENESS AND USEFULNESS OF ANY INFORMATION PROVIDED, AND USE OF THIS WEBSITE IS SOLELY AT THE USER'S OWN RISK. SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES, SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO SOME USERS.

                                            Limitation of Liability

                                            THE USER SPECIFICALLY AGREES THAT THE COMPANY SHALL NOT BE RESPONSIBLE FOR UNAUTHORIZED ACCESS TO OR ALTERATION OF YOUR TRANSMISSIONS OR DATA, ANY MATERIAL OR DATA SENT OR RECEIVED OR NOT SENT OR RECEIVED, OR ANY TRANSACTIONS ENTERED INTO THROUGH THIS WEBSITE. THE USER SPECIFICALLY AGREES THAT THE COMPANY IS NOT RESPONSIBLE OR LIABLE FOR ANY THREATENING, DEFAMATORY, OBSCENE, OFFENSIVE OR ILLEGAL CONTENT OR CONDUCT OF ANY OTHER PARTY OR ANY INFRINGEMENT OF ANOTHER'S RIGHTS, INCLUDING INTELLECTUAL PROPERTY RIGHTS. THE USER SPECIFICALLY AGREES THAT THE COMPANY IS NOT RESPONSIBLE FOR ANY CONTENT SENT USING THE COMMUNICATION SERVICES AND/OR INCLUDED IN THIS SITE BY ANY THIRD PARTY.

                                            IN NO EVENT SHALL THE COMPANY BE LIABLE FOR ANY SPECIAL, INCIDENTAL, INDIRECT, PUNITIVE OR CONSEQUENTIAL DAMAGES OF ANY KIND, OR ANY DAMAGES WHATSOEVER, WHETHER IN CONTRACT, TORT, STRICT LIABILITY OR OTHERWISE, (INCLUDING WITHOUT LIMITATION, THOSE RESULTING FROM: (1) RELIANCE ON THE MATERIALS PRESENTED, (2) COSTS OF REPLACEMENT GOODS, (3) LOSS OF USE, DATA OR PROFITS, (4) DELAYS OR BUSINESS INTERRUPTIONS, (5) AND ANY THEORY OF LIABILITY) ARISING OUT OF OR IN CONNECTION WITH THE USE OF, OR INABILITY TO USE THIS WEBSITE, WHETHER OR NOT THE COMPANY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.

                                            No Agency

                                            No agency, partnership, joint venture, employer-employee or franchisor-franchisee relationship is intended or created by this User Agreement. No agency, partnership, joint venture, employer-employee or franchisor-franchisee relationship is intended, exists or is created between the Company and any buyer or seller.

                                            Notices

                                            Except as explicitly stated otherwise, any legal notices shall served on Internet Onitshamarketing Limited, via registered mail, to Plot 530A, Aina Akingbala Street (Omole Phase 2), Ikeja Lagos. Nigeria (in the case of the Company) or to the email address you provide to us during the registration process (in your case). Notice shall be deemed given 24 hours after email is sent, unless the sending party is notified that the email address is invalid. Alternatively, we may give you legal notice by mail to the address provided during the registration process. In such case, notice shall be deemed given three days after the date of mailing unless otherwise required by law.

                                            Applicable Law and Jurisdiction

                                            By visiting this Website, you agree that the laws of Nigeria, without regard to principles of conflict of laws, will govern this User Agreement and any dispute of any sort that might arise between you and the Company.

                                            The courts of Nigeria will have non-exclusive jurisdiction over any legal action or the proceedings against the Company arising out of, with respect to, or in connection with any disputes over this User Agreement and disputes between Users.

                                            General

                                            If any provision of this Agreement is held to be invalid or unenforceable, such provision shall be struck and the remaining provisions shall be enforced. Headings are for reference purposes only and do not limit the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. We do not guarantee we will take action against all breaches of this Agreement.

                                            We may amend this Agreement at any time by posting the amended terms on this site. Except as stated elsewhere, all amended terms shall automatically be effective 14 days after they are initially posted. This Agreement may not be otherwise amended except in a writing signed by you and us. This Agreement sets forth the entire understanding and agreement between us with respect to the subject matter hereof.




                                        </div>
                                    </div>
                                    <div class="form-group" style="position:static !important;">
                                        <div class="col-lg-7" style="text-align:left;margin-top:40px;">

                                            <div class="checkbox">
                                                <input id="terms" type='checkbox' name="terms"
                                                       title="Terms and Conditions"
                                                       class="magic-checkbox" required disabled>
                                                <label for="terms">I have read and accepted the Terms and
                                                    Conditions?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <div class="box-inline">
                                <button type="button" class="previous btn btn-primary">Previous</button>
                                <button type="button" class="next btn btn-primary">Next</button>
                                <button type="submit" class="finish btn btn-warning" disabled>Finish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
<!--            <div class="pad-all">-->
<!--                <a href="--><?//= base_url(); ?><!--" class="btn-link mar-rgt">Go to Homepage</a>-->
<!--            </div>-->
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/nifty.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/demo/form-wizard.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('#bus_reg').change(function () {
            if (this.checked) {
                $('#reg_opt').fadeIn('slow');
                $('#rc_num').attr('required', true);
            } else {
                $('#reg_opt').fadeOut('slow');
                $('#rc_num').attr('required', false);
            }
        });
        $('#plat_reg').change(function () {
            if (this.checked) {
                $('#plat_opt').fadeIn('slow');
                $('#platform').attr('required', true);
            } else {
                $('#plat_opt').fadeOut('slow');
                $('#platform').attr('required', false);
            }
        });

        // $('.finish').on('click', function(){
        //     $('#demo-bv-wz-form').each(function(index) {
        //         console.log($(this).attr('name') + " = " + $(this).val());
        //     });
        // })
    });
    $('.read_here').scroll(function () {
        if ($(this).scrollTop() + $(this).innerHeight() + 2 >= $(this)[0].scrollHeight) {
            $('#terms').removeAttr('disabled');
        }
    });
</script>
</body>
</html>

