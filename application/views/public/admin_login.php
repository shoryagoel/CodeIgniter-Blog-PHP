<?php
include('public_header.php');

?>
<div class="container">
    <?php echo form_open('login/admin_login', ['class' => 'form-horizontal']) ?>
    <fieldset>
        <legend>Admin Login</legend>
        <div class="row">
            <div class="col-lg-6">
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">

                <div class="form-group">
                    <label for="exampleInputEmail1">Username:</label>
                    <?php echo form_input(['name' => 'username', 'value' => set_value('username'), 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter Username Here']); ?>
                    <?php
                    if (!empty($error['username'])) {
                        echo $error['username'];
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <?php echo form_error('username', "<p class='text-danger'>", "</p>"); ?> 
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputPassword1">Password:</label>
                    <?php echo form_password(['name' => 'password', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'placeholder' => 'Enter Password Here']); ?>
                        <?php
                    if (!empty($error['password'])) {
                        echo $error['password'];
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <?php echo form_error('password'); ?> 
        </div>
    </fieldset>
    <?php echo form_reset(['name' => 'reset', 'value' => 'Reset', 'class' => 'btn btn-default']); ?>
    <?php echo form_submit(['name' => 'Submit', 'value' => 'Login', 'class' => 'btn btn-primary']); ?>
    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
</fieldset>
</div>

<?php include('public_footer.php'); ?>