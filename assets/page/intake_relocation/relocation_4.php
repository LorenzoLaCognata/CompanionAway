				<form method="post" action="<?= $currentPage . '?step=' . $i ?>">

					<input type="hidden" name="from" value="summary">
					<h2 class="intake-section-title"><?= $translations['summary_title_plain'] ?> <em><?= $translations['summary_title_em'] ?></em></h2>
					<p class="intake-section-desc"><?= $translations['summary_desc'] ?></p>

					<div class="intake-summary-grid">

						<div class="intake-summary-card">
							<div class="intake-summary-card-title"><?= $translations['summary_card_about_title'] ?></div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_about_name']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars(trim(($_SESSION['data']['firstName'] ?? '') .' '. ($_SESSION['data']['lastName'] ?? ''))) ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_about_email']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['email'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_about_location']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['currentLocation'] ?? '') ?></span>
							</div>
						</div>

						<div class="intake-summary-card">
							<div class="intake-summary-card-title"><?= $translations['summary_card_relocation_title'] ?></div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_relocation_route']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars(trim(($_SESSION['data']['movingFrom'] ?? '') . ' → ' . ($_SESSION['data']['movingTo'] ?? ''))) ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_relocation_arrival']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['arrivalDate'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_relocation_who']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['whoRelocating'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_relocation_language']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['reloLang'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_relocation_topics']) ?></span>
								<span class="intake-summary-val"><?= checked_labels($_SESSION['data'], 'reloTopics', $translations) ?></span>
							</div>
						</div>

						<div class="intake-summary-card">
							<div class="intake-summary-card-title"><?= $translations['summary_card_other_title'] ?></div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_other_howfound']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['howFound'] ?? '') ?></span>
							</div>
						</div>

						<div class="intake-hp-field"><label for="website"></label><input type="text" name="website" id="website" tabindex="-1" autocomplete="off"></div>

					</div>


					<div class="intake-nav-row">
						<button class="intake-btn-back" type="submit" name="action" value="prev"><?= $translations['btn_back'] ?></button>
						<span class="intake-step-count"></span>
						<button class="intake-btn-next" type="submit" name="action" value="submit"><?= $translations['btn_confirm'] ?></button>
					</div>

				</form>
