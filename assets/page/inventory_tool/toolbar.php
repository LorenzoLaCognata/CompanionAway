<form class="hi-toolbar" method="get" action="<?= $currentPage ?>">
<?php foreach (['type', 'filter', 'sort', 'view'] as $k): if (isset($_GET[$k])): ?>
	<input type="hidden" name="<?= $k ?>" value="<?= htmlspecialchars($_GET[$k]) ?>">
<?php endif; endforeach; ?>

<?php $addItemCtx = listContextQuery(); ?>
	<a class="btn btn--amber btn--sm" href="<?= $currentPage ?>?action=add<?= $addItemCtx !== '' ? '&' . $addItemCtx : '' ?>"><?= $translations['toolbar_add_item'] ?></a>

	<input class="hi-input hi-toolbar__search" type="text" name="q" placeholder="<?= htmlspecialchars($translations['toolbar_search_placeholder']) ?>" value="<?= htmlspecialchars($search) ?>">
	<button type="submit" class="btn btn--outline btn--sm" aria-label="<?= htmlspecialchars($translations['toolbar_search_aria']) ?>">🔍</button>

	<a class="btn btn--sm<?= $view === 'cards' ? ' btn--dark' : ' btn--outline' ?>" href="<?= $currentPage ?>?<?= qsExcept(['view', 'action', 'id']) ?>&view=cards"><?= $translations['toolbar_view_cards'] ?></a>
	<a class="btn btn--sm<?= $view === 'list' ? ' btn--dark' : ' btn--outline' ?>" href="<?= $currentPage ?>?<?= qsExcept(['view', 'action', 'id']) ?>&view=list"><?= $translations['toolbar_view_list'] ?></a>

	<span class="hi-filters__label"><?= $translations['toolbar_sort_label'] ?></span>
	<a class="btn btn--sm<?= $sort === 'name' ? ' btn--dark' : ' btn--outline' ?>" href="<?= $currentPage ?>?<?= qsExcept(['sort', 'action', 'id']) ?>&sort=<?= 'name' ?>">&#128278;</a>
	<a class="btn btn--sm<?= $sort === 'cat' ? ' btn--dark' : ' btn--outline' ?>" href="<?= $currentPage ?>?<?= qsExcept(['sort', 'action', 'id']) ?>&sort=<?= 'cat' ?>">&#128193;</a>
	<a class="btn btn--sm<?= $sort === 'owner' ? ' btn--dark' : ' btn--outline' ?>" href="<?= $currentPage ?>?<?= qsExcept(['sort', 'action', 'id']) ?>&sort=<?= 'owner' ?>">&#128100;</a>
	<a class="btn btn--sm<?= $sort === 'loc' ? ' btn--dark' : ' btn--outline' ?>" href="<?= $currentPage ?>?<?= qsExcept(['sort', 'action', 'id']) ?>&sort=<?= 'loc' ?>">&#127760;</a>
	<a class="btn btn--sm<?= $sort === 'bag' ? ' btn--dark' : ' btn--outline' ?>" href="<?= $currentPage ?>?<?= qsExcept(['sort', 'action', 'id']) ?>&sort=<?= 'bag' ?>">&#129523;</a>

	<div class="hi-filters__group">
		<span class="hi-filters__label">&#128193;</span>
		<select class="hi-select" name="fcat" onchange="this.form.submit()">
			<option value=""><?= $translations['word_all'] ?></option>
<?php foreach (catAll($db) as $c): ?>
			<option value="<?= (int)$c['id'] ?>" <?= $extra['cat'] == $c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['icon']) ?> <?= htmlspecialchars($c['name']) ?></option>
<?php endforeach; ?>
		</select>
	</div>

	<div class="hi-filters__group">
		<span class="hi-filters__label">&#128100;</span>
		<select class="hi-select" name="fowner" onchange="this.form.submit()">
			<option value=""><?= $translations['word_all'] ?></option>
<?php foreach (ownerAll($db) as $o): ?>
			<option value="<?= (int)$o['id'] ?>" <?= $extra['owner'] == $o['id'] ? 'selected' : '' ?>><?= htmlspecialchars($o['icon']) ?> <?= htmlspecialchars($o['name']) ?></option>
<?php endforeach; ?>
		</select>
	</div>

	<div class="hi-filters__group">
		<span class="hi-filters__label">&#127760;</span>
		<select class="hi-select" name="floc" onchange="this.form.submit()">
			<option value=""><?= $translations['word_all'] ?></option>
<?php foreach (locPlaces($db) as $pl): ?>
			<option value="<?= (int)$pl['id'] ?>" <?= $extra['loc'] == $pl['id'] ? 'selected' : '' ?>><?= htmlspecialchars($pl['icon']) ?> <?= htmlspecialchars($pl['name']) ?></option>
<?php foreach (locChildren($db, (int)$pl['id']) as $rm): ?>
			<option value="<?= (int)$rm['id'] ?>" <?= $extra['loc'] == $rm['id'] ? 'selected' : '' ?>>&nbsp;&nbsp;<?= htmlspecialchars($rm['icon']) ?> <?= htmlspecialchars($rm['name']) ?></option>
<?php foreach (locChildren($db, (int)$rm['id']) as $ct): ?>
			<option value="<?= (int)$ct['id'] ?>" <?= $extra['loc'] == $ct['id'] ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;<?= htmlspecialchars($ct['icon']) ?> <?= htmlspecialchars($ct['name']) ?></option>
<?php endforeach; endforeach; endforeach; ?>
		</select>
	</div>

	<div class="hi-filters__group">
		<span class="hi-filters__label">&#129523;</span>
		<select class="hi-select" name="fbag" onchange="this.form.submit()">
			<option value=""><?= $translations['word_all'] ?></option>
<?php foreach (bagTopLevel($db) as $b): ?>
			<option value="<?= (int)$b['id'] ?>" <?= $extra['bag'] == $b['id'] ? 'selected' : '' ?>><?= htmlspecialchars($b['icon']) ?> <?= htmlspecialchars($b['name']) ?></option>
<?php foreach (bagChildren($db, (int)$b['id']) as $c): ?>
			<option value="<?= (int)$c['id'] ?>" <?= $extra['bag'] == $c['id'] ? 'selected' : '' ?>>&nbsp;&nbsp;<?= htmlspecialchars($c['icon']) ?> <?= htmlspecialchars($c['name']) ?></option>
<?php endforeach; endforeach; ?>
		</select>
	</div>

	<span class="hi-filters__count"><?= sprintf($translations[$countTotal === 1 ? 'item_count_one' : 'item_count_other'], $countTotal) ?></span>
</form>
