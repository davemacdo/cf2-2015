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


?>
