		</main>

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
				</nav>

			</div>

			<div class="footer__bottom">
				<p>&copy; <?= date('Y') ?> Companion Away . All rights reserved.</p>
				<p class="footer__note">Not AI-generated. Every plan is handcrafted.</p>
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

	</body>

</html>