			<div class="paths">
				<p class="paths__eyebrow"><?= $translations['services_eyebrow'] ?>!</p>
				<h2 class="paths__heading"><?= $translations['services_h2'] ?></h2>
				<p class="paths__intro"><?= $translations['services_intro'] ?></p>
				<div class="paths__grid">
					<div class="paths__card">
						<div class="paths__icon">🏠</div>
						<div class="paths__title"><?= $translations['services_relocation_title'] ?></div>
						<div class="paths__tagline"><?= $translations['services_relocation_tagline'] ?></div>
						<div class="paths__price"><?= $translations['services_relocation_price'] ?></div>
						<div class="paths__desc"><?= $translations['services_relocation_desc'] ?></div>
						<div class="paths__features"><?= $translations['services_relocation_features'] ?></div>
						<a href="/<?= $lang ?>/relocation.php" class="paths__cta"><?= $translations['services_relocation_cta'] ?></a>
					</div>
					<div class="paths__card">
						<div class="paths__icon">✈</div>
						<div class="paths__title"><?= $translations['services_escape_title'] ?></div>
						<div class="paths__tagline"><?= $translations['services_escape_tagline'] ?></div>
						<div class="paths__price"><?= $translations['services_escape_price'] ?></div>
						<div class="paths__desc"><?= $translations['services_escape_desc'] ?></div>
						<div class="paths__features"><?= $translations['services_escape_features'] ?></div>
						<a href="/<?= $lang ?>/travel.php" class="paths__cta"><?= $translations['services_escape_cta'] ?></a>
					</div>
					<div class="paths__card paths__card--bundle">
						<div class="paths__icon">🎁</div>
						<div class="paths__title"><?= $translations['services_bundle_title'] ?></div>
						<div class="paths__tagline"><?= $translations['services_bundle_tagline'] ?></div>
						<div class="paths__price"><?= $translations['services_bundle_price'] ?></div>
						<div class="paths__desc"><?= $translations['services_bundle_desc'] ?></div>
						<div class="paths__features"><?= $translations['services_bundle_features'] ?></div>
						<div class="paths__bundle-note"><?= $translations['services_bundle_note_before'] ?><a href="/<?= $lang ?>/relocation.php"><?= $translations['services_bundle_note_relocation_link'] ?></a><?= $translations['services_bundle_note_between'] ?><a href="/<?= $lang ?>/travel.php"><?= $translations['services_bundle_note_travel_link'] ?></a><?= $translations['services_bundle_note_after'] ?></div>
					</div>
				</div>
			</div>
