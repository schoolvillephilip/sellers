<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $page_title; ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/png">
    <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/png">
    <link rel="canonical" href="<?= current_url(); ?>"/>
    <meta name="robots" content="noindex,nofollow">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" type="text/css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600|Oxygen' rel='stylesheet' type='text/css'>
    <link href="<?= base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/nifty.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/demo/nifty-demo-icons.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/select2/css/select2.min.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <?php if( in_array($pg_name, array('product','template','register'))) :?>
        <link href="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.css')?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/dropzone/dropzone.min.html')?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')?>" rel="stylesheet">
    <?php endif; ?>
    <?php if( in_array($pg_name, array('manage_product','overview','message','report','orders') ) ): ?>
        <link href="<?= base_url('assets/plugins/datatables/media/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css'); ?>" rel="stylesheet">
    <?php endif;?>
    <style>
        #demo-nifty-settings{ display: none; }
        .panel-title{ color:#fff; background: #425865 !important; }
        .panel-title:hover{ background: #1ca28b !important; color:#fff; }
        body { font-family: 'Oxygen', sans-serif !important; color: #354645; }
        #footer { color: #fff; background-color: #2ba27d;}
    </style>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5c8b67c4101df77a8be2b49b/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

