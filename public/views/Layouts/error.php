<?php 
    ob_end_clean();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: rgb(1, 22, 30);
        }

        #error-contents {
            margin-top: 300px;
            display: grid;
            place-items: center;
            color: rgba(239, 246, 224, 0.4);
        }

        #error-contents > h1 {
            color: rgb(239, 246, 224);
        }
    </style>
</head>

<body>
    <div id="error-contents">
        <h1>ERROR</h1>
        Page Not Found
        <?php echo $_SERVER['REQUEST_URI']; ?>
    </div>
</body>
</html>
    