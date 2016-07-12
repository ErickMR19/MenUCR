<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout','add']);
    }
    
    public function login()
    {
        if($this->Auth->user()) return $this->redirect($this->Auth->redirectUrl());
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Usuario o contraseña inválida, inténtelo de nuevo'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
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
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Associations']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Change Password Method
     *
     *
     *
     */
    public function changePassword()
    {
        $user =$this->Users->get($this->Auth->user('id'));
        if (!empty($this->request->data)) {
            $user = $this->Users->patchEntity($user, [
                    'old_password'  => $this->request->data['old_password'],
                    'password'      => $this->request->data['password'],
                    'passwordr'     => $this->request->data['passwordr']
                ],
                ['validate' => 'changePassword']
            );
            if ($this->Users->save($user)) {
                $this->Flash->success('La contraseña fue cambiada correctamente.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('No se pudo cambiar la contraseña!');
            }
        }
        $this->set('user',$user);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido agregado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El usuario no pudo ser agregado. Por favor, inténtelo de nuevo.'));
            }
        }
        $associations = $this->Users->Associations->find('list');
        $this->set(compact('user', 'associations'));
        $this->set('roles', ['admin'=>'Administrador del Sistema', 'manager'=>'Encargado de Soda']);
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $isAdmin = $this->Auth->user('role') === 'admin';
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido editado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El usuario no pudo ser editado. Por favor, inténtelo de nuevo.'));
                Log::debug($this->validationErrors);
            }
        }
        $associations = $this->Users->Associations->find('list');
        $this->set(compact('user', 'associations'));
        $this->set('roles', ['admin'=>'Administrador del Sistema', 'manager'=>'Encargado de Soda']);
        $this->set('isAdmin', $isAdmin);
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El usuario no pudo ser eliminado. Por favor, inténtelo de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {
        Log::debug('isAuthorized');
        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit'])) {
            $userId = (int)$this->request->params['pass'][0];
            if ($userId === $user['id']) {
                return true;
            }
        }
        Log::debug('will use parents');
        return parent::isAuthorized($user);
    }
}
