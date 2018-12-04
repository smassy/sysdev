<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use \DateTime;

/**
 * Item Entity
 *
 * @property int $id
 * @property int $category_id
 * @property int $supplier_id
 * @property int $unit_id
 * @property string $name
 * @property float|null $qty
 * @property float|null $threshold
 * @property \Cake\I18n\FrozenTime|null $last_added
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\Unit $unit
 */
class Item extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'category_id' => true,
        'supplier_id' => true,
        'unit_id' => true,
        'name' => true,
        'qty' => true,
        'threshold' => true,
        'last_added' => true,
        'category' => true,
        'supplier' => true,
        'unit' => true
    ];

    public function getDaysSinceArrived() {
	    if ($this->last_added) {
	    	$today = new DateTime();
	    	return $this->last_added->diff($today)->format("%a");
	    }
	    return -1;
    }
}
