<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TrxUserTerminal Controller
 *
 * @property \App\Model\Table\TrxUserTerminalTable $TrxUserTerminal
 */
class TrxUserTerminalController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Terminals']
        ];
        $trxUserTerminal = $this->paginate($this->TrxUserTerminal);

        $this->set(compact('trxUserTerminal'));
        $this->set('_serialize', ['trxUserTerminal']);
    }

    /**
     * View method
     *
     * @param string|null $id Trx User Terminal id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $trxUserTerminal = $this->TrxUserTerminal->get($id, [
            'contain' => ['Users', 'Terminals']
        ]);

        $this->set('trxUserTerminal', $trxUserTerminal);
        $this->set('_serialize', ['trxUserTerminal']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $trxUserTerminal = $this->TrxUserTerminal->newEntity();
        if ($this->request->is('post')) {
            $trxUserTerminal = $this->TrxUserTerminal->patchEntity($trxUserTerminal, $this->request->data);
            if ($this->TrxUserTerminal->save($trxUserTerminal)) {
                $this->Flash->success(__('The trx user terminal has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trx user terminal could not be saved. Please, try again.'));
            }
        }
        $users = $this->TrxUserTerminal->Users->find('list', ['limit' => 200]);
        $terminals = $this->TrxUserTerminal->Terminals->find('list', ['limit' => 200]);
        $this->set(compact('trxUserTerminal', 'users', 'terminals'));
        $this->set('_serialize', ['trxUserTerminal']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Trx User Terminal id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trxUserTerminal = $this->TrxUserTerminal->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trxUserTerminal = $this->TrxUserTerminal->patchEntity($trxUserTerminal, $this->request->data);
            if ($this->TrxUserTerminal->save($trxUserTerminal)) {
                $this->Flash->success(__('The trx user terminal has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trx user terminal could not be saved. Please, try again.'));
            }
        }
        $users = $this->TrxUserTerminal->Users->find('list', ['limit' => 200]);
        $terminals = $this->TrxUserTerminal->Terminals->find('list', ['limit' => 200]);
        $this->set(compact('trxUserTerminal', 'users', 'terminals'));
        $this->set('_serialize', ['trxUserTerminal']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Trx User Terminal id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trxUserTerminal = $this->TrxUserTerminal->get($id);
        if ($this->TrxUserTerminal->delete($trxUserTerminal)) {
            $this->Flash->success(__('The trx user terminal has been deleted.'));
        } else {
            $this->Flash->error(__('The trx user terminal could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
