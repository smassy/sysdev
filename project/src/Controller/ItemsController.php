<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{

	public $uses = array("Items", "Categories");
    /**
     * list method
     *
     * @return \Cake\Http\Response|void
     */
    public function list()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Suppliers', 'Units']
        ];
        $items = $this->paginate($this->Items);

        $this->set(compact('items'));
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['Categories', 'Suppliers', 'Units']
        ]);

        $this->set('item', $item);
    }

    /**
     * new method
     *
     * @return \Cake\Http\Response|null Redirects on successful new, renders view otherwise.
     */
    public function new()
    {
        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'list']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
	$this->loadModel("Categories");
	$this->loadModel("Suppliers");
	$this->loadModel("Units");
        $categories = $this->Categories->find('all', ["order" => "name"]);
        $suppliers = $this->Suppliers->find("all", ["order" => "name"]);
        $units = $this->Units->find("all", ["order" => "name"]);
        $this->set(compact('item', 'categories', 'suppliers', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'list']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
	$this->loadModel("Categories");
	$this->loadModel("Suppliers");
	$this->loadModel("Units");
        $categories = $this->Categories->find('all', ["order" => "name"]);
        $suppliers = $this->Suppliers->find("all", ["order" => "name"]);
        $units = $this->Units->find("all", ["order" => "name"]);
        $this->set(compact('item', 'categories', 'suppliers', 'units'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to list.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'list']);
    }
}
