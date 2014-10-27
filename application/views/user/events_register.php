<?php include 'application/views/inc/header.php'; ?>


<section>
<div class="page-header"><h1>Events <small>Register Here</small></h1></div>

<div class="well well-large">
    <h2>Enter partcipating details.</h2>
    <?php echo form_open('user/events/register/'.$event_details->event_name, array('class' => 'form-horizontal')); ?>
    <div class="control-group">
    <?php echo form_label('College Name', 'college_name', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_name = array(
            'name'          => 'college_name',
            'id'            => 'college_name',
            'class'         => 'span3',
            'placeholder'   => 'Your full name here',
            'value'         => set_value('college_name')
            );
          echo form_input($arr_name);
          ?>
          <p class="help-block"><em>Your college name comes here</em></p>
        </div>
      </div>
    </div>

    <div class="control-group">
    <?php echo form_label('Team Name', 'team_name', array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_name = array(
            'name'          => 'team_name',
            'id'            => 'team_name',
            'class'         => 'span3',
            'placeholder'   => 'Your full name here',
            'value'         => set_value('team_name')
            );
          echo form_input($arr_name);
          ?>
          <p class="help-block"><em>Your team name comes here</em></p>
        </div>
      </div>
    </div>
    <hr>
    <?php
    for ($i=0; $i < $event_details->max_part ; $i++) { ?>
        <div class="control-group">
      <?php echo form_label('Name of participant '.($i+1), 'fullName'.$i, array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_name = array(
            'name'          => 'fullName'.$i,
            'id'            => 'fullName'.$i,
            'class'         => 'span3',
            'placeholder'   => 'Your full name here',
            'value'         => set_value('fullName'.$i)
            );
          echo form_input($arr_name);
          ?>
          <p class="help-block"><em>Your real name comes here</em></p>
        </div>
      </div>
    </div>
     <div class="control-group">
      <?php echo form_label('Email of participant '.($i+1), 'email'.$i, array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_name = array(
            'name'          => 'email'.$i,
            'id'            => 'email'.$i,
            'class'         => 'span3',
            'placeholder'   => 'Your full name here',
            'value'         => set_value('email'.$i)
            );
          echo form_input($arr_name);
          ?>
          <p class="help-block"><em>Your real name comes here</em></p>
        </div>
      </div>
    </div>


    <div class="control-group">
      <?php echo form_label('Contact Number of participant '.($i+1), 'contact'.$i, array('class' => 'control-label')); ?>
      <div class="controls">
        <div class="input-xlarge">
          <?php
          $arr_contact = array(
            'name'          => 'contact'.$i,
            'id'            => 'contact'.$i,
            'class'         => 'span3',
            'placeholder'   => 'Your contact number here',
            'value'         => set_value('contact'.$i)
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


<?php include 'application/views/inc/footer.php'; ?>