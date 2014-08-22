<?php include 'application/views/inc/header.php'; ?>

<section>
  
  <div class="page-header"><h1>Admin Settings <small>Add events here</small></h1></div>
  
  <div class="well well-large">
    <h2>Event Details</h2>
    <?php
    echo form_open('admin/settings', array('class' => 'form-horizontal'));
    ?>
    <div class="control-group">
      <?php
      echo form_label('Event Name', 'event_name', array('class' => 'control-label'));
      ?>
      <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-pencil icon-large"></i></span>
          <?php
          $arr_user_name = array(
            'name'          => 'event_name',
            'id'            => 'event_name',
            'class'         => 'span3',
            'placeholder'   => 'Site Name',
            // 'value'         => set_value('site_name', $site_name)
            );
          echo form_input($arr_user_name);
          ?>
        </div>
        <span class="help-block"><em>Enter the event name. The same name will be reflected all over the website.</em></span>
      </div>
    </div>
    <div class="control-group">
      <?php
      echo form_label('Event Description', 'event_desp', array('class' => 'control-label'));
      ?>
      <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-tasks icon-large"></i></span>
          <?php
          $arr_user_name = array(
            'name'          => 'event_desp',
            'id'            => 'event_desp',
            'class'         => 'span3',
            'placeholder'   => 'Event Description',
            // 'value'         => set_value('year', $year)
            );
          echo form_textarea($arr_user_name);
          ?>
        </div>
        <span class="help-block"><em>Enter the description for the particular event.</em></span>
      </div>
    </div>
    <div class="control-group">
      <?php
      echo form_label('Minimum Participants', 'min_part', array('class' => 'control-label'));
      ?>
      <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-link  icon-large"></i></span>
          <?php
          $arr_user_name = array(
            'name'          => 'min_part',
            'id'            => 'min_part',
            'class'         => 'span3',
            'placeholder'   => 'Minimum Participants',
            // 'value'         => set_value('year', $year)
            );
          echo form_input($arr_user_name);
          ?>
        </div>
        <span class="help-block"><em>Enter the minimum number of participants.</em></span>
      </div>
    </div>
    <div class="control-group">
      <?php
      echo form_label('Maximum Participants', 'max_part', array('class' => 'control-label'));
      ?>
      <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-magic icon-large"></i></span>
          <?php
          $arr_user_name = array(
            'name'          => 'max_part',
            'id'            => 'max_part',
            'class'         => 'span3',
            'placeholder'   => 'Maximum Participants',
            // 'value'         => set_value('year', $year)
            );
          echo form_input($arr_user_name);
          ?>
        </div>
        <span class="help-block"><em>Enter the maximum number of participants.</em></span>
      </div>
    </div>
    <div class="control-group">
      <?php
      $arr_button = array(
        'name'  => 'submit',
        'value' => 'Update',
        'class' => 'btn btn-info span3'
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
      if ($error != "") {
        ?>
        <div class="alert alert-error">
          <p><?php echo $error; ?></p>
        </div>
        <?php
      }
      echo validation_errors();
      ?>
    </div>
    
   
    
  </section>

  <?php include 'application/views/inc/footer.php'; ?>