<?php
/**
 *
 * This is our template parser class, nothing to get excited about.
 *
 * Template Parser
 *
 * @package Lasse\Template
 * @author Lasse Nielsen <lasseskovgaard92@gmail.com>
 * @version 0.1
 * Date: 07-06-2018
 * Time: 14:36
 */

namespace Template;

class Template
{

    /**
     * Create the $vars as an array.
     *
     * @var array
     */
    private $vars = array();


    /**
     * Now we need to set delimiters from where our parser need to look for placeholders
     * @var string
     */

    private $right_delim = '}',
        $left_delim = '{';


    /**
     * Now we need to be able to assign a key-value pair, we do that with the help of a function.
     *
     * @param $key
     * @param $value
     */
    public function assign($key, $value)
    {
        $this->vars[$key] = $value;
    }

    /**
     * Now for the fun stuff, we need the parser to loop through, we'll also use a function for that.
     *
     * @param $template_file
     */
    public function parseFile($template_file)
    {
        if (file_exists($template_file)) {
            $content = file_get_contents($template_file);

            foreach ($this->vars as $key => $value) {
                if (!is_array($value)) {
                    $content = $this->parse($key, $value, $content);
                }
            }

            eval('?> ' . $content . '<?php ');
        } else {
            exit('<h1>Template error</h1>');
        }
    }

    /**
     * Now parse the content and replace the placeholders with text.
     *
     * @param $key
     * @param $value
     * @param $string
     * @return mixed this is our content
     */
    private function parse($key, $value, $string)
    {

        return str_replace($this->left_delim . $key . $this->right_delim, $value, $string);
    }
}