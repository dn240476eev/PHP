<?php 
header('Content-Type: text/html; charset=utf-8');
require_once 'data/data_pages.php';

function getPages($data_pages) {
	if(file_exists('data/data_pages.php')) {
		return unserialize($data_pages);
	}
}

$pages = getPages($data_pages);

function makeMenu($pages) {
	if(is_array($pages)) {
		foreach ($pages as $page) {
			if ($page->visible && $page->menu_id == 1) {
				if ($page->id == 1) {
					echo "<a href='/'> $page->name </a>";
				} else {
					echo "<a href=?route=page&id=$page->id> $page->name </a>";
				}
			}
		}
	}
}

function getPage($pages, $id) {
	if(is_array($pages)) {
		return $pages[$id];
	}
}

// function getPage($pages) {
// 	if(is_array($pages)) {
// 		return $pages[$_GET['id']];
// 	}
// }