<html>

<head>
    <title>App Name - ESB App</title>

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #EEF2FF;
            color: black;
            text-align: center;
        }

    </style>

</head>

<body>
    <?php $__env->startSection('sidebar'); ?>

    <?php echo $__env->yieldSection(); ?>
    <br>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="text-center footer">

        ESB Apps <br>
        by Linda Sebastian <br>
        <?php echo e(now()->year); ?>


    </div>
</body>

</html><?php /**PATH /Users/lindasebastian/Documents/work/esb-app/resources/views/layouts/app.blade.php ENDPATH**/ ?>