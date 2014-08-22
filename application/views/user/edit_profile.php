<?php include 'application/views/inc/header.php'; ?>

<section>
  
  <div class="page-header"><h1>Edit Profile <small>You can edit your profile here</small></h1></div>
  
  <div class="well well-large">
    <h2>Your Personal Details</h2>
    <?php echo form_open_multipart('user/edit_profile', array('class' => 'form-horizontal')); ?>
    
    <div class="control-group">
      <?php echo form_label('Full Name', 'fullName', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_name = array(
            'name'          => 'fullName',
            'id'            => 'fullName',
            'class'         => 'span3',
            'placeholder'   => 'Your full name here',
            'value'         => set_value('fullName', $fullName)
            );
          echo form_input($arr_name);
          ?>
          <p class="help-block"><em>Your real name comes here</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Date', 'date', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_date = array(
            'name'          => 'date',
            'id'            => 'date',
            'class'         => 'span1',
            'value'         => set_value('date', $date)
            );
          echo form_input($arr_date);
          ?>
          <p class="help-block"><em>Date of your birth</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Month', 'month', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_month = array(
            'January'     => 'January',
            'February'    => 'February',
            'March'       => 'March',
            'April'       => 'April',
            'May'         => 'May',
            'June'        => 'June',
            'July'        => 'July',
            'August'      => 'August',
            'September'   => 'September',
            'October'     => 'October',
            'November'    => 'November',
            'December'    => 'December'
            );
          echo form_dropdown('month', $arr_month, $month, 'class = "span3"');
          ?>
          <p class="help-block"><em>Month of your birth</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo form_label('Year', 'year', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_year = array(
            'name'          => 'year',
            'id'            => 'year',
            'class'         => 'span1',
            'value'         => set_value('year', $year)
            );
          echo form_input($arr_year);
          ?>
          <p class="help-block"><em>Year of your birth</em></p>
        </div>
      </div>
    </div>
    
    <div class="control-group">
      <?php echo form_label('Contact Number', 'contact', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_contact = array(
            'name'          => 'contact',
            'id'            => 'contact',
            'class'         => 'span3',
            'placeholder'   => 'Your contact number here',
            'value'         => set_value('contact', $contact)
            );
          echo form_input($arr_contact);
          ?>
          <p class="help-block"><em>It would be great if we can have your number</em></p>
        </div>
      </div>
    </div>
    
    <div class="control-group">
      <?php echo form_label('Profile Image', 'profile_image', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_image = array(
            'name'          => 'profile_image',
            'id'            => 'profile_image',
            'class'         => 'span3'
            );
          echo form_upload($arr_image);
          ?>
          <p class="help-block"><em>Maximum allowed dimensions are 1024px &times; 768px</em></p>
        </div>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <?php
        $arr_button = array(
          'name'  => 'submit',
          'value' => 'Update Info',
          'class' => 'btn btn-info span3'
          );
        echo form_submit($arr_button);
        ?>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
  <?php
  if ( $error != NULL )
    echo '<div class="alert alert-error">'. $error.' </div>';
  echo validation_errors();
  ?>
  
  <div class="well well-large">
    <h2>Change Your Password</h2>
    <?php echo form_open('user/change_password', array('class' => 'form-horizontal')); ?>
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
  
</section>

<?php include 'application/views/inc/footer.php'; ?>