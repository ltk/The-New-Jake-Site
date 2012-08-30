<form role="search" method="get" id="site-search" class="form-search" action="<?php echo home_url('/'); ?>">
  <label class="hide-text" for="s"><?php _e('Search for:', 'roots'); ?></label>
  <input type="text" value="" name="s" id="s" class="search-query" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
  <button type="submit" id="searchsubmit" class="btn"><?php _e('Search', 'roots'); ?></button>
</form>