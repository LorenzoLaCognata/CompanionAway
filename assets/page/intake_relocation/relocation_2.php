				<form method="post" action="<?= $currentPage . '?step=' . $i ?>">
					<input type="hidden" name="from" value="2">
					<h2 class="intake-section-title"><?= $translations['relo_title_plain'] ?> <em><?= $translations['relo_title_em'] ?></em></h2>
					<p class="intake-section-desc"><?= $translations['relo_desc'] ?></p>

					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['relo_from_label'] ?></label><input type="text" name="movingFrom" value="<?= $_SESSION['data']['movingFrom'] ?>" placeholder="<?= $translations['relo_from_placeholder'] ?>" required></div>
						<div class="intake-field"><label><?= $translations['relo_to_label'] ?></label><input type="text" name="movingTo" value="<?= $_SESSION['data']['movingTo'] ?>" placeholder="<?= $translations['relo_to_placeholder'] ?>" required></div>
					</div>

					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['relo_arrival_label'] ?></label><input type="date" name="arrivalDate" value="<?= $_SESSION['data']['arrivalDate'] ?>"></div>
						<div class="intake-field"><label><?= $translations['relo_certainty_label'] ?></label>
							<select name="dateCertainty">
								<option value=""><?= $translations['relo_certainty_select'] ?></option>
								<option<?= $_SESSION['data']['dateCertainty'] === htmlspecialchars($translations['relo_certainty_arrived'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_certainty_arrived'] ?></option>
								<option<?= $_SESSION['data']['dateCertainty'] === htmlspecialchars($translations['relo_certainty_booked'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_certainty_booked'] ?></option>
								<option<?= $_SESSION['data']['dateCertainty'] === htmlspecialchars($translations['relo_certainty_month'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_certainty_month'] ?></option>
								<option<?= $_SESSION['data']['dateCertainty'] === htmlspecialchars($translations['relo_certainty_flexible'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_certainty_flexible'] ?></option>
							</select>
						</div>
					</div>

					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['relo_who_label'] ?></label>
							<select name="whoRelocating" required>
								<option value=""><?= $translations['relo_who_select'] ?></option>
								<option<?= $_SESSION['data']['whoRelocating'] === htmlspecialchars($translations['relo_who_solo'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_who_solo'] ?></option>
								<option<?= $_SESSION['data']['whoRelocating'] === htmlspecialchars($translations['relo_who_partner'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_who_partner'] ?></option>
								<option<?= $_SESSION['data']['whoRelocating'] === htmlspecialchars($translations['relo_who_family'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_who_family'] ?></option>
								<option<?= $_SESSION['data']['whoRelocating'] === htmlspecialchars($translations['relo_who_family_pets'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_who_family_pets'] ?></option>
								<option<?= $_SESSION['data']['whoRelocating'] === htmlspecialchars($translations['relo_who_partner_pets'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_who_partner_pets'] ?></option>
							</select>
						</div>
						<div class="intake-field"><label><?= $translations['relo_lang_label'] ?></label>
							<select name="reloLang">
								<option value=""><?= $translations['relo_lang_select'] ?></option>
								<option<?= $_SESSION['data']['reloLang'] === htmlspecialchars($translations['relo_lang_en'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_lang_en'] ?></option>
								<option<?= $_SESSION['data']['reloLang'] === htmlspecialchars($translations['relo_lang_it'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['relo_lang_it'] ?></option>
							</select>
						</div>
					</div>

					<p class="intake-field-group-title"><?= $translations['relo_topics_title'] ?></p>
					<div class="intake-field">
						<label><?= $translations['relo_topics_label'] ?></label>
						<div class="intake-check-group">
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="housing"<?= is_checked('reloTopics', 'housing') ? ' checked' : '' ?>><span><?= $translations['relo_topic_housing'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="ssn"<?= is_checked('reloTopics', 'ssn') ? ' checked' : '' ?>><span><?= $translations['relo_topic_ssn'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="bank"<?= is_checked('reloTopics', 'bank') ? ' checked' : '' ?>><span><?= $translations['relo_topic_bank'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="licence"<?= is_checked('reloTopics', 'licence') ? ' checked' : '' ?>><span><?= $translations['relo_topic_licence'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="health"<?= is_checked('reloTopics', 'health') ? ' checked' : '' ?>><span><?= $translations['relo_topic_health'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="community"<?= is_checked('reloTopics', 'community') ? ' checked' : '' ?>><span><?= $translations['relo_topic_community'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="school"<?= is_checked('reloTopics', 'school') ? ' checked' : '' ?>><span><?= $translations['relo_topic_school'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="pets"<?= is_checked('reloTopics', 'pets') ? ' checked' : '' ?>><span><?= $translations['relo_topic_pets'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="shipping"<?= is_checked('reloTopics', 'shipping') ? ' checked' : '' ?>><span><?= $translations['relo_topic_shipping'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="language"<?= is_checked('reloTopics', 'language') ? ' checked' : '' ?>><span><?= $translations['relo_topic_language'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="jobsearch"<?= is_checked('reloTopics', 'jobsearch') ? ' checked' : '' ?>><span><?= $translations['relo_topic_jobsearch'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="reloTopics[]" value="other_relo"<?= is_checked('reloTopics', 'other_relo') ? ' checked' : '' ?>><span><?= $translations['relo_topic_other'] ?></span></label>
						</div>
					</div>

					<div class="intake-form-row intake-full intake-mt">
						<div class="intake-field"><label><?= $translations['relo_worries_label'] ?></label>
							<textarea name="reloWorries" placeholder="<?= $translations['relo_worries_placeholder'] ?>"><?= $_SESSION['data']['reloWorries'] ?></textarea>
						</div>
					</div>
					<div class="intake-form-row intake-full">
						<div class="intake-field"><label><?= $translations['relo_extra_label'] ?></label>
							<textarea name="reloExtra" placeholder="<?= $translations['relo_extra_placeholder'] ?>"><?= $_SESSION['data']['reloExtra'] ?></textarea>
						</div>
					</div>

					<div class="intake-nav-row">
						<button class="intake-btn-back" type="submit" name="action" value="prev"><?= $translations['btn_back'] ?></button>
						<span class="intake-step-count"></span>
						<button class="intake-btn-next" type="submit" name="action" value="next"><?= $translations['btn_continue'] ?></button>
					</div>

				</form>
