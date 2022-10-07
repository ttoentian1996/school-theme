<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Website
 */

get_header();
?>

	<main id="primary" class="site-main">

    <?php 
            $arguments = array(
                'post_type' => 'school-students',
                'post_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'studentt-category',
                        'field' => 'slug',
                        'terms' => array('developer', 'designer'),
                    )
                )
            );
            $query = new WP_Query( $arguments );
            if( $query -> have_posts() ) {
                echo '<section>';
                while( $query -> have_posts() ) {
                    $query -> the_post();
                    ?>
                    <article class="student-archive">
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                        </a>
                        <?php the_post_thumbnail( 'medium' ); ?>
                        <?php the_excerpt(); ?>
                        <div>
                            <?php
                            $ref = get_the_term_list( get_the_ID(), 'studentt-category', '<p>Specialty: </p>' );
                            echo $ref
                            ?>
                        </div>
                    </article>
                    <?php
                }
                wp_reset_postdata();
                echo '</section>';
            }
        ?>
        <?php
        ?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
