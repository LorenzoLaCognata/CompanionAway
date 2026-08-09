				<div class="hi-field hi-field--full">
					<label><?= $translations['word_location'] ?></label>
					<div class="hi-field__row">
						<select class="hi-select" name="f_place" onchange="this.form.submit()">
							<option value=""><?= $translations['option_place_dash'] ?></option>
<?php foreach (locPlaces($db) as $pl): ?>
							<option value="<?= (int)$pl['id'] ?>" <?= $fPlace == $pl['id'] ? 'selected' : '' ?>><?= htmlspecialchars($pl['icon']) ?> <?= htmlspecialchars($pl['name']) ?></option>
<?php endforeach; ?>
						</select>
						<select class="hi-select" name="f_room" onchange="this.form.submit()" <?= empty($rooms) ? 'disabled' : '' ?>>
							<option value=""><?= $translations['option_room_dash'] ?></option>
<?php foreach ($rooms as $rm): ?>
							<option value="<?= (int)$rm['id'] ?>" <?= $fRoom == $rm['id'] ? 'selected' : '' ?>><?= htmlspecialchars($rm['icon']) ?> <?= htmlspecialchars($rm['name']) ?></option>
<?php endforeach; ?>
						</select>
						<select class="hi-select" name="f_cont" onchange="this.form.submit()" <?= empty($containers) ? 'disabled' : '' ?>>
							<option value=""><?= $translations['option_container_dash'] ?></option>
<?php foreach ($containers as $ct): ?>
							<option value="<?= (int)$ct['id'] ?>" <?= $fCont == $ct['id'] ? 'selected' : '' ?>><?= htmlspecialchars($ct['icon']) ?> <?= htmlspecialchars($ct['name']) ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
