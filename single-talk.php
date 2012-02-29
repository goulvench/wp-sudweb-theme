<?php get_header(); the_post(); ?>

<div class="row">
	<?php get_sidebar('conferences') ?>

	<?php $speakers = p2p_type('talk_to_speaker')->get_connected(get_the_id()) ?>
	<?php $schedule = p2p_type('talk_to_schedule')->get_connected(get_the_id())->next_post() ?>

	<div class="content">
		<article <?php post_class() ?>>
			<header>
				<?php the_post_thumbnail() ?>
				<h2 class="post-title"><?php the_title() ?></h2>
				<?php if (function_exists('p2p_list_posts')): ?>
				<?php p2p_list_posts($speakers, array(
					'before_list' => '<span class="post-speaker">',
					'after_list' => '</span>',
					'before_item' => '',
					'after_item' => '',
				)) ?>
				<?php endif ?>
			</header>

				<span class="post-datetime">
					<a href="<?php echo get_post_permalink($schedule->ID) ?>"><?php echo $schedule->post_title ?></a>
					à <?php the_field('schedule') ?>
				</span>
				(<?php echo get_the_terms(get_the_id(), 'talk_types')->name ?>)
			</p>

			<?php the_content() ?>
		</article>
	</div>
</div>

<?php get_footer() ?>
