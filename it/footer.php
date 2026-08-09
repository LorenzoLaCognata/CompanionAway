		</main>

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
				</nav>

			</div>

			<div class="footer__bottom">
				<p>&copy; <?= date('Y') ?> Companion Away . All rights reserved.</p>
				<p class="footer__note">Non generato dall'AI. Ogni piano è creato su misura.</p>
			</div>
			
		</footer>

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

	</body>

</html>