<?php
// This file is part of Moodle - http://moodle.org/
// ...existing code...
namespace block_annotation;

use advanced_testcase;
use block_annotation;
use context_course;

/**
 * PHPUnit block_annotation tests
 *
 * @package    block_annotation
 * @category   test
 * @copyright  2021 Sara Arjona (sara@moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversDefaultClass \block_annotation
 */
class annotation_test extends advanced_testcase
{
    public static function setUpBeforeClass(): void
    {
        require_once(__DIR__ . '/../../moodleblock.class.php');
        require_once(__DIR__ . '/../block_annotation.php');
    }

    /**
     * Test the behaviour of can_block_be_added() method.
     *
     * @covers ::can_block_be_added
     */
    public function test_can_block_be_added(): void
    {
        $this->resetAfterTest();
        $this->setAdminUser();

        // Create a course and prepare the page where the block will be added.
        $course = $this->getDataGenerator()->create_course();
        $page = new \moodle_page();
        $page->set_context(context_course::instance($course->id));
        $page->set_pagelayout('course');

        $block = new block_annotation();

        // If annotation advanced feature is enabled, the method should return true.
        set_config('usecomments', true);
        $this->assertTrue($block->can_block_be_added($page));

        // However, if the annotation advanced feature is disabled, the method should return false.
        set_config('usecomments', false);
        $this->assertFalse($block->can_block_be_added($page));
    }
}
