<?php

use \Lib\Class\ServerEntity;
use Symfony\Component\Yaml\Yaml;
use Windwalker\Renderer\PhpRenderer;

function getServerConfig($file = null) {
    $file = $file ?? dirname(__DIR__) . '/serverConfig.json';
    try {
        $configJson = file_get_contents($file);
        if (!$configJson) {
            die('Unable to find a config file.');
        }
        return json_decode($configJson);
    } catch (Error $e) {
        debuge('Error reading config file:', $e->getMessage());
        exit();
    }
}

function getServers($currentFirst = true, $file = null): array {
    $file = $file ?? dirname(__DIR__) . '/servers.yml';
    try {
        $serversYaml = file_get_contents($file);
        $serversData = Yaml::parse($serversYaml);
        $servers = ServerEntity::createMultiple($serversData);
        if ($currentFirst) {
            usort($servers, function (ServerEntity $a, ServerEntity $b) {
                if ($a->isCurrent) return -1;
                else if ($b->isCurrent) return 1;
                return 0;
            });
        }
        return $servers;
    } catch (Error $e) {
        debuge('Error reading servers file:', $e->getMessage());
        exit();
    }
}


function dumpVar()
{
    echo '<pre style="margin-left: 0px; margin-right: 0px; padding: 10px; border: solid 1px black; background-color: ghostwhite; color: black; text-align: left;">';
    foreach (func_get_args() as $var) {
        echo "\n";
        var_dump($var);
    }
    echo '</pre>' . "\n";
}

function printVar()
{
    echo '<pre style="margin-left: 0px; margin-right: 0px; padding: 10px; border: solid 1px black; background-color: ghostwhite; color: black; text-align: left;">';
    foreach (func_get_args() as $var) {
        echo "\n";
        print_r($var);
    }
    echo '</pre>' . "\n";
}

// Rendering funcs
/**
 *
 */
function colorFromStatus ($status) {
    if ($status === LBX_ALL_UP) {
        return 'green';
    } else if ($status === LBX_SOME_DOWN) {
        return 'yellow';
    }
    return 'red';
}

function sentenceFromStatus ($status, $entity = 'websites') {
    if ($status === LBX_ALL_UP) {
        return "All $entity are up.";
    } else if ($status === LBX_SOME_DOWN) {
        return "Some $entity are down.";
    }
    return "All $entity are down.";
}

/**
 * Dump une variable
 */
function isDebug()
{
    return ((defined('LBX_DEBUG') && LBX_DEBUG === true));
}

/**
 * Dump une variable
 */
function debug()
{
    if (isDebug()) {
        foreach (func_get_args() as $var) {
            printVar($var);
        }
    }
}


/**
 * Dump une variable et stop l'execution
 */
function debuge()
{
    if (isDebug()) {
        foreach (func_get_args() as $var) {
            printVar($var);
        }
        exit;
    }
}

/**
 * Dump une variable
 */
function dump()
{
    if (isDebug()) {
        foreach (func_get_args() as $var) {
            dumpVar($var);
        }
    }
}


/**
 * Dump une variable et stop l'execution
 */
function dumpe()
{
    if (isDebug()) {
        foreach (func_get_args() as $var) {
            dumpVar($var);
        }
        exit;
    }
}

$renderer = new PhpRenderer(__DIR__ . '/partials', []);
