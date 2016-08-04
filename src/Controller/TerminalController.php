<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Terminal Controller
 *
 * @property \App\Model\Table\TerminalTable $Terminal
 */
class TerminalController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $terminal = $this->paginate($this->Terminal);

        $this->set(compact('terminal'));
        $this->set('_serialize', ['terminal']);
    }

    /**
     * View method
     *
     * @param string|null $id Terminal id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $terminal = $this->Terminal->get($id, [
            'contain' => ['TrxTruckTerminal', 'TrxUserTerminal']
        ]);

        $this->set('terminal', $terminal);
        $this->set('_serialize', ['terminal']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $terminal = $this->Terminal->newEntity();
        if ($this->request->is('post')) {
            $terminal = $this->Terminal->patchEntity($terminal, $this->request->data);
            if ($this->Terminal->save($terminal)) {
                $this->Flash->success(__('The terminal has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The terminal could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('terminal'));
        $this->set('_serialize', ['terminal']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Terminal id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $terminal = $this->Terminal->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $terminal = $this->Terminal->patchEntity($terminal, $this->request->data);
            if ($this->Terminal->save($terminal)) {
                $this->Flash->success(__('The terminal has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The terminal could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('terminal'));
        $this->set('_serialize', ['terminal']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Terminal id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $terminal = $this->Terminal->get($id);
        if ($this->Terminal->delete($terminal)) {
            $this->Flash->success(__('The terminal has been deleted.'));
        } else {
            $this->Flash->error(__('The terminal could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
