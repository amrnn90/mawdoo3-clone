<?php 

namespace App;
use DOMWrap\Document;

class PostContentPrepare {
    private $doc;

    public function __construct(Document $doc)
    {
        $this->doc = $doc;
    }

    public function prepare($htmlString) {
        $purified = clean($htmlString);

        $this->doc->html($purified);
        $this->doc
            ->find('table')
            // ->not($this->doc->find('.table-wrapper table'))
            ->wrap('<div class="table-wrapper"></div>');
        return $this->doc->find('body')->html();
    }
}