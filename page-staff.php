<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Website
 */

get_header();
?>

	<main id="primary" class="site-main">
	<header class="page-header">
			
			<h1><?php single_post_title(); ?></h1>
			<p><?php the_content(); ?></p>
		</header>

		<?php
            $terms = get_terms(
                array(
                    'taxonomy' => 'schoolwebsite-staff-category',
                )
            );
            if ( $terms && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $args = array(
                        'post_type'      => 'schoolwebsite-staff',
                        'posts_per_page' => -1,
						'order'			 => 'ASC',
                        'tax_query'      => array(
                            array (
                                'taxonomy' => 'schoolwebsite-staff-category',
                                'field'    => 'slug',
                                'terms'    => $term->slug
                            ),
                        ),
                    );

                    $query = new WP_Query ( $args );

                    if ($query->have_posts()){
						?>
						<h2><?php echo $term->name ?></h2>
						<?php
                        while( $query->have_posts() ) {
                            $query->the_post(); ?>
                        <section>
							<h3><?php echo the_title(); ?></h3>
                            <?php if ( function_exists( 'get_field' ) ) {
                                if ( get_field('staff_') ) {
                                    the_field('staff_');
                                }
                            } ?>
							<?php if ( function_exists( 'get_field' ) ) {
                                if ( get_field('courses') ) {
                                    the_field('courses');
                                }
                            } ?>
							<?php if ( function_exists( 'get_field' ) ) {
                                if ( get_field('link') ) {
                                    the_field('link');
                                }
                            } ?>
                        </section>
                        <?php
                    wp_reset_postdata();
                        }
                    }
                };
            };
        ?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
