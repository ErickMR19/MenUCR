<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Console\Exception;
use Cake\Datasource\Exception\RecordNotFoundException;

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
        try
        {
            $headquarters = $this->Headquarters->get($id, [
                'contain' => []
            ]);
        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que intenta ver no existe en la base de datos. Verifique e intente de nuevo.'));
            return $this->redirect(['action' => 'index']);
        }


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
                $this->Flash->success(__('La sede ha sido agregada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La sede no pudo ser agregada. Por favor, inténtelo de nuevo.'));
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
        try
        {
            $headquarters = $this->Headquarters->get($id, [
                'contain' => []
            ]);
        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que intenta editar no existe en la base de datos. Verifique e intente de nuevo.'));
            return $this->redirect(['action' => 'index']);
        }


        if ($this->request->is(['patch', 'post', 'put'])) {
            $headquarters = $this->Headquarters->patchEntity($headquarters, $this->request->data);
            if ($this->Headquarters->save($headquarters)) {
                $this->Flash->success(__('La sede ha sido editada.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La sede no pudo ser editada. Por favor, inténtelo de nuevo.'));
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

        try{
            $headquarters = $this->Headquarters->get($id);

            try{
                if ($this->Headquarters->delete($headquarters)) {
                    $this->Flash->success(__('La sede ha sido eliminada.'));
                } else {
                    $this->Flash->error(__('La sede no pudo ser eliminada. Por favor, inténtelo de nuevo.'));
                }
            }
            catch (\PDOException $e)
            {
                $this->Flash->error(__('La sede no pudo ser eliminada. Debe primero borrar información asociada a esta sede, como por ejemplo asociaciones.'));
            }
        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que intenta borrar no existe en la base de datos. Verifique e intente de nuevo.'));
        }




        return $this->redirect(['action' => 'index']);
    }
}
