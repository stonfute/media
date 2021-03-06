<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Config Controller
 *
 * @property \App\Model\Table\ConfigTable $Config
 */
class ConfigController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('configs', $this->paginate($this->Config));
        $this->set('_serialize', ['config']);
    }

    /**
     * View method
     *
     * @param string|null $id Config id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $config = $this->Config->get($id, [
            'contain' => []
        ]);
        $this->set('config', $config);
        $this->set('_serialize', ['config']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $config = $this->Config->newEntity();
        if ($this->request->is('post')) {
            $config = $this->Config->patchEntity($config, $this->request->data);
            if ($this->Config->save($config)) {
                $this->Flash->success(__('The config has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The config could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('config'));
        $this->set('_serialize', ['config']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Config id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $config = $this->Config->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $config = $this->Config->patchEntity($config, $this->request->data);
            if ($this->Config->save($config)) {
                $this->Flash->success(__('The config has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The config could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('config'));
        $this->set('_serialize', ['config']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Config id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $config = $this->Config->get($id);
        if ($this->Config->delete($config)) {
            $this->Flash->success(__('The config has been deleted.'));
        } else {
            $this->Flash->error(__('The config could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
