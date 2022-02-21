<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd14435086883960732abd55d9740b44e
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Conf\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Conf\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd14435086883960732abd55d9740b44e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd14435086883960732abd55d9740b44e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd14435086883960732abd55d9740b44e::$classMap;

        }, null, ClassLoader::class);
    }
}
