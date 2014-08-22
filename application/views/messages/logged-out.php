<?php include 'application/views/inc/header.php'; ?>

<section>
  
  <div class="page-header"><h1>Logged Out</h1></div>
  <p>You have been successfully logged out.</p>
  <p>To login again, click <?php echo anchor($type.'/login', 'here'); ?>.</p>
  
</section>

<?php include 'application/views/inc/footer.php'; ?>