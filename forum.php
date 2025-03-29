<?php
$page = 'home';
include_once 'header.php';

// Assuming $userid is set elsewhere in your code

// Function to get the total number of rows for pagination
function get_total_rows()
{
    $sql = "SELECT * FROM forum";
    return sizeof(select_rows($sql));
}

// Function to get paginated rows
function get_paginated_rows($sql, $offset, $limit)
{

    return select_rows($sql);
}



// Default sorting option
$sort_by = 'latest'; // Default sorting by latest

// Handling sorting options
if (isset($_GET['sort'])) {
    $sort_by = $_GET['sort'];
}

// Handling pagination
$page = 1; // Default page number
$limit = 5; // Number of posts per page

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
}

$offset = ($page - 1) * $limit; // Calculate offset

// Construct SQL query based on sorting option
switch ($sort_by) {
    case 'all':
        $sql = "
            SELECT
                forum.*,
                user.user_name,
                user.user_id,
                user.user_image,
                COUNT(comment.forum_id) AS comment_count
            FROM
                forum
            JOIN
                user ON user.user_id = forum.user_id
            LEFT JOIN
                comment ON comment.forum_id = forum.forum_id
            WHERE
                forum.forum_status = 'active'
            GROUP BY
                forum.forum_id
            ORDER BY
                forum.forum_date_created DESC
            LIMIT $limit OFFSET $offset;
        ";
        break;
    case 'mine':
        $sql = "
            SELECT
                forum.*,
                user.user_name,
                user.user_id,
                user.user_image,
                COUNT(comment.forum_id) AS comment_count
            FROM
                forum
            JOIN
                user ON user.user_id = forum.user_id
            LEFT JOIN
                comment ON comment.forum_id = forum.forum_id
            WHERE
                forum.forum_status = 'active' AND forum.user_id = $userid
            GROUP BY
                forum.forum_id
            ORDER BY
                forum.forum_date_created DESC
            LIMIT $limit OFFSET $offset;
        ";
        break;
    case 'latest':
        $sql = "
            SELECT
                forum.*,
                user.user_name,
                user.user_id,
                user.user_image,
                COUNT(comment.forum_id) AS comment_count
            FROM
                forum
            JOIN
                user ON user.user_id = forum.user_id
            LEFT JOIN
                comment ON comment.forum_id = forum.forum_id
            WHERE
                forum.forum_status = 'active'
            GROUP BY
                forum.forum_id
            ORDER BY
                forum.forum_date_created DESC
            LIMIT $limit OFFSET $offset;
        ";
        break;
    case 'popular':
        $sql = "
            SELECT
                forum.*,
                user.user_name,
                user.user_id,
                user.user_image,
                COUNT(comment.forum_id) AS comment_count
            FROM
                forum
            JOIN
                user ON user.user_id = forum.user_id
            LEFT JOIN
                comment ON comment.forum_id = forum.forum_id
            WHERE
                forum.forum_status = 'active'
            GROUP BY
                forum.forum_id
            ORDER BY
                comment_count DESC
            LIMIT $limit OFFSET $offset;
        ";
        break;
    default:
        // If invalid sort option provided, fallback to default sorting
        $sql = "
            SELECT
                forum.*,
                user.user_name,
                user.user_id,
                user.user_image,
                COUNT(comment.forum_id) AS comment_count
            FROM
                forum
            JOIN
                user ON user.user_id = forum.user_id
            LEFT JOIN
                comment ON comment.forum_id = forum.forum_id
            WHERE
                forum.forum_status = 'active'
            GROUP BY
                forum.forum_id
            ORDER BY
                forum.forum_date_created DESC
            LIMIT $limit OFFSET $offset;
        ";
        break;
}

// Get total rows count for pagination
$total_rows = get_total_rows();

// Fetch paginated rows
$forums = get_paginated_rows($sql, $offset, $limit);

$total_pages = ceil($total_rows / $limit);

?>

<!--====== Page Title Start ======-->
<section class="page-title-area page-title-bg" style="background-image: url(assets/img/section-bg/page-title.jpg);">
    <div class="container">
        <h1 class="page-title">&nbsp;</h1>

        <ul class="breadcrumb-nav">
            <li><a href="#">Home </a></li>
            <li><i class="fas fa-angle-right"></i></li>
            <li>Patient Forum</li>
        </ul>
    </div>
</section>
<!--====== Page Title End ======-->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
    <div class="container">
        <div>
            <?php
            foreach ($forums as $forum) { ?>

                <a style="text-decoration:none;color:unset;width:100%" href="single_forum?id=<?= encrypt($forum['forum_id']) ?>">


                    <div class="QuotesCard2">
                        <div class="QuotesInner2">
                            <div style="display:flex;justify-content:flex-start;align-items:center;">
                                <img src="<?= file_url . get_user_image($forum['user_image']) ?>" class="ForumImg" />
                                <div style="margin-left:10px;">
                                    <p style="font-size:24px;" class="AitchOne">
                                        <?= $forum['forum_title'] ?>
                                    </p>
                                    <p>
                                        <?= $forum['user_name'] ?>
                                    </p>
                                </div>
                            </div>

                            <hr class="rounded">
                            <p>
                                <?= limit_text_large($forum['forum_text']) ?>
                            </p>
                            <div class="row">
                                <div class="col-4">
                                    <div class="DeeFlex">
                                        <i style="color:#4C84C3;" class="fa-regular fa-comments"></i>
                                        <p class="ForumTxt">
                                            <?= $forum['comment_count'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="DeeFlex">
                                        <i style="color:#4C84C3;" class="fa-regular fa-eye"></i>
                                        <p class="ForumTxt">
                                            View
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="DeeFlex">
                                        <i style="color:#4C84C3;" class="fa-regular fa-bookmark"></i>
                                        <p class="ForumTxt">
                                            Save
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            <?php
            }

            ?>
        </div>


        <div class="pagination">
            <?php
            // Loop to generate pagination links
            for ($i = 1; $i <= $total_pages; $i++) {
                // Determine the class for active or inactive state
                $class = ($i == $page) ? 'active' : 'inactive';
                // Output the pagination link
                $link = ($i == $page) ? '#' : '?sort=' . $sort_by . '&page=' . $i . '';

                echo "<a href='$link' class='page-link $class'>$i</a>";
            }
            ?>
        </div>

    </div>
</section>
<!--====== Contact Info Section End ======-->

<style>
    /* Rounded border */
    hr.rounded {
        border-top: 2px solid #bbb;
        border-radius: 1px;
    }

    .ForumImg {
        height: 100px;
        width: 100px;
        object-fit: cover;
        border-radius: 50px;
    }

    .QuotesCard2 {
        margin-bottom: 50px;
    }

    .ForumTxt {
        font-weight: 600;
        margin-left: 10px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-link {
        display: inline-block;
        padding: 8px;
        margin: 0 4px;
        border-radius: 50%;
        text-align: center;
        color: #fff;
        text-decoration: none;
        height: 40px;
        width: 40px;
    }

    .pagination .page-link.active {
        background-color: #F4F5F7;
    }

    .pagination .page-link.inactive {
        background-color: #FF594D;
    }
</style>

<?php
include_once 'footer.php';
?>