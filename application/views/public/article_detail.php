<?php include('public_header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h2>
                <?php echo $article->title; ?>
            </h2>
        </div>
        <div class="col-lg-6">
            <span class="pull-right">
                <?php echo $article->created_at; ?>
            </span>
        </div>
    </div>
<hr>
<p>
    <?php echo $article->body; ?>
</p>
<?php if(!is_null($article->image_path)){?>
<img src= <?php echo base_url("uploads/".$article->image_path); ?> alt="" />
<?php } ?>
</div>
<?php include('public_footer.php'); ?>