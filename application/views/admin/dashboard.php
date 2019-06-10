 <?php include('admin_header.php'); ?>  
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-6">
            <a href="<?php echo base_url('admin/add_article'); ?>" class="btn btn-lg btn-primary">Add Article</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-6">
            <?php if(!empty($success)){echo "<h5>".$success."</h5>"; } ?>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>Sr.No.</th>
            <th>Title</th>
            <th>Action</th>
        </thead>
        <tbody>
             <?php if(count($articles)){
             $val = $this->uri->segment(3,0);    
             ?>
              <?php  foreach ($articles as $article){ ?>
            <tr>
                <td><?php echo ++$val; ?></td>
                <td><?php echo $article->title; ?></td>
                <td>
                    <div class="row">
                        <div class="col-lg-2">
                            <?php echo anchor("admin/edit_article/{$article->id}",'Edit',['class'=>"btn btn-primary"]); ?>
                        </div>
                        <div class="col-lg-2">
                            <?php echo form_open('admin/delete_article');
                            echo form_hidden('article_id',$article->id);
                             //echo anchor("admin/delete_article",'Delete',['class'=>"btn btn-danger"]);
                            echo form_submit(['name'=>'submit','value'=>'Delete','class'=>'btn btn-danger']);
                            echo form_close();?>
                        </div>
                    </div>
                </td>
            </tr>
             <?php } ?>
             <?php } else{ ?>
             <tr>
                <td colspan="3">No Records Found.</td> 
             </tr>
             <?php } ?>       
        </tbody>
    </table>
    <div class="text-center">
    <?php echo $this->pagination->create_links(); ?>
    </div>
</div>
<?php include('admin_footer.php'); ?>  