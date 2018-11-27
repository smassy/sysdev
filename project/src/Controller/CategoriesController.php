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

	public function edit($id) {
		$category = $this->Categories->get($id);
		if ($this->request->is(["post", "put"])) {
			$this->Categories->patchEntity($category, $this->request->getData());
			if ($this->Categories->save($category)) {
				$this->Flash->success(__("Category was successfully updated."));
				return $this->redirect(["action" => "list"]);
			}
			$this->Flash->error(__("Failed to update category."));
		}
		$this->set(compact("category"));
	}
}
?>
