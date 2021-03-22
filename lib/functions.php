<?php

use \Lib\Class\ServerEntity;

function getServerConfig($file = null) {
    $file = $file ?? dirname(__DIR__) . '/serverConfig.json';
    try {
        $configJson = file_get_contents($file);
        if (!$configJson) {
            die('Unable to find a config file.');
        }
        return json_decode($configJson);
    } catch (Error $e) {
        echo "error reading config file.";
        exit();
    }
}

function getServers($currentFirst = true, $file = null): array {
    $file = $file ?? dirname(__DIR__) . '/servers.json';
    try {
        $serversJson = file_get_contents($file);
        $serversData = json_decode($serversJson);
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
        echo "error reading config file.";
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
