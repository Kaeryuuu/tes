<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(url('customer')); ?>">Customer</a>
                    </li>
                    <li class="breadcrumb-item active">Index</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo e(route('customer.create')); ?>" class="btn btn-md btn-success mb-3">Tambah Customer</a>
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Customer</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">No Telepon</th>
                                        <th class="text-center">Quantity Bookings</th>
                                        <th class="text-center">Tanggal Bookings</th>
                                        <th class="text-center">Tanggal Kembali</th>
                                        <th class="text-center">Poster Film</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($item->name); ?></td>
                                        <td class="text-center"><?php echo e($item->email); ?></td>
                                        <td class="text-center"><?php echo e($item->phone); ?></td>
                                        <td class="text-center"><?php echo e($item->quantity_bookings); ?></td>
                                        <td class="text-center"><?php echo e($item->booking_date); ?></td>
                                        <td class="text-center"><?php echo e($item->return_date); ?></td>
                                        <td class="text-center">
                                            <img style="width:100px" src="<?php echo e(asset($item->poster)); ?>" alt="Poster Film">
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="<?php echo e(route('customer.destroy', $item->id)); ?>" method="POST">
                                                <a href="<?php echo e(route('customer.edit', $item->id)); ?>" class="btn btn-sm btn-primary">EDIT</a>
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="alert alert-danger">
                                                Data Customer belum tersedia
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($customer->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Semester 5\Pemrograman Web\PW7_D_11811\PW7_D_11811\resources\views/customer/index.blade.php ENDPATH**/ ?>