<div class="card max-w-lg mx-auto border-warning" style="max-width: 600px;">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0"><?php echo isset($claim) ? 'Edit' : 'Submit New'; ?> Service Claim</h5>
    </div>
    <div class="card-body">
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form action="<?php echo isset($claim) ? base_url('claims/edit/'.$claim['id']) : base_url('claims/create'); ?>" method="post">
            <div class="mb-3">
                <label for="service_name" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="service_name" name="service_name" placeholder="e.g., NMS, CPCS" value="<?php echo isset($claim) ? $claim['service_name'] : set_value('service_name'); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="patient_identifier" class="form-label">Patient Identifier (NHS Number / initials)</label>
                <input type="text" class="form-control" id="patient_identifier" name="patient_identifier" value="<?php echo isset($claim) ? $claim['patient_identifier'] : set_value('patient_identifier'); ?>">
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Claim Amount (£)</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="<?php echo isset($claim) ? $claim['amount'] : set_value('amount'); ?>" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Submitted" <?php echo (isset($claim) && $claim['status'] == 'Submitted') ? 'selected' : ''; ?>>Submitted</option>
                    <option value="Processing" <?php echo (isset($claim) && $claim['status'] == 'Processing') ? 'selected' : ''; ?>>Processing</option>
                    <option value="Approved" <?php echo (isset($claim) && $claim['status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                    <option value="Rejected" <?php echo (isset($claim) && $claim['status'] == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?php echo base_url('claims'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-warning"><?php echo isset($claim) ? 'Update Claim' : 'Submit Claim'; ?></button>
            </div>
        </form>
    </div>
</div>
