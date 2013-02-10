<?php
/*
Plugin Name: wp-markdown-code-highlighting-options
Plugin URI: https://github.com/mczenko/wp-markdown-code-highlighting-options.git
Description: This WordPress plugin works to enhance the handling of code blocks in markdown syntax and allows to turn on and off wrapping.
Version: 0.1.0
Author: Marcin Czenko (Red Green Refactor)
Author URI: http://redgreenrefactor.eu
License: MIT License
*/

/*
Copyright (c) 2013 Red Green Refactor

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS  IN THE SOFTWARE.
*/

// Install filter to run after markdown (priority 6)
add_filter('the_content',       'wmcho_process_markdown', 7);
add_filter('the_content_rss',   'wmcho_process_markdown', 7);
add_filter('get_the_excerpt',   'wmcho_process_markdown', 7);

function wmcho_process_markdown( $text ) {
    return preg_replace( '|<pre><code>(?:#!(nowrap)\n)?#!([^\n]+)\n|se', 'wmcho_process_language(\'$2\',\'$1\');', $text);
}

function wmcho_process_language( $language, $wrap) {
    if(strcmp($wrap,'nowrap') == 0) {
        $style = 'style="white-space:pre;word-wrap:normal;text-indent:0;padding:15px;overflow:auto;"';
    } else {
        $style = '';
    }
    return '<pre><code class="'. $language . '" ' . $style . '>';
}
