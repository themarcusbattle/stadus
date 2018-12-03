<?php

namespace Stadus\Classes\CPTs;

class Update extends \Weaverbird\Helpers\CPT {

    public function __construct() {

        $this->name        = 'update';
        $this->slug_is_int = true;

        $this->settings    = [
            'public'   => true,
            'label'    => 'Updates',
            'rewrite'  => [ 'slug' => 'updates' ],
            'supports' => [ 'title', 'editor', 'comments' ]
        ];
    }
}