<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit379f1ce20057a94c17b2175610524669
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit379f1ce20057a94c17b2175610524669::$classMap;

        }, null, ClassLoader::class);
    }
}
