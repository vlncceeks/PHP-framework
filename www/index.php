<?php

spl_autoload_register(function(string $className) {
    require(dirname(__DIR__).'\\'.$className.'.php');
});
// require('src/Modules/Users/User.php');
// require('src/Modules/Articles/Article.php');
//     $user = new \src\Modules\Users\User('Ksenia');
    // $article = new \src\Modules\Articles\Article('title', 'text', $user);

    $route = isset($_GET['route']) ? $_GET['route'] : '';
    $patterns = require('route.php');
    $findRoute = false;

    foreach($patterns as $pattern => $controllerAndAction) {
        if (preg_match($pattern, $route, $matches)) {
            $findRoute = true;
            unset($matches[0]);
            $action = $controllerAndAction[1];
            $controller = new $controllerAndAction[0];
            $controller -> $action(...$matches);
        }
    }

    if (!$findRoute) echo 'Страница не найдена';
    // $controller  = new src\Controllers\MainController;

    // if (isset($_GET['name'])) $controller -> sayHello($article->getAuthor()->getName());
    // echo $controller -> main();
?>    