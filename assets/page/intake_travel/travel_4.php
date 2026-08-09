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
							<div class="intake-summary-card-title"><?= $translations['summary_card_travel_title'] ?></div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_travel_destination']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars(trim(($_SESSION['data']['travelDest'] ?? ''))) ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_travel_dates']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['travelDates'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_travel_length']) ?></span>
								<span class="intake-summary-val"><?=  match($_SESSION['data']['tripLength']) {
																		'1' => $translations['travel_length_weekend'],
																		'2' => $translations['travel_length_short'],
																		'3' => $translations['travel_length_2weeks'],
																		'0' => $translations['travel_length_unsure'],
																		default => ''
																	  } ?> </span>
							</div>
						</div>

						<div class="intake-summary-card">
							<div class="intake-summary-card-title"><?= $translations['summary_card_profile_title'] ?></div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_profile_first_time']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['firstTime'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_profile_group']) ?></span>
								<span class="intake-summary-val"><?= match($_SESSION['data']['travelGroup']) {
																		'solo' => $translations['travel_group_solo'],
																		'couple' => $translations['travel_group_couple'],
																		'friends' => $translations['travel_group_friends'],
																		'family_young' => $translations['travel_group_family_young'],
																		'family_teen' => $translations['travel_group_family_teen'],
																		'mixed' => $translations['travel_group_mixed'],
																		default => ''
																	  } ?></span>
							</div>

							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_profile_daily_budget']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['travelBudget'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_profile_pace']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['pace'] ?? '') ?></span>
							</div>
						</div>

						<div class="intake-summary-card">					
							<div class="intake-summary-card-title"><?= $translations['summary_card_style_title'] ?></div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_style_style']) ?></span>
								<span class="intake-summary-val"><?= checked_labels_style($_SESSION['data'], 'travelStyle', $translations) ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_style_logistics']) ?></span>
								<span class="intake-summary-val"><?= checked_labels_transport($_SESSION['data'], 'transport', $translations) ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_style_accomodation']) ?></span>
								<span class="intake-summary-val"><?= checked_labels_accommodation($_SESSION['data'], 'accommodation', $translations) ?></span>
							</div>
						</div>

						<div class="intake-summary-card">					
							<div class="intake-summary-card-title"><?= $translations['summary_card_requests_title'] ?></div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_requests_chronotype']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['chronotype'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_requests_booking']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['bookingStyle'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_requests_occasion']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['specialOccasion'] ?? '') ?></span>
							</div>
							<div class="intake-summary-item">
								<span class="intake-summary-key"><?= htmlspecialchars($translations['summary_card_requests_accessibility']) ?></span>
								<span class="intake-summary-val"><?= htmlspecialchars($_SESSION['data']['accessibility'] ?? '') ?></span>
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
