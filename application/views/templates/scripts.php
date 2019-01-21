<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/nifty.min.js');?>"></script>
<script src="<?= base_url('assets/js/demo/nifty-demo.min.js'); ?>"></script>
<script type="text/javascript"> base_url = '<?= base_url(); ?>';</script>
<?php if( in_array($pg_name, array('product','template','register'))) :?>
    <script src="<?= base_url('assets/plugins/dropzone/dropzone.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/demo/form-file-upload.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/demo/form-wizard.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<?php endif; ?>
<?php if( in_array($pg_name, array('manage_product'))) :?>
    <script src="<?= base_url('assets/plugins/datatables/media/js/jquery.dataTables.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/media/js/dataTables.bootstrap.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'); ?>"></script>
<?php endif; ?>
<?php if( in_array($pg_name, array('overview','report','orders'))) :?>
    <script src="<?= base_url('assets/plugins/datatables/media/js/jquery.dataTables.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/media/js/dataTables.bootstrap.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('assets/plugins/morris-js/morris.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/morris-js/raphael-js/raphael.min.js'); ?>"></script>
<?php endif; ?>
<?php if( $pg_name === 'register') :?>
    <script src="<?= base_url('assets/js/demo/form-file-upload.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/demo/form-wizard.js'); ?>"></script>
<?php endif; ?>