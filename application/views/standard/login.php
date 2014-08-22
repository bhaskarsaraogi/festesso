<?php include 'application/views/inc/header.php'; ?>

<section>
  <div class="page-header"><h1>Login to access your profile</h1></div>

  <?php echo form_open('main/login', array('class' => 'form-horizontal')); ?>
  <div class="control-group">
    <?php echo form_label('Username', 'user_name', array('class' => 'control-label')); ?>
    <div class="controls">
      <div>
        <?php
        $arr_user_name = array(
          'name'          => 'user_name',
          'id'            => 'user_name',
          'class'         => 'span3',
          'placeholder'   => 'Username/email',
          'value'         => set_value('user_name')
          );
        echo form_input($arr_user_name);
        ?>
      </div>
    </div>
  </div>
  <div class="control-group">
    <?php echo form_label('Password', 'password', array('class' => 'control-label')); ?>
    <div class="controls">
      <div>
        <?php
        $arr_password = array(
          'name'          => 'password',
          'id'            => 'password',
          'class'         => 'span3',
          'placeholder'   => 'Password',
          'value'         => set_value('password')
          );
        echo form_password($arr_password);
        ?>
      </div>
    </div>
  </div>
  <div class="control-group">
    <?php
    $arr_button = array(
      'name'  => 'submit',
      'value' => 'Login',
      'class' => 'btn btn-primary span3'
      );
      ?>
      <div class="controls">
        <?php
        echo form_submit($arr_button);
        ?>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <?php
        echo anchor('/main/forgot_password', 'Forgot Password', array('title' => 'Forgot Passoword', 'class' => 'btn'));
        ?>
      </div>
    </div>
    
    <?php
    echo form_close();
    if ($error != "") {
      ?>
      <div class="alert alert-error">
        <p><?php echo $error; ?></p>
      </div>
      <?php
    }
    echo validation_errors();
    ?>
  </section>

  <?php include 'application/views/inc/footer.php'; ?>