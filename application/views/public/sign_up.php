<?php include('public_header.php'); ?>
<div class="container">
<?php echo form_open('login/do_sign_up'); ?>
  <fieldset>
    <legend>Sign up Form</legend>
    
   <div class="row">
            <div class="col-lg-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <!--<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">-->
      <?php echo form_input(['name'=>'username','type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','placeholder'=>"Enter Username"]);?>
      <?php if(!empty($error['username'])){echo $error['username'];} ?>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">First Name</label>
      <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name"> -->
      <?php echo form_input(['name'=>'fname','type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','placeholder'=>"Enter First Name"]);?>
      <?php if(!empty($error['fname'])){echo $error['fname'];} ?>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Last Name</label>
      <?php echo form_input(['name'=>'lname','type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','placeholder'=>"Enter Last Name"]);?>
      <?php if(!empty($error['lname'])){echo $error['lname'];} ?>
      <!--<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Last Name">-->
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <?php echo form_password(['name'=>'pword','type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','placeholder'=>"Enter Password"]);?>
      <?php if(!empty($error['pword'])){echo $error['pword'];} ?>
      <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">-->
    </div>
            </div>
   </div>
    <?php echo form_submit(['name' => 'Submit', 'value' => 'Register', 'class' => 'btn btn-primary']); ?>
    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
  </fieldset>
</form>
</div>
<?php include('public_footer.php'); ?>