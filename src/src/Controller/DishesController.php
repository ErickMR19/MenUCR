<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dishes Controller
 *
 * @property \App\Model\Table\DishesTable $Dishes
 */
class DishesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
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
        $dish = $this->Dishes->get($id, [
            'contain' => []
        ]);

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
            $dish = $this->Dishes->patchEntity($dish, $this->request->data);
            if ($this->Dishes->save($dish)) {
                $this->Flash->success(__('The dish has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dish could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dish'));
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
        $dish = $this->Dishes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dish = $this->Dishes->patchEntity($dish, $this->request->data);
            if ($this->Dishes->save($dish)) {
                $this->Flash->success(__('The dish has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dish could not be saved. Please, try again.'));
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
        $dish = $this->Dishes->get($id);
        if ($this->Dishes->delete($dish)) {
            $this->Flash->success(__('The dish has been deleted.'));
        } else {
            $this->Flash->error(__('The dish could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
