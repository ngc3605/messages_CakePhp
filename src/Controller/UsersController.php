<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
        
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {



        $user = $this->Users->newEmptyEntity();
        
            if ($this->request->is('post')) {
              
               $this->request->getSession()->write('Session', $this->request->getData());
               $sessionName = $this->request->getSession()->read('Session')['name'];
               $userName = $this->Users->find('all', [
                'conditions' => ['users.name' => $sessionName]
               ]);
               
               $checkName = '';

               foreach ($userName as $value) {
                    $checkName = $value->name;
                }
                    if($checkName){
                       $this->redirect('/');
                        
                    } else {
                        
                        $user = $this->Users->patchEntity($user, $this->request->getData());
                        if ($this->Users->save($user)) {
                        $this->Flash->success(__('Пользователь сохранен'));

                        $this->redirect('/');
                }
                $this->set(compact('user'));
            }
                
               
               //debug($userName);
           //      try {
           //          $user = $this->Users->patchEntity($user, $this->request->getData());
           //      if ($this->Users->save($user)) {
           //          $this->Flash->success(__('Пользователь сохранен'));

           //          return $this->redirect(['action' => 'index']);
           //      }
                
           // } catch(Error $e){
           //      echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
           // }
            
        }

        

        
        $this->set(compact('user'));
    }

    public function logout(){
        $this->request->getSession()->destroy();
        $this->redirect('/');

    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function checkUser(){
        
    }
}
