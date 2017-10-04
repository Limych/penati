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

class PriceContentBlock extends ContentBlock
{
    public function html()
    {
        $title = $this->title;
        $price = $this->summary;
        $content = $this->content;

        $view = view('block.price', compact('title', 'price', 'content'));

        return $view->render();
    }
}
