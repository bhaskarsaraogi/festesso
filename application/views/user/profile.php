<?php include 'application/views/inc/header.php'; ?>

<?php if ($user_details) { ?>

<section>

  <div class="page-header"><h1><?php echo $user_details->name; ?> <small>User Profile</small></h1></div>

  <div class="profile well">

    <?php if ($user_details->image_thumb) { ?>
    <figure class="pull-right">
      <img class="thumbnail" src="<?php echo site_url().'uploads/'.$user_details->image_thumb; ?>" alt="<?php echo $user_details->name.'\'s Photograph' ?>" />
    </figure>
    <?php } ?>

    <dl>
      <dt>Name</dt>
      <dd><?php echo $user_details->name; ?></dd>
      <dt>Date of Birth</dt>
      <dd><?php echo $user_details->dob; ?></dd>
      <dt>Contact Number</dt>
      <dd><?php echo $user_details->contact; ?></dd>
    </dl>
  </div>

  
<?php } ?>

<?php include 'application/views/inc/footer.php'; ?>