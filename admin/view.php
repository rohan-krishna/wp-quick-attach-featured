<?php
// Meant for MasterStudy LMS
$courses = new WP_Query([
    'post_type' => 'stm-courses',
    'posts_per_page' => -1,
]);

// $posts = new WP_Query([
//     'fields' => 'ids',
//     'post_type' => 'post',
//     'posts_per_page' => -1
// ]);

// $all_ids = array_merge($courses->posts, $posts->posts);

// $all_posts = new WP_Query([
//     'post__in' => $all_ids,
//     'posts_per_page' => -1
// ]);

// var_dump(count($all_posts->posts));
if(isset($_POST['update'])) {
    $post_id = (int) $_POST['post_id'];
    $attachment_id = (int) $_POST['attachment_id'];
    $set = set_post_thumbnail($post_id, $attachment_id);
}
?>

<div class="wrap">
    <h1>Quick Attach Featured Image</h1>
    <hr>

    <?php if ($courses->have_posts()) { ?>

        <table class="wp-list-table widefat striped posts mt-3 adv-table">
            <thead>
                <tr>
                    <th>Featured Image</th>
                    <th>Post Title</th>
                    <th>Post Category</th>
                </tr>
            </thead>
            <tbody>

            <?php while($courses->have_posts() ) : $courses->the_post(); ?>
                
                <tr>
                
                <?php

                echo '<td>';

                if(has_post_thumbnail()) {
                    echo '<img src=' . get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) . ' class="featured-image-wrapper border-0 shadow-md rounded" />';
                } else {
                    echo '<img class="featured-image-wrapper border-0 shadow-md rounded" />';
                }
                ?>

                <form class="update_attachment_form" method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
                <?php
                
                echo '<input type="hidden" class="attachment_id" name="attachment_id" value='. get_post_thumbnail_id(get_the_ID()) . ' />';
                echo '<input type="hidden" class="post-id" name="post_id" value=' . get_the_ID() . ' />';
                echo '<input type="submit" name="update" class="save-btn button bg-blue-500 text-white hover:bg-blue-600 my-3 hidden" value="Submit"/>';
                echo '</form>';
                echo '<button class="button upload-image-button mt-3">Change Image</button>';
                echo '</td>';


                echo '<td>' . get_the_title() . '</td>';

                echo '<td>';
                    foreach(get_the_category() as $key => $category) {
                        // echo $category->name . '<br/>';
                        echo '<span class="inline-block mr-3 p-1 px-3 bg-blue-500 text-white rounded shadow">' . $category->name . '</span>';
                    }
                echo '</td>';

                echo '</tr>';
                endwhile;
            ?>
            </tbody>
        </table>

        <?php } ?>
    <?php wp_reset_query(); ?>
</div>