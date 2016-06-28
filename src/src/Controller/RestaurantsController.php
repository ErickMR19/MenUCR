<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Restaurants Controller
 *
 * @property \App\Model\Table\RestaurantsTable $Restaurants
 */
class RestaurantsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->config('authError', ':(');
        $this->Auth->allow(['index','view', 'edit', 'add']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Associations']
        ];
        $restaurants = $this->paginate($this->Restaurants);

        $this->set(compact('restaurants'));
        $this->set('_serialize', ['restaurants']);
    }

    /**
     * View method
     *
     * @param string|null $id Restaurant id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $restaurant = $this->Restaurants->get($id, [
            'contain' => ['Associations', 'Categories', 'Menus']
        ]);

        $this->set('restaurant', $restaurant);
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$sedes = $this->loadModel('Headquarters')->find('list');
        //$sedes = $this->loadModel('Headquarters')->query("select * from restaurants;");
        $sedes = TableRegistry::get('Headquarters')->find();
        $restaurant = $this->Restaurants->newEntity();
        if ($this->request->is('post')) {
            
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->data);
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));
               // return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The restaurant could not be saved. Please, try again.'));
            }
            
            debug($this->request->data);
        }
        $associations = $this->Restaurants->Associations->find('list', ['limit' => 200]);
        $this->set(compact('restaurant', 'associations', 'sedes'));
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Restaurant id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sedes = TableRegistry::get('Headquarters')->find();
        $restaurant = $this->Restaurants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->data);
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The restaurant could not be saved. Please, try again.'));
            }
        }
        $associations = $this->Restaurants->Associations->find('list');
        $this->set(compact('restaurant', 'associations', 'sedes'));
        $this->set('_serialize', ['restaurant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Restaurant id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurant = $this->Restaurants->get($id);
        if ($this->Restaurants->delete($restaurant)) {
            $this->Flash->success(__('The restaurant has been deleted.'));
        } else {
            $this->Flash->error(__('The restaurant could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
