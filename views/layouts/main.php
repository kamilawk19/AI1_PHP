<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/main.css">
    <title><?php echo $this->title ?></title>
</head>
<body>
    <header>
        <?php use app\core\Application;

        if (Application::isGuest()): ?>
        <a class="logo" href="/"><img src="/css/logowhite.svg" alt="logo" style="width: 114.4px; height: 32.2px"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="/"></a></li>
            </ul>
        </nav>
        <div>
            <a class="cta" href="/login">Login</a>
            <a class="cta" href="/register">Register</a>
        </div>

        
        <?php else: ?>
        <a class="logo" href="/"><img src="/css/logowhite.svg" alt="logo" style="width: 114.4px; height: 32.2px"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="/">Home</a></li>
                <li><a href="/timer">Timer</a></li>
                <li><a href="/projects">Projects</a></li>
                <li><a href="/clients">Clients</a></li>
                <li><a href="/team">Team</a></li>
                <li><a href="/profile">Profile</a></li>
            </ul>
        </nav>
        <div>
            <a a class="cta" href="/logout">Logout</a>
        </div>
        <?php endif; ?>
    </header>
    <?php if (Application::$app->session->getFlash('success')): ?>
        <div>
            <p><?php echo Application::$app->session->getFlash('success') ?></p>
        </div>
    <?php endif; ?>
    <div>{{content}}</div>


</body>