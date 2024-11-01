<?php
/*
  Plugin Name: WP filter in nested html table
  Plugin URI: http://www.laobanit.com/wp-filter-in-nested-html-table/
  Description: If you are interested in understanding or developing WordPress, sooner or later you might want to trace do_action('template_redirect'). With the knowledge from function's documentation, you know $wp_filter is involved. You may show array using val_dump or print_r, but it will take time for human eyes to read array in plain text directly. This plugin will show $wp_filter content in nested html table style for your easy reference. When activated you will see immediate result of your admin screen on every page.
  Version: 1.0
  Author: TaijiMark
  Author URI: http://www.laobanit.com/about/
 */

/*
  Copyright 2012,  TaijiMark  (email : info@laobanit.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

function taijimark003_array_to_table($src) {
    if (is_array($src)):
        echo "<table class='taijimark003'>";
        foreach ($src as $key => $val):
            echo "<tr><th>$key</th><td>";
            if (is_array($val)):
                taijimark003_array_to_table($val);
            else:
                echo $val;

            endif;
            echo "</td></tr>";
        endforeach;
        echo "</table>";
    endif;
}

function taijimark003_main() {
    global $wp_filter;
    echo "<h2>--- See content of WP filter --- </h2>";
    taijimark003_array_to_table($wp_filter);
}

add_action('admin_footer', 'taijimark003_main');

function taijimark003_css() {
    echo "
    <style type='text/css'>
            table.taijimark003 {
                margin: 1em 1em 1em 2em;
                background: #F0F0F0;
                border-collapse: collapse;
            }
            table.taijimark003 th,table.taijimark003 td {
                border: 1px #C0C0C0 solid;
                padding: 0.2em;
            }
            table.taijimark003 th {
                background: #D0D0D0;
                text-align: left;
            }
        </style>
        "
    ;
}

add_action('admin_head', 'taijimark003_css');
