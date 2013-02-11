## WP-Markdown-Code-Highlighting-Options  
**Contributors**: marcin.czenko  
**Link**: https://github.com/mczenko/wp-markdown-code-highlighting-options.git  
**Tags**: markdown, highlight.js, syntax, code, pre, highlight, wrap  
**Requires at least**: not tested  
**Tested up to**: 3.5  
**Stable tag**: 0.1.1  
**License**: MIT License  
**License URI**: http://opensource.org/licenses/MIT

WP Markdown Code Highlighting Options is a simple plugin that works in conjunction with Markdown code blocks and highlight.js to change the formatting of the code.

### Description

WP Markdown Code Highlighting Options works in conjunction with plugins such as [wp-markdown](http://wordpress.org/extend/plugins/wp-markdown/)
and [wp-highlight.js](http://wordpress.org/extend/plugins/wp-highlightjs/). Markdown is fantastic markup for easily
writing blogs, and [highlight.js](http://softwaremaniacs.org/soft/highlight/en/) is an extremely easy way to highlight
code examples. In most cases, highlight.js automatically detects the proper language for a block of code. In certain
cases, primarily if your code example is short, highlight.js could improperly detect the language that you are using;
that is where this plugin comes into play. By adding one line to your code blocks, you can explicitly set the language
that you are using, allowing highlight.js to properly format your code.

The concept is inspired by the [wp-markdown-syntax-highlight](https://github.com/spjwebster/wp-markdown-syntax-highlight) and the
[wp-markdown-syntax-sugar](https://github.com/visoft/wp-markdown-syntax-sugar) plugins.

Currently it allows you to add the formatting language (besides the one automatically recognised by wp-highlight.js) and choose if the code should be wrapped or not.

The usage is extremely simple. Just add a shebang as the first line of your code example with some extra formatting options:

    #!ruby,nowrap
    class Foo < Bar
      def hello
        puts "Hello World!"
      end
    end

The shebang is removed, and the code is outputted as:

    <pre><code class="ruby" style="white-space:pre;word-wrap:normal;text-indent:0;padding:15px;overflow:auto;">class Foo < Bar
      def hello
        puts "Hello World!"
      end
    end</code></pre>

> Options are comma-separated and must all be in one line.

Without the `nowrap` option the style will not be added and your default style will be used. To make your code wrapping at the end of the line you can add the following additional CSS in the wp-highlight.js settings:

    pre code {
        border: 1px solid #ccc;
        overflow: auto;
        white-space: pre-wrap;       /* css-3 */
        white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
        white-space: -pre-wrap;      /* Opera 4-6 */
        white-space: -o-pre-wrap;    /* Opera 7 */
        word-wrap: break-word;       /* Internet Explorer 5.5+ */
        text-indent: -80px;
        padding-left: 95px;
    }

### Installation

Installation is standard and straight forward.

1. Upload the `wp-markdown-code-highlighting-options` folder (and all it's contents) to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Modify code blocks with a shebang options.

### Changelog

#### 0.1.0
* Initial release

#### 0.1.0
* Options are comma-separated and must be on the same line. Source code is better prepared to accommodate future options.
  Regular expressions are not using the "e" modifier which is considered insecure.
