<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('inventory_tool_demo/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = [
		'/assets/css/shared-demo.min.css',
		'/assets/css/inventory-style.min.css'
	];
?>

<?php
require_once __DIR__ . '/../assets/page/inventory_tool/bootstrap.php';
require_once __DIR__ . '/../assets/page/inventory_tool/list-context.php';

require_once __DIR__ . '/../assets/page/inventory_tool/query-params.php';
?>

<?php require __DIR__ . '/head.php'; ?>
<?php require __DIR__ . '/../assets/page/inventory_tool_demo/header.php'; ?>
<?php require __DIR__ . '/../assets/page/inventory_tool/toolbar.php'; ?>
<?php require __DIR__ . '/../assets/page/inventory_tool/sidebar.php'; ?>
<?php
$action = $_GET['action'] ?? 'list';

if ($action === 'add' || $action === 'edit' || $action === 'delete' || $action === 'master_data') {
	require __DIR__ . '/../assets/page/inventory_tool_demo/locked.php';
} else {
	require __DIR__ . '/../assets/page/inventory_tool/view-dispatch.php';
}
?>
	</main>
</div>
	
<?php require __DIR__ . '/footer.php'; ?>