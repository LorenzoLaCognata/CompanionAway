<div class="hi-field__row hi-manage-nav">
	<a class="btn btn--outline btn--sm" href="<?= $currentPage ?>"><?= $translations['manage_back_to_items'] ?></a>
<?php if ($manage === 'list'): ?>
	<a class="btn btn--amber btn--sm" href="<?= htmlspecialchars(manageUrl($currentPage, $table, 'add')) ?>"><?= $translations[manageAddLabelKey($table, -1)] ?></a>
<?php endif; ?>
	<a class="btn btn--sm<?= $table === 'categories' ? ' btn--dark' : ' btn--outline' ?>" href="<?= manageUrl($currentPage, 'categories') ?>"><?= $translations['sidebar_categories_label'] ?></a>
	<a class="btn btn--sm<?= $table === 'owners' ? ' btn--dark' : ' btn--outline' ?>" href="<?= manageUrl($currentPage, 'owners') ?>"><?= $translations['sidebar_owners_label'] ?></a>
	<a class="btn btn--sm<?= $table === 'locations' ? ' btn--dark' : ' btn--outline' ?>" href="<?= manageUrl($currentPage, 'locations') ?>"><?= $translations['sidebar_locations_label'] ?></a>
	<a class="btn btn--sm<?= $table === 'bags' ? ' btn--dark' : ' btn--outline' ?>" href="<?= manageUrl($currentPage, 'bags') ?>"><?= $translations['sidebar_bags_label'] ?></a>
</div>
