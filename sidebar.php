<?php if( is_active_sidebar('sidebar') ) { ?>
<div class="sidebar-holder col-md-2"><?php dynamic_sidebar('sidebar'); ?></div>
<button class="sidebar-toggle" type="button" data-action="sidebar-toggle">
	<span class="line"></span>
	<span class="line"></span>
	<span class="line"></span>
</button>
<?php } else { define('NOSIDEBAR', true); } ?>
<?php if( is_active_sidebar('filter') and is_tax() or is_post_type_archive('product') ) { ?>
	<?php /*
	<aside id="filter-sidebar">
		<button type="button" data-action="toggle-filter"><span>ФИЛЬТР</span></button>
		<?php dynamic_sidebar('filter'); ?>
	</aside>
	*/ ?>
<div id="filter-sidebar-drop" data-action="toggle-filter"></div>
<?php
$q = get_queried_object();
$pl = '';

$available_steps = array();
$q_args = array();
foreach ($_GET as $key => $values)
{
	$q_args[$key] = $values;
}
unset($q_args['paged']);

if(is_search())
{
	$pl = home_url('/');
	$pl = add_query_arg(['s'=>get_query_var('s'),'post_type'=>get_query_var('post_type')],$pl);
}
elseif(is_tax())
{
	$pl = get_term_link($q);
}
elseif(is_post_type_archive())
{
	$pl = get_post_type_archive_link($q->name);
}
elseif(is_singular())
{
	$pl = get_permalink($q);
}
wc_enqueue_js("
var filter_sidebar = $('#filter-sidebar');
jQuery( 'body' ).on('click', '[data-action=\"toggle-filter\"]', function() {
	filter_sidebar.toggleClass('open');
});
filter_sidebar.on('click', '.toggler', function() {
	var t = $(this);
	var d = t.next();
	if(t.hasClass('open'))
	{
		t.removeClass('open')
		d.slideUp(300);
	}
	else
	{
		t.addClass('open')
		d.slideDown(300);
	}
});
filter_sidebar.on('click', 'button[type=\"reset\"]', function(e) {
	document.location.href = '{$pl}';
	// e.preventDefault();
	// filter_sidebar.find('input[type=\"checkbox\"]').prop('checked',false);
	// var mins = filter_sidebar.find('input[name^=\"min_\"]');
	// mins.each(function(){
	// 	var i = $(this);
	// 	i.val(i.data('min')).trigger(\"change\");
	// });
	// var maxs = filter_sidebar.find('input[name^=\"max_\"]');
	// maxs.each(function(){
	// 	var i = $(this);
	// 	i.val(i.data('max')).trigger(\"change\");
	// });
});
");
?>
<?php } ?>