<?php get_header(); ?>
    <div class="tainacan-items-list-container">
        <div class="tainacan-items-list-header">
            <div class="elementor-shape elementor-shape-bottom" data-negative="false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" style="height: 24px;/*! fill: red; *//*! color: red; *//*! background: red; */">
                    <path class="elementor-shape-fill" d="M194,99c186.7,0.7,305-78.3,306-97.2c1,18.9,119.3,97.9,306,97.2c114.3-0.3,194,0.3,194,0.3s0-91.7,0-100c0,0,0,0,0-0 L0,0v99.3C0,99.3,79.7,98.7,194,99z"></path>
                </svg>		
            </div>
            <div class="tainacan-items-list-header--inner">
                <h1><?php echo __('Todos os itens do acervo') ?></h1>
            </div>
        </div>
        <?php tainacan_the_faceted_search(array(
            'show_filters_button_inside_search_control' => true
        )); ?>
    </div>
<?php get_footer(); ?>