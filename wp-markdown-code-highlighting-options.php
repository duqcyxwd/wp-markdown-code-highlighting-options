<?php
/*
Plugin Name: wp-markdown-code-highlighting-options
Plugin URI: https://github.com/mczenko/wp-markdown-code-highlighting-options.git
Description: This WordPress plugin works to enhance the handling of code blocks in markdown syntax and allows to turn on and off wrapping.
Version: 0.1.1
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
add_filter('the_content',       array(WP_MarkdownCodeHighlightingOptionProcessor::instance(),'processMarkdown'), 7);
add_filter('the_content_rss',   array(WP_MarkdownCodeHighlightingOptionProcessor::instance(),'processMarkdown'), 7);
add_filter('get_the_excerpt',   array(WP_MarkdownCodeHighlightingOptionProcessor::instance(),'processMarkdown'), 7);

class WP_MarkdownCodeHighlightingOptionProcessor
{
    private $styleString = '';
    private $classString = '';

    private function processOption($option) {
        if(strcmp($option,'nowrap') == 0) {
            $this->styleString = 'style="white-space:pre;word-wrap:normal;text-indent:0;padding:15px;overflow:auto;"';
        } else {
            $this->classString = 'class="'.$option.'"';
        }
    }

    private function generateReplacement() {
        return '<pre><code ' . $this->classString . ' ' . $this->styleString . '>';
    }

    private function resetOptions() {
        $this->styleString = '';
        $this->classString = '';
    }

    private function replaceCallback($matches) {
        $this->resetOptions();   
        foreach (explode(',',$matches[1]) as $option) {
            $this->processOption($option);
        }
        return $this->generateReplacement();
    }    

    public static function instance() {
        return new WP_MarkdownCodeHighlightingOptionProcessor();
    }

    public function processMarkdown($markdown_text) {
        return preg_replace_callback('|<pre><code>#!(.+?)\n|', array($this,'replaceCallback'), $markdown_text);
    }
}
