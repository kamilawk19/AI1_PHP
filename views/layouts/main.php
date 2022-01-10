<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/css/main.css">
    <title><?php echo $this->title ?></title>
</head>
<body>
<nav>
    <a href="#">Navbar</a>
    <div>
        <ul>
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
        </ul>

        <?php use app\core\Application;

        if (Application::isGuest()): ?>
            <ul>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            </ul>
        <?php else: ?>
            <ul">
                <li class="nav-item">
                    <a class="nav-link" href="/timer">
                        Timer
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/profile">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">
                        Welcome <?php echo Application::$app->user->getDisplayName() ?> (Logout)
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <?php if (Application::$app->session->getFlash('success')): ?>
        <div>
            <p><?php echo Application::$app->session->getFlash('success') ?></p>
        </div>
    <?php endif; ?>
    {{content}}
</div>

</body>
</html>