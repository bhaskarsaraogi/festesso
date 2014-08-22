<?php include 'application/views/inc/header.php'; ?>

<section>
  <div class="page-header"><h1>Enter New Password </h1></div>
  
  <div class="well well-large">
    <!-- <h2>Change Your Password</h2> -->
    <?php echo form_open('main/password_reset', array('class' => 'form-horizontal')); ?>
    <div class="control-group">
      <?php echo form_label('New Password', 'password', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_password = array(
            'name'          => 'password',
            'id'            => 'password',
            'class'         => 'span3'
            );
          echo form_password($arr_password);
          ?>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Confirm New Password', 'passconf', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_passconf = array(
            'name'          => 'passconf',
            'id'            => 'passconf',
            'class'         => 'span3'
            );
          echo form_password($arr_passconf);
          ?>
        </div>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <?php
        $arr_button = array(
          'name'  => 'submit',
          'value' => 'Update Password',
          'class' => 'btn btn-info span3'
          );
        echo form_submit($arr_button);
        ?>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>


  <p>Please send a mail to <a href="mailto:admin@bits-melange.com">admin@bits-melange.com</a> from your BITS mail so that we can send you a new password.</p>
</section>

<?php include 'application/views/inc/footer.php'; ?>