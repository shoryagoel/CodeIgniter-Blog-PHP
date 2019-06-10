<?php include('admin_header.php'); ?>
<div class="container">
    <?php echo form_open_multipart(base_url("admin/do_edit_article/$result->id"), ['class' => 'form-horizontal']) ?>
   
    <fieldset>
        <legend>Edit Article</legend>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Article Title</label>
                    <?php echo form_input(['name' => 'title', 'value' => set_value('title',$result->title), 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter Title Here']); ?>
                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> -->
                    <?php
                    if (!empty($error['title'])) {
                        echo $error['title'];
                    }
                    ?>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputPassword1">Article Body</label>
                    <?php echo form_textarea(['name' => 'body', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'value' => set_value('body',$result->body), 'placeholder' => 'Enter Article Here']); ?>
                    <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                    <?php
                    if (!empty($error['body'])) {
                        echo $error['body'];
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-4 control-label">Select a File</label>
                    <div class="col-lg-8">
                        <?php // print_r($result->image_path); ?>
                        <?php echo form_upload(['name'=>'userfile','class'=>'form-control','value' => set_value('userfile',$result->image_path)]); ?>
                    <?php
                    if (!empty($error['userfile'])) {
                        echo $error['userfile'];
                    }
                    ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <?php if(isset($upload_error)){echo $upload_error;} ?>
            </div>
        </div>
       
       <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-primary">Back</a>
        <?php echo form_submit(['name' => 'Submit', 'value' => 'Submit', 'class' => 'btn btn-primary']); ?>
        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
        </form>
    </fieldset>
</div>
<?php include 'admin_footer.php'; ?>

