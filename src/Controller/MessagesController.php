<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{

    

  
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

            if($this->request->is('get') && !$this->request->getSession()->read('Session')){
               
                $this->redirect('/users/add');

            }

            
            $this->paginate = [
                'contain' => ['Users'],
            ];
            
            $messages = $this->paginate($this->Messages, ['limit'=> '5']);
            $this->set(compact('messages'));
            
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => ['Users'],
        ]);
        
        
        $allComments = $this->Messages->getCommentsForMessage($id);
       
       if ($this->request->is('post')) {
            $commentContent = $this->request->getData('commentContent');
            //debug($this->request);
           $message = $this->Messages->addNewComment($id, $commentContent,  $this->request->getSession()->read('Session')['name']);
           $this->redirect('/messages/view/'.$id);
       }

        $this->set(compact('message'));
        $this->set(compact('allComments'));
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$message = $this->Messages->newEmptyEntity();
        if ($this->request->is('post')) {
            $title = $this->request->getData()['title'];
            $content = $this->request->getData()['content'];
            $preview = $this->request->getData()['preview'];

            $user_id = $this->Messages->getUserId( $this->request->getSession()->read('Session')['name'] );
            
            $message = $this->Messages->newEmptyEntity();
            $this->Messages->patchEntity($message, [
            'title' => $title,
                'content' => $content,
                'preview' => $preview,
                'author_id' => $user_id
        ]);
        $this->Messages->save($message);
        $this->redirect('/');
        }
      


    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $users = $this->Messages->Users->find('list', ['limit' => 200]);
        $this->set(compact('message', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
