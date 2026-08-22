		<div class="cookie-modal-overlay" id="cookieModalOverlay" hidden>
			<div class="cookie-modal" role="dialog" aria-modal="true" aria-labelledby="cookieModalTitle">

				<div class="cookie-modal__header">
					<h2 class="cookie-modal__title" id="cookieModalTitle"><?= $translations['cc_modal_title'] ?></h2>
					<button type="button" class="cookie-modal__close" id="cookieModalClose" aria-label="<?= $translations['cc_modal_close'] ?>">&times;</button>
				</div>

				<p class="cookie-modal__intro">
					<?= $translations['cc_modal_intro'] ?> <a href="/<?= $lang ?>/terms.php?section=cookies"><?= $translations['cc_banner_link_text'] ?></a>.
				</p>

				<div class="cookie-cat">
					<div class="cookie-cat__header">
						<span class="cookie-cat__name"><?= $translations['cc_cat_essential_title'] ?></span>
						<label class="cookie-switch">
							<input type="checkbox" checked disabled>
							<span class="cookie-switch__track"></span>
						</label>
					</div>
					<p class="cookie-cat__desc"><?= $translations['cc_cat_essential_desc'] ?></p>
				</div>

				<div class="cookie-cat">
					<div class="cookie-cat__header">
						<span class="cookie-cat__name"><?= $translations['cc_cat_functional_title'] ?></span>
						<label class="cookie-switch">
							<input type="checkbox" id="cookieToggleFunctional">
							<span class="cookie-switch__track"></span>
						</label>
					</div>
					<p class="cookie-cat__desc"><?= $translations['cc_cat_functional_desc'] ?></p>
				</div>

				<div class="cookie-cat">
					<div class="cookie-cat__header">
						<span class="cookie-cat__name"><?= $translations['cc_cat_analytics_title'] ?></span>
						<label class="cookie-switch">
							<input type="checkbox" id="cookieToggleAnalytics">
							<span class="cookie-switch__track"></span>
						</label>
					</div>
					<p class="cookie-cat__desc"><?= $translations['cc_cat_analytics_desc'] ?></p>
				</div>

				<div class="cookie-cat">
					<div class="cookie-cat__header">
						<span class="cookie-cat__name"><?= $translations['cc_cat_marketing_title'] ?></span>
						<span class="cookie-cat__status"><?= $translations['cc_cat_marketing_status'] ?></span>
					</div>
					<p class="cookie-cat__desc"><?= $translations['cc_cat_marketing_desc'] ?></p>
				</div>

				<div class="cookie-modal__footer">
					<button type="button" class="cookie-btn cookie-btn--ghost" id="cookieModalSave"><?= $translations['cc_modal_save'] ?></button>
					<button type="button" class="cookie-btn cookie-btn--primary" id="cookieModalAcceptAll"><?= $translations['cc_modal_accept_all'] ?></button>
				</div>

			</div>
		</div>
