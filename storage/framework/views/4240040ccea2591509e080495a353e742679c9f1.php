<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <form action="/storeNewDep" method="POST">

                <label>Department Name:</label>
                <input type="text" name="dep_name" class="form-control input-lg" value="">

                <?php echo e(Form::label('department_id', 'Parent department: ')); ?>


                <select class="form-control input-lg" name="department_id">
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->department_id); ?>"><?php echo e($department->dep_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <hr>
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="submit" class="btn btn-success btn-block">
                </form>
            </div>


            <div class="col-md-4">
            <form name="myForm" action="">
                <label>Department Name: </label>

                <select id="e" class="form-control input-lg" name="department_id" onchange="test()">

                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->department_id); ?>"><?php echo e($department->dep_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>
                <hr>

                <a id="link" class="btn btn-block btn-danger" ><i class="glyphicon glyphicon-remove"></i>  Delete Department  </a>
            </form>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>

    function test(myForm) {
   /* var i = document.getElementById('e').selected;*/
        var button = document.getElementById('link');
        button.setAttribute('href','');
        var e = document.getElementById("e");
        var selectedDep = e.options[e.selectedIndex].value;
        var url = '/deleteDep/'+selectedDep;
        button.setAttribute('href',url);

    }

    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>