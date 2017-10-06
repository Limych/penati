<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>.
 */

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 14.09.2017
 * Time: 13:13.
 */

namespace Penati\ContentBlocks;

class MapContentBlock extends ContentBlock
{
    public function html()
    {
        $title = $this->title;
        $coordinates = $this->summary;
        $content = $this->content;

        $view = view('block.map', compact('title', 'coordinates', 'content'));

        return $view->render();
    }
}
