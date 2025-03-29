<?php
ob_start();
$page = 'home';
include_once 'header.php';


if (!isset($_GET['sender_token']) || !isset($_GET['reciever_token'])) {
    ob_clean();
    header("location:../consult");
}


?>


<!--====== Why Choose Section Start ======-->
<section style="background:#FFF;" class="AppSection">

    <div class="chat-container">
        <div class="chat-header">
            <h2>Chat</h2>
        </div>
        <div id="help" class="chat-body">
            <?php
            $conn = connect();
            $rt = mysqli_real_escape_string($conn, $_GET['reciever_token']);
            $st = mysqli_real_escape_string($conn, $_GET['sender_token']);
            $sql = "select * from messages where (sender_token = '$st' and reciever_token = '$rt') or (sender_token = '$rt' and reciever_token = '$st')";
            $row = select_rows($sql);
            foreach ($row as $key => $item) {
                $row[$key]['message'] = $item['message'];
            }
            foreach ($row as $item) {
                if ($item['sender_token'] != $st) {
            ?>
                    <div class="chat-message incoming">
                        <div class="message-avatar">
                            <img src="https://via.placeholder.com/50x50" alt="Avatar">
                        </div>
                        <div class="message-content">
                            <p><?= $item['message'] ?></p>
                            <span class="message-time"> 
                                <?= get_ordinal_month_year($item['date_created']) . " at " . get_hours_mins($item['date_created']) ?>
                            </span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="chat-message outgoing">
                        <div class="message-content">
                            <p>
                                <?= $item['message'] ?>
                            </p>
                            <span class="message-time">
                                <?= get_ordinal_month_year($item['date_created']) . " at " . get_hours_mins($item['date_created']) ?>
                            </span>
                        </div>
                        <div class="message-avatar">
                            <img src="https://via.placeholder.com/50x50" alt="Avatar">
                        </div>
                    </div>
            <?php  }
            }
            ?>
        </div>

        <input type="hidden" id="st" name="sender_token" value="<?= $st ?>">
        <input type="hidden" id="rt" name="reciever_token" value="<?= $rt ?>">
        <div class="chat-footer">
            <div class="textarea-container">
                <textarea id="message" placeholder="Enter your message..."></textarea>
                <button id="submit">Send</button>
            </div>

        </div>

    </div>

</section>
<!--====== Why Choose Section End ======-->

<style>
    .chat-container {
        display: flex;
        flex-direction: column;
        height: 100%;
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .chat-header {
        background-color: #1da1f2;
        color: #fff;
        padding: 10px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .chat-header h2 {
        margin: 0;
        font-size: 20px;
    }

    .chat-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow-y: scroll;
        padding: 10px;
    }

    .chat-message {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }

    .incoming .message-avatar {
        margin-right: 10px;
    }

    .outgoing .message-avatar {
        margin-left: 10px;
    }

    .message-avatar img {
        display: block;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .message-content {
        background-color: #f5f5f5;
        padding: 10px;
        border-radius: 10px;
        max-width: 70%;
    }

    .outgoing .message-content {
        background-color: blue;
        color: white;

    }

    .message-content p {
        margin: 0;
        line-height: 1.4;
    }

    .outgoing .message-content p {
        color: white;
    }

    .message-time {
        font-size: 12px;
        margin-left: 10px;
    }

    .chat-footer {
        display: block;
        padding: 10px;
        border-top: 1px solid #ccc;
    }

    .outgoing {
        display: flex;
        justify-content: flex-end;
    }

    .textarea-container {
        position: relative;
    }

    .textarea-container textarea {
        height: 70px;
        padding: 10px;
        border: none;
        resize: none;
        width: 100%;
    }

    .textarea-container button {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
    }

    .textarea-container button:hover {
        background-color: #45a049;
    }
</style>

<script>
    $(document).ready(function() {
        setInterval(function() {
            $("#help").load(window.location.href + " #help");
        }, 3000);
        $("#submit").click(function() {
            $("#submit").attr("disabled", true);
            $.post("model/update/create.php?action=chat", {
                    sender_token: $("#st").val(),
                    reciever_token: $("#rt").val(),
                    message: $("#message").val()
                },
                function(data, status) {
                    $("#submit").attr("disabled", false);
                    $("#message").val("");
                });
        });
    });
</script>

<?php
include_once 'footer.php';
?>