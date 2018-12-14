<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-<?php echo e($id); ?>">
    <?php echo e(__('Delete')); ?>

</button>

<!-- Modal -->
<div class="modal fade" id="delete-modal-<?php echo e($id); ?>" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label-<?php echo e($id); ?>" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modal-label-<?php echo e($id); ?>">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
                
            
            <div class="modal-footer">
                <form id="delete-form-<?php echo e($id); ?>" action="<?php echo e($action); ?>" method="POST" style="display: none;">
                    <?php echo method_field('DELETE'); ?>
                    <?php echo csrf_field(); ?>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="<?php echo e($action); ?>"
                   onclick="event.preventDefault();
                           document.getElementById('delete-form-<?php echo e($id); ?>').submit();">
                    <?php echo e(__('Confirm Delete')); ?>

                </a>
            </div>
        </div>
    </div>
</div>