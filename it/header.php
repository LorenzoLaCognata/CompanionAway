	<body>

		<header class="site-header">

			<nav class="nav" aria-label="Main navigation">

				<a href="<?= $homeSlug ?>" class="nav-logo">
					<img src="../assets/img/logo.svg" height="44" alt="logo" />
					<span class="nav-logo__wordmark">Companion Away</span>
				</a>

				<ul class="nav-links" role="list">
					<li>
						<a href="<?= $homeSlug ?>" class="nav-links__item <?php echo ($currentPage === 'index.php') ? 'nav-links__item--active' : ''; ?>">Home</a>
					</li>
					<li>
						<a href="/<?= $lang ?>/relocation.php" class="nav-links__item <?php echo ($currentPage === 'relocation.php') ? 'nav-links__item--active' : ''; ?>">Trasferimento</a>
					</li>
					<li>
						<a href="/<?= $lang ?>/travel.php" class="nav-links__item <?php echo ($currentPage === 'travel.php') ? 'nav-links__item--active' : ''; ?>">Viaggio</a>
					</li>
					<li>
						<a href="/<?= $lang ?>/login.php" class="btn btn--ghost btn--sm <?php echo ($currentPage === 'login.php') ? 'nav-links__item--active' : ''; ?>">ACCEDI</a>
					</li>
					<li>
						<span class="nav-lang__option <?php echo ($lang === 'en') ? 'nav-lang__option--active' : ''; ?>"><a href="<?= $enSlug ?>"><span class="flag flag-us"></span> EN</a></span>
					</li>
					<li>
						<span class="nav-lang__option <?php echo ($lang === 'it') ? 'nav-lang__option--active' : ''; ?>"><a href="<?= $itSlug ?>"><span class="flag flag-it"></span> IT</a></span>
					</li>
				</ul>

				<button class="nav-burger" aria-label="Toggle navigation menu" aria-expanded="false">
					<span></span>
					<span></span>
					<span></span>
				</button>

			</nav>

		</header>

		<main>
