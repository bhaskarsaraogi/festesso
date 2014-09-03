<?php include 'application/views/inc/header.php'; ?>

<section>
  <div class="page-header"><h1>Account Not Verified</h1></div>
  <p>
    Your account has not been verified. Please confirm it first.
  </p>
  <p>
  Or <?php echo anchor('main/resend_verification_mail', 'Click here'); ?> to resend verification mail.
  </p>
</section>

<?php include 'application/views/inc/footer.php'; ?>