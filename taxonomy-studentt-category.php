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

	<?php if ( have_posts() ) : ?>
            <header >
                <h1><?php the_archive_title() ?> Students</h1>
                <?php
                the_archive_description( '<div>', '</div>' );
                ?>
            </header><!-- .page-header -->
            <section class="taxonomy-content">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article>
                        <div>
                            <a href="<?php the_permalink(); ?>">
                                <h2><?php the_title(); ?></h2>
                            </a>
                            <?php
                            the_post_thumbnail( 'school-students' );
                            ?>
                        </div>
                        <?php the_content(); ?>
                    </article>
                    <?php
                endwhile;
                ?>
            </section>
            <?php
            the_posts_navigation();
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
