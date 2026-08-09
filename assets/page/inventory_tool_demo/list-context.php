<?php
	function qsExcept(array $except): string {
		$params = $_GET;
		foreach ($except as $key) unset($params[$key]);
		return http_build_query($params);
	}

	function listContextQuery(): string {
		$keys = ['type', 'filter', 'q', 'sort', 'view', 'fcat', 'fowner', 'floc', 'fbag'];
		$params = [];
		foreach ($keys as $key) {
			if (isset($_GET[$key]) && $_GET[$key] !== '') {
				$params[$key] = $_GET[$key];
			}
		}
		return http_build_query($params);
	}

	function sidebarLink(string $type, ?int $filter = null): string {
		$qs = qsExcept(['type', 'filter', 'action', 'id']);
		$url = 'inventory_tool_demo.php?type=' . urlencode($type);
		if ($filter !== null) {
			$url .= '&filter=' . $filter;
		}
		if ($qs !== '') {
			$url .= '&' . $qs;
		}
		return $url;
	}
