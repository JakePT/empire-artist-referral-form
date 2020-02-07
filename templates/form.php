<div class="empire-artist-referral-form">
	<form class="empire-artist-referral-form__form">
		<label for="earf-email-address" class="empire-artist-referral-form__label screen-reader-text">
			<?php esc_html_e( 'Email address', 'empire-artist-referral-form' ); ?>
		</label>

		<input type="email" name="email_address" id="earf-email-address" class="empire-artist-referral-form__input" placeholder="<?php esc_attr_e( 'Email address', 'empire-artist-referral-form' ); ?>" required>

		<input type="submit" value="<?php esc_html_e( 'Go', 'empire-artist-referral-form' ); ?>" class="empire-artist-referral-form__submit" disabled>
	</form>

	<div class="empire-artist-referral-form__messages" role="alert">
		<noscript>
			<p><?php esc_html_e( 'Please enable JavaScript to use this form.', 'empire-artist-referral-form' ); ?></p>
		</noscript>
	</div>
</div>