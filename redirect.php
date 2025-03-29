<?php
require_once 'path.php';
require_once MODEL_PATH . 'operations.php';
global $GOOGLE_OAUTH_URL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        window.location = '<?= $GOOGLE_OAUTH_URL ?>';
    </script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>