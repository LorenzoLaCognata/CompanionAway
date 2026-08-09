				<div class="hi-field hi-field--full">
					<label><?= $translations['word_travel_bag'] ?></label>
					<div class="hi-field__row">
						<select class="hi-select" name="f_bag_top" onchange="this.form.submit()">
							<option value=""><?= $translations['option_no_bag_dash'] ?></option>
<?php foreach (bagTopLevel($db) as $b): ?>
							<option value="<?= (int)$b['id'] ?>" <?= $fBagTop == $b['id'] ? 'selected' : '' ?>><?= htmlspecialchars($b['icon']) ?> <?= htmlspecialchars($b['name']) ?></option>
<?php endforeach; ?>
						</select>
						<select class="hi-select" name="f_bag_cont" onchange="this.form.submit()" <?= empty($bagContainers) ? 'disabled' : '' ?>>
							<option value=""><?= $translations['option_no_container_dash'] ?></option>
<?php foreach ($bagContainers as $c): ?>
							<option value="<?= (int)$c['id'] ?>" <?= $fBagCont == $c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['icon']) ?> <?= htmlspecialchars($c['name']) ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
