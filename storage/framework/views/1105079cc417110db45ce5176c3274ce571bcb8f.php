<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2 ">
                <img src="/uploads/avatars/default.jpg" style="width:150px;
                height:150px; float:left; border-radius:50%; margin-right:25px;">
                <h2>New Profile</h2>
                <form enctype="multipart/form-data" action="/storeNewUser" method="POST">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
                <hr>
            </div>

            <div class="col-md-8 col-md-offset-2 ">

                <form action="/storeNewUser" method="POST">

                    <label>Name</label>
                    <input type="text" name="name" class="form-control input-lg" value="">

                    <label>Surname</label>
                    <input type="text" name="surname" class="form-control input-lg" value="">

                    <label>Email</label>
                    <input type="text" name="email" class="form-control input-lg" value="">

                    <?php echo e(Form::label('department_id', 'Department: ')); ?>


                    <select class="form-control input-lg" name="department_id">
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->department_id); ?>"><?php echo e($department->dep_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <label>Address</label>
                    <input type="text" name="address" class="form-control input-lg" value="">

                    <label>Role</label>

                    <select class="form-control input-lg" name="admin">
                            <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>

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