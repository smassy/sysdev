<?php
namespace App\Controller;

class UnitsController extends AppController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent("Flash");
		$this->viewBuilder()->setLayout('window');
	}

	public function list() {
		$this->set("units", $this->Units->getCountInfo());
		$this->set("blankUnit", $this->Units->newEntity());
	}

	public function new() {
		$newUnit = $this->Units->newEntity();
		if ($this->request->is("post")) {
			$newUnit = $this->Units->patchEntity($newUnit, $this->request->getData());
			if ($this->Units->save($newUnit)) {
				$this->Flash->success(__("Unit" . $newUnit->name . "successfully created."));
				return $this->redirect(["action" => "list"]);
			}
			$this->Flash->error(__("An error occured when attempting to create unit " . $newUnit->name));
		}
		$this->set(compact("newUnit", $newUnit));
	}

	public function edit($id) {
		$unit = $this->Units->get($id);
		if ($this->request->is(["post", "put"])) {
			$this->Units->patchEntity($unit, $this->request->getData());
			if ($this->Units->save($unit)) {
				$this->Flash->success(__("Unit was successfully updated."));
				return $this->redirect(["action" => "list"]);
			}
			$this->Flash->error(__("Failed to update unit."));
		}
		$this->set(compact("unit"));
	}

	public function delete($id) {
		$this->request->allowMethod(["post", "delete"]);
		$unit = $this->Units->get($id);
		if ($this->Units->delete($unit)) {
			$this->Flash->success(__("Unit " . $unit->name . " successfully deleted."));
			return $this->redirect(["action" => "list"]);
		}
		$this->Flash->error(__("The unit could not be deleted (This shouldn't have happened!)."));
		return $this->redirect(["action" => "list"]);
	}
}
?>
