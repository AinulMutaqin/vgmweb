<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LaneTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LaneTable Test Case
 */
class LaneTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LaneTable
     */
    public $Lane;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lane'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Lane') ? [] : ['className' => 'App\Model\Table\LaneTable'];
        $this->Lane = TableRegistry::get('Lane', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Lane);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
