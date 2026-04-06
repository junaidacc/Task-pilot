<div class="card max-w-lg mx-auto border-danger" style="max-width: 600px;">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0">Add Invoice to Check list</h5>
    </div>
    <div class="card-body">
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form action="<?php echo base_url('invoices/create'); ?>" method="post">
            <div class="mb-3">
                <label for="invoice_number" class="form-label">Invoice Number</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="<?php echo set_value('invoice_number'); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="supplier_name" class="form-label">Supplier Name</label>
                <select class="form-select" id="supplier_name" name="supplier_name" required>
                    <option value="">-- Select Supplier --</option>
                    <option value="Alliance Healthcare">Alliance Healthcare</option>
                    <option value="AAH Pharmaceuticals">AAH Pharmaceuticals</option>
                    <option value="Phoenix Healthcare">Phoenix Healthcare</option>
                    <option value="Sigma Pharmaceuticals">Sigma Pharmaceuticals</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="total_amount" class="form-label">Total Amount (£)</label>
                <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" value="<?php echo set_value('total_amount'); ?>" required>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?php echo base_url('invoices'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-danger">Add Invoice</button>
            </div>
        </form>
    </div>
</div>
