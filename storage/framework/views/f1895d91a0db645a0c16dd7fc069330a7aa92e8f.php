

<?php $__env->startSection('title', 'Book List'); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .thumbnail {
            height: 100px;
        }

        .card-img-top {
            height: 300px;
            object-fit: contain;
        }

        .book {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
            transition: 0.3s;
            margin: 20px 0;
        }

        .book-list {
            display: table;
            width: 100%;
            margin: 15px 0;
        }

        .book-list .book {
            display: table-cell;
            padding: 16px;
        }

        .cs-pagination li.page-item{
            margin: 0 4px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="head py-3 d-flex justify-content-between align-items-center">
            <h2>Book List</h2>
            <div class="buttons">
                <a href="<?php echo e(route('getBooks')); ?>" class="btn btn-primary">Import Books</a>
                <a href="<?php echo e(route('logout')); ?>" class="btn btn-secondary">Logout</a>
            </div>
        </div>

        
        <?php if(Session::has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(Session::get('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        
        <?php if(Session::has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(Session::get('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <section class="pb-3 pt-1">
            <?php if($books): ?>
                <div class="row">
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $image = '';
                            if ($book['thumbnail']) {
                                $image = $book['thumbnail'];
                            } elseif ($book['small_thumbnail']) {
                                $image = $book['small_thumbnail'];
                            }
                        ?>
                        <div class="book-list col-lg-4 col-md-6 col-sm-12">
                            <div class="book">
                                <img src="<?php echo e($image); ?>" class="card-img-top" alt="<?php echo e($book['title']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($book['title']); ?></h5>
                                    <p class="card-text"><b><?php echo e($book['subtitle']); ?></b></p>
                                    <p class="card-text">Authors: <?php echo e($book['authors']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
                <div class="cs-pagination d-flex align-items-center justify-content-center py-2 ">
                    <?php echo e($books->links('pagination::bootstrap-4')); ?>

                </div>
            <?php endif; ?>
        </section>
    
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH J:\xampp\htdocs\Assignment\resources\views/books/view_book.blade.php ENDPATH**/ ?>