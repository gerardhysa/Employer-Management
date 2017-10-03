<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2 ">
                <img src="/uploads/avatars/<?php echo e($user->avatar); ?>" style="width:150px;
                height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2><?php echo e($user->name); ?>'s Profile</h2>
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
                <hr>
            </div>

            <div class="col-md-8 col-md-offset-2 ">

                <form action="/profileupdate" method="POST">

                    <label>Name</label>
                    <input type="text" name="name" class="form-control input-lg" value="<?php echo e($user->name); ?>">


                    <label>Surname</label>
                    <input type="text" name="surname" class="form-control input-lg" value="<?php echo e($user->surname); ?>">

                    <label>Address</label>
                    <input type="text" name="address" class="form-control input-lg" value="<?php echo e($user->address); ?>">

                <hr>

                <div class="col-sm-6 col-md-offset-3">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="submit" class="btn btn-success btn-block">
                </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>