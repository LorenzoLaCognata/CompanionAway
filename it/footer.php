		</main>

<?php
	$cookieConsentLangJson = file_get_contents('cookie_consent/lang.json');
	$translations = array_merge($translations, json_decode($cookieConsentLangJson, true));
?>

		<footer class="site-footer">
		
			<div class="footer__inner">

				<nav class="footer__nav" aria-label="Footer navigation">
					<ul role="list">
						<li><a href="/<?= $lang ?>/relocation.php">Trasferimento</a></li>
					</ul>
					<ul role="list">
						<li><a href="/<?= $lang ?>/travel.php">Viaggio</a></li>
					</ul>
					<ul role="list">
						<li><a href="/<?= $lang ?>/terms.php">Termini e Condizioni</a></li>
					</ul>
					<ul role="list">
						<li><a href="/<?= $lang ?>/contact.php">Contatti</a></li>
					</ul>
					<ul role="list">
						<li><button type="button" class="footer-cc-trigger" id="cookieSettingsLink"><?= $translations['cc_footer_link'] ?></button></li>
					</ul>
				</nav>

			</div>

			<div class="footer__bottom">
				<p>&copy; <?= date('Y') ?> Companion Away . All rights reserved.</p>
				<p class="footer__note">Non generato dall'AI. Ogni piano è creato su misura.</p>
			</div>
			
		</footer>

<?php include '../assets/page/cookie_consent/banner.php'; ?>

<?php include '../assets/page/cookie_consent/modal.php'; ?>

		<script>
			const burger = document.querySelector('.nav-burger');
			const navLinks = document.querySelector('.nav-links');

			burger.addEventListener('click', () => {
				const isOpen = burger.getAttribute('aria-expanded') === 'true';
				burger.setAttribute('aria-expanded', !isOpen);
				navLinks.setAttribute('aria-expanded', !isOpen);
			});

			navLinks.querySelectorAll('a').forEach(link => {
				link.addEventListener('click', () => {
					burger.setAttribute('aria-expanded', 'false');
					navLinks.setAttribute('aria-expanded', 'false');
				});
			});
		</script>

		<script>
			function tick(el) {
				el.classList.toggle('done');
				updateProgress();
			}
			function updateProgress() {
				const all  = document.querySelectorAll('.check-item');
				const done = document.querySelectorAll('.check-item.done');
				const pct  = all.length ? (done.length / all.length) * 100 : 0;
				const bar  = document.getElementById('prog');
				if (bar) bar.style.width = pct + '%';
			}
		</script>

		<script>
			function showTab(id, btn) {
				document.querySelectorAll(".guide-panel").forEach(p => p.classList.remove("active"));
				document.querySelectorAll(".gt").forEach(b => b.classList.remove("active"));
				document.getElementById("tab-" + id).classList.add("active");
				btn.classList.add("active");
			}
			function toggleFaq(btn) {
				btn.parentElement.classList.toggle("open");
			}
		</script>

		<script>
			(function () {
				var COOKIE_NAME = 'ca_consent';
				var GA_ID = 'G-2KTKK3SNWY';

				function getConsent() {
					var match = document.cookie.match(new RegExp('(?:^|; )' + COOKIE_NAME + '=([^;]*)'));
					if (!match) return null;
					try {
						return JSON.parse(decodeURIComponent(match[1]));
					} catch (e) {
						return null;
					}
				}

				function setConsent(functional, analytics) {
					var value = {
						essential: true,
						functional: !!functional,
						analytics: !!analytics,
						marketing: false,
						ts: Date.now()
					};
					document.cookie = COOKIE_NAME + '=' + encodeURIComponent(JSON.stringify(value)) + ';path=/;max-age=' + (60 * 60 * 24 * 365) + ';SameSite=Lax';
					return value;
				}

				function loadAnalytics() {
					if (window.__caAnalyticsLoaded || typeof gtag !== 'function') return;
					window.__caAnalyticsLoaded = true;
					var s = document.createElement('script');
					s.async = true;
					s.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
					document.head.appendChild(s);
					gtag('consent', 'update', { analytics_storage: 'granted' });
					gtag('config', GA_ID);
				}

				var banner   = document.getElementById('cookieBanner');
				var overlay  = document.getElementById('cookieModalOverlay');
				var fnToggle = document.getElementById('cookieToggleFunctional');
				var anToggle = document.getElementById('cookieToggleAnalytics');

				function showBanner() { if (banner) banner.removeAttribute('hidden'); }
				function hideBanner() { if (banner) banner.setAttribute('hidden', ''); }

				function openModal() {
					var consent = getConsent();
					if (fnToggle) fnToggle.checked = consent ? !!consent.functional : false;
					if (anToggle) anToggle.checked = consent ? !!consent.analytics : false;
					if (overlay) overlay.removeAttribute('hidden');
					hideBanner();
				}

				function closeModal() {
					if (overlay) overlay.setAttribute('hidden', '');
					if (!getConsent()) showBanner();
				}

				function applyConsent(consent) {
					hideBanner();
					if (overlay) overlay.setAttribute('hidden', '');
					if (consent.analytics) loadAnalytics();
				}

				var acceptAllBtns = [
					document.getElementById('cookieBannerAcceptAll'),
					document.getElementById('cookieModalAcceptAll')
				];
				acceptAllBtns.forEach(function (btn) {
					if (btn) btn.addEventListener('click', function () {
						applyConsent(setConsent(true, true));
					});
				});

				var essentialBtn = document.getElementById('cookieBannerEssential');
				if (essentialBtn) essentialBtn.addEventListener('click', function () {
					applyConsent(setConsent(false, false));
				});

				var manageBtn = document.getElementById('cookieBannerManage');
				if (manageBtn) manageBtn.addEventListener('click', openModal);

				var saveBtn = document.getElementById('cookieModalSave');
				if (saveBtn) saveBtn.addEventListener('click', function () {
					applyConsent(setConsent(
						fnToggle && fnToggle.checked,
						anToggle && anToggle.checked
					));
				});

				var closeBtn = document.getElementById('cookieModalClose');
				if (closeBtn) closeBtn.addEventListener('click', closeModal);

				if (overlay) overlay.addEventListener('click', function (e) {
					if (e.target === overlay) closeModal();
				});

				var footerTrigger = document.getElementById('cookieSettingsLink');
				if (footerTrigger) footerTrigger.addEventListener('click', function (e) {
					e.preventDefault();
					openModal();
				});

				var existing = getConsent();
				if (existing) {
					if (existing.analytics) loadAnalytics();
				} else {
					showBanner();
				}
			})();
		</script>

	</body>

</html>