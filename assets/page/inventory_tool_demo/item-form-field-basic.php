				<div class="hi-field hi-field--full">
					<label><?= $translations['word_name'] ?></label>
					<input class="hi-input" type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
				</div>

				<div class="hi-field">
					<label><?= $translations['word_category'] ?></label>
					<select class="hi-select" name="category_id">
						<option value=""><?= $translations['option_none'] ?></option>
<?php foreach (catAll($db) as $c): ?>
						<option value="<?= (int)$c['id'] ?>" <?= $categoryId == $c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['icon']) ?> <?= htmlspecialchars($c['name']) ?></option>
<?php endforeach; ?>
					</select>
				</div>

				<div class="hi-field">
					<label><?= $translations['word_owner'] ?></label>
					<select class="hi-select" name="owner_id">
						<option value=""><?= $translations['option_unassigned_dash'] ?></option>
<?php foreach (ownerAll($db) as $o): ?>
						<option value="<?= (int)$o['id'] ?>" <?= $ownerId == $o['id'] ? 'selected' : '' ?>><?= htmlspecialchars($o['icon']) ?> <?= htmlspecialchars($o['name']) ?></option>
<?php endforeach; ?>
					</select>
				</div>
