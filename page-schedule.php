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
	<header>
			<h1><?php single_post_title(); ?></h1>
		</header>

		<?php
			if( have_rows('schedule') ):
				echo "<table>";
				echo "<caption>Course Schedules</caption>";
				echo '<tbody>';
				$day_label = get_sub_field_object('date');
				$course_label = get_sub_field_object('courses');
				$instructor_label = get_sub_field_object('instructor');
				$date_header = $day_label['label'];
				$course_header = $course_label['label'];
				$instructor_header = $instructor_label['label'];
				echo "<th>" . $date_header . "</th>";
				echo "<th>" . $course_header . "</th>";
				echo "<th>" . $instructor_header . "</th>";
			
				while( have_rows('schedule') ) : the_row();
					echo '<tr>';
					$date = get_sub_field('date');
					$course = get_sub_field('courses');
					$instructor = get_sub_field('instructor');
					echo "<td>". $date ."</td>";
					echo "<td>". $course ."</td>";
					echo "<td>". $instructor ."</td>";
					echo '</tr>';
				endwhile;
				echo '</tbody>';
				echo "</table>";
			
			else :
				
			endif;
		?>

	</main>

<?php
get_sidebar();
get_footer();
