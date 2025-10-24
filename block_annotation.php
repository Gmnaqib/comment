<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The annotation block
 *
 * @package    block_annotation
 * @copyright 2009 Dongsheng Cai <dongsheng@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_annotation extends block_base
{
    /**
     * @var string|null
     */
    public $title = null;
    /**
     * @var stdClass|null
     */
    public $content = null;
    function init()
    {
        global $CFG;
        require_once($CFG->dirroot . '/comment/lib.php');
        $this->title = 'Annotation';
    }
    function specialization()
    {
        // No external comment init needed for list view.
    }
    function applicable_formats()
    {
        return array('all' => true);
    }
    function instance_allow_multiple()
    {
        return false;
    }
    function get_content()
    {
        if ($this->content !== NULL) {
            return $this->content;
        }
        $this->content = new stdClass();
        $this->content->footer = '';
        $list = '<ul>';
        for ($i = 1; $i <= 10; $i++) {
            $list .= '<li>helloworld</li>';
        }
        $list .= '</ul>';
        $this->content->text = $list;
        return $this->content;
    }
    public function can_block_be_added($page)
    {
        global $CFG;
        return $CFG->usecomments;
    }
}
