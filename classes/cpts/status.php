<?php

namespace Stadus\Classes\CPTs;

class Status extends \Weaverbird\Helpers\CPT {

    public function __construct() {

        $this->name        = 'status';
        $this->slug_is_int = true;

        $this->settings    = [
            'public'   => true,
            'label'    => 'Status',
            'rewrite'  => [ 'slug' => 'updates' ],
            'supports' => [ 'title', 'editor', 'comments' ]
        ];
    }
}