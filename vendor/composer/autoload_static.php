<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8ea0e2e028f6480dcbfe45b0f2e528ad
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8ea0e2e028f6480dcbfe45b0f2e528ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8ea0e2e028f6480dcbfe45b0f2e528ad::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8ea0e2e028f6480dcbfe45b0f2e528ad::$classMap;

        }, null, ClassLoader::class);
    }
}
