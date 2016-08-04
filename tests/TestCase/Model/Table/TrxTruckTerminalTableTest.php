<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrxTruckTerminalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrxTruckTerminalTable Test Case
 */
class TrxTruckTerminalTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TrxTruckTerminalTable
     */
    public $TrxTruckTerminal;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.trx_truck_terminal',
        'app.trucks',
        'app.terminals',
        'app.users',
        'app.containers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TrxTruckTerminal') ? [] : ['className' => 'App\Model\Table\TrxTruckTerminalTable'];
        $this->TrxTruckTerminal = TableRegistry::get('TrxTruckTerminal', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TrxTruckTerminal);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
