<?php 
/* Template Name: Check Stock */ 
get_header(); ?>
<style>
.stock.out-of-stock {
    display: inline;
}.inner.img-effect {
    display: none;
}.inner img {
    display: none;
}.inner {
    display: none;
}
</style>
<div class="container">
   <div class="row" style=""> 
	   <div class="col-lg-12" style="margin-top:30px;">
    <?php  
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
    );

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
	
        echo '<div style="background: #e5e5e5;padding: 10px 15px 15px;border-radius: 5px;margin: 10px;">';
	
        global $product;
		
        echo '<a href="'.get_permalink().'"> '.get_the_title().'</a>';

	if ($product->is_type( 'variable' )){

		// Get the available variations for the variable product
		$available_variations = $product->get_available_variations();

		// Initializing variables
		$variations_count = count($available_variations);
		$loop_count = 0;
		 echo '</br>';
		 
		// Iterating through each available product variation
		$total = 0; 
		foreach( $available_variations as $key => $values ) {
			$loop_count++;
			
			// Get the term color name
			$attribute_color = $values['attributes']['attribute_pa_tamanho'];
			$wp_term = get_term_by( 'slug', $attribute_color, 'pa_tamanho' );
			$term_name = $wp_term->name; // Color name

			// Get the variation quantity
			$variation_obj = wc_get_product( $values['variation_id'] );
			$stock_qty = $variation_obj->get_stock_quantity(); // Stock qty

			// The display
			$separator_string = " // ";
			$separator = $variations_count < $loop_count ? $separator_string : '';
			$stock_qty + 0;
			$total +=  $stock_qty;
			//echo $total;
			echo $term_name . '(' . $stock_qty . ') - ';
		}
	}

	echo '</br>';
	
	echo 'Total: ' . $total . '</br>';
	
	//do_action( 'woocommerce_before_shop_loop_item_title' );

	if ($total > 0){
		echo "<span style='background: #61b400;color: #fffd;padding: 1px 4px;border-radius: 3px;opacity: 0.5;'>TEM ESTOQUE</span></br>";
		$temestoque = 1;
	}
	if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
		echo "<span style='background: #F44336;color: #fffd;padding: 1px 4px;border-radius: 3px;opacity: 0.5;'>FORA DE ESTOQUE</span></br>";
		$naotemestoque = 1;
	}
	if ($naotemestoque === $temestoque){
		echo "<span style='background: #FF5722;color: #ffffff;padding: 1px 4px;border-radius: 3px;'>!!!ERRO!!!</span></br>";
		wp_mail( 'seuemail@aqui.com', 'Erro de estoque no produto: ' . get_the_title() . ' No site ' . get_bloginfo( 'name' ) . '', 'Acesse o link para editar: ' . get_permalink() .' ' );
		
	}
	
	$temestoque = 0;
	$naotemestoque = 0;	
	
	
	echo '</div>';
    endwhile;
    wp_reset_query();
?>

	   </div>
   </div>
</div>
<?php get_footer(); ?>


