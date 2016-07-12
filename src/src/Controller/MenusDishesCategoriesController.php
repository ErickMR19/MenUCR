<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * MenusDishesCategories Controller
 *
 * @property \App\Model\Table\MenusDishesCategoriesTable $MenusDishesCategories
 */
class MenusDishesCategoriesController extends AppController
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

        $condition = $this->getRestaurantId('Menus.restaurant_id');

        $this->paginate = [
            'contain' => ['Dishes', 'Categories',
                'Menus' => function($query) use ($condition){
                    return $query->where([$condition]);
                }
            ]
        ];
        $menusDishesCategories = $this->paginate($this->MenusDishesCategories);

        $this->set(compact('menusDishesCategories'));
        $this->set('_serialize', ['menusDishesCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Menus Dishes Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $condition = $this->getRestaurantId('Categories.restaurant_id');


        try
        {
            $menusDishesCategory = $this->MenusDishesCategories->get($id, [
                'contain' => ['Menus', 'Dishes', 'Categories'=>function($query) use ($condition){
                return $query->where([$condition]);
                }]
            ]);

        }
        catch (RecordNotFoundException $e)
        {
            return $this->redirect(['action' => 'index']);
        }




        $this->set('menusDishesCategory', $menusDishesCategory);
        $this->set('_serialize', ['menusDishesCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menusDishesCategory = $this->MenusDishesCategories->newEntity();
        if ($this->request->is('post')) {


            $menusDishesCategory = $this->MenusDishesCategories->patchEntity($menusDishesCategory, $this->request->data);
            if ($this->verifyRestaurant($this->request->data) && $this->MenusDishesCategories->save($menusDishesCategory)) {
                $this->Flash->success(__('La categoría ha sido agregada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La categoría no pudo ser agregada. Por favor, inténtelo de nuevo.'));
            }

        }


        $condition = $this->getRestaurantId('restaurant_id');


        $menus = $this->MenusDishesCategories->Menus->find()
                                            ->select(['id','type'])
                                            ->where([$condition]);
        
        $temp = array();

        foreach ($menus as $key => $value)
        {
            $temp[$value->id] = $value->type;
        }

        $menus = $temp;
        
        
        $dishes = $this->MenusDishesCategories->Dishes->find('list')
                        ->where([$condition]);

        $categories = $this->MenusDishesCategories->Categories->find('list')
                                ->where([$condition]);

        $this->set(compact('menusDishesCategory', 'menus', 'dishes', 'categories'));
        $this->set('_serialize', ['menusDishesCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Menus Dishes Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $condition = $this->getRestaurantId('Categories.restaurant_id');


        try
        {
            $menusDishesCategory = $this->MenusDishesCategories->get($id, [
                'contain' => ['Categories'=>function($query) use ($condition){
                    return $query->where([$condition]);
                }]
            ]);

        }
        catch (RecordNotFoundException $e)
        {
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $menusDishesCategory = $this->MenusDishesCategories->patchEntity($menusDishesCategory, $this->request->data);
            if ($this->verifyRestaurant($this->request->data) && $this->MenusDishesCategories->save($menusDishesCategory)) {
                $this->Flash->success(__('La categoría ha sido editada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La categoría no pudo ser editada. Por favor, inténtelo de nuevo.'));
            }
        }


        $condition = $this->getRestaurantId('restaurant_id');


        $menus = $this->MenusDishesCategories->Menus->find()
            ->select(['id','type'])
            ->where([$condition]);

        $temp = array();

        foreach ($menus as $key => $value)
        {
            $temp[$value->id] = $value->type;
        }

        $menus = $temp;


        $dishes = $this->MenusDishesCategories->Dishes->find('list')
            ->where([$condition]);

        $categories = $this->MenusDishesCategories->Categories->find('list')
            ->where([$condition]);

        $this->set(compact('menusDishesCategory', 'menus', 'dishes', 'categories'));
        $this->set('_serialize', ['menusDishesCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Menus Dishes Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $condition = $this->getRestaurantId('Categories.restaurant_id');


        try
        {
            $menusDishesCategory = $this->MenusDishesCategories->get($id, [
                'contain' => ['Categories'=>function($query) use ($condition){
                    return $query->where([$condition]);
                }]
            ]);

        }
        catch (RecordNotFoundException $e)
        {
            return $this->redirect(['action' => 'index']);
        }

        if ($this->MenusDishesCategories->delete($menusDishesCategory)) {
            $this->Flash->success(__('La categoría ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La categoría no pudo ser eliminada. Por favor, inténtelo de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /*
     * La siguiente función valida que los datos que yo voy a guardar están asociados a una misma soda.
     */

    private function verifyRestaurant($data)
    {
        $query = $this->MenusDishesCategories->Categories->find()
            ->select(['Categories.id'])
            ->hydrate(false)
            ->join([
                'type' => [
                    'table' => 'menus',
                    'type' => 'INNER',
                    'conditions' => 'type.restaurant_id = Categories.restaurant_id',
                ],
                'dishe' => [
                    'table' => 'dishes',
                    'type' => 'INNER',
                    'conditions' => 'dishe.restaurant_id = type.restaurant_id',
                ]
            ])
            ->andWhere(['Categories.id'=>$data['category_id'], 'type.id'=>$data['menu_id'], 'dishe.id'=>$data['dishe_id']]);

        $query = $query->toArray();
        return !empty($query);

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
