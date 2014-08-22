<?php include 'application/views/inc/header.php'; ?>

<section>
  
  <div class="page-header"><h1>Select to edit event.</h1></div>
  
  <div class="search-results">
    <?php
    if (!empty($search_results)) {
      ?>
      <ul class="thumbnails">
        <?php
        foreach($search_results as $row) {
          ?>
          <li class="span3">
            <figure class="profile">
              <a class="thumbnail" href="<?php echo site_url().'/admin/edit_event/'.$row->event_id ?>">
                <img src="https://success.salesforce.com/resource/1402185600000/sharedlayout/img/new-user-image-default.png" alt="<?php echo $row->event_name.'\'s Photograph' ?>" />
              </a>
              <figcaption><p class="name"><?php echo "<strong>".$row->event_id.".</strong> ".$row->event_name; ?></a></figcaption>
            </figure>
          </li>
          <?php
        }
        ?>
      </ul>
      <?php
    }
    else {
      ?>
      <p>No results found.</p>
      <?php
    }
    ?>                        
  </div>
  
</section>

<?php include 'application/views/inc/footer.php'; ?>