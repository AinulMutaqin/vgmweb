<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TrxTruckTerminal Controller
 *
 * @property \App\Model\Table\TrxTruckTerminalTable $TrxTruckTerminal
 */
class TrxTruckTerminalController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trucks', 'Terminals', 'Users', 'Containers']
        ];
        $trxTruckTerminal = $this->paginate($this->TrxTruckTerminal);

        $this->set(compact('trxTruckTerminal'));
        $this->set('_serialize', ['trxTruckTerminal']);
    }

    /**
     * View method
     *
     * @param string|null $id Trx Truck Terminal id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $trxTruckTerminal = $this->TrxTruckTerminal->get($id, [
            'contain' => ['Trucks', 'Terminals', 'Users', 'Containers']
        ]);

        $this->set('trxTruckTerminal', $trxTruckTerminal);
        $this->set('_serialize', ['trxTruckTerminal']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $trxTruckTerminal = $this->TrxTruckTerminal->newEntity();
        if ($this->request->is('post')) {
            $trxTruckTerminal = $this->TrxTruckTerminal->patchEntity($trxTruckTerminal, $this->request->data);
            if ($this->TrxTruckTerminal->save($trxTruckTerminal)) {
                $this->Flash->success(__('The trx truck terminal has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trx truck terminal could not be saved. Please, try again.'));
            }
        }
        $trucks = $this->TrxTruckTerminal->Trucks->find('list', ['limit' => 200]);
        $terminals = $this->TrxTruckTerminal->Terminals->find('list', ['limit' => 200]);
        $users = $this->TrxTruckTerminal->Users->find('list', ['limit' => 200]);
        $containers = $this->TrxTruckTerminal->Containers->find('list', ['limit' => 200]);
        $this->set(compact('trxTruckTerminal', 'trucks', 'terminals', 'users', 'containers'));
        $this->set('_serialize', ['trxTruckTerminal']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Trx Truck Terminal id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trxTruckTerminal = $this->TrxTruckTerminal->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trxTruckTerminal = $this->TrxTruckTerminal->patchEntity($trxTruckTerminal, $this->request->data);
            if ($this->TrxTruckTerminal->save($trxTruckTerminal)) {
                $this->Flash->success(__('The trx truck terminal has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trx truck terminal could not be saved. Please, try again.'));
            }
        }
        $trucks = $this->TrxTruckTerminal->Trucks->find('list', ['limit' => 200]);
        $terminals = $this->TrxTruckTerminal->Terminals->find('list', ['limit' => 200]);
        $users = $this->TrxTruckTerminal->Users->find('list', ['limit' => 200]);
        $containers = $this->TrxTruckTerminal->Containers->find('list', ['limit' => 200]);
        $this->set(compact('trxTruckTerminal', 'trucks', 'terminals', 'users', 'containers'));
        $this->set('_serialize', ['trxTruckTerminal']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Trx Truck Terminal id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trxTruckTerminal = $this->TrxTruckTerminal->get($id);
        if ($this->TrxTruckTerminal->delete($trxTruckTerminal)) {
            $this->Flash->success(__('The trx truck terminal has been deleted.'));
        } else {
            $this->Flash->error(__('The trx truck terminal could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
