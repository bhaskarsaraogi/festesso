<?php include 'application/views/inc/header.php'; ?>


<section>
<div class="page-header"><h1>Events <small>Register Here</small></h1></div>

<div class="well well-large">
    <h2>Enter partcipating details.</h2>
    <?php echo form_open('user/events/register/'.$event_details->event_id, array('class' => 'form-horizontal')); ?>
    <?php
    for ($i=0; $i < $event_details->max_part ; $i++) { ?>
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
            'value'         => set_value('fullName')
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
            'value'         => set_value('date')
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
          echo form_dropdown('month', $arr_month, 'class = "span3"');
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
            'value'         => set_value('year')
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
            'value'         => set_value('contact')
            );
          echo form_input($arr_contact);
          ?>
          <p class="help-block"><em>It would be great if we can have your number</em></p>
        </div>
      </div>
    </div>
    <hr><br>
    <?php  } ?>

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


<?php include 'application/views/inc/footer.php'; ?>