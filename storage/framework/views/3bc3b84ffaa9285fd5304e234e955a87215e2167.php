<?php echo $__env->make('layouts._head_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
        <?php echo $__env->make('layouts._nav_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main class="">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
</body>
	<?php echo $__env->yieldContent('scripts'); ?>
    <?php echo $__env->make('layouts._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</html>
<?php /**PATH C:\laragon\www\cambios\resources\views/layouts/layout.blade.php ENDPATH**/ ?>