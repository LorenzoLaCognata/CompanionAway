				<form method="post" action="<?= $currentPage . '?step=' . $i ?>">

					<input type="hidden" name="from" value="3">
					<h2 class="intake-section-title"><?= $translations['final_title_plain'] ?> <em><?= $translations['final_title_em'] ?></em></h2>
					<p class="intake-section-desc"><?= $translations['final_desc'] ?></p>

					<div class="intake-form-row intake-full">
						<div class="intake-field"><label><?= $translations['final_howfound_label'] ?></label>
							<select name="howFound" required>
								<option value=""><?= $translations['final_howfound_select'] ?></option>
								<option<?= $_SESSION['data']['howFound'] === htmlspecialchars($translations['final_howfound_recommendation'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['final_howfound_recommendation'] ?></option>
								<option<?= $_SESSION['data']['howFound'] === htmlspecialchars($translations['final_howfound_facebook'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['final_howfound_facebook'] ?></option>
								<option<?= $_SESSION['data']['howFound'] === htmlspecialchars($translations['final_howfound_reddit'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['final_howfound_reddit'] ?></option>
								<option<?= $_SESSION['data']['howFound'] === htmlspecialchars($translations['final_howfound_social'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['final_howfound_social'] ?></option>
								<option<?= $_SESSION['data']['howFound'] === htmlspecialchars($translations['final_howfound_google'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['final_howfound_google'] ?></option>
								<option<?= $_SESSION['data']['howFound'] === htmlspecialchars($translations['final_howfound_community'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['final_howfound_community'] ?></option>
								<option<?= $_SESSION['data']['howFound'] === htmlspecialchars($translations['final_howfound_other'], ENT_QUOTES) ? ' selected' : '' ?>><?= $translations['final_howfound_other'] ?></option>
							</select>
						</div>
					</div>
					<div class="intake-form-row intake-full">
						<div class="intake-field"><label><?= $translations['final_notes_label'] ?></label>
							<textarea name="finalNotes" placeholder="<?= $translations['final_notes_placeholder'] ?>"><?= $_SESSION['data']['finalNotes'] ?></textarea>
						</div>
					</div>

					<div class="intake-nav-row">
						<button class="intake-btn-back" type="submit" name="action" value="prev"><?= $translations['btn_back'] ?></button>
						<span class="intake-step-count"></span>
						<button class="intake-btn-next" type="submit" name="action" value="next"><?= $translations['btn_continue'] ?></button>
					</div>

				</form>
