<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'phpDocumentor\\Reflection\\' => array($vendorDir . '/phpdocumentor/reflection-common/src', $vendorDir . '/phpdocumentor/reflection-docblock/src', $vendorDir . '/phpdocumentor/type-resolver/src'),
    'Webmozart\\Assert\\' => array($vendorDir . '/webmozart/assert/src'),
    'WebServer\\' => array($baseDir . '/src'),
    'Tests\\' => array($baseDir . '/tests'),
    'Symfony\\Polyfill\\Ctype\\' => array($vendorDir . '/symfony/polyfill-ctype'),
    'Prophecy\\' => array($vendorDir . '/phpspec/prophecy/src/Prophecy'),
    'PhpParser\\' => array($vendorDir . '/nikic/php-parser/lib/PhpParser'),
    'Doctrine\\Instantiator\\' => array($vendorDir . '/doctrine/instantiator/src/Doctrine/Instantiator'),
    'DeepCopy\\' => array($vendorDir . '/myclabs/deep-copy/src/DeepCopy'),
);
