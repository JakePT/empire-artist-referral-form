<div class="empire-artist-referral-form">
	<form class="empire-artist-referral-form__form">
		<label for="earf-email-address" class="empire-artist-referral-form__label">
			<?php esc_html_e( 'Email address', 'empire-artist-referral-form' ); ?>
		</label>

		<input type="email" name="email_address" id="earf-email-address" class="empire-artist-referral-form__input" required>

		<input type="submit" value="<?php esc_html_e( 'Go', 'empire-artist-referral-form' ); ?>" class="empire-artist-referral-form__submit">
	</form>

	<div class="empire-artist-referral-form__messages" role="alert"></div>
</div>