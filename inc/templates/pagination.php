<?php
    // $total   = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
    // $current = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    // $base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
    // $format  = isset( $format ) ? $format : '';
$links = paginate_links(
    array( // WPCS: XSS ok.
        'add_args'     => false,
        'prev_text'    => inline('assets/svg/slider-button.svg',false),
        'next_text'    => inline('assets/svg/slider-button.svg',false),
        'type'         => 'list',
        'end_size'     => 3,
        'mid_size'     => 3,
    )
);
if($links)
{
?>
<div class="items-grid-controls">
    <nav class="items-grid-controls-pagination"><?=$links?></nav>
</div>
<?php
}
?>