<?php

namespace Stadus\Classes\Taxonomies;

class Project extends \Weaverbird\Helpers\Taxonomy {

    public function __construct() {
        $this->name     = 'project';
        $this->objects  = [ 'update', 'user' ];
        $this->settings = [
            'label'        => 'Projects',
            'rewrite'      => [ 'slug' => 'projects' ],
            'hierarchical' => true,
        ];
    }

    public function edit_form_fields( $taxonomy ) {

        $background_img_url = get_term_meta( $taxonomy->term_id, 'background_img_url', true );

        ?>
            <tr class="form-field term-name-wrap">
                <th scope="row"><label for="background-img-url">Background Image URL</label></th>
                <td><input name="term_meta[background_img_url]" id="background-img-url" type="text" value="<?php echo esc_attr( $background_img_url ); ?>" size="40" aria-required="true">
                <p class="description">This is the background image that will display on the project archive.</p></td>
            </tr>
        <?php
    }
}