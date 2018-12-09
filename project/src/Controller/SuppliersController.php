<?php
namespace App\Controller;

class SuppliersController extends AppController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent("Flash");
		$this->viewBuilder()->setLayout('window');
	}

	public function list() {
		$this->set("suppliers", $this->Suppliers->getCountInfo());
		$this->set("blankSupplier", $this->Suppliers->newEntity());
	}

	public function new() {
		$newSupplier = $this->Suppliers->newEntity();
		if ($this->request->is("post")) {
			$newSupplier = $this->Suppliers->patchEntity($newSupplier, $this->request->getData());
			if ($this->Suppliers->save($newSupplier)) {
				$this->Flash->success(__("Supplier" . $newSupplier->name . "successfully created."));
				return $this->redirect(["action" => "list"]);
			}
			$this->Flash->error(__("An error occured when attempting to create supplier " . $newSupplier->name));
		}
		$this->set(compact("newSupplier", $newSupplier));
	}

	public function edit($id) {
		$supplier = $this->Suppliers->get($id);
		if ($this->request->is(["post", "put"])) {
			$this->Suppliers->patchEntity($supplier, $this->request->getData());
			if ($this->Suppliers->save($supplier)) {
				$this->Flash->success(__("Supplier was successfully updated."));
				return $this->redirect(["action" => "list"]);
			}
			$this->Flash->error(__("Failed to update supplier."));
		}
		$this->set(compact("supplier"));
	}

	public function delete($id) {
		$this->request->allowMethod(["post", "delete"]);
		$supplier = $this->Suppliers->get($id);
		if ($this->Suppliers->delete($supplier)) {
			$this->Flash->success(__("Supplier " . $supplier->name . " successfully deleted."));
			return $this->redirect(["action" => "list"]);
		}
		$this->Flash->error(__("The supplier could not be deleted (This shouldn't have happened!)."));
		return $this->redirect(["action" => "list"]);
	}

    public function isAuthorized($user) {
	    return true;
    }
}
?>
