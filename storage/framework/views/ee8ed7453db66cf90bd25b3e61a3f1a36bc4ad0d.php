<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <?php echo $__env->yieldContent('header_script'); ?>

    <?php echo $__env->yieldContent('style'); ?>
</head>

<body>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php echo $__env->yieldContent('footer_script'); ?>
</body>

</html>
<?php /**PATH J:\xampp\htdocs\Assignment\resources\views/layouts/layout.blade.php ENDPATH**/ ?>