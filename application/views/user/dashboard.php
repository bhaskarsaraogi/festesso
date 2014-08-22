<?php include 'application/views/inc/header.php'; ?>

<section>

  <div class="page-header"><h1>Dashboard <small>Welcome, <?php echo ($user_details->name)?$user_details->name:$this->session->userdata('user_name'); ?></small></h1></div>

  <?php
  echo form_open('user/search', array('class' => 'form-search'));
  ?>
  
  <div class="input-append">
    <?php
    $arr_search = array(
      'name'          => 'query',
      'id'            => 'query',
      'class'         => 'input-medium',
      'placeholder'   => 'Looking for someone'
      );
    echo form_input($arr_search);
    $arr_button = array(
      'name'      => 'search',
      'type'      => 'submit',
      'class'     => 'btn',
      'content'   => 'Search'
      );
    echo form_button($arr_button);
    ?>
  </div>
  <?php
  echo form_close();
  ?>

  

    <div class="span6">
      <div class="well">
        <div>
          <h2>Profile Completeness</h2>
          <?php
          $flag = 1;
          if (!is_null($user_details->name))
            $flag++;
          if (!is_null($user_details->dob))
            $flag++;
          if (!is_null($user_details->contact))
            $flag++;
          if (!is_null($user_details->image_name))
            $flag++;
          ?>
          <div class="progress progress-striped <?php if ($flag < 3) echo 'progress-warning'; else if ($flag < 6) echo 'progress-info'; else echo 'progress-success'; ?> active">
            <div class="bar" style="width: <?php echo ($flag*10).'%;'; ?>;"></div>
          </div>
          <ul>
            
            <li><i class="<?php if (!is_null($user_details->name)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Name</li>
            <li><i class="<?php if (!is_null($user_details->dob)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Date of Birth</li>
            <li><i class="<?php if (!is_null($user_details->contact)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Contact</li>
            <li><i class="<?php if (!is_null($user_details->image_name)) echo 'icon-ok'; else echo 'icon-remove' ?>"></i>Profile Image</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#testimonials').load('<?php echo site_url().'testimonials/testimonial_approval/'.$user_details->iduser_details; ?>');
});
</script>


</section>

<?php include 'application/views/inc/footer.php'; ?>