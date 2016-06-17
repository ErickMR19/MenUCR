<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Associations Controller
 *
 * @property \App\Model\Table\AssociationsTable $Associations
 */
class AssociationsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->config('authError', ':(');
        $this->Auth->allow(['index','view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Headquarters']
        ];
        $associations = $this->paginate($this->Associations);

        $this->set(compact('associations'));
        $this->set('_serialize', ['associations']);
    }

    /**
     * View method
     *
     * @param string|null $id Association id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $association = $this->Associations->get($id, [
            'contain' => ['Headquarters', 'Restaurants', 'Users']
        ]);

        $this->set('association', $association);
        $this->set('_serialize', ['association']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $association = $this->Associations->newEntity();
        if ($this->request->is('post')) {
            $association = $this->Associations->patchEntity($association, $this->request->data);
            if ($this->Associations->save($association)) {
                $this->Flash->success(__('The association has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The association could not be saved. Please, try again.'));
            }
        }
        $headquarters = $this->Associations->Headquarters->find('list', ['limit' => 200]);
        $this->set(compact('association', 'headquarters'));
        $this->set('_serialize', ['association']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Association id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $association = $this->Associations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $association = $this->Associations->patchEntity($association, $this->request->data);
            if ($this->Associations->save($association)) {
                $this->Flash->success(__('The association has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The association could not be saved. Please, try again.'));
            }
        }
        $headquarters = $this->Associations->Headquarters->find('list', ['limit' => 200]);
        $this->set(compact('association', 'headquarters'));
        $this->set('_serialize', ['association']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Association id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $association = $this->Associations->get($id);
        if ($this->Associations->delete($association)) {
            $this->Flash->success(__('The association has been deleted.'));
        } else {
            $this->Flash->error(__('The association could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
