<?php
namespace App\Controller;

class CategoriesController extends AppController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent("Flash");
	}

	public function list() {
		$query = $this->Categories->find()->leftJoinWith("Items");
		$query = $query->select(["id" => "Categories.id", "name" => "Categories.name", "count" => $query->func()->count("Items.category_id")])->group("Categories.id");
		$query =  $query->order("Categories.name");
		$this->set("categories", $query);
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
