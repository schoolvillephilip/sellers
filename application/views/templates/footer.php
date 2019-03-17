<footer id="footer">
    <p class="pad-lft">© 2015 - <?= date('Y'); ?> Internet Onitshamarketing Limited All rights reserved</p>
</footer>
<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/nifty.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/demo/nifty-demo.min.js'); ?>"></script>
<!--<script src="--><?//= base_url('assets/plugins/select2/js/select2.js')?><!--"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript"> base_url = '<?= base_url(); ?>';</script>
<script>
    var HW_config = {
        selector: ".change_log_list", // CSS selector where to inject the badge
        account: "yoN2XJ" // your account ID, you can find it in Settings->Widget
    };
</script>
<script async src="https://cdn.headwayapp.co/widget.js"></script>
<script>
    $(document).ready(function () {
        let frame = $('#HW_frame_cont');
        let control = $('#change_log');
        control.on("click", function () {
            let vis = frame.css('visibility');
            if (vis === "hidden") {
                frame.css("visibility", "visible");
            }
            if (vis === "visible") {
                frame.css("visibility", "hidden");
            }
        });
        $('.select2').select2();
    });
</script>