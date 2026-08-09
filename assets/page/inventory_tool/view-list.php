			<table class="hi-table">
				<thead>
					<tr><th></th><th><?= $translations['word_name'] ?></th><th><?= $translations['word_category'] ?></th><th><?= $translations['word_location'] ?></th><th><?= $translations['word_owner'] ?></th><th><?= $translations['word_travel_bag'] ?></th><th></th></tr>
				</thead>
				<tbody>
<?php foreach ($items as $item): ?>
<?php include 'item-row.php'; ?>
<?php endforeach; ?>
				</tbody>
			</table>
