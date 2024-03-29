<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Validation\Validator;
use Cake\Network\Http\Client;

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
        $this->Auth->allow(['index','view','getMenus','indexByHeadquarter','sendEmail']);
        $this->response->header('Access-Control-Allow-Origin','*');
        $this->response->header('Access-Control-Allow-Methods','*');
        $this->response->header('Access-Control-Allow-Headers','X-Requested-With');
        $this->response->header('Access-Control-Allow-Headers','Content-Type, x-xsrf-token');
        $this->response->header('Access-Control-Max-Age','172800');
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
     * IndexByHeadquaters method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexByHeadquarter($id = null)
    {
        $restaurants = $this->Restaurants->find('all', ['contain' => ['Associations']])->where(['Associations.headquarter_id =' => $id]);
        foreach ($restaurants as $restaurant){
            if( $restaurant['image_name'] != "" )
            {
                $rutaImagen = "/img/restaurants_pictures/{$restaurant['image_name']}";
                $restaurant['image_name'] = Router::url($rutaImagen, true);
            }
        }
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
        try
        {
            $restaurant = $this->Restaurants->get($id, [
                'contain' => ['Associations', 'Categories', 'Menus']
            ]);
        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que está tratando de ver no existe en la base de datos. Verifique e intente de nuevo.'));
            return $this->redirect(['action' => 'index']);
        }



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
                $this->Flash->success(__('La soda ha sido agregada.'));
                //Guardar imagen
                
                if (!empty($this->request->data['imagen_seleccionada']["name"])) {
                    $file = $this->request->data['imagen_seleccionada']; 
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //obtenemos la extension para ver si es un imagen
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //extensiones validas
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
                $this->Flash->error(__('La soda no pudo ser agregada. Por favor, inténtelo de nuevo.'));
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

        try
        {
            $restaurant = $this->Restaurants->get($id, [
                'contain' => []
            ]);
        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que está tratando de editar no existe en la base de datos. Verifique e intente de nuevo.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $restaurant = $this->Restaurants->patchEntity($restaurant, $this->request->data);
            //debug($this->request->data);
            //Salvo el nombre de la imagen anterior
            $nombre_imagen_anterior = $this->request->data['image_name'];
            if ($this->Restaurants->save($restaurant)) {
                $this->Flash->success(__('La soda ha sido editada.'));
                //Edicion de imagen
                if (!empty($this->request->data['imagen_seleccionada']["name"])) {
                    $file = $this->request->data['imagen_seleccionada']; 
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //obtenemos la extension para ver si es un imagen
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //extensiones validas
                    //El nombre de las imagenes es [id_soda]+[nombre_soda]+[nombre_imagen]
                    $setNewFileName = $this->request->data['id'] . "_" . $this->request->data['name'] . "_" . $this->request->data['imagen_seleccionada']["name"];
                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //Borramos la imagen anterior pues ya no se utilizará
                        if ( (file_exists(WWW_ROOT . 'img/restaurants_pictures/' . $nombre_imagen_anterior)) && (strlen($nombre_imagen_anterior) > 0)) {
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
                $this->Flash->error(__('La soda no pudo ser editada. Por favor, inténtelo de nuevo.'));
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

        try
        {
            $restaurant = $this->Restaurants->get($id);

            try
            {
                $nombre_imagen_anterior = $restaurant->image_name;
                if ($this->Restaurants->delete($restaurant)) {
                    $this->Flash->success(__('La soda ha sido eliminada.'));
                    //Se borra la imagen del folder de imagenes-restaurantes
                    if (file_exists(WWW_ROOT . 'img/restaurants_pictures/' . $nombre_imagen_anterior)) {
                        unlink(WWW_ROOT . 'img/restaurants_pictures/' . $nombre_imagen_anterior);
                    }
                } else {
                    $this->Flash->error(__('La soda no pudo ser eliminada. Por favor, inténtelo de nuevo.'));
                }
            }
            catch (\PDOException $e)
            {
                $this->Flash->error(__('No se pudo eliminar la soda. Debe borrar primero información como tipos de menú, tipos de platillo o platillos.'));
            }
        }
        catch (RecordNotFoundException $record)
        {
            $this->Flash->error(__('La información que está tratando de borrar no existe en la base de datos. Verifique e intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getMenus($id = null)
    {
        if($id)
        {
            $data = $this->Restaurants->Categories->find()
                ->select(['name', 'type.type','dishe.name', 'price','type.schedule','dishe.description'])
                ->hydrate(false)
                ->join([
                    'type' => [
                        'table' => 'menus',
                        'type' => 'INNER',
                        'conditions' => 'type.restaurant_id = Categories.restaurant_id',
                    ],
                    'menu' => [
                        'table' => 'menus_dishes_categories',
                        'type' => 'INNER',
                        'conditions' => 'menu.menu_id = type.id AND menu.category_id = Categories.id',
                    ],
                    'dishe' => [
                        'table' => 'dishes',
                        'type' => 'INNER',
                        'conditions' => 'dishe.id = menu.dishe_id',
                    ]
                ])
                ->andWhere(['Categories.restaurant_id'=>$id, 'menu.date'=> "".date("Y-m-d").""])
                ->order('Categories.name');



            $this->set('menus', $data);
            $this->set('_serialize', ['menus']);
        }
    }


    /**
     * SendEmail method
     *
     * Valida los datos de envío de un email, y si no hay errores lo envía
     */
    public function sendEmail($id)
    {   
        if ($this->request->is('post')) {
            $restaurant = $this->Restaurants->get($id);             
            if(! $restaurant)  {
                $errors = ['IndicadorSoda' => 'La soda indicada  no existe'];
            }
            else
            {
                $validator = new Validator();
                $validator
                    ->requirePresence('email')
                    ->add('email', 'validFormat', [
                        'rule' => 'email',
                        'message' => 'La direccion email debe ser válida.'
                    ])
                    ->requirePresence('name')
                    ->notEmpty('name', 'El nombre es requerido.')
                    ->requirePresence('body')
                    ->notEmpty('comment', 'Necesita escribir un mensaje.')
                    ->requirePresence('recaptchaResponse')
                    ->notEmpty('recaptchaResponse', 'Realizar el CAPTCHA es requerido.');
                $errors = $validator->errors($this->request->data());
            }
            
            if( empty($errors) )
            {
                $datos = $this->request->data;
                $http = new Client();
                $response = $http->post('https://www.google.com/recaptcha/api/siteverify', [
                  'secret' => '6LfI5yQTAAAAAJVOe5YFdkEK_fRgVdJTjJ24alaA',
                  'response' => $datos['recaptchaResponse']
                ]);
                if($response->json['success'])
                {
                    $email = new Email('default');
                    $email->from([$datos['email'] => $datos['name']])
                        ->to([$restaurant['email'] => $restaurant['name']])
                        ->replyTo([$datos['email'] => $datos['name']])
                        ->subject('Mensaje recibido mediante MenUCR')
                        ->send($datos['body']);
                    $errors['Exito'] = 1;
                }
                else {                    
                    $errors['captcha'] = 'Error en el captcha';
                }
            }
            else {
                $errors['Exito'] = 0;
            }
            $this->set('respuesta', $errors);
            $this->set('_serialize', ['respuesta']);
            
        }
    }

}
