<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport", initial-scale=1.0">
    
    <link rel="icon" href=""/>
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="/public/css/app.css"> -->
</head>

<body>
    <style>
        <?php 
            echo file_get_contents('./public/css/app.css');
        ?>
    </style>
    <header>
        <nav class="main-navigation-scroll">
            <input type="checkbox" id="nav-toggle" />

            <a href="home" class="logo" tabindex="-1"
                ><img src="" /> LOGO
            </a>

            <div class="nav-links">
                <a href="home" class="link-enabled">Home</a>
                <a href="#ABOUT" class="link-disabled">About</a>
                <a href="profile" class="link-disabled">Profile</a>
            </div>

            <label for="nav-toggle" class="icon-menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </label>
        </nav>
    </header>

    <section class="main-body">
        <?php 
            require_once('./routes/web.php');
        ?>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="./public/js/app.js"></script> -->
    <script>
        <?php 
            echo file_get_contents('./public/js/app.js');
        ?>
    </script>
</body>
</html>