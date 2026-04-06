<div class="card max-w-lg mx-auto border-success" style="max-width: 600px;">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><?php echo isset($prescription) ? 'Edit' : 'New'; ?> Request Email to GP</h5>
    </div>
    <div class="card-body">
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form action="<?php echo isset($prescription) ? base_url('prescriptions/edit/'.$prescription['id']) : base_url('prescriptions/create'); ?>" method="post">
            <div class="mb-3">
                <label for="patient_name" class="form-label">Patient Name & DOB</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" placeholder="e.g., John Doe - 01/01/1980" value="<?php echo isset($prescription) ? $prescription['patient_name'] : set_value('patient_name'); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="gp_surgery" class="form-label">GP Surgery Name</label>
                <input type="text" class="form-control" id="gp_surgery" name="gp_surgery" value="<?php echo isset($prescription) ? $prescription['gp_surgery'] : set_value('gp_surgery'); ?>" required>
            </div>

            <div class="mb-3">
                <label for="medications" class="form-label">Requested Medications</label>
                <textarea class="form-control" id="medications" name="medications" rows="4" placeholder="List items like: Amlodipine 5mg, Aspirin 75mg"><?php echo isset($prescription) ? $prescription['medications'] : set_value('medications'); ?></textarea>
                <div class="form-text">This information will be used to track the request sent to the GP.</div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Requested" <?php echo (isset($prescription) && $prescription['status'] == 'Requested') ? 'selected' : ''; ?>>Requested (Sent to GP)</option>
                    <option value="Processed" <?php echo (isset($prescription) && $prescription['status'] == 'Processed') ? 'selected' : ''; ?>>Processed (Received back)</option>
                    <option value="Completed" <?php echo (isset($prescription) && $prescription['status'] == 'Completed') ? 'selected' : ''; ?>>Completed (Ready for patient)</option>
                </select>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?php echo base_url('prescriptions'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success"><?php echo isset($prescription) ? 'Update Request' : 'Save Request'; ?></button>
            </div>
        </form>
    </div>
</div>
