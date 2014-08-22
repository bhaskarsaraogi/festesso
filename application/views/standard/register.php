<?php include 'application/views/inc/header.php'; ?>

<section>
  <div class="page-header"><h1>Register</h1></div>
  
  <?php echo form_open('main/register', array('class' => 'form-horizontal')); ?>
  <div class="control-group">
    <?php echo form_label('Email', 'user_name', array('class' => 'control-label')); ?>
    <div class="controls">
      <div>
        <?php
        $arr_user_name = array(
          'name'          => 'user_name',
          'id'            => 'user_name',
          'class'         => 'span3',
          'placeholder'   => 'Email',
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
    <?php echo form_label('Confirm Password', 'passconf', array('class' => 'control-label')); ?>
    <div class="controls">
      <div>
        <?php   
        $arr_passconf = array(
          'name'          => 'passconf',
          'id'            => 'passconf',
          'class'         => 'span3',
          'placeholder'   => 'Confirm Password',
          'value'         => set_value('passconf')
          );
        echo form_password($arr_passconf);
        ?>
      </div>
    </div>
  </div>
  <div class="control-group">
    <?php
    $arr_button = array(
      'name'  => 'submit',
      'value' => 'Register',
      'class' => 'btn btn-primary span3'
      );
      ?>
      <div class="controls">
        <?php
        echo form_submit($arr_button);
        ?>
      </div>
    </div>
    <?php
    echo form_close();
    if ( $error != NULL )
      echo '<div class="alert alert-error">'. $error.' </div>';
    echo validation_errors();
    ?>
  </section>

  <?php include 'application/views/inc/footer.php'; ?>