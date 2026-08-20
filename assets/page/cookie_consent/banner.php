		<div class="cookie-banner" id="cookieBanner" hidden>
			<p class="cookie-banner__text">
				<?= $translations['cc_banner_pre'] ?> <a href="/<?= $lang ?>/terms.php?section=cookies"><?= $translations['cc_banner_link_text'] ?></a><?= $translations['cc_banner_post'] ?>
			</p>
			<div class="cookie-banner__actions">
				<button type="button" class="cookie-btn cookie-btn--ghost" id="cookieBannerEssential"><?= $translations['cc_banner_essential_only'] ?></button>
				<button type="button" class="cookie-btn cookie-btn--ghost" id="cookieBannerManage"><?= $translations['cc_banner_manage'] ?></button>
				<button type="button" class="cookie-btn cookie-btn--primary" id="cookieBannerAcceptAll"><?= $translations['cc_banner_accept_all'] ?></button>
			</div>
		</div>
