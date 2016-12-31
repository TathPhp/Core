<?php
declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationRegistry;

(function () {
    $path = explode(DIRECTORY_SEPARATOR, __DIR__);

    $autoloadPath = function ($path) {
        array_push($path, 'vendor');
        array_push($path, 'autoload.php');
        return implode(DIRECTORY_SEPARATOR, $path);
    };

    while (!empty($path) && !file_exists($autoloadPath($path))) {
        array_pop($path);
    }
    require_once $autoloadPath($path);

    array_push($path, 'app');
//    array_push($path, 'AppKernel.php');
    $_SERVER['KERNEL_DIR'] = implode(DIRECTORY_SEPARATOR, $path);
//    require_once implode(DIRECTORY_SEPARATOR, $path);
})();

AnnotationRegistry::registerFile(__DIR__ . "/Fixtures/AnnotationA.php");
AnnotationRegistry::registerFile(__DIR__ . "/Fixtures/AnnotationB.php");
