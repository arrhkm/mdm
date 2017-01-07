<?php
namespace common\cart\storage;

interface StorageInterface
{
	public function load();
	public function save(array $items);
}


?>