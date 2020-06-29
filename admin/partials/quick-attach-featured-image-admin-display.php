<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/rohan-krishna
 * @since      1.0.0
 *
 * @package    Quick_Attach_Featured_Image
 * @subpackage Quick_Attach_Featured_Image/admin/partials
 */
?>
<?php
    // $terms = get_terms(['taxonomy' => 'stm_lms_course_taxonomy', 'hierarchical' => true ]);
    // echo '<pre>';
    // var_dump($terms);
    // echo '</pre>';
    $posts = $this->queryByCategory(null, 1);

    if( isset($_POST['fetch_courses']) ) {
        // echo '<pre>';
        // var_dump($_POST['tax_input']["stm_lms_course_taxonomy"]);
        // echo '</pre>';
        $page = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;

        if(!$page)
            $page = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;

        $posts = $this->queryByCategory($_POST['tax_input']["stm_lms_course_taxonomy"], $page);
    }

    if( isset($_POST['save_attachment'])) {
        // echo '<pre>';
        // var_dump($_POST['attachment_id']);
        // echo '</pre>';
        $this->saveAttachment($_POST['post_id'], $_POST['attachment_id']);
    }

    // var_dump($posts->max_num_pages);

    // $page_num = 1;

?>



<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap qafi-wrapper">
    <h1 style="font-weight: 600;">Quick Attach Featured Image</h1>
    <p>No BS approach to quickly add featured images to posts, built specifically for MasterStudy, after hours of frustration.</p>
    <p>Found - <?php echo $posts->found_posts; ?> Posts</p>
    <hr>

    <form method="post" class="d-block">
        <span style="display: flex; margin-bottom: 1.52em; align-items: center;">
            <?php $this->get_all_terms_list(); ?> <input type="submit" class="button" style="margin: 0 3px !important;" value="Fetch Courses" name="fetch_courses">
            <!-- <p>Found - <?php echo $posts->found_posts; ?> Posts</p> -->
        </span>
    </form>

    <table class="table table-bordered adv-table table-striped">
        <thead>
            <tr class="table-success">
                <th>#</th>
                <th>Featured Image</th>
                <th>Post Title</th>
                <th>Post Category</th>
            </tr>
        </thead>
        <tbody>
            <?php while($posts->have_posts()) {
                $post = $posts->the_post();
            ?>
            <tr>
                <td><?php echo $posts->current_post + 1 ?></td>
                <td class="text-center">
                    <?php
                        if(has_post_thumbnail()) {
                            echo '<img src=' . get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) . ' class="featured-image img-thumbnail" width="128" /> <br />';
                        } else {
                            echo '<img src=' . plugin_dir_url(__FILE__) . 'images/noimage.png' . ' class="featured-image img-thumbnail" width="128"/> <br />';
                        }
                        echo '<button class="btn btn-sm btn-info upload-image-button mt-3">Upload Image</button>';
                        // echo '<button class="btn btn-sm btn-success save-btn mt-3 ml-3 d-none">Submit</button>';
                    ?>
                    <form class="update_attachment_form" method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" class="attachment_id" name="attachment_id" />
                        <input type="hidden" class="post-id" name="post_id" value="<?php echo get_the_ID(); ?>">
                        <input type="submit" class="btn btn-success save-btn mt-3 d-none" name="save_attachment" value="Submit" />
                    </form>
                </td>
                <td>
                    <a href="<?php echo get_edit_post_link($post->ID); ?>">
                        <?php the_title(); ?></td>
                    </a>
                <td>
                    <?php
                        $terms = get_the_terms($post->ID, $this->taxonomy);
                        $terms_string = join(', ', wp_list_pluck($terms, 'name'));
                        echo $terms_string;
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php while($page_num <= $posts->max_num_pages) { ?>
                <li class="page-item"><a class="page-link" href="#"><?php echo $page_num; ?></a></li>
                <?php $page_num++; ?>
            <?php } ?>
        </ul>
    </nav> -->
    <?php wp_reset_postdata(); ?>
</div>
