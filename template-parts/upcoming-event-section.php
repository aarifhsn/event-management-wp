<?php if(!$args['paginate']) {
    $paginate = false;
    $per_page = 3;
    if($args['type'] == 'league') {
        $per_page =2;
    }
} else {
    $paginate = true;
    $per_page = 12;
} ?>

<?php 
$type = isset($args['type']) ? $args['type'] : '';

$upcoming_event = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => $per_page,
    'meta_query' => array(
        array(
            'key' => 'type', 
            'value' => $type,
        )
    )
]); ?>
<div class="event_section text-center mt-20">
    <?php if(array_key_exists('paginate', $args) && !$args['paginate']) : ?>
        <h2 class="text-[#263877] font-bold mt-4 mb-8 text-4xl uppercase">Upcoming <?php echo $type;?>s</h2>
    <?php endif; ?>
    <div class="flex flex-wrap gap-4 px-8 justify-center">

        <?php while($upcoming_event->have_posts()): $upcoming_event->the_post(); ?>

        <div class="single_event shadow-lg px-12 py-4 w-[30%]">
            <div class="thumbnail  p-4 flex justify-center">
                <?php the_post_thumbnail('thumbnail', ['class' =>'h-52 w-52 border border-slate-400']); ?>
            </div>
            <div class="event_content">
                <h3 class="title uppercase text-black py-2 font-bold"><?php the_title(); ?></h3>
                <p class="location text-xs"><?php echo get_field('location'); ?></p>
                <p class="date text-sm">
                    <?php echo date('M j', strtotime(get_field('start_date'))); ?> - <?php echo date('M j, Y', strtotime(get_field('end_date'))); ?>
                </p>
                <?php $product = wc_get_product(get_the_ID()); ?>
                <h6 class="text-lg text-red-800 py-2"><?php echo $product->get_price_html(); ?></h6>
            </div>
            <div class="join">
                <h3 class="bg-[#263877] py-2 px-4 text-white inline-block"><a href="<?php the_permalink(); ?>">Join the <?php echo $type; ?></a></h3>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    
    <?php if(array_key_exists('paginate', $args) && !$args['paginate']) : ?>
    
        <h2 class="bg-[#E92F31] text-white my-8 inline-block rounded-sm"><a class="py-4 px-6 uppercase block" href="?type=<?php echo $type; ?>">View All <?php echo $type; ?>s</a></h2>

    <?php else : ?>
        <h4>Pagination</h4>
    <?php endif; ?>
</div> <!--end Tournament Section-->