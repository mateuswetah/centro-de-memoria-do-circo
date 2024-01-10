<?php get_header(); ?>

<div class="tainacan-item-page-container">
    <div class="tainacan-items-list-header">
        <div class="elementor-shape elementor-shape-bottom" data-negative="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" style="height: 24px;/*! fill: red; *//*! color: red; *//*! background: red; */">
                <path class="elementor-shape-fill" d="M194,99c186.7,0.7,305-78.3,306-97.2c1,18.9,119.3,97.9,306,97.2c114.3-0.3,194,0.3,194,0.3s0-91.7,0-100c0,0,0,0,0-0 L0,0v99.3C0,99.3,79.7,98.7,194,99z"></path>
            </svg>		
        </div>
        <div class="tainacan-items-list-header--inner">
            <div class="tainacan-items-list-header-collections-link">
                <?php if( function_exists( 'bcn_display' ) ) bcn_display(); ?>
            </div>
            <h1><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="tainacan-item-page-information">
        <section id="tainacan-document-section">
            <?php tainacan_the_item_gallery(array(
                //'openLightboxOnClick' => false
                'showDownloadButtonMain' => false
            )); ?>
        </section>

        <section id="tainacan-metatata-sections-section">
            <?php tainacan_the_metadata_sections(); ?>
        </section>

        <?php 

            $adjacent_links = tainacan_get_adjacent_item_links('small');

            $previous = $adjacent_links['previous'];
            $next = $adjacent_links['next'];
        ?>
        <?php if ($previous !== '' || $next !== '') : ?>
            <div class="tainacan-item-page-navigation">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

                    <h2 class="mb-0 title-content-items" id="single-item-navigation-label">
                        <?php echo __('Continue explorando'); ?>
                    </h2>

                    <div id="item-single-navigation" class="d-flex align-items-center justify-center">
                        <div class="pagination">
                            <?php echo wp_kses_post($previous); ?>
                        </div>
                        <div class="pagination">
                            <?php echo wp_kses_post($next); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>