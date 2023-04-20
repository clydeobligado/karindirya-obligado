<?php if ($edit) { ?>
    <h3 class="fw-bold">
        Edit Product
    </h3>
<?php } else { ?>
    <h3 class="fw-bold">
        View Product
    </h3>
<?php } ?>
<!-- if not null si validation errors lalabas si div class -->
<!-- validation errors are the errors from the form -->

<?php if (!null == validation_errors()) : ?>
    <div class="alert alert-danger col-md-4 " role="alert">
        <?php echo validation_errors(); ?>
    </div>

<?php endif; ?>
<div class="col-md-4">
    <!-- when the form is submitted, this function in the controller will be called. -->
    <?php echo form_open_multipart('Products/processEditProduct/'. $product->prod_id); ?>
    <form>
        <br>
        <div class="form-group">
            <label for="prod_name">Prod name</label>
            <input name="prod_name" type="text" class="form-control" id="prod_name" placeholder="Prod name" value="<?php echo $product->prod_name; ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="prod_description">Prod Description</label>
            <input name="prod_description" type="text" class="form-control" id="prod_description" placeholder="Prod description" value="<?php echo $product->prod_description; ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="prod_price">Prod Price</label>
            <input name="prod_price" type="text" class="form-control" id="prod_price" placeholder="Prod price" value="<?php echo $product->prod_price; ?>">
        </div>
        <br>
        <br>
        <a type="a" class="btn btn-primary" href="<?= base_url('home/view_products'); ?>">Back</a>
        <?php if ($edit) : ?>
            <button type="submit" class="btn btn-success">Update</button>
        <?php endif ?>
    </form>
</div>