				<form method="post" action="<?= $currentPage . '?step=' . $i ?>">
					<input type="hidden" name="from" value="1">
					<h2 class="intake-section-title"><?= $translations['you_title_plain'] ?> <em><?= $translations['you_title_em'] ?></em></h2>
					<p class="intake-section-desc"><?= $translations['you_desc'] ?></p>
					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['you_first_name_label'] ?></label><input type="text" name="firstName" value="<?= $_SESSION['data']['firstName'] ?>" placeholder="<?= $translations['you_first_name_placeholder'] ?>" required></div>
						<div class="intake-field"><label><?= $translations['you_last_name_label'] ?></label><input type="text" name="lastName" value="<?= $_SESSION['data']['lastName'] ?>" placeholder="<?= $translations['you_last_name_placeholder'] ?>" required></div>
					</div>
					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['you_email_label'] ?></label><input type="email" name="email" value="<?= $_SESSION['data']['email'] ?>" placeholder="<?= $translations['you_email_placeholder'] ?>" required></div>
						<div class="intake-field"><label><?= $translations['you_phone_label'] ?></label><input type="tel" name="phone" value="<?= $_SESSION['data']['phone'] ?>" placeholder="<?= $translations['you_phone_placeholder'] ?>"></div>
					</div>
					<div class="intake-form-row intake-full">
						<div class="intake-field"><label><?= $translations['you_location_label'] ?></label><input type="text" name="currentLocation" value="<?= $_SESSION['data']['currentLocation'] ?>" placeholder="<?= $translations['you_location_placeholder'] ?>" required></div>
					</div>
					<div class="intake-nav-row">
						<span class="intake-step-count"></span>
						<button class="intake-btn-next" type="submit"><?= $translations['btn_continue'] ?></button>
					</div>
				</form>
