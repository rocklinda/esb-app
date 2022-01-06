<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>ESB Apps</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo e(route('invoices.create')); ?>" title="Create a invoice"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Invoice ID</th>
            <th>From</th>
            <th>For</th>
            <th>Issue Date</th>
            <th>Due Date</th>
            <th>Subject</th>
            <th>Subtotal</th>
            <th>Tax</th>
            <th>Payments</th>
            <th>Date Creation</th>
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($invoice->supplier->name); ?></td>
                <td><?php echo e($invoice->customer->name); ?></td>
                <td><?php echo e($invoice->issue_date); ?></td>
                <td><?php echo e($invoice->due_date); ?></td>
                <td><?php echo e($invoice->subject); ?></td>
                <td><?php echo e($invoice->subtotal); ?></td>
                <td><?php echo e($invoice->tax); ?></td>
                <td><?php echo e($invoice->payment); ?></td>
                <td><?php echo e($invoice->created_at); ?></td>
                <td>
                    <form action="<?php echo e(route('invoices.destroy', $invoice->id)); ?>" method="POST">

                        <a href="<?php echo e(route('invoices.show', $invoice->id)); ?>" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="<?php echo e(route('invoices.edit', $invoice->id)); ?>">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <?php echo $invoices->links(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/lindasebastian/Documents/work/esb-app/resources/views/invoices/index.blade.php ENDPATH**/ ?>