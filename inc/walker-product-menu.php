<?php
class Header_Menu_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        // Keep only 'current-menu-item' or 'menu-item-has-children' for functionality, drop others to match clean HTML
        $keep_classes = array_intersect($classes, ['current-menu-item', 'menu-item-has-children', 'current-menu-ancestor']);
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($keep_classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li>';

        $attributes  = ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}
