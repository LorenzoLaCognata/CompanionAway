		</main>

<?php
	$cookieConsentLangJson = file_get_contents(__DIR__ . '/cookie_consent/lang.json');
	$translations = array_merge($translations ?? [], json_decode($cookieConsentLangJson, true) ?? []);
?>

		<footer class="site-footer">
		
			<div class="footer__inner">

				<nav class="footer__nav" aria-label="Footer navigation">
					<ul role="list">
						<li><a href="/<?= $lang ?>/relocation.php">Relocation</a></li>
					</ul>
					<ul role="list">
						<li><a href="/<?= $lang ?>/travel.php">Travel</a></li>
					</ul>
					<ul role="list">
						<li><a href="/<?= $lang ?>/terms.php">Terms of service</a></li>
					</ul>
					<ul role="list">
						<li><a href="/<?= $lang ?>/contact.php">Contact</a></li>
					</ul>
					<ul role="list">
						<li><button type="button" class="footer-cc-trigger" id="cookieSettingsLink"><?= $translations['cc_footer_link'] ?></button></li>
					</ul>
				</nav>

			</div>

			<div class="footer__bottom">
				<p>&copy; <?= date('Y') ?> Companion Away . All rights reserved.</p>
				<p class="footer__note">Not AI-generated. Every plan is handcrafted.</p>
			</div>
			
		</footer>

<?php include __DIR__ . '/../assets/page/cookie_consent/banner.php'; ?>

<?php include __DIR__ . '/../assets/page/cookie_consent/modal.php'; ?>

		<script>
			const burger = document.querySelector('.nav-burger');
			const navLinks = document.querySelector('.nav-links');

			if (burger) {
				burger.addEventListener('click', () => {
					const isOpen = burger.getAttribute('aria-expanded') === 'true';
					burger.setAttribute('aria-expanded', !isOpen);
					navLinks.setAttribute('aria-expanded', !isOpen);
				});
			}
			
			if (navLinks) {
				navLinks.querySelectorAll('a').forEach(link => {
					link.addEventListener('click', () => {
						burger.setAttribute('aria-expanded', 'false');
						navLinks.setAttribute('aria-expanded', 'false');
					});
				});
			}
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
				// Bump this whenever the cookie categories or what they do materially changes —
				// visitors on an older version get re-prompted instead of silently carrying over.
				var POLICY_VERSION = 1;

				function getConsent() {
					var match = document.cookie.match(new RegExp('(?:^|; )' + COOKIE_NAME + '=([^;]*)'));
					if (!match) return null;
					try {
						return JSON.parse(decodeURIComponent(match[1]));
					} catch (e) {
						return null;
					}
				}

				(function () {
					var params = new URLSearchParams(location.search);
					if (params.has('ca_self')) {
						var on = params.get('ca_self') === '1';
						document.cookie = 'ca_self=' + (on ? '1' : '0') + ';path=/;max-age=' + (on ? (60 * 60 * 24 * 730) : 0) + ';SameSite=Lax';
					}
				})();

				function isSelf() {
					return document.cookie.indexOf('ca_self=1') !== -1;
				}

				function isCurrentConsent(consent) {
					return !!consent && consent.version === POLICY_VERSION;
				}

				function functionalAllowed() {
					var c = getConsent();
					return isCurrentConsent(c) && !!c.functional;
				}

				function logEvent(payload) {
					try {
						payload.self = isSelf() ? 1 : 0;
						fetch('/consent-log.php', {
							method: 'POST',
							headers: { 'Content-Type': 'application/json' },
							body: JSON.stringify(payload),
							keepalive: true
						});
					} catch (e) {}
				}

				function clearFunctionalCookies() {
					['ca_lang', 'ca_resume_relocation', 'ca_resume_travel'].forEach(function (name) {
						document.cookie = name + '=;path=/;max-age=0;SameSite=Lax';
					});
				}

				function setConsent(functional, analytics) {
					var value = {
						essential: true,
						functional: !!functional,
						analytics: !!analytics,
						marketing: false,
						version: POLICY_VERSION,
						ts: Date.now()
					};
					document.cookie = COOKIE_NAME + '=' + encodeURIComponent(JSON.stringify(value)) + ';path=/;max-age=' + (60 * 60 * 24 * 365) + ';SameSite=Lax';
					if (!value.functional) clearFunctionalCookies();
					logEvent({ event: 'choice', functional: value.functional, analytics: value.analytics });
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
				var lastFocusedBeforeModal = null;

				function showBanner() { if (banner) banner.removeAttribute('hidden'); }
				function hideBanner() { if (banner) banner.setAttribute('hidden', ''); }

				function getFocusable(container) {
					if (!container) return [];
					return Array.prototype.slice.call(
						container.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])')
					).filter(function (el) { return !el.disabled && el.offsetParent !== null; });
				}

				function returnFocus() {
					if (lastFocusedBeforeModal && typeof lastFocusedBeforeModal.focus === 'function') {
						lastFocusedBeforeModal.focus();
					}
					lastFocusedBeforeModal = null;
				}

				function openModal() {
					lastFocusedBeforeModal = document.activeElement;
					var consent = getConsent();
					if (fnToggle) fnToggle.checked = consent ? !!consent.functional : false;
					if (anToggle) anToggle.checked = consent ? !!consent.analytics : false;
					if (overlay) {
						overlay.removeAttribute('hidden');
						var focusable = getFocusable(overlay);
						if (focusable.length) focusable[0].focus();
					}
					hideBanner();
				}

				function closeModal() {
					if (overlay) overlay.setAttribute('hidden', '');
					if (!isCurrentConsent(getConsent())) showBanner();
					returnFocus();
				}

				function applyConsent(consent) {
					hideBanner();
					var modalWasOpen = overlay && !overlay.hasAttribute('hidden');
					if (overlay) overlay.setAttribute('hidden', '');
					if (consent.analytics) loadAnalytics();
					if (modalWasOpen) returnFocus();
				}

				document.addEventListener('keydown', function (e) {
					if (!overlay || overlay.hasAttribute('hidden')) return;
					if (e.key === 'Escape') {
						closeModal();
						return;
					}
					if (e.key !== 'Tab') return;
					var focusable = getFocusable(overlay);
					if (!focusable.length) return;
					var first = focusable[0];
					var last = focusable[focusable.length - 1];
					if (e.shiftKey && document.activeElement === first) {
						e.preventDefault();
						last.focus();
					} else if (!e.shiftKey && document.activeElement === last) {
						e.preventDefault();
						first.focus();
					}
				});

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

				var langLinks = document.querySelectorAll('.nav-lang__option a[data-set-lang]');
				langLinks.forEach(function (link) {
					link.addEventListener('click', function () {
						if (!functionalAllowed()) return;
						var chosen = link.getAttribute('data-set-lang');
						document.cookie = 'ca_lang=' + chosen + ';path=/;max-age=' + (60 * 60 * 24 * 365) + ';SameSite=Lax';
					});
				});

				function logOncePerSession(key, event) {
					try {
						if (sessionStorage.getItem(key)) return;
						sessionStorage.setItem(key, '1');
					} catch (e) {} // sessionStorage unavailable — log anyway rather than lose the signal
					logEvent({ event: event });
				}

				var existing = getConsent();
				if (isCurrentConsent(existing)) {
					if (existing.analytics) loadAnalytics();
					logOncePerSession('caReturnLogged', 'return');
				} else {
					showBanner();
					logOncePerSession('caShownLogged', 'shown');
				}
			})();
		</script>

	</body>

</html>