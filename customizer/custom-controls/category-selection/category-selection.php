<?php

class GK_Portfolio_Category_Selection extends WP_Customize_Control {
    public $type = 'gk_portfolio_category_selection';
 
    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);
    }
 
    public function enqueue() {
        wp_enqueue_script('gk-portfolio-category-selection', get_template_directory_uri() . '/customizer/custom-controls/category-selection/category-selection.js');
        wp_enqueue_style('gk-portfolio-category-selection', get_template_directory_uri() . '/customizer/custom-controls/category-selection/category-selection.css');
    }
 
    public function render_content() {
        ?>
        <label>
            <?php if(!empty($this->label)) : ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php endif; ?>
 
            <?php if(!empty($this->description)) : ?>
            <span class="description customize-control-description">
                <?php echo $this->description ; ?>
            </span>
            <?php endif; ?>
            
            <div class="gk-portfolio-category-selection">
                <ul>
                    <li class="gk-portfolio-fake-checkbox"><input type="checkbox" /></li>
                    
                    <?php wp_category_checklist(0, 0, explode(',', $this->value()), false, new Dziudek_TC_Walker_Category_Checklist($this->id), false); ?>
                </ul>
             
                <input type="hidden" id="<?php echo $this->id; ?>" class="gk-portfolio-category-selection-value" <?php $this->link(); ?> value="<?php echo sanitize_text_field( $this->value() ); ?>">
            </div>
        </label>
        <?php
    }
}

class Dziudek_TC_Walker_Category_Checklist extends Walker {
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');
    var $field_name = '';
 
    function __construct($field_name) {
        $this->field_name = $field_name;
    }
 
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class='children'>\n";
    }
 
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
 
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        extract($args);
        $output .= "\n<li>" . '<label><input value="' . $category->term_id . '" type="checkbox" ' . checked(in_array($category->term_id, $selected_cats), true, false ) . disabled(empty($args['disabled']), false, false) . ' class="gk-portfolio-category-selection-checkbox" data-id="'.$this->field_name.'" data-category-id="'.$category->term_id.'" /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
    }
 
    function end_el( &$output, $category, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}

