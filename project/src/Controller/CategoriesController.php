<?php
namespace App\Controller;

class CategoriesController extends AppController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent("Flash");
	}

	public function list() {
		$this->set("categories", $this->Categories->getCountInfo());
		$this->set("blankCategory", $this->Categories->newEntity());
	}

	public function new() {
		$newCategory = $this->Categories->newEntity();
		if ($this->request->is("post")) {
			$newCategory = $this->Categories->patchEntity($newCategory, $this->request->getData());
			if ($this->Categories->save($newCategory)) {
				$this->Flash->success(__($newCategory->name . " Category successfully created."));
				return $this->redirect(["action" => "list"]);
			}
			$this->Flash->error(__("An error occured when attempting to create category " . $newCategory->name));
		}
		$this->set(compact("newCategory", $newCategory));
	}
}
?>
