				<form method="post" action="<?= $currentPage . '?step=' . $i ?>">
					<input type="hidden" name="from" value="1">
					<h2 class="intake-section-title"><?= $translations['contact_title_plain'] ?> <em><?= $translations['contact_title_em'] ?></em></h2>
					<p class="intake-section-desc"><?= $translations['contact_desc'] ?></p>
					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['contact_first_name_label'] ?></label><input type="text" name="firstName" value="<?= htmlspecialchars($_SESSION['data']['firstName'] ?? '') ?>" placeholder="<?= $translations['contact_first_name_placeholder'] ?>" required></div>
						<div class="intake-field"><label><?= $translations['contact_last_name_label'] ?></label><input type="text" name="lastName" value="<?= htmlspecialchars($_SESSION['data']['lastName'] ?? '') ?>" placeholder="<?= $translations['contact_last_name_placeholder'] ?>" required></div>
					</div>
					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['contact_email_label'] ?></label><input type="email" name="email" value="<?= htmlspecialchars($_SESSION['data']['email'] ?? '') ?>" placeholder="<?= $translations['contact_email_placeholder'] ?>" required></div>
						<div class="intake-field"><label><?= $translations['contact_phone_label'] ?></label><input type="tel" name="phone" value="<?= htmlspecialchars($_SESSION['data']['phone'] ?? '') ?>" placeholder="<?= $translations['contact_phone_placeholder'] ?>"></div>
					</div>
					<div class="intake-form-row intake-full">
						<div class="intake-field"><label><?= $translations['contact_location_label'] ?></label><input type="text" name="currentLocation" value="<?= htmlspecialchars($_SESSION['data']['currentLocation'] ?? '') ?>" placeholder="<?= $translations['contact_location_placeholder'] ?>" required></div>
					</div>
					<div class="intake-form-row intake-full">
						<div class="intake-field"><label><?= $translations['contact_message_label'] ?></label><textarea name="message" placeholder="<?= $translations['contact_message_placeholder'] ?>" required><?= htmlspecialchars($_SESSION['data']['message'] ?? '') ?></textarea></div>
					</div>
					<div class="intake-hp-field"><label for="website"></label><input type="text" name="website" id="website" tabindex="-1" autocomplete="off"></div>
					<div class="intake-nav-row">
						<span class="intake-step-count"></span>
						<button class="intake-btn-next" type="submit" name="action" value="submit"><?= $translations['btn_send'] ?></button>
					</div>
				</form>
