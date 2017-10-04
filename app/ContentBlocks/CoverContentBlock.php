<?php
/**
 * Copyright (c) 2017 Andrey "Limych" Khrolenok <andrey@khrolenok.ru>.
 */

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 14.09.2017
 * Time: 13:13.
 */

namespace Penati\ContentBlocks;

class CoverContentBlock extends ContentBlock
{
    public function html()
    {
        $title = $this->title;
        $background = $this->summary;
//        $content = $this->content;

        $view = view('block.cover', compact('title', 'background'));

        return $view->render();
    }
}
