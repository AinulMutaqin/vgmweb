<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogTransactionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogTransactionTable Test Case
 */
class LogTransactionTableTest extends TestCase
{

    /**
     * Test subject     *
     * @var \App\Model\Table\LogTransactionTable     */
    public $LogTransaction;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.log_transaction'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LogTransaction') ? [] : ['className' => 'App\Model\Table\LogTransactionTable'];        $this->LogTransaction = TableRegistry::get('LogTransaction', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LogTransaction);

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
