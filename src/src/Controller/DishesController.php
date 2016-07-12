<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Dishes Controller
 *
 * @property \App\Model\Table\DishesTable $Dishes
 */
class DishesController extends AppController
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

        $dishes = $this->paginate($this->Dishes);

        $this->set(compact('dishes'));
        $this->set('_serialize', ['dishes']);
    }

    /**
     * View method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $condition = $this->getRestaurantId('Restaurants.id');

        try
        {
            $dish = $this->Dishes->get($id, [
                'contain' => ['Restaurants'=> function($query) use ($condition){
                    return $query->where([$condition]);
                }
                ]
            ]);
        }
        catch (RecordNotFoundException $e)
        {
            $this->Flash->error(__('La información que desea ver no se encuentra en la base de datos. Verifique e intente de nuevo.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('dish', $dish);
        $this->set('_serialize', ['dish']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dish = $this->Dishes->newEntity();
        if ($this->request->is('post')) {

            if($this->request->session()->read('Auth.User.role') === 'manager')
            {
                $restaurant_id = $this->Dishes->getRestaurantId($this->request->session()->read('Auth.User.association_id'));
                $restaurant_id = ((is_null($restaurant_id))? null : $restaurant_id[0]['id']);
                $this->request->data['restaurant_id'] = $restaurant_id;
            }

            $dish = $this->Dishes->patchEntity($dish, $this->request->data);
            if ($this->Dishes->save($dish)) {
                $this->Flash->success(__('El platillo ha sido agregado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El platillo no pudo ser agregado. Por favor, inténtelo de nuevo.'));
            }
        }


        $restaurants = $this->Dishes->Restaurants->find()
            ->select(['id','name']);

        $temp = array();

        foreach ($restaurants as $key => $value)
        {
            $temp[$value->id] = $value->name;
        }

        $restaurants = $temp;

        $this->set(compact('dish','restaurants'));
        $this->set('_serialize', ['dish']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $condition = $this->getRestaurantId('Restaurants.id');

        try
        {
            $dish = $this->Dishes->get($id, [
                'contain' => ['Restaurants'=> function($query) use ($condition){
                    return $query->where([$condition]);
                }
                ]
            ]);
        }
        catch (RecordNotFoundException $e)
        {
            $this->Flash->error(__('La información que desea editar no se encuentra en la base de datos. Verifique e intente de nuevo.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $dish = $this->Dishes->patchEntity($dish, $this->request->data);
            if ($this->Dishes->save($dish)) {
                $this->Flash->success(__('El platillo ha sido editado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El platillo no pudo ser editado. Por favor, inténtelo de nuevo.'));
            }
        }
        $this->set(compact('dish'));
        $this->set('_serialize', ['dish']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $condition = $this->getRestaurantId('Restaurants.id');

        try
        {
            $dish = $this->Dishes->get($id, [
                'contain' => ['Restaurants'=> function($query) use ($condition){
                    return $query->where([$condition]);
                }
                ]
            ]);


            try
            {
                if ($this->Dishes->delete($dish)) {
                    $this->Flash->success(__('El platillo ha sido eliminado.'));
                } else {
                    $this->Flash->error(__('El platillo no pudo ser eliminado. Por favor, inténtelo de nuevo.'));
                }
            }
            catch (\PDOException $e)
            {
                $this->Flash->error(__('No se pudo borrar el platillo. Debe primero borrar información asociada a este platillo como tipos de menú o tipos de platillo.'));
            }

        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que desea borrar no se encuentra en la base de datos. Verifique e intente de nuevo.'));
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
