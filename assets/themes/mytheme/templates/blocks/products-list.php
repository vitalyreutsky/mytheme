<section class="products-list">
   <div class="wrapper">
      <div class="products-list__wrapper content-block__wrapper">
         <div class="products-list__items">
            <?php
            $args = array(
               'post_type'     => 'product',
               'posts_per_page' => -1,
            );

            $items = get_posts($args);
            foreach ($items as $product_id) {
               get_template_part('templates/cards/product-card', null, array('product_id' => $product_id->ID));
            }
            ?>
         </div>
      </div>
   </div>
</section>