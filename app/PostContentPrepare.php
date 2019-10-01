<?php

namespace App;

use DOMWrap\Document;

class PostContentPrepare
{
    private $doc;

    public function __construct(Document $doc)
    {
        $this->doc = $doc;
    }

    public function prepare($htmlString)
    {
        $purified = clean($htmlString);

        $this->doc->html($purified);
        $this->doc
            ->find('table')
            // ->not($this->doc->find('.table-wrapper table'))
            ->wrap('<div class="table-wrapper"></div>');

        // https://github.com/scotteh/php-dom-wrapper/pull/11#issuecomment-524396817
        return mb_convert_encoding($this->doc->find('body')->html(), "Windows-1252", "UTF-8");
    }
}
