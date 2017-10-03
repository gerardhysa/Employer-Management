<?php $__env->startSection('content'); ?>;
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="users-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
    <?php $__env->startPush('scripts'); ?>
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo route('datatables.data'); ?>',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'surname', name: 'surname' },
                    { data: 'email', name: 'email' },
                    { data: 'dep_name', name: 'dep_name' },
                    { data: 'address', name: 'address' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>