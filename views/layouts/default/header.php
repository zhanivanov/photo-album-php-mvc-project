<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="/content/bower_components/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/content/bower_components/bootstrap/dist/js/bootstrap.js"></script>

    <script type="text/javascript" src="/content/js/changeLogoColor.js"></script>

    <link rel="stylesheet" href="/content/styles.css"/>
    <link rel="stylesheet" href="/content/bower_components/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="/content/bower_components/bootstrap/dist/css/bootstrap-theme.css"/>
    <title><?php echo htmlspecialchars($this->title) ?></title>
</head>

<body>
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">SoftUniAlbum</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <?php if($this->isLoggedIn()) : ?>
                        <div class="col-lg-10"></div>
                        <ul class="nav navbar-nav logged-in-info">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello, <?= $_SESSION['username']; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="">
                                            <form action="/account/logout" method="post">
                                                <button type="submit" class="btn btn-danger btn-block">Logout</button>
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <?php include_once('messages.php'); ?>
    <main class="jumbotron row" id="wrapper">
