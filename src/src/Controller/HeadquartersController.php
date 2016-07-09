<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Headquarters Controller
 *
 * @property \App\Model\Table\HeadquartersTable $Headquarters
 */
class HeadquartersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $headquarters = $this->paginate($this->Headquarters);

        $this->set(compact('headquarters'));
        $this->set('_serialize', ['headquarters']);
    }

    /**
     * View method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $headquarters = $this->Headquarters->get($id, [
            'contain' => []
        ]);

        $this->set('headquarters', $headquarters);
        $this->set('_serialize', ['headquarters']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $headquarters = $this->Headquarters->newEntity();
        if ($this->request->is('post')) {
            $headquarters = $this->Headquarters->patchEntity($headquarters, $this->request->data);
            if ($this->Headquarters->save($headquarters)) {
                $this->Flash->success(__('The headquarters has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The headquarters could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('headquarters'));
        $this->set('_serialize', ['headquarters']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $headquarters = $this->Headquarters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $headquarters = $this->Headquarters->patchEntity($headquarters, $this->request->data);
            if ($this->Headquarters->save($headquarters)) {
                $this->Flash->success(__('The headquarters has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The headquarters could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('headquarters'));
        $this->set('_serialize', ['headquarters']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Headquarters id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $headquarters = $this->Headquarters->get($id);
        if ($this->Headquarters->delete($headquarters)) {
            $this->Flash->success(__('The headquarters has been deleted.'));
        } else {
            $this->Flash->error(__('The headquarters could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
