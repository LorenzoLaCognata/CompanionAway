<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('inventory_tool_demo/lang.json');
	$translations = json_decode($langJson, true);

	// REVIEW TO OPTIMIZE
	$pageStylesheet = '/assets/css/style.css';
?>

<?php
require_once '../assets/page/inventory_tool_demo/bootstrap.php';
require_once '../assets/page/inventory_tool_demo/list-context.php';

require_once '../assets/page/inventory_tool_demo/query-params.php';
?>

<?php require 'head.php'; ?>
<?php require '../assets/page/inventory_tool_demo/header.php'; ?>
<?php require '../assets/page/inventory_tool_demo/toolbar.php'; ?>
<?php require '../assets/page/inventory_tool_demo/sidebar.php'; ?>
<?php
$action = $_GET['action'] ?? 'list';

if ($action === 'add' || $action === 'edit' || $action === 'delete' || $action === 'master_data') {
	require '../assets/page/inventory_tool_demo/locked.php';
} else {
	require '../assets/page/inventory_tool_demo/view-dispatch.php';
}
?>
	</main>
</div>
	
<?php require 'footer.php'; ?>