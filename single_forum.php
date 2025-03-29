<?php
$page = 'home';
include_once 'header.php';
$id = security('id', 'GET');
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
                forum.forum_id = '$id'
          ";

$forum = select_rows($sql)[0];


$sql1 = "SELECT * FROM comment WHERE comment_status = 'active' AND forum_id = '$id'  ORDER BY comment_date_created DESC;";
$comments = select_rows($sql1);

// Function to replace doctor's name with a clickable link
function makeDoctorClickable($text, $doctorName, $doctorId) {
    return preg_replace('/@' . preg_quote($doctorName, '/') . '/', '<a style="color:#4C84C3" href="single_doc?id=' . encrypt($doctorId) . '">@' . $doctorName . '</a>', $text);
}

// Replace doctor's name with blue and clickable link
$forum_text = makeDoctorClickable($forum['forum_text'], $forum['doctor_name'], $forum['tagged_doctor']);
?>

<section class="section-gap contact-top-wrappper">
    <div class="container">
        <div>

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
                         <?= $forum_text ?>
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

        </div>




        <?php
        if (isset($_SESSION['user_login'])) { ?>
            <div class="blog__sidebar mb-30">

                <div class="latest-comments mb-55">
                    <h3><?= $forum['comment_count'] ?> Comment(s)</h3>
                    <div class="CommentBox">
                        <ul>
                            <?php foreach ($comments as $comment) : ?>
                                <?php
                                $cid = $comment['comment_id'];
                                $photo = !empty($forum['user_image']) ? $forum['user_image'] : 'white_bg_image.png';
                                $reply = str_replace('\\', '', $comment['comment_text']);
                                $comment_date = $comment['comment_date_created'];
                                ?>
                                <li>
                                    <div class="comments-box grey-bg-2">
                                        <div class="comments-info d-flex">
                                            <div class="comments-avatar mr-15">
                                                <img src="<?= file_url . $photo ?>" class="ForumImg">
                                            </div>
                                            <div class="avatar-name">
                                                <span class="post-meta"><?= get_month_name($comment_date) . " " . get_day($comment_date) . "," . get_full_year($comment_date) ?></span>
                                            </div>
                                        </div>
                                        <div class="comments-text ml-65">
                                            <p><?= $reply ?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <form class="OurDivParent" method="POST" action="<?= model_url ?>comment">

                    <div class="row">
                        <div class="col-12" style="width:100%;">
                            <div class="comment__input-wrapper mb-25">
                                <h5>Message</h5>
                                <div class="comment__input textarea">
                                    <textarea name="comment_text" placeholder="Add a comment"></textarea>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-12">
                            <input hidden name="page" value="<?= $_SERVER['REQUEST_URI'] ?>">
                            <input hidden name="forum_id" value="<?= $id ?>">
                            <input hidden name="user_id" value="<?= $_SESSION['user_id'] ?>">
                            <button type="submit" class="btn-primary"> <span></span><i class="fal fa-comment"></i> Write Comment </button>
                        </div>
                    </div>
                </form>
            </div>
        <?php
        } else { ?>
            <div class="blog__sidebar mb-30">
                <h2>Log in to comment</h2>

                <form method='post' action="<?= model_url ?>user_login&page=<?= encrypt($_SERVER['REQUEST_URI']) ?>" style="width: 100%;">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group ModalFormInput">
                            <div class="form-group ModalFormInput">
                                <input type="email" name="user_email" class="form-control AppointmentInput" placeholder="Email" aria-label="Email">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group ModalFormInput">
                            <div class="form-group ModalFormInput">
                                <input type="password" name="user_password" class="form-control AppointmentInput" placeholder="Password  " aria-label="Password    ">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="TransBtn FullWidth">
                            Continue
                        </button>
                    </div>
                </form>
            </div>

        <?php }
        ?>






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

<script>
    $(document).ready(function() {
        <?php
        foreach ($comments as $key => $val) {
        ?>

            $('#ReplyList<?= $val['comment_id'] ?>').click(function() {
                $('#ReplyBox<?= $val['comment_id'] ?>').css("display", "block");
                $('#ReplyList<?= $val['comment_id'] ?>').css("display", "none");
            });

            $('#CloseReplyBox<?= $val['comment_id'] ?>').click(function() {
                $('#ReplyBox<?= $val['comment_id'] ?>').css("display", "none");
                $('#ReplyList<?= $val['comment_id'] ?>').css("display", "block");
            });



            $("#ViewReplies<?= $val['comment_id'] ?>").click(function() {
                $(".ReplyChildren<?= $val['comment_id'] ?>").css("display", "block");
                $("#CloseReplies<?= $val['comment_id'] ?>").css("display", "block");
                $("#ViewReplies<?= $val['comment_id'] ?>").css("display", "none");
            });

            $("#CloseReplies<?= $val['comment_id'] ?>").click(function() {
                $(".ReplyChildren<?= $val['comment_id'] ?>").css("display", "none");
                $("#CloseReplies<?= $val['comment_id'] ?>").css("display", "none");
                $("#ViewReplies<?= $val['comment_id'] ?>").css("display", "block");
            });
        <?php } ?>
    });
</script>



<style>
    .LoveHeart {
        margin-left: 20px;
    }

    .ViewReplies {
        margin-left: 20px;
    }

    .CloseReplies {
        margin-left: 10px;
        display: none;
    }

    .children {
        display: none;
    }

    .SingleImage {
        height: 315px;
        object-fit: cover;
        width: 100%;
    }

    .ReplyBox {
        display: none;
    }

    .CommentBox {
        height: auto;
        overflow-y: scroll;
        overflow-x: hidden;
        max-height: 1000px;
    }

    @media screen and (max-width:600px) {
        .SingleImage {
            height: auto;
        }
    }
</style>

<style>
    .latest-comments {
        margin-bottom: 55px;
    }

    .latest-comments h3 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .CommentBox {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
    }

    .CommentBox ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .CommentBox li {
        margin-bottom: 20px;
    }

    .comments-box {
        padding: 15px;
        border-radius: 5px;
        background-color: #fff;
    }

    .comments-info {
        align-items: center;
    }

    .comments-avatar {
        margin-right: 15px;
    }

    .comments-avatar img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .avatar-name .post-meta {
        font-size: 14px;
        color: #999;
    }

    .comments-text p {
        font-size: 16px;
        color: #555;
        margin-top: 10px;
    }
</style>

<?php
include_once 'footer.php';
?>