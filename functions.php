<?php

/* Functions for CF2-2015, child of Twenty Thirteen feed */

function the_composition( $param, $echo = true ) {
	$custom_fields = get_post_custom();
	if ( $echo )
		echo $custom_fields[$param][0];

	return $custom_fields[$param][0];
}


// grab media stuff
function cf_instr( $echo = true ){
	$custom_fields = get_post_custom();

	foreach($custom_fields['instrumentation'] as $instr) {
		echo '<h2 class="cf-instrumentation">for '.$instr.'</h2>';
	}
}

function cf_media( $echo = true ){
	$custom_fields = get_post_custom();

	foreach($custom_fields['media_embed'] as $iframe) {
		echo '<div class="cf-media-wrapper">'.$iframe.'</div>';
	}
}

function cf_score( $echo = true ){
	$custom_fields = get_post_custom();
	if ( $echo && $custom_fields['score_url'][0])
		echo '<p class="score-link"><a href="'.$custom_fields['score_url'][0].'"target="_blank">score download</a></p>';

	return $custom_fields[$param][0];
}

function cf_site( $echo = true ){
	$custom_fields = get_post_custom();
	if ( $echo && $custom_fields['site'][0])
		echo '<p class="more-info-link"><a href="'.$custom_fields['site'][0].'"target="_blank">more about '.$custom_fields['composer'][0].'</a></p>';

	return $custom_fields[$param][0];
}

// Fix title for custom page types
function composition_page_title(){
  return the_composition("title",false)." by ".the_composition("composer",false);
}


// Adding "pub date" to avoid confusion.

function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">posted <time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}

// END entry date


// "PLUGIN" type thingy for composition type child pages
function list_compositions_by_type ( $atts, $content=null ) {
	shortcode_atts( array('type'=>'Chamber Works', 'show_inst'=>true), $atts);
	//return $atts['type'] . $atts['show_inst'];

	$this_page_id = get_the_ID();

	$args = array(
		'post_type'		=> 'page',
		'post_per-page'	=> -1,
		'post_parent'	=> $this_page_id,
		'order'			=> 'ASC',
		'meta_key'		=> 'composer',
		'orderby'		=> 'meta_value'
	);

	$parent = new WP_Query( $args );
	//$output = 0;
	//return $parent->post_count;
	$list_items = '';
	if ( $parent->have_posts() ) :

		while ( $parent->have_posts() ) : $parent->the_post();
			$list_items .= '<li><a href="' . get_permalink() . '">' . the_composition('title',false) . '</a>';
			if ( the_composition('instrumentation',false) != null) :
				$list_items .= ' for ' . the_composition('instrumentation',false);
			endif;
			$list_items .= ' by ' . the_composition('composer',false) . '</li>';
		endwhile;

		return '<ul class="comp-list">' . $list_items . '</ul>';
	endif;
	wp_reset_query();

}

add_shortcode('comp-list','list_compositions_by_type');

?>
