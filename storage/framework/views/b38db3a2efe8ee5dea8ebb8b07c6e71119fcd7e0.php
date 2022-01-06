<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?php echo e(route('invoices.index')); ?>" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('invoices.update', $invoice->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="supplier-option">From:</label>
                    <select class="form-control" id="supplier_id" name="supplier_id">
                    <option value="" disabled>Select supplier</option>
                      <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($supplier->id); ?>" <?php if($supplier->id == $invoice->supplier_id): ?> selected  <?php endif; ?>><?php echo e($supplier->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="customer-option">For:</label>
                    <select class="form-control" id="customer_id" name="customer_id">
                    <option value="" disabled>Select customer</option>
                      <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($customer->id); ?>" <?php if($customer->id == $invoice->customer_id): ?> selected  <?php endif; ?>><?php echo e($customer->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subject:</strong>
                    <input type="text" name="subject" class="form-control" placeholder="Subject" value="<?php echo e($invoice->subject); ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Due Date:</strong>
                    <input type="date" name="due_date" class="form-control" placeholder="Due Date" value="<?php echo e($invoice->due_date); ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Issue Date:</strong>
                    <input type="date" name="issue_date" class="form-control" placeholder="Issue Date" value="<?php echo e($invoice->issue_date); ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Payment:</strong>
                    <input type="number" name="payment" class="form-control" placeholder="Payment" value="<?php echo e($invoice->payment); ?>">
                </div>
            </div>
            <table class="table" id="items_table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                    </tr>
                </thead>                
                <tbody>
                <?php $__currentLoopData = $invoice->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="item0">
                        <td>
                            <select name="items[]" class="form-control" id=items>
                                <option value="" disabled>-- choose item --</option>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>" <?php if($item->id == $detail->item_id): ?> selected  <?php endif; ?>>
                                        <?php echo e($item->description); ?> ($<?php echo e(number_format($item->unit_price, 2)); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="quantities[]" class="form-control" value="<?php echo e($detail->quantity); ?>" />
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" id="add_row" class="btn btn-default">+ Add Row</button>
                    <button type="button" id='delete_row' class="btn btn-danger">- Delete Row</button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
  $(document).ready(function(){
    let row_number = <?php echo e(count(old('items', ['']))); ?>;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#item' + row_number).html($('#item' + new_row_number).html()).find('td:first-child');
      $('#items_table').append('<tr id="item' + (row_number + 1) + '"></tr>');
      row_number++;
    });
    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#item" + (row_number - 1)).html('');
        row_number--;
      }
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/lindasebastian/Documents/work/esb-app/resources/views/invoices/edit.blade.php ENDPATH**/ ?>