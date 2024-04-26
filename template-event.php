<?php
/*
Template Name: Event Template
*/

get_header();

$individual_type = false;
if(array_key_exists('type', $_GET) && !empty($_GET['type']) && in_array($_GET['type'], ['tournament', 'league', 'camp'])) {
    $individual_type = $_GET['type'];
}
?>

    <?php if($individual_type) : ?>
    <div class="bg-cover bg-center event_type_heading relative">
        <div class="bg-[#263877E5] absolute opacity-90 w-full h-full top-0 left-0"></div>
        <div class="container relative z-10">
            <h2 class="text-4xl text-white px-12 uppercase py-8 text-left font-bold"><?php echo $individual_type; ?>s</h2>
        </div>
    </div>
    <div class="container mx-auto">
        <?php get_template_part( 'template-parts/upcoming-event-section', '', [
            'type' => $individual_type,
            'paginate' => true,
        ] ); ?>
    </div>
    <?php else: ?>

	<div class="section">
        <div class="container mx-auto">
            <!-- Tournament Section -->
            <?php get_template_part( 'template-parts/upcoming-event-section', '', [
                'type' => 'tournament',
                'paginate' => false,
            ] ); ?>

            <!-- League Section -->
            <?php get_template_part( 'template-parts/upcoming-event-section', '', [
                'type' => 'league',
                'paginate' => false,
            ] ); ?>

            <!-- Camps Section -->
            <?php get_template_part( 'template-parts/upcoming-event-section', '', [
                'type' => 'camp',
                'paginate' => false,
            ] ); ?>

        </div>
    </div>

    <?php endif;?>
<?php

get_footer();