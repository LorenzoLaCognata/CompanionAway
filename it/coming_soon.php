<?php
	$lang = 'it';
	$currentPage = 'coming_soon.php';
?>

<?php include 'head.php'; ?>

<?php include 'header.php'; ?>

			<section class="hero" aria-labelledby="hero-heading">

				<div class="hero__left">

					<h1 class="hero__title" id="hero-heading">
						Qualcosa di<br><em>entusiasmante</em><br>sta per arrivare.
					</h1>

					<p class="hero__body">Stiamo creando qualcosa di speciale. Tornate a trovarci presto.</p>

					<a href="<?= $homeSlug ?>">← Torna alla home</a>

				</div>

				<div class="hero__right" aria-hidden="true">
					<svg class="hero__illustration"
							 viewBox="0 0 500 460"
							 preserveAspectRatio="xMidYMid slice"
							 xmlns="http://www.w3.org/2000/svg"
							 role="img"
							 aria-label="Globe inside a suitcase">

						<rect width="500" height="460" fill="#F2E4CC"/>
						<circle cx="420" cy="180" r="280" fill="#E8C9A0" opacity=".5"/>
						<circle cx="400" cy="160" r="190" fill="#E0B888" opacity=".35"/>
						<circle cx="380" cy="140" r="110" fill="#D4A870" opacity=".25"/>

						<g transform="rotate(-6 250 230)">
							<rect x="150" y="130" width="200" height="140" rx="16" fill="#1a2340"/>					
							<rect x="190" y="100" width="120" height="32" rx="8" fill="#FDF6EC" stroke="#1a2340" stroke-width="2"/>
							<circle cx="250" cy="200" r="50" fill="none" stroke="#E8A838" stroke-width="2"/>
							<line x1="200" y1="200" x2="300" y2="200" stroke="#E8A838" stroke-width="1.5"/>
							<line x1="250" y1="150" x2="250" y2="250" stroke="#E8A838" stroke-width="1.5"/>
							<ellipse cx="250" cy="200" rx="24" ry="50" fill="none" stroke="#E8A838" stroke-width="1" opacity=".5"/>
							<path d="M250 190 C250 190 240 182 240 189 C240 194 250 201 250 201 C250 201 260 194 260 189 C260 182 250 190 250 190Z" fill="#C85C3A"/>
						</g>

					</svg>
				</div>

			</section>

<?php include 'footer.php'; ?>