<div class="posts-spoiler-block">
	<div class="wrapper">
		<div class="row">
			<div class="col-xs-20 col-lg-15">
				<div class="block-title"><?=$type->label?></div>
				<div class="block-content">
					<?php foreach($posts as $post) { ?>
					<div class="spoiler">
						<div class="spoiler-label"><div class="toggler"></div><?=$post->post_title?></div>
						<div class="spoiler-content"><?=apply_filters( 'the_content', $post->post_content )?></div>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-xs-20 col-lg-4">
				<div class="read-all">
					<a href="<?=get_post_type_archive_link($type->name)?>">
						<div class="icon"><?=$icon?></div>
						<div class="text">Читать все <?=$type->label?></div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>