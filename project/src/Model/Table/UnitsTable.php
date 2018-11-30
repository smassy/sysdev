<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Units Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\HasMany $Items
 *
 * @method \App\Model\Entity\Unit get($primaryKey, $options = [])
 * @method \App\Model\Entity\Unit newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Unit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Unit|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unit|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Unit[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Unit findOrCreate($search, callable $callback = null, $options = [])
 */
class UnitsTable extends Table
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

        $this->setTable('units');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Items', [
            'foreignKey' => 'unit_id'
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
            ->maxLength('name', 10)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->boolean('is_whole')
            ->allowEmpty('is_whole');

        return $validator;
    }

    public function implementedEvents() {
	    return ["Model.beforeDelete" => "beforeDelete"];
    }

    public function beforeDelete($event, $entity) {
	    $query = $this->find()->innerJoinWith("Items")->where(["Items.unit_id = " => $entity->id]);
	    if ($query->count() > 0) {
		    return false;
	    }
    }
	
    /*
     * Return a query qhich, once executed, will return sorted units
     * arrays with the id and name of each unit along with a count of how
     * many items are associated with each.
     */
    public function getCountInfo() {
		$query = $this->find()->leftJoinWith("Items");
		$query = $query->select(["id" => "Units.id", "name" => "Units.name", "count" => $query->func()->count("Items.unit_id"), "is_whole" => "Units.is_whole"])->group("Units.id");
		$query =  $query->order("Units.name");
		return $query;
    }
}
