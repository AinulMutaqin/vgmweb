<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LogTransaction Controller
 *
 * @property \App\Model\Table\LogTransactionTable $LogTransaction
 */
class LogTransactionController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $logTransaction = $this->paginate($this->LogTransaction);

        $this->set(compact('logTransaction'));
        $this->set('_serialize', ['logTransaction']);
    }

    /**
     * View method
     *
     * @param string|null $id Log Transaction id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $logTransaction = $this->LogTransaction->get($id, [
            'contain' => []
        ]);

        $this->set('logTransaction', $logTransaction);
        $this->set('_serialize', ['logTransaction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logTransaction = $this->LogTransaction->newEntity();
        if ($this->request->is('post')) {
            $logTransaction = $this->LogTransaction->patchEntity($logTransaction, $this->request->data);
            if ($this->LogTransaction->save($logTransaction)) {
                $this->Flash->success(__('The log transaction has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The log transaction could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('logTransaction'));
        $this->set('_serialize', ['logTransaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Log Transaction id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logTransaction = $this->LogTransaction->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logTransaction = $this->LogTransaction->patchEntity($logTransaction, $this->request->data);
            if ($this->LogTransaction->save($logTransaction)) {
                $this->Flash->success(__('The log transaction has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The log transaction could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('logTransaction'));
        $this->set('_serialize', ['logTransaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Log Transaction id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logTransaction = $this->LogTransaction->get($id);
        if ($this->LogTransaction->delete($logTransaction)) {
            $this->Flash->success(__('The log transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The log transaction could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
