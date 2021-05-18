<?php 
namespace CF\Controllers;

use CF\Models\Item;
use CF\{Container, Request};


class Home extends ControllerHtml {

	public function Index() {
		
		$modelItem = Container::getInstance()->get(Item::class);

		$this->render('index', [
			'items' => $modelItem->getItemTypes(),
		]);
	} 

	public function ItemPost(string $aliasItem) {

		$modelItem = Container::getInstance()->get(Item::class);

		if (!$item = $modelItem->findByAlias($aliasItem)) {
			echo 'not found';
			die;			
		}


		$modelItem->createItemProperty($item['item_id'], $this->request->getPost()['property_id']);
		$modelItem->createPropertyConfines(
			$item['item_id'],
			$this->request->getPost()['property_id'],
			$this->request->getPost()['min'],
			$this->request->getPost()['max']
		);

		header("Location:/item/{$aliasItem}");
	}

	public function Item(string $aliasItem) {
		
		$modelItem = Container::getInstance()->get(Item::class);
		
		if (!$item = $modelItem->findByAlias($aliasItem)) {
			echo 'not found';
			die;			
		}

		
		$properties = $modelItem->getPropertiesByItemId($item['item_id']);

		$this->render('item', [
			'item' => $item,
			'properties' => $properties,

			'props' => $modelItem->getProperties(),
		]);
	}
}