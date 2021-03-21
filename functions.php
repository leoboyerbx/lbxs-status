<?php
function getServerConfig($file = './serverConfig.json') {
    echo file_get_contents($file);
}
