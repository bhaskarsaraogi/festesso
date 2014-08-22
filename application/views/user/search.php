<?php include 'application/views/inc/header.php'; ?>

<section>
  
  <div class="page-header"><h1>Search Results <small>Results for "<?php echo $search_query; ?>"</small></h1></div>
  
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
              <a class="thumbnail" href="<?php echo site_url().'/user/profile/'.$row->iduser_details ?>">
                <img src="<?php if ($row->image_thumb) echo site_url().'uploads/'.$row->image_thumb; else echo 'https://success.salesforce.com/resource/1402185600000/sharedlayout/img/new-user-image-default.png' ?>" alt="<?php echo $row->name.'\'s Photograph' ?>" />
              </a>
              <figcaption><p class="name"><?php echo $row->name; ?></a></figcaption>
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