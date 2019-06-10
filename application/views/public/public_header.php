<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    
</head>    
    
<body style="background:#ffcc33;;">  
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
       <a class="navbar-brand" href="<?php echo base_url('user');?>">Article List</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url('login');?>" >Login<span class="sr-only">(current)</span></a></li>
      <li><a class="nav-link" href="<?php echo base_url('login/sign_up');?>" >Sign Up<span class="sr-only">(current)</span></a></li>
    </ul>
      <?php echo form_open('user/search',['class'=>"form-inline my-2 my-lg-0"]); ?>
      <input class="form-control mr-sm-2" name="query" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      
      <?php echo form_error('query',"<p class='text-danger'","</p>"); ?>
    <?php echo form_close(); ?>
    
  </div>
</nav>