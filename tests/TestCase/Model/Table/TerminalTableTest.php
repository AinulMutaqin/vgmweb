<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TerminalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TerminalTable Test Case
 */
class TerminalTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TerminalTable
     */
    public $Terminal;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.terminal',
        'app.trx_truck_terminal',
        'app.trx_user_terminal'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Terminal') ? [] : ['className' => 'App\Model\Table\TerminalTable'];
        $this->Terminal = TableRegistry::get('Terminal', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Terminal);

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
