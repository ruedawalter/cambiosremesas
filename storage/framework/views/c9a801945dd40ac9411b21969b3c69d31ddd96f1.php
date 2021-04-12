<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default" style="background-color: #ffffff">
                <div class="Panel-heading py-1 px-3"><h2><?php echo e(__('Dashboard')); ?></h2></div>
                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                        
                         <?php if(Auth::user()->id_rol_user == 1): ?>
                            
                            <div class="px-2 py-2">
                                <table class="table table-responsive mx-auto nowrap px-2 py-2">
                                    <tr>
                                        <td class="">
                                            <a href="<?php echo e(route('bancos.index')); ?>" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="fas fa-university"></i>  <?php echo e(__('Banks')); ?></a>
                                        </td>
                                        <td class="">
                                            <a href="<?php echo e(route('documentos.index')); ?>" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="far fa-file-alt"></i>  <?php echo e(__('Type Documents')); ?></a>
                                        </td>
                                        <td class="">
                                            <a href="<?php echo e(route('estados.index')); ?>" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="fas fa-info"></i>  <?php echo e(__('Status')); ?></a>
                                        </td>
                                        <td class="">
                                            <a href="<?php echo e(route('paises.index')); ?>" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="fas fa-globe"></i>  <?php echo e(__('Countries')); ?></a>
                                        </td>
                                        <td class="">
                                            <a href="<?php echo e(route('titulares.index')); ?>" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="far fa-address-card"></i>  <?php echo e(__('Owners')); ?></a>
                                        </td>
                                    </tr>
                                    <td></td>
                                    <tr class="">
                                        <td class="">
                                            <a href="<?php echo e(route('paises.index')); ?>" class="btn btn-success btn-lg" width="35px" height="35px"><i class="fas fa-university"></i>  <?php echo e(__('Countries')); ?></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php endif; ?>

                    <?php echo e(__('You are logged in!')); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\cambios\resources\views/home.blade.php ENDPATH**/ ?>