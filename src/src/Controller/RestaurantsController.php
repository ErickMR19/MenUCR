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
        $sedes = TableRegistry::get('Headquarters')->find();
        $restaurant = $this->Restaurants->newEntity();
        if ($this->request->is('post')) {
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->data);
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));
                //Guardar imagen
                if (!empty($this->request->data['imagen_seleccionada']["name"])) {
                    $file = $this->request->data['imagen_seleccionada']; 
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //obtenemos la extension para ver si es un imagen
                    $arr_ext = array('jpg', 'jpeg', 'gif'); //extensiones validas
                    //El siguiente código actualiza el row recién agregado a la bd, poniéndo un nombre para el campo "image_name"
                    $ultimo = $this->Restaurants->find('all')->last();
                    $sodas_upadate = TableRegistry::get('Restaurants');
                    $sodas_select = $sodas_upadate->get($ultimo->id); 
                    //El nombre de las imagenes es [id_soda]+[nombre_soda]+[nombre_imagen]
                    $setNewFileName = $sodas_select['id'] . "_" . $this->request->data['name'] . "_" . $this->request->data['imagen_seleccionada']["name"];
                    $sodas_select->image_name = $setNewFileName;
                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //Colocamos la imagen en el folder adecuado
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/restaurants_pictures/' . $setNewFileName);
                        $sodas_upadate->save($sodas_select);
                    }
                }
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
            //debug($this->request->data);
            //Salvo el nombre de la imagen anterior
            $nombre_imagen_anterior = $this->request->data['image_name'];
            debug($nombre_imagen_anterior);
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('The restaurant has been saved.'));
                //Edicion de imagen
                if (!empty($this->request->data['imagen_seleccionada']["name"])) {
                    $file = $this->request->data['imagen_seleccionada']; 
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //obtenemos la extension para ver si es un imagen
                    $arr_ext = array('jpg', 'jpeg', 'gif'); //extensiones validas
                    //El nombre de las imagenes es [id_soda]+[nombre_soda]+[nombre_imagen]
                    $setNewFileName = $this->request->data['id'] . "_" . $this->request->data['name'] . "_" . $this->request->data['imagen_seleccionada']["name"];
                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //Borramos la imagen anterior pues ya no se utilizará
                        if (file_exists(WWW_ROOT . 'img/restaurants_pictures/' . $nombre_imagen_anterior)) {
                            unlink(WWW_ROOT . 'img/restaurants_pictures/' . $nombre_imagen_anterior);
                        }
                        //Colocamos la imagen en el folder adecuado
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/restaurants_pictures/' . $setNewFileName);
                        //El siguiente código actualiza el row recién agregado a la bd, poniéndo un nombre para el campo "image_name"
                        $sodas_upadate = TableRegistry::get('Restaurants');
                        $sodas_select = $sodas_upadate->get($this->request->data['id']); 
                        $sodas_select->image_name = $setNewFileName;
                        $sodas_upadate->save($sodas_select);
                        }
                }
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
        $nombre_imagen_anterior = $restaurant->image_name;
        if ($this->Restaurants->delete($restaurant)) {
            $this->Flash->success(__('The restaurant has been deleted.'));
            //Se borra la imagen del folder de imagenes-restaurantes
             if (file_exists(WWW_ROOT . 'img/restaurants_pictures/' . $nombre_imagen_anterior)) {
                 unlink(WWW_ROOT . 'img/restaurants_pictures/' . $nombre_imagen_anterior);
             }
        } else {
            $this->Flash->error(__('The restaurant could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
