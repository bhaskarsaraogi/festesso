<?php include 'application/views/inc/header.php'; ?>

<section>

  <div class="page-header"><h1>Registered</h1></div>
  <p>You have been successfully registered for <?php echo $event_name ?>, watch your dashboard and email for confirmation.</p>
  <p>To register for other events, click <?php echo anchor('user/events', 'here'); ?>.</p>

</section>

<?php include 'application/views/inc/footer.php'; ?>