<?php include 'application/views/inc/header.php'; ?>



<section>

  <div class="page-header"><h1>Events <small>Register Here</small></h1></div>

  <div class="">
    <?php 
      if ($event_details) {
        foreach ($event_details as $value) {
    ?>
   <div class="profile well">

    <figure class="pull-right">
      <img class="thumbnail" src="https://success.salesforce.com/resource/1402185600000/sharedlayout/img/new-user-image-default.png" alt="" />
    </figure>
    
    <dl>
      <dt>Event Name:</dt>
      <dd><?php echo $value->event_name; ?></dd>
      <dt>Event Description:</dt>
      <dd><?php echo $value->event_desp; ?></dd>
      <dt>Minimum Participants:</dt>
      <dd><?php echo $value->min_part; ?></dd>
      <dt>Minimum Participants:</dt>
      <dd><?php echo $value->max_part; ?></dd>
    </dl>
    <a href="<?php echo site_url()."/user/events/register/".$value->event_id; ?>"><button class="btn btn-primary span3">Register</button></a>
  
    
      
    </div>
    
   <?php
    }}
    else {
      ?>
      <p>No results found.</p>
      <?php
    }
    ?>    

     

  </div>



<?php include 'application/views/inc/footer.php'; ?>