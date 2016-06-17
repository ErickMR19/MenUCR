<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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
            'contain' => ['Menus', 'Dishes', 'Categories']
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
        $menusDishesCategory = $this->MenusDishesCategories->get($id, [
            'contain' => ['Menus', 'Dishes', 'Categories']
        ]);

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
            if ($this->MenusDishesCategories->save($menusDishesCategory)) {
                $this->Flash->success(__('The menus dishes category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The menus dishes category could not be saved. Please, try again.'));
            }
        }
        $menus = $this->MenusDishesCategories->Menus->find('list', ['limit' => 200]);
        $dishes = $this->MenusDishesCategories->Dishes->find('list', ['limit' => 200]);
        $categories = $this->MenusDishesCategories->Categories->find('list', ['limit' => 200]);
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
        $menusDishesCategory = $this->MenusDishesCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menusDishesCategory = $this->MenusDishesCategories->patchEntity($menusDishesCategory, $this->request->data);
            if ($this->MenusDishesCategories->save($menusDishesCategory)) {
                $this->Flash->success(__('The menus dishes category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The menus dishes category could not be saved. Please, try again.'));
            }
        }
        $menus = $this->MenusDishesCategories->Menus->find('list', ['limit' => 200]);
        $dishes = $this->MenusDishesCategories->Dishes->find('list', ['limit' => 200]);
        $categories = $this->MenusDishesCategories->Categories->find('list', ['limit' => 200]);
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
        $menusDishesCategory = $this->MenusDishesCategories->get($id);
        if ($this->MenusDishesCategories->delete($menusDishesCategory)) {
            $this->Flash->success(__('The menus dishes category has been deleted.'));
        } else {
            $this->Flash->error(__('The menus dishes category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
