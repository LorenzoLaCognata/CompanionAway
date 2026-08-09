				<form method="post" action="<?= $currentPage . '?step=' . $i ?>">
					<input type="hidden" name="from" value="2">
					<h2 class="intake-section-title"><?= $translations['travel_title_plain'] ?> <em><?= $translations['travel_title_em'] ?></em></h2>
					<p class="intake-section-desc"><?= $translations['travel_desc'] ?></p>

					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['travel_dest_label'] ?></label><input type="text" name="travelDest" value="<?= $_SESSION['data']['travelDest'] ?>" placeholder="<?= $translations['travel_dest_placeholder'] ?>" required></div>
						<div class="intake-field"><label><?= $translations['travel_dates_label'] ?></label><input type="text" name="travelDates" value="<?= $_SESSION['data']['travelDates'] ?>" placeholder="<?= $translations['travel_dates_placeholder'] ?>"></div>

					</div>

					<div class="intake-form-row">

						<div class="intake-field"><label><?= $translations['travel_length_label'] ?></label>
							<select name="tripLength" required>
								<option value=""><?= $translations['travel_length_select'] ?></option>
								<option value="1"<?= $_SESSION['data']['tripLength'] === '1' ? ' selected' : '' ?>><?= $translations['travel_length_weekend'] ?></option>
								<option value="2"<?= $_SESSION['data']['tripLength'] === '2' ? ' selected' : '' ?>><?= $translations['travel_length_short'] ?></option>
								<option value="3"<?= $_SESSION['data']['tripLength'] === '3' ? ' selected' : '' ?>><?= $translations['travel_length_2weeks'] ?></option>
								<option value="0"<?= $_SESSION['data']['tripLength'] === '0' ? ' selected' : '' ?>><?= $translations['travel_length_unsure'] ?></option>
							</select>
						</div>

						<div class="intake-field"><label><?= $translations['travel_firsttime_label'] ?></label>
							<select name="firstTime" required>
								<option value=""><?= $translations['travel_firsttime_select'] ?></option>
								<option<?= $_SESSION['data']['firstTime'] === htmlspecialchars($translations['travel_firsttime_yes'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_firsttime_yes'] ?></option>
								<option<?= $_SESSION['data']['firstTime'] === htmlspecialchars($translations['travel_firsttime_no'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_firsttime_no'] ?></option>
								<option<?= $_SESSION['data']['firstTime'] === htmlspecialchars($translations['travel_firsttime_living'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_firsttime_living'] ?></option>
							</select>
						</div>

					</div>

					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['travel_group_label'] ?></label>
							<select name="travelGroup" required>
								<option value=""><?= $translations['travel_group_select'] ?></option>
								<option value="solo"<?= $_SESSION['data']['travelGroup'] === 'solo' ? ' selected' : '' ?>><?= $translations['travel_group_solo'] ?></option>
								<option value="couple"<?= $_SESSION['data']['travelGroup'] === 'couple' ? ' selected' : '' ?>><?= $translations['travel_group_couple'] ?></option>
								<option value="friends"<?= $_SESSION['data']['travelGroup'] === 'friends' ? ' selected' : '' ?>><?= $translations['travel_group_friends'] ?></option>
								<option value="family_young"<?= $_SESSION['data']['travelGroup'] === 'family_young' ? ' selected' : '' ?>><?= $translations['travel_group_family_young'] ?></option>
								<option value="family_teen"<?= $_SESSION['data']['travelGroup'] === 'family_teen' ? ' selected' : '' ?>><?= $translations['travel_group_family_teen'] ?></option>
								<option value="mixed"<?= $_SESSION['data']['travelGroup'] === 'mixed' ? ' selected' : '' ?>><?= $translations['travel_group_mixed'] ?></option>
							</select>
						</div>
						<?php $needs_size = in_array($_SESSION['data']['travelGroup'] ?? '', ['friends','family_young','family_teen','mixed'], true); ?>
						<div class="intake-field<?= !$needs_size ? ' intake-hidden' : '' ?>">
							<label><?= $translations['travel_groupsize_label'] ?></label>
							<input type="number" name="groupSize" value="<?= $_SESSION['data']['groupSize'] ?>" placeholder="<?= $translations['travel_groupsize_placeholder'] ?>" min="2" max="20">
						</div>
					</div>

					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['travel_budget_label'] ?></label>
							<select name="travelBudget" required>
								<option value=""><?= $translations['travel_budget_select'] ?></option>
								<option<?= $_SESSION['data']['travelBudget'] === htmlspecialchars($translations['travel_budget_under100'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_budget_under100'] ?></option>
								<option<?= $_SESSION['data']['travelBudget'] === htmlspecialchars($translations['travel_budget_under100'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_budget_100_200'] ?></option>
								<option<?= $_SESSION['data']['travelBudget'] === htmlspecialchars($translations['travel_budget_under100'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_budget_200_400'] ?></option>
								<option<?= $_SESSION['data']['travelBudget'] === htmlspecialchars($translations['travel_budget_under100'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_budget_flexible'] ?></option>
							</select>
						</div>
						<div class="intake-field"><label><?= $translations['travel_pace_label'] ?></label>
							<select name="pace" required>
								<option value=""><?= $translations['travel_pace_select'] ?></option>
								<option<?= $_SESSION['data']['pace'] === htmlspecialchars($translations['travel_pace_packed'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_pace_packed'] ?></option>
								<option<?= $_SESSION['data']['pace'] === htmlspecialchars($translations['travel_pace_balanced'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_pace_balanced'] ?></option>
								<option<?= $_SESSION['data']['pace'] === htmlspecialchars($translations['travel_pace_relaxed'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_pace_relaxed'] ?></option>
							</select>
						</div>
					</div>

					<p class="intake-field-group-title"><?= $translations['travel_style_title'] ?></p>
					<div class="intake-field">
						<label><?= $translations['travel_style_label'] ?></label>
						<div class="intake-check-group">
							<label class="intake-check-option"><input type="checkbox" name="travelStyle[]" value="slow"<?= is_checked('travelStyle', 'slow') ? ' checked' : '' ?>><span><?= $translations['travel_style_slow'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="travelStyle[]" value="mix"<?= is_checked('travelStyle', 'mix') ? ' checked' : '' ?>><span><?= $translations['travel_style_mix'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="travelStyle[]" value="food"<?= is_checked('travelStyle', 'food') ? ' checked' : '' ?>><span><?= $translations['travel_style_food'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="travelStyle[]" value="active"<?= is_checked('travelStyle', 'active') ? ' checked' : '' ?>><span><?= $translations['travel_style_active'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="travelStyle[]" value="art"<?= is_checked('travelStyle', 'art') ? ' checked' : '' ?>><span><?= $translations['travel_style_art'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="travelStyle[]" value="offbeat"<?= is_checked('travelStyle', 'offbeat') ? ' checked' : '' ?>><span><?= $translations['travel_style_offbeat'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="travelStyle[]" value="comfort"<?= is_checked('travelStyle', 'comfort') ? ' checked' : '' ?>><span><?= $translations['travel_style_comfort'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="travelStyle[]" value="nightlife"<?= is_checked('travelStyle', 'nightlife') ? ' checked' : '' ?>><span><?= $translations['travel_style_nightlife'] ?></span></label>
						</div>
					</div>

					<p class="intake-field-group-title"><?= $translations['travel_logistics_title'] ?></p>
					<div class="intake-field">
						<label><?= $translations['travel_transport_label'] ?></label>
						<div class="intake-check-group">
							<label class="intake-check-option"><input type="checkbox" name="transport[]" value="car"<?= is_checked('transport', 'car') ? ' checked' : '' ?>><span><?= $translations['travel_transport_car'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="transport[]" value="own_car"<?= is_checked('transport', 'own_car') ? ' checked' : '' ?>><span><?= $translations['travel_transport_owncar'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="transport[]" value="public"<?= is_checked('transport', 'public') ? ' checked' : '' ?>><span><?= $translations['travel_transport_public'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="transport[]" value="walking"<?= is_checked('transport', 'walking') ? ' checked' : '' ?>><span><?= $translations['travel_transport_walking'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="transport[]" value="rideshare"<?= is_checked('transport', 'rideshare') ? ' checked' : '' ?>><span><?= $translations['travel_transport_rideshare'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="transport[]" value="train"<?= is_checked('transport', 'train') ? ' checked' : '' ?>><span><?= $translations['travel_transport_train'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="transport[]" value="flight"<?= is_checked('transport', 'flight') ? ' checked' : '' ?>><span><?= $translations['travel_transport_flight'] ?></span></label>
							<label class="intake-check-option"><input type="checkbox" name="transport[]" value="mix"<?= is_checked('transport', 'mix') ? ' checked' : '' ?>><span><?= $translations['travel_transport_mix'] ?></span></label>
						</div>
					</div>

					<div class="intake-form-row intake-full intake-mt">
						<div class="intake-field"><label><?= $translations['travel_accommodation_label'] ?></label>
							<div class="intake-check-group">
								<label class="intake-check-option"><input type="checkbox" name="accommodation[]" value="hotels"<?= is_checked('accommodation', 'hotels') ? ' checked' : '' ?>><span><?= $translations['travel_accommodation_hotels'] ?></span></label>
								<label class="intake-check-option"><input type="checkbox" name="accommodation[]" value="airbnb"<?= is_checked('accommodation', 'airbnb') ? ' checked' : '' ?>><span><?= $translations['travel_accommodation_airbnb'] ?></span></label>
								<label class="intake-check-option"><input type="checkbox" name="accommodation[]" value="boutique"<?= is_checked('accommodation', 'boutique') ? ' checked' : '' ?>><span><?= $translations['travel_accommodation_boutique'] ?></span></label>
								<label class="intake-check-option"><input type="checkbox" name="accommodation[]" value="budget"<?= is_checked('accommodation', 'budget') ? ' checked' : '' ?>><span><?= $translations['travel_accommodation_budget'] ?></span></label>
								<label class="intake-check-option"><input type="checkbox" name="accommodation[]" value="glamping"<?= is_checked('accommodation', 'glamping') ? ' checked' : '' ?>><span><?= $translations['travel_accommodation_glamping'] ?></span></label>
								<label class="intake-check-option"><input type="checkbox" name="accommodation[]" value="mix"<?= is_checked('accommodation', 'mix') ? ' checked' : '' ?>><span><?= $translations['travel_accommodation_mix'] ?></span></label>
							</div>
						</div>
					</div>

					<div class="intake-form-row">
						<div class="intake-field"><label><?= $translations['travel_chronotype_label'] ?></label>
							<select name="chronotype">
								<option value=""><?= $translations['travel_chronotype_select'] ?></option>
								<option<?= $_SESSION['data']['chronotype'] === htmlspecialchars($translations['travel_chronotype_early'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_chronotype_early'] ?></option>
								<option<?= $_SESSION['data']['chronotype'] === htmlspecialchars($translations['travel_chronotype_balanced'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_chronotype_balanced'] ?></option>
								<option<?= $_SESSION['data']['chronotype'] === htmlspecialchars($translations['travel_chronotype_night'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_chronotype_night'] ?></option>
							</select>
						</div>
						<div class="intake-field"><label><?= $translations['travel_booking_label'] ?></label>
							<select name="bookingStyle">
								<option value=""><?= $translations['travel_booking_select'] ?></option>
								<option<?= $_SESSION['data']['bookingStyle'] === htmlspecialchars($translations['travel_booking_prebooked'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_booking_prebooked'] ?></option>
								<option<?= $_SESSION['data']['bookingStyle'] === htmlspecialchars($translations['travel_booking_mix'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_booking_mix'] ?></option>
								<option<?= $_SESSION['data']['bookingStyle'] === htmlspecialchars($translations['travel_booking_spontaneous'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['travel_booking_spontaneous'] ?></option>
							</select>
						</div>
					</div>

					<div class="intake-form-row intake-full">
						<div class="intake-field"><label><?= $translations['travel_occasion_label'] ?></label>
							<input type="text" name="specialOccasion" value="<?= $_SESSION['data']['specialOccasion'] ?>" placeholder="<?= $translations['travel_occasion_placeholder'] ?>">
						</div>
					</div>
					<div class="intake-form-row intake-full">
						<div class="intake-field"><label><?= $translations['travel_accessibility_label'] ?></label>
							<input type="text" name="accessibility" value="<?= $_SESSION['data']['accessibility'] ?>" placeholder="<?= $translations['travel_accessibility_placeholder'] ?>">
						</div>
					</div>

					<div class="intake-nav-row">
						<button class="intake-btn-back" type="submit" name="action" value="prev"><?= $translations['btn_back'] ?></button>
						<span class="intake-step-count"></span>
						<button class="intake-btn-next" type="submit" name="action" value="next"><?= $translations['btn_continue'] ?></button>
					</div>

				</form>

				<script>
					document.querySelector('[name="travelGroup"]').addEventListener('change', function() {
						const needs = ['friends','family_young','family_teen','mixed'].includes(this.value);
						document.querySelector('[name="groupSize"]').closest('.intake-field').classList.toggle('intake-hidden', !needs);
					});
				</script>
