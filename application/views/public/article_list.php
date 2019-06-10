<?php include('public_header.php'); ?>  
<div class="container">
    <h2>All Articles</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <td>Sr. No.</td>
                <td>Article List</td>
                <td>Published On</td>
            </tr>
        </thead>
        <tbody>
            <?php if(count($articles)){
                $count = $this->uri->segment(3,0);
                foreach ($articles as $article){
            ?>
            <tr>
                <td><?php echo ++$count; ?> </td>
                <td><?php echo anchor("user/article/{$article->id}",$article->title); ?></td>
                <td><?php echo $article->created_at; ?></td>
            </tr>
            <?php  } }  
            else{ ?>
            <tr>
                <td colspan="3">No Records Found.</td> 
            </tr>
            <?php } ?> 
        </tbody>
    </table>
    <?php echo $this->pagination->create_links(); ?>
</div>

<?php include('public_footer.php'); ?>  