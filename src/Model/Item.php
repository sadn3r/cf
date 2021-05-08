<?php
namespace CF\Model;

class Item extends Model{

	public function createItemProperty($itemId, $propertyId) {
		$this->exec('INSERT INTO item_properties VALUES(i:item_id, i:property_id)', [
			'item_id' => $itemId,
			'property_id' => $propertyId,
		]);
	}

	public function createPropertyConfines($itemId, $propertyId, $min = null, $max = null) {
		$data = [
			'property_id' => $propertyId,
			'item_id'	=> $itemId,
		];

		$this->exec('INSERT INTO property_confines(property_id, item_id, min, max) VALUES(i:property_id, i:item_id, '.($min==""?"null":$min).', '.($max==""?"null":$max).')', $data);
	}

	public function findByAlias(string $alias):array {

		$sql = 'SELECT
					   i1.item_id,
					   i1.title,
					   i1.quality,
					   i2.title AS extends_title,
					   t1.title AS type_title,
					   t1.alias AS type_alias
				  FROM items i1
		    INNER JOIN types t1
		    		ON t1.type_id = i1.type_id
			 LEFT JOIN items i2
			 		ON i2.item_id = i1.extends_id
				 WHERE i1.alias = "s:alias"
		';
		

		$result = $this->exec($sql, [
			'alias' => $alias,
		]);


		return $result->fetch_assoc();
	}

	public function getPropertiesByItemId(int $itemId):array {
		
		$sql = '
				SELECT p1.title, pc1.min, pc1.max, pc1.optional, p1.property_id id
				  FROM properties p1
			INNER JOIN property_confines pc1
					ON pc1.property_id = p1.property_id
				 WHERE pc1.item_id = i:item_id
			  ORDER BY p1.property_order ASC
		';

		return $this->exec($sql, [
			'item_id' => $itemId
		])->fetch_all(MYSQLI_ASSOC);
	}


	public function getItemTypes():array {
		return $this->exec('
			SELECT t1.title, t1.alias
			  FROM types t1
		  ORDER BY t1.type_id ASC
		')->fetch_all(MYSQLI_ASSOC);
	}

	public function getItemsByType(string $aliasType):array {

		$result = $this->exec('
			SELECT t1.type_id
			  FROM types t1
			 WHERE t1.alias = "s:alias"
		', ['alias'=>$aliasType]);

		$type = $result->fetch_assoc();


		return $this->exec('
			SELECT i1.title, i1.alias
			  FROM items i1
			 WHERE i1.type_id = i:type_id', [
			 	'type_id'=>$type['type_id']
		])->fetch_all(MYSQLI_ASSOC);
	}

	public function getItemsByPropertyId(int $propertyId):array {
		$results = $this->exec('
			SELECT i1.title, i1.alias
			  FROM item_properties ip1
		INNER JOIN items i1
				ON i1.item_id = ip1.item_id
			 WHERE ip1.property_id = i:property_id
		', [
			'property_id' => $propertyId,
		]);

		return $results->fetch_all(MYSQLI_ASSOC);
	}

	public function getProperties():array {
		$results = $this->exec('
			SELECT p1.property_id, p1.title, p1.property_order
			  FROM properties p1
		  ORDER BY p1.property_order ASC
		');

		return $results->fetch_all(MYSQLI_ASSOC);
	}

	public function updatePropertyOrder($propertyId, $propertyOrder) {
		$this->exec('
			UPDATE properties p1
			   SET p1.property_order = i:property_order
			 WHERE p1.property_id = i:property_id
		', [
			'property_order' => $propertyOrder,
			'property_id'	=> $propertyId,
		]);
	}
}