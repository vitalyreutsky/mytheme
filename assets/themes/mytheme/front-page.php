<?php if (!defined('ABSPATH')) exit('No direct script access allowed');
/**
 * The front page template.
 * Template Name: Front Page template
 */

get_header();
?>
<div class="main">
   <div class="main__wrapper">
      <?php
      get_template_part('templates/blocks/hero');
      ?>
   </div>
</div>
<?php
get_footer(); ?>