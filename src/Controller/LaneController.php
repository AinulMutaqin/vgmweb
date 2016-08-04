<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lane Controller
 *
 * @property \App\Model\Table\LaneTable $Lane
 */
class LaneController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $lane = $this->paginate($this->Lane);

        $this->set(compact('lane'));
        $this->set('_serialize', ['lane']);
    }

    /**
     * View method
     *
     * @param string|null $id Lane id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lane = $this->Lane->get($id, [
            'contain' => []
        ]);

        $this->set('lane', $lane);
        $this->set('_serialize', ['lane']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lane = $this->Lane->newEntity();
        if ($this->request->is('post')) {
            $lane = $this->Lane->patchEntity($lane, $this->request->data);
            if ($this->Lane->save($lane)) {
                $this->Flash->success(__('The lane has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lane could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lane'));
        $this->set('_serialize', ['lane']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lane id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lane = $this->Lane->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lane = $this->Lane->patchEntity($lane, $this->request->data);
            if ($this->Lane->save($lane)) {
                $this->Flash->success(__('The lane has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lane could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lane'));
        $this->set('_serialize', ['lane']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lane id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lane = $this->Lane->get($id);
        if ($this->Lane->delete($lane)) {
            $this->Flash->success(__('The lane has been deleted.'));
        } else {
            $this->Flash->error(__('The lane could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
