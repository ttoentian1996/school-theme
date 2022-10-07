<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Website
 */

get_header();
?>

	<main id="primary" class="site-main">

	<?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_type() );
            ?>
            <?php
                $terms = get_the_terms(
                    get_the_ID(),
                    'studentt-category',
                );
                if ( $terms && ! is_wp_error( $terms ) ) {
                    foreach ( $terms as $term ) {
                        $args = array(
                            'post_type'      => 'school-students',
                            'posts_per_page' => -1,
                            'post__not_in' => array( $post->ID ),
                            'orderby' => 'title',
                            'order'          => 'ASC',
                            'tax_query'      => array(
                                array (
                                    'taxonomy' => 'studentt-category',
                                    'field'    => 'slug',
                                    'terms'    => $term->slug
                                ),
                            ),
                        );
                        $query = new WP_Query ( $args );
                        if ($query->have_posts()){
                            ?>
                            <h2>Meet Other <?php echo $term->name ?> Students</h2>
                            <nav>
                                <ul>
                                <?php
                                while( $query->have_posts() ) :
                                    $query->the_post(); ?>
                                    <li><a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a></li>
                                <?php endwhile;?>
                                </ul>
                            </nav>
                            <?php
                            wp_reset_postdata();
                        }
                    };
                };
            ?>
            <?php
        endwhile;
        ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
