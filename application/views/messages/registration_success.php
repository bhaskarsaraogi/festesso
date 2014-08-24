<?php include 'application/views/inc/header.php'; ?>

<section>
  
  <div class="page-header"><h1>Registration Success</h1></div>
  <p>
    Your account has been created.<br>
    To login, please verify your account by clicking on the verification mail sent on your email.
  </p>
  <?php anchor('main/resend_verification_mail', 'Click here')." to resend verification mail."; 
) ?>
  
</section>

<?php include 'application/views/inc/footer.php'; ?>