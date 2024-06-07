<?php
/**
 *  Custom ACF Gutenberg blocks.
 *
 *  @package WP-rock
 *  @since 4.4.0
 */

/**
 * Registering ACF blocks.
 */
class WP_Rock_Blocks {

    /**
     * Array with blocks defining.
     *
     * @var array[]
     */
    public $blocks = array(
        'block-top-page' => array(
            'title'      => 'Block - Top page',
        ),
        'block-services' => array(
            'title'      => 'Block - services',
        ),
        'block-benefts' => array(
            'title'     => 'Block - Benefts',
        ),
        'block-clients' => array(
            'title'     => 'Block - Clients',
        ),
        'block-experts' => array(
            'title'     => 'Block - Experts',
        ),
        'block-journey' => array(
            'title'     => 'Block - Journey',
        ),
        'block-lets-talk' => array(
            'title'     => 'Block - Let’s talk',
        ),
        'block-service-top' => array(
            'title'     => 'Block - Service top',
            'post_types' => array('page', 'careers')
        ),
        'block-slider-popup' => array(
            'title'     => 'Block - Slider popup',
        ),
        'block-text-repeater' => array(
            'title'     => 'Block - Text repeater',
        ),
        'block-tabs' => array(
            'title'     => 'Block - Tabs',
        ),
        'block-about-us' => array(
            'title'     => 'Block - About us',
        ),
        'block-our-team' => array(
            'title'     => 'Block - Our team',
        ),
        'block-courses' => array(
            'title'     => 'Block - Courses',
        ),
        'block-knowledge' => array(
            'title'     => 'Block - Knowledge',
        ),
        'block-small-hero' => array(
            'title'     => 'Block - Small hero',
        ),
        'block-text-content' => array(
            'title'     => 'Block - Text content',
        ),
        'block-mirror-repeater' => array(
            'title'     => 'Block - Mirror repeater',
        ),
        'block-accordion' => array(
            'title'     => 'Block - Accordion',
        ),
        'block-image-text' => array(
            'title'     => 'Block - Image text',
        ),
        'block-careers-posts' => array(
            'title'     => 'Block - Careers posts',
        ),
        'block-career-content' => array(
            'title'     => 'Block - Career content',
            'post_types' => array('careers')
        ),
        'block-browse-by-topic' => array(
            'title'     => 'Block - Browse by topic',
        ),
        'block-sign-up-offer' => array(
            'title'     => 'Block - Sign up offer',
        ),
        'block-custom-content' => array(
            'title'     => 'Block - Custom content',
        ),
        'block-level-repeater' => array(
            'title'     => 'Block - Level repeater',
        ),
        'block-our-services' => array(
            'title'     => 'Block - Our services',
        ),
        'block-select-tag' => array(
            'title'     => 'Block - Select tag',
        ),
        'block-custom-map' => array(
            'title'     => 'Block - Custom map',
        ),
        'block-custom-video' => array(
            'title'     => 'Block - Custom video',
        ),
        'block-content-w-images' => array(
            'title'     => 'Block - Content with images',
        ),
        'block-faq' => array(
            'title'     => 'Block - FAQ',
        ),
    );

    /**
     * List of Allowed blocks
     * core/freeform  - it's standard WYSIWYG.
     *
     * @var string[]
     */
    protected array $allowed = array( 'core/freeform', 'core/columns' );


    /**
     *  Construct of the class
     */
    public function __construct() {
        add_action( 'init', array( $this, 'add_custom_blocks' ) );
        add_filter( 'allowed_block_types_all', array( $this, 'filter_allowed_blocks' ), 10, 2 );
    }

    /**
     * Function for `allowed_block_types_all` filter-hook.
     *
     * @param bool|string[]           $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
     * @param WP_Block_Editor_Context $editor_context      The current block editor context.
     *
     * @return bool|string[]
     */
    public function filter_allowed_blocks( $allowed_block_types, $editor_context ) {

        if ( ! empty( $editor_context->post ) ) {
            $allowed = array_map( array( $this, 'add_prefix' ), array_keys( $this->blocks ) );

            if ( ! empty( $this->allowed ) ) {
                foreach ( $this->allowed as $block ) {
                    $allowed[] = $block;
                }
            }

            return $allowed;
        }
        return $allowed_block_types;
    }

    /**
     * Just adding prefix to blocks.
     *
     * @param string $value  - name of block.
     * @return string
     */
    public function add_prefix( $value ) {
        return 'acf/' . $value;
    }

    /**
     * Final registration blocks
     *
     * @return void
     */
    public function add_custom_blocks() {
        if (function_exists('acf_register_block_type')) {


            function wp_rock_category($categories, $post) {
                return array_merge(
                    $categories,
                    array(
                        array(
                            'slug' => 'wp-rock',
                            'title' => 'WP Rock',
                            'icon'  => 'wordpress-alt'
                        ),
                    )
                );
            }
            add_filter('block_categories_all', 'wp_rock_category', 10, 2);

            foreach ($this->blocks as $id => $block) {

                $title = $block['title'];
                $description = (isset($block['description'])) ? $block['description'] : '';

                $args = array(
                    'public'   => true,
                    '_builtin' => false,
                );

                $output = 'names'; // names or objects, note names is the default
                $operator = 'and'; // 'and' or 'or'

                $post_types = get_post_types($args, $output, $operator);

                $post_types = array_keys($post_types);

                $post_types[] = 'page';
                $post_types[] = 'post';
                $args = array(
                    'name' => $id,
                    'title' => __($title, 'wp-rock'),
                    'description' => __($description, 'wp-rock'),
                    'render_template' => 'src/template-parts/acf-blocks/' . $id . '.php',
                    'render_callback' => 'block_render',
                    'category' => 'wp-rock',
                    'post_types' => $post_types,
                    'mode' => array_key_exists('mode', $block) ? $block['mode'] : 'preview',
                    'multiple' => array_key_exists('multiple', $block) ? $block['multiple'] : true,
                    'supports' => array(
                        'align' => false,
                        'full_height' => false,
                        'anchor' => true,
                        'color' => array(
                            'gradients' => true,
                            'background' => true,
                        )
                    ),

                    'example' => array(
                        'attributes' => array(
                            'mode' => 'preview', // Important!
                            'data' => array(
                                'preview_image' => file_exists(THEME_DIR . '/src/images/acf-blocks/' . $id . '.jpg') ? THEME_URI . '/src/images/acf-blocks/' . $id . '.jpg' : THEME_URI . '/src/images/acf-blocks/no-preview.jpg',
                            ),
                        )
                    )

                );

                /*$style_file = THEME_DIR . '/assets/public/css/' . $id . '.css';
                if (file_exists($style_file) && file_get_contents($style_file)) {
                    $args['enqueue_style'] = ASSETS_CSS . $id . '.css';
                }*/

                $script_file = THEME_DIR . '/assets/public/js/js-' . $id . '.js';
                if (file_exists($script_file) && file_get_contents($script_file)) {
                    $args['enqueue_script'] = ASSETS_JS . 'js-' . $id . '.js';
                }

                acf_register_block_type($args);
            }

            /**
             * Callback block render,
             * return preview image
             */
            function block_render($block) {
                if (isset($block['data']['preview_image'])) {
                    echo '<img src="' . $block['data']['preview_image'] . '" style="width: 468px;">';
                    return;
                }
                $template = str_replace('.php', '', $block['render_template']);
                get_template_part('/' . $template, null, $block);
            }
        }
    }
}

new WP_Rock_Blocks();
