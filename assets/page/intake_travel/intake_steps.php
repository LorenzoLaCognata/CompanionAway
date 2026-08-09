			<div class="intake-steps-wrap">
			
				<div class="intake-step-item">
					<div class="intake-step-dot <?php if ($i > 1) { echo ' intake-done'; } elseif ($i === 1) { echo ' intake-active'; } ?>">1</div>
					<div class="intake-step-label <?php if ($i > 1) { echo ' intake-done'; } elseif ($i === 1) { echo ' intake-active'; } ?>"><?= $translations['step_label_1'] ?></div>
				</div>

				<div class="intake-step-arrow"></div>

				<div class="intake-step-item">
					<div class="intake-step-dot <?php if ($i > 2) { echo ' intake-done'; } elseif ($i === 2) { echo ' intake-active'; } ?>">2</div>
					<div class="intake-step-label <?php if ($i > 2) { echo ' intake-done'; } elseif ($i === 2) { echo ' intake-active'; } ?>"><?= $translations['step_label_2'] ?></div>
				</div>
				
				<div class="intake-step-arrow"></div>

				<div class="intake-step-item">
					<div class="intake-step-dot <?php if ($i > 3) { echo ' intake-done'; } elseif ($i === 3) { echo ' intake-active'; } ?>">3</div>
					<div class="intake-step-label <?php if ($i > 3) { echo ' intake-done'; } elseif ($i === 31) { echo ' intake-active'; } ?>"><?= $translations['step_label_3'] ?></div>
				</div>

				<div class="intake-step-arrow"></div>

				<div class="intake-step-item">
					<div class="intake-step-dot <?php if ($i > 4) { echo ' intake-done'; } elseif ($i === 4) { echo ' intake-active'; } ?>">4</div>
					<div class="intake-step-label <?php if ($i > 4) { echo ' intake-done'; } elseif ($i === 4) { echo ' intake-active'; } ?>"><?= $translations['step_label_4'] ?></div>
				</div>

			</div>
