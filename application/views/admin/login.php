<?php include 'application/views/inc/header.php'; ?>

<section>
  <div class="page-header"><h1>Administrator Login</h1></div>

  <?php echo form_open('admin/login', array('class' => 'form-horizontal')); ?>
  <div class="control-group">
    <?php echo form_label('Username', 'user_name', array('class' => 'control-label')); ?>
    <div class="controls">
      <div>
        <?php
        $arr_user_name = array(
          'name'          => 'user_name',
          'id'            => 'user_name',
          'class'         => 'span3',
          'placeholder'   => 'Username',
          'value'         => set_value('user_name')
          );
        echo form_input($arr_user_name);
        ?>
        <span class="help-block"><em>e.g f20xxxx, h20xxxxx</em></span>
      </div>
    </div>
  </div>
  <div class="control-group">
    <?php echo form_label('Password', 'password', array('class' => 'control-label')); ?>
    <div class="controls">
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
  <div class="control-group">
    <div class="controls">
      <?php
      $arr_button = array(
        'name'  => 'submit',
        'value' => 'Login',
        'class' => 'btn btn-primary span3'
        );
      echo form_submit($arr_button);
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