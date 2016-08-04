<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrxUserTerminalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrxUserTerminalTable Test Case
 */
class TrxUserTerminalTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TrxUserTerminalTable
     */
    public $TrxUserTerminal;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.trx_user_terminal',
        'app.users',
        'app.terminals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TrxUserTerminal') ? [] : ['className' => 'App\Model\Table\TrxUserTerminalTable'];
        $this->TrxUserTerminal = TableRegistry::get('TrxUserTerminal', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TrxUserTerminal);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
