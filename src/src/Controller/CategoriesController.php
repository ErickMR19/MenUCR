<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
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

        $condition = $this->getRestaurantId('Restaurants.id');

        $this->paginate = [
            'contain' => ['Restaurants'=> function($query) use ($condition){
                return $query->where([$condition]);
            }
            ]
        ];
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $condition = $this->getRestaurantId('Restaurants.id');

        try
        {
            $category = $this->Categories->get($id, [
                'contain' => ['Restaurants'=> function($query) use ($condition){
                    return $query->where([$condition]);
                }
                ]
            ]);
        }
        catch (RecordNotFoundException $e)
        {
            return $this->redirect(['action' => 'index']);
        }

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {

            if($this->request->session()->read('Auth.User.role') === 'manager')
            {
                $restaurant_id = $this->Categories->getRestaurantId($this->request->session()->read('Auth.User.association_id'));
                $restaurant_id = ((is_null($restaurant_id))? null : $restaurant_id[0]['id']);
                $this->request->data['restaurant_id'] = $restaurant_id;
            }

            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }

        $restaurants = $this->Categories->Restaurants->find()
                                    ->select(['id','name']);
        
        $temp = array();
        
        foreach ($restaurants as $key => $value)
        {
            $temp[$value->id] = $value->name;
        }

        $restaurants = $temp;
        
        
        
        $this->set(compact('category', 'restaurants'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $condition = $this->getRestaurantId('Restaurants.id');

        try
        {
            $category = $this->Categories->get($id, [
                'contain' => ['Restaurants'=> function($query) use ($condition){
                    return $query->where([$condition]);
                }
                ]
            ]);
        }
        catch (RecordNotFoundException $e)
        {
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        
        $restaurants = $this->Categories->Restaurants->find()
                                    ->select(['id','name']);
        
        $temp = array();
        
        foreach ($restaurants as $key => $value)
        {
            $temp[$value->id] = $value->name;
        }

        $restaurants = $temp;
        $this->set(compact('category', 'restaurants'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $condition = $this->getRestaurantId('Restaurants.id');

        try
        {
            $category = $this->Categories->get($id, [
                'contain' => ['Restaurants'=> function($query) use ($condition){
                    return $query->where([$condition]);
                }
                ]
            ]);
        }
        catch (RecordNotFoundException $e)
        {
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    private function getRestaurantId($key)
    {
        $restaurant_id = 1;

        if($this->request->session()->read('Auth.User.role') === 'manager') {

            $association_id = $this->request->session()->read('Auth.User.association_id');


            $this->loadModel('Restaurants');
            $restaurant_id = $this->Restaurants->find()
                ->select(['id'])
                ->where(['association_id' => $association_id]);

            $restaurant_id = $restaurant_id->toArray();

            $restaurant_id = ((is_null($restaurant_id)) ? null : $restaurant_id[0]['id']);
        }
        else
        {
            $key = $restaurant_id." = ";
        }

        $condition[$key] = $restaurant_id;

        return $condition;
    }

    public function isAuthorized($user)
    {
        return true;

        return parent::isAuthorized($user);
    }

}
