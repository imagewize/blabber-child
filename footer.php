<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage BLABBER
 * @since BLABBER 1.0
 */

							// Widgets area inside page content
							blabber_create_widgets_area( 'widgets_below_content' );
							?>
						</div><!-- </.content> -->
					<?php

					// Show main sidebar
					get_sidebar();

					$blabber_body_style = blabber_get_theme_option( 'body_style' );
					?>
						
					</div><!-- </.content_wrap> -->
					<?php

					// Widgets area below page content and related posts below page content
					$blabber_widgets_name = blabber_get_theme_option( 'widgets_below_page' );
					$blabber_show_widgets = ! blabber_is_off( $blabber_widgets_name ) && is_active_sidebar( $blabber_widgets_name );
					$blabber_show_related = is_single() && blabber_get_theme_option( 'related_position' ) == 'below_page';
					if ( $blabber_show_widgets || $blabber_show_related ) {
						if ( 'fullscreen' != $blabber_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $blabber_show_related ) {
							do_action( 'blabber_action_related_posts' );
						}

						// Widgets area below page content
						if ( $blabber_show_widgets ) {
							blabber_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $blabber_body_style ) {
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Single posts banner before footer
			if ( is_singular( 'post' ) ) {
				blabber_show_post_banner('footer');
			}
			
			// Skip link anchor to fast access to the footer from keyboard
			?>
			<a id="footer_skip_link_anchor" class="blabber_skip_link_anchor" href="#"></a>
			<?php
			
			// Footer
			$blabber_footer_type = blabber_get_theme_option( 'footer_type' );
			if ( 'custom' == $blabber_footer_type && ! blabber_is_layouts_available() ) {
				$blabber_footer_type = 'default';
			}
			get_template_part( apply_filters( 'blabber_filter_get_template_part', "templates/footer-{$blabber_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

<?php
	$logo           = get_field('fs_logo', 'option');
$avs_buttons    = get_field('avs_buttons', 'option');
?>
<!-- Age Verification Modal -->
<div class="modal-verification" id="modal_verification">
  <div class="modal-data-panel">
    <div class="modal-header-panel text-center">

      <?php if (!empty(get_field('avs_header_logo', 'option'))): ?>

        <div class="modal-logo">

          <img src="<?php echo get_field('avs_header_logo', 'option'); ?>" alt="" />

        </div>

      <?php endif; ?>

      <div class="modal-header-data">

        <?php if (!empty(get_field('avs_heading', 'option'))): ?>

          <h5 style="margin-top: 0;"><?php echo get_field('avs_heading', 'option'); ?></h5>

        <?php endif; ?>

        <?php if (!empty(get_field('avs_subheading', 'option'))): ?>

          <h2 class='h1' style="margin-top: 0; margin-bottom: 10px; font-weight: 500;"><?php echo get_field('avs_subheading', 'option'); ?></h2>

        <?php endif; ?>

        <?php if (!empty(get_field('avs_description', 'option'))): ?>

          <div class="modal-header-content text-base">

            <p><?php echo get_field('avs_description', 'option'); ?></p>

          </div>

        <?php endif; ?>

      </div>
    </div>



    <div class="modal-content-panel">

      <?php if (!empty($avs_buttons)): ?>

        <div class="btn-stack">

          <?php if (!empty($avs_buttons['button_1'])): ?>
            <a href="javascript:void(0)" id="under-18" class="btn-default"><?php echo $avs_buttons['button_1']; ?></a>
          <?php endif; ?>

          <?php if (!empty($avs_buttons['button_2'])): ?>
            <a href="javascript:void(0)" id="18-23" class="btn-default"><?php echo $avs_buttons['button_2']; ?></a>
          <?php endif; ?>

          <?php if (!empty($avs_buttons['button_3'])): ?>
            <a href="javascript:void(0)" id="over-24" class="btn-default"><?php echo $avs_buttons['button_3']; ?></a>
          <?php endif; ?>

        </div>

      <?php endif; ?>

      <?php if (!empty(get_field('avs_verification_check_text', 'option'))): ?>

        <div class="verification-check">
          <div class="form-group">
            <input type="checkbox" checked="checked" name="" id="age_verify" />
            <label for="age_verify"><?php echo get_field('avs_verification_check_text', 'option'); ?></label>
          </div>
        </div>

      <?php endif; ?>

    </div>

    <?php if (!empty(get_field('avs_confirmation_text', 'option'))): ?>

      <div class="modal-bottom-text text-center">

        <p><?php echo get_field('avs_confirmation_text', 'option'); ?></p>

      </div>

    <?php endif; ?>

  </div>
</div>
<div class="modal-overlayer"></div>
<style>
.text-center {
  text-align: center !important;
}
.text-base {
  font-size: 16px;
  margin-bottom: 5px;
}
.btn-default {
  background-color: #2da7cf;
  font-weight: 600;
  border-radius: 5px;
  padding: 10px 20px;
  display: inline-block;
  text-decoration: none;
  color: #fff!important;
  transition: all ease-in-out 0.3s;
  font-size: 16px;
	cursor: pointer!important;
}

.btn-default:hover {
  background-color: rgba(45, 167, 207, 0.8);
  color: #fff;
}
.modal-overlayer {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 99999;
  background-color: rgba(45, 167, 207, 0.6);
  -webkit-backdrop-filter: blur(35px);
          backdrop-filter: blur(35px);
  transition: all ease-out 0.4s;
  opacity: 0;
  visibility: hidden;
}
.modal-overlayer.visible {
  opacity: 1;
  visibility: visible;
}
	
.modal-data-panel {
  max-width: 660px;
  width: 100%;
  background-color: #fff;
  border-radius: 10px;
  margin: auto;
  padding: 30px;
}

.modal-verification {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 999999;
  display: flex;
  align-items: center;
  opacity: 0;
  visibility: hidden;
  transition: all ease-out 0.2s;
  padding: 0 12px;
}
.modal-verification.modal-visible {
  opacity: 1;
  visibility: visible;
}
.modal-verification .modal-header-panel .modal-logo {
  max-width: 220px;
  width: 100%;
  margin: 0 auto 36px;
}
.modal-verification .modal-header-panel .modal-header-data {
  margin-bottom: 18px;
}
.modal-verification .modal-header-panel .modal-header-data h5 {
  color: #2da7cf;
  font-weight: 700;
  margin-bottom: 18px;
}
.modal-verification .modal-header-panel .modal-header-data h1 {
  color: #29324e;
  margin-bottom: 18px;
}
.modal-verification .modal-content-panel {
  margin-bottom: 18px;
}
.modal-verification .modal-content-panel .btn-stack {
  margin-bottom: 18px;
}
.modal-verification .modal-content-panel .btn-stack .btn-default {
  font-weight: 400;
}
@media (min-width: 992px) {
  .modal-verification .modal-content-panel .btn-stack .btn-default {
    padding: 20px 15px;
    font-size: 18px;
  }
}
.modal-verification .modal-content-panel .verification-check input[type=checkbox] {
  display: none;
}
.modal-verification .modal-content-panel .verification-check input[type=checkbox] + label {
  position: relative;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 10px;
  padding-left: 32px;
  padding-top: 5px;
  cursor: pointer;
}
.modal-verification .modal-content-panel .verification-check input[type=checkbox] + label:before {
  content: "";
  width: 25px;
  height: 24px;
  border-radius: 6px;
  background-color: #fff;
  border: 1px solid rgba(41, 50, 78, 0.4);
  display: inline-block;
  flex-shrink: 0;
}
.modal-verification .modal-content-panel .verification-check input[type=checkbox] + label:after {
  content: "";
  height: 24px;
  width: 25px;
/*   background-image: url("./images/check-box.svg"); */
  background-size: 12px;
  background-position: center;
  background-repeat: no-repeat;
  position: absolute;
  left: 0;
  top: 15px;
  z-index: 1;
  display: none;
  transform: translateY(-50%);
}
.modal-verification .modal-content-panel .verification-check input[type=checkbox]:checked + label::before {
  background-color: #2da7cf;
  border-color: #2da7cf!important;
}
.modal-verification .modal-content-panel .verification-check input[type=checkbox]:checked + label:after {
  display: block;
}
.modal-verification .modal-bottom-text {
  font-size: 14px;
  margin-top: 18px;
}
.btn-stack {
  display: flex;
  flex-direction: column;
  row-gap: 18px;
}
@media (max-width: 991px) {
  .btn-stack {
    row-gap: 8px;
  }
}
.btn-stack .btn-default {
  text-align: center;
}
</style>

<script>
// Age verification modal integration - only handles the modal part, not the toggle functionality
document.addEventListener('DOMContentLoaded', function() {
  // Modal elements
  var modal = document.querySelector('.modal-verification');
  var overlay = document.querySelector('.modal-overlayer');
  var ageVerifyCheck = document.querySelector('#age_verify');
  
  // Helper functions - using different names to avoid conflicts
  function setAgeCookie(name, value, days) {
    var expires = '';
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
  }

  function getAgeCookie(name) {
    var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
    return match ? match[3] : null;
  }
  
  function closeModal() {
    if (modal) {
      modal.classList.remove('modal-visible');
      overlay.classList.remove('visible');
      document.body.classList.remove('overflow-hidden');
    }
  }
  
  // Only handle ad visibility through the toggle button in ad-toggle.js
  function updateToggleButton(checked) {
    var toggleBtn = document.getElementById('toggle_inputAds');
    if (toggleBtn) {
      toggleBtn.checked = checked;
      // Trigger a change event for the slider toggle
      var event = new Event('change');
      toggleBtn.dispatchEvent(event);
    }
  }
  
  // Show modal if no cookie is set
  if (!getAgeCookie('canSeeAds') && modal) {
    modal.classList.add('modal-visible');
    overlay.classList.add('visible');
  }
  
  // Age verification button handlers - only set cookie and update toggle button
  var ageButtons = ['under-18', '18-23'];
  ageButtons.forEach(function(id) {
    var button = document.getElementById(id);
    if (button) {
      button.addEventListener('click', function() {
        setAgeCookie('canSeeAds', 'false', 1);
        closeModal();
        updateToggleButton(true);
        // Let ad-toggle.js handle the actual hiding/showing
      });
    }
  });
  
  var over24Button = document.getElementById('over-24');
  if (over24Button && ageVerifyCheck) {
    over24Button.addEventListener('click', function() {
      var showAds = ageVerifyCheck.checked ? 'true' : 'false';
      setAgeCookie('canSeeAds', showAds, 365);
      closeModal();
      updateToggleButton(showAds === 'false');
      // Let ad-toggle.js handle the actual hiding/showing
    });
  }
});
</script>
	<?php wp_footer(); ?>

</body>
</html>
