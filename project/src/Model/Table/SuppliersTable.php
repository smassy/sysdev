<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Suppliers Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\HasMany $Items
 *
 * @method \App\Model\Entity\Supplier get($primaryKey, $options = [])
 * @method \App\Model\Entity\Supplier newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Supplier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Supplier|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Supplier|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Supplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier findOrCreate($search, callable $callback = null, $options = [])
 */
class SuppliersTable extends Table
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

        $this->setTable('suppliers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Items', [
            'foreignKey' => 'supplier_id'
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function implementedEvents() {
	    return ["Model.beforeDelete" => "beforeDelete", "Model.beforeSave" => "beforeSave"];
    }

    public function beforeDelete($event, $entity) {
	    $query = $this->find()->innerJoinWith("Items")->where(["Items.supplier_id = " => $entity->id]);
	    if ($query->count() > 0) {
		    return false;
	    }
    }
	
    public function beforeSave($event, $entity) {
	    $entity->name = ucfirst($entity->name);
    }

    /*
     * Return a query qhich, once executed, will return sorted suppliers
     * arrays with the id and name of each supplier along with a count of how
     * many items are associated with each.
     */
    public function getCountInfo() {
		$query = $this->find()->leftJoinWith("Items");
		$query = $query->select(["id" => "Suppliers.id", "name" => "Suppliers.name", "count" => $query->func()->count("Items.supplier_id")])->group("Suppliers.id");
		$query =  $query->order("Suppliers.name");
		return $query;
    }
}
