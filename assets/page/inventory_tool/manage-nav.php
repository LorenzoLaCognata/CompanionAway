<div class="hi-field__row">
	<a class="btn btn--outline btn--sm" href="inventory_tool.php"><?= $translations['manage_back_to_items'] ?></a>
	<a class="btn btn--sm<?= $activePage === 'categories' ? ' btn--dark' : ' btn--outline' ?>" href="categories.php"><?= $translations['sidebar_categories_label'] ?></a>
	<a class="btn btn--sm<?= $activePage === 'owners' ? ' btn--dark' : ' btn--outline' ?>" href="owners.php"><?= $translations['sidebar_owners_label'] ?></a>
	<a class="btn btn--sm<?= $activePage === 'locations' ? ' btn--dark' : ' btn--outline' ?>" href="locations.php"><?= $translations['sidebar_locations_label'] ?></a>
	<a class="btn btn--sm<?= $activePage === 'bags' ? ' btn--dark' : ' btn--outline' ?>" href="bags.php"><?= $translations['sidebar_bags_label'] ?></a>
</div>
