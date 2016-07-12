<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;


/**
 * Menus Controller
 *
 * @property \App\Model\Table\MenusTable $Menus
 */
class MenusController extends AppController
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
        $menus = $this->paginate($this->Menus);

        $this->set(compact('menus'));
        $this->set('_serialize', ['menus']);
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
       $condition = $this->getRestaurantId('Restaurants.id');


        try
        {
            $menu = $this->Menus->get($id, [
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



        $this->set('menu', $menu);
        $this->set('_serialize', ['menu']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menu = $this->Menus->newEntity();
        if ($this->request->is('post')) {
            
            if($this->request->session()->read('Auth.User.role') === 'manager')
            {
                $restaurant_id = $this->Menus->getRestaurantId($this->request->session()->read('Auth.User.association_id'));
                $restaurant_id = ((is_null($restaurant_id))? null : $restaurant_id[0]['id']);
                $this->request->data['restaurant_id'] = $restaurant_id;
            }
            
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
                
                if ($this->Menus->save($menu)) {
                    $this->Flash->success(__('El menú ha sido agregado.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('El menu no pudo ser agregado. Por favor, inténtelo de nuevo.'));
                }

        }
        
        
        $restaurants = $this->Menus->Restaurants->find()
                                    ->select(['id','name']);
        
        $temp = array();
        
        foreach ($restaurants as $key => $value)
        {
            $temp[$value->id] = $value->name;
        }

        $restaurants = $temp;
        
        $this->set(compact('menu', 'restaurants'));
        $this->set('_serialize', ['menu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $condition = $this->getRestaurantId('Restaurants.id');

        try
        {
            $menu = $this->Menus->get($id, [
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
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('El menú ha sido editado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El menu no pudo ser editado. Por favor, inténtelo de nuevo.'));
            }
        }
        
        $restaurants = $this->Menus->Restaurants->find()
                                    ->select(['id','name']);
        
        $temp = array();
        
        foreach ($restaurants as $key => $value)
        {
            $temp[$value->id] = $value->name;
        }

        $restaurants = $temp;
        
        
        $this->set(compact('menu', 'restaurants'));
        $this->set('_serialize', ['menu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $condition = $this->getRestaurantId('Restaurants.id');

        try
        {
            $menu = $this->Menus->get($id, [
                'contain' => ['Restaurants'=> function($query) use ($condition){
                    return $query->where([$condition]);
                }
                ]
            ]);

            try
            {
                if ($this->Menus->delete($menu)) {
                    $this->Flash->success(__('El menú ha sido eliminado.'));
                } else {
                    $this->Flash->error(__('El menu no pudo ser eliminado. Por favor, inténtelo de nuevo.'));
                }
            }
            catch (\PDOException $e)
            {
                $this->Flash->error(__('No se pudo borrar el tipo de menú. Debe borrar antes la información asociada a este tipo de menú, como platillos o tipos de platillos.'));
            }

        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que desea borrar no se encuentra en la base de datos. Verifique e intente de nuevo.'));
            return $this->redirect(['action' => 'index']);
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
