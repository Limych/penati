<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>.
 */

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 14.09.2017
 * Time: 12:28.
 */

namespace Penati\ContentBlocks;

class PhotosContentBlock extends ContentBlock
{
    public function html()
    {
        $title = $this->title;
        $summary = $this->summary;
        $content = explode("\n", $this->content);

        $view = view('block.photos', compact('title', 'summary', 'content'));

        return $view->render();
    }
}
