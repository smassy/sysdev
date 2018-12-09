<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventListenerInterface;

/**
 * Categories Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\HasMany $Items
 *
 * @method \App\Model\Entity\Category get($primaryKey, $options = [])
 * @method \App\Model\Entity\Category newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Category|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Category[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Category findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Items', [
            'foreignKey' => 'category_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));
debug("TEST");
        return $rules;
    }

    public function implementedEvents() {
	    return ["Model.beforeDelete" => "beforeDelete", "Model.beforeSave" => "beforeSave"];
    }

    public function beforeDelete($event, $entity) {
	    $query = $this->find()->innerJoinWith("Items")->where(["Items.category_id = " => $entity->id]);
	    if ($query->count() > 0) {
		    return false;
	    }
    }

    public function beforeSave($event, $entity) {
	    $entity->name = ucfirst($entity->name);
    }
	
    /*
     * Return a query qhich, once executed, will return sorted categories
     * arrays with the id and name of each category along with a count of how
     * many items are associated with each.
     */
    public function getCountInfo() {
		$query = $this->find()->leftJoinWith("Items");
		$query = $query->select(["id" => "Categories.id", "name" => "Categories.name", "count" => $query->func()->count("Items.category_id")])->group("Categories.id");
		$query =  $query->order("Categories.name");
		return $query;
    }
}
