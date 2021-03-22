<?php

use Lib\Class\WebsiteEntity;
/**
 * @var $site WebsiteEntity
 */

?>
<article class="shadow-lg p-4 rounded mb-6">
    <header class="text-gray-600 flex flex-col pb-2 border-b border-gray-200 mb-2">
        <div class="flex">
            <span class="w-2 h-2 rounded-full bg-<?php echo colorFromStatus($site->status) ?>-500 self-center"></span>
            <span class="ml-2 text-lg"><?php echo $site->name ?></span>
        </div>
        <span
                class="font-light text-sm text-<?php echo colorFromStatus($site->status) ?>-500"
        >
            <?php echo sentenceFromStatus($site->status, 'urls') ?>
        </span>
    </header>
    <main class="flex flex-col">
        <?php foreach ($site->urls as $url): ?>
        <?php $status = $url->isUp ? LBX_ALL_UP : LBX_ALL_DOWN; ?>
            <a href="<?php echo $url->fullUrl ?>" target="_blank" class="flex relative py-1 hover:bg-gray-100" title="<?php echo $url->isUp ? 'This URL is up.' : 'This URL is down.' ?>">
                <div
                        class="w-1 ml-2 bg-<?php echo colorFromStatus($status) ?>-500"
                ></div>
                <span class="ml-2 font-light text-gray-500"><?php echo $url->url ?></span>
            </a>
        <?php endforeach; ?>
    </main>
</article>
