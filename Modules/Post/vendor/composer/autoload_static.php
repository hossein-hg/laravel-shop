<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc9b856d39228e38bf524b96dc8387e65
{
    public static $files = array (
        '85cc2029821577800abf4aa5d6e902ab' => __DIR__ . '/../..' . '/../../app/Helpers/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Post\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Post\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitc9b856d39228e38bf524b96dc8387e65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc9b856d39228e38bf524b96dc8387e65::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc9b856d39228e38bf524b96dc8387e65::$classMap;

        }, null, ClassLoader::class);
    }
}
