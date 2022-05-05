<?php
/**
 * Settings class
 *
 * @package PLUGIN_PACKAGE
 */

namespace PLUGIN_PACKAGE\Admin;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Settings
 */
class Settings {

	/**
	 * Settings key
	 *
	 * @var string
	 */
	public static $settings_key = 'FUNCTION_PREFIX';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Admin menu
	 */
	public function admin_menu() {
		add_submenu_page(
			'options-general.php',
			__( 'PLUGIN_NAME Settings', 'PLUGIN_TEXT_DOMAIN' ),
			__( 'PLUGIN_NAME', 'PLUGIN_TEXT_DOMAIN' ),
			'manage_options',
			'PLUGIN_TEXT_DOMAIN-settings',
			array( $this, 'settings_page' )
		);
	}

	/**
	 * Register settings
	 */
	public function register_settings() {
		register_setting(
			self::$settings_key,
			self::$settings_key
		);

		foreach ( \PLUGIN_PACKAGE\Core\Settings::get_sections() as $key => $section ) {
			add_settings_section(
				self::$settings_key . '_' . $key,
				$section['title'],
				array( $this, 'settings_section' ),
				self::$settings_key
			);
		}

		foreach ( \PLUGIN_PACKAGE\Core\Settings::get_settings() as $key => $setting ) {
			$options = array(
				'label_for' => $key,
			);

			$options = array_merge( $options, $setting );

			add_settings_field(
				$key,
				! empty( $setting['title'] ) ? $setting['title'] : false,
				array( $this, 'settings_field' ),
				self::$settings_key,
				self::$settings_key . '_' . $setting['section'],
				$options
			);
		}
	}

	/**
	 * Settings section
	 *
	 * @param array $args Section arguments.
	 */
	public function settings_section( $args ) {
	}

	/**
	 * Settings field
	 *
	 * @param array $args Field arguments.
	 */
	public function settings_field( $args ) {
		switch ( $args['type'] ) {
			case 'html':
				echo wp_kses(
					$args['html'],
					array(
						'strong' => array(),
						'a'      => array(
							'href'   => array(),
							'target' => array(),
							'class'  => array(),
							'rel'    => array(),
						),
						'em'     => array(),
						'code'   => array(),
						'h1'     => array(
							'style' => array(),
						),
						'h2'     => array(
							'style' => array(),
						),
						'h3'     => array(
							'style' => array(),
						),
						'h4'     => array(
							'style' => array(),
						),
						'h5'     => array(
							'style' => array(),
						),
						'h6'     => array(
							'style' => array(),
						),
					)
				);
				break;
			case 'textarea':
				?>
				<textarea
					id="<?php echo esc_attr( $args['label_for'] ); ?>"
					name="<?php echo esc_attr( self::$settings_key ); ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
					rows="5"
					<?php if ( ! empty( $args['field_class'] ) ) : ?>
						class="<?php echo esc_attr( $args['field_class'] ); ?>"
					<?php endif; ?>
					<?php if ( ! empty( $args['placeholder'] ) ) : ?>
						placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>"
					<?php endif; ?>
				><?php if ( ! empty( $args['value'] ) ) : ?><?php echo trim( esc_attr( $args['value'] ) ); ?><?php endif; ?></textarea>
				<?php
				break;
			case 'url':
			case 'text':
			case 'password':
			case 'number':
			case 'email':
				?>
				<input
					id="<?php echo esc_attr( $args['label_for'] ); ?>"
					name="<?php echo esc_attr( self::$settings_key ); ?>[<?php echo esc_attr( $args['label_for'] ); ?>]"
					type="<?php echo esc_attr( $args['type'] ); ?>"
					<?php if ( ! empty( $args['value'] ) ) : ?>
						value="<?php echo esc_attr( $args['value'] ); ?>"
					<?php endif; ?>
					<?php if ( ! empty( $args['field_class'] ) ) : ?>
						class="<?php echo esc_attr( $args['field_class'] ); ?>"
					<?php endif; ?>
					<?php if ( ! empty( $args['placeholder'] ) ) : ?>
						placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>"
					<?php endif; ?>
					<?php if ( ! empty( $args['min'] ) ) : ?>
						min="<?php echo esc_attr( $args['min'] ); ?>"
					<?php endif; ?>
					<?php if ( ! empty( $args['max'] ) ) : ?>
						max="<?php echo esc_attr( $args['max'] ); ?>"
					<?php endif; ?>
					<?php if ( ! empty( $args['step'] ) ) : ?>
						step="<?php echo esc_attr( $args['step'] ); ?>"
					<?php endif; ?>
				/>
				<?php
				break;
			case 'select':
				if ( empty( $args['options'] ) ) {
					return;
				}

				$name = self::$settings_key . '[' . esc_attr( $args['label_for'] ) . ']';
				if ( ! empty( $args['multiple'] ) ) :
					$name = self::$settings_key . '[' . esc_attr( $args['label_for'] ) . '][]';
				endif;
				?>
				<select
					id="<?php echo esc_attr( $args['label_for'] ); ?>"
					name="<?php echo esc_attr( $name ); ?>"
					<?php if ( ! empty( $args['multiple'] ) ) : ?>
						multiple
					<?php endif; ?>
					<?php if ( ! empty( $args['field_class'] ) ) : ?>
						class="<?php echo esc_attr( $args['field_class'] ); ?>"
					<?php endif; ?>
				>
						<?php
						foreach ( $args['options'] as $key => $label ) :
							$selected = false;
							if ( ! empty( $args['value'] ) && ! empty( $args['multiple'] ) && is_array( $args['value'] ) ) :
								if ( in_array( $key, $args['value'], true ) ) :
									$selected = true;
								endif;
							else :
								if ( ! empty( $args['value'] ) && $args['value'] == $key ) {
									$selected = true;
								}
							endif;
							?>
							<option
								value="<?php echo esc_attr( $key ); ?>"
								<?php if ( $selected ) : ?>
									selected="selected"
								<?php endif; ?>
							>
								<?php echo esc_html( $label ); ?>
							</option>
						<?php endforeach; ?>
				</select>
				<?php
				break;
			case 'checkbox':
			case 'radio':
				if ( empty( $args['options'] ) ) {
					return;
				}

				foreach ( $args['options'] as $key => $label ) {
					$selected = false;
					$name     = self::$settings_key . '[' . esc_attr( $args['label_for'] ) . ']';
					if ( count( $args['options'] ) > 1 && 'checkbox' === $args['type'] ) {
						$name .= '[' . esc_attr( $key ) . ']';
					}

					if ( ! empty( $args['value'] ) && $args['value'] == $key ) {
						$selected = true;
					}

					?>
					<label for="<?php echo esc_attr( $args['label_for'] . $key ); ?>">
						<input
							type="<?php echo esc_attr( $args['type'] ); ?>"
							id="<?php echo esc_attr( $args['label_for'] . $key ); ?>"
							name="<?php echo esc_attr( $name ); ?>"
							value="<?php echo esc_attr( $key ); ?>"
							<?php if ( ! empty( $args['field_class'] ) ) : ?>
								class="<?php echo esc_attr( $args['field_class'] ); ?>"
							<?php endif; ?>
							<?php if ( $selected ) : ?>
								checked="checked"
							<?php endif; ?>
						/>
						<?php
						echo wp_kses(
							$label,
							array(
								'a' => array(
									'target' => array(),
									'href'   => array(),
									'class'  => array(),
									'rel'    => array(),
								),
								'strong' => array(),
								'b'      => array(),
								'code'   => array(),
							)
						);
						?>
					</label><br />
				<?php
				}
				break;
		}

		if ( ! empty( $args['suffix'] ) ) {
			echo wp_kses(
				$args['suffix'],
				array(
					'a' => array(
						'target' => array(),
						'href'   => array(),
						'class'  => array(),
						'rel'    => array(),
					),
					'strong' => array(),
					'b'      => array(),
					'code'   => array(),
				)
			);
		}

		if ( ! empty( $args['desc'] ) ) {
			echo '<p class="description">' . wp_kses(
				$args['desc'],
				array(
					'a'      => array(
						'target' => array(),
						'href'   => array(),
						'class'  => array(),
						'rel'    => array(),
					),
					'strong' => array(),
					'b'      => array(),
					'code'   => array(),
				)
			) . '</p>';
		}
	}

	/**
	 * Settings page
	 */
	public function settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$base_admin_link = 'options-general.php?page=PLUGIN_TEXT_DOMAIN-settings';
		// @codingStandardsIgnoreLine
		$current_tab = ! empty( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : 'settings';
		$admin_tabs  = array(
			'settings' => array(
				'title'    => __( 'Settings', 'PLUGIN_TEXT_DOMAIN' ),
				'template' => 'settings',
			),
		);
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<nav class="nav-tab-wrapper" style="margin-bottom: 16px;">
				<?php
				foreach ( $admin_tabs as $key => $tab ) :
					$admin_url = admin_url( $base_admin_link . '&amp;tab=' . $key );
					$classes   = array( 'nav-tab' );

					if ( $current_tab === $key ) :
						$classes[] = 'nav-tab-active';
					endif;
					?>
					<a
						href="<?php echo esc_url( $admin_url ); ?>"
						class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
					>
						<?php echo esc_html( $tab['title'] ); ?>
					</a>
				<?php endforeach; ?>
			</nav>

			<?php require PLUGIN_CONSTANT_PATH . 'admin/templates/' . $admin_tabs[ $current_tab ]['template'] . '.php'; ?>
		</div>
		<?php
	}
}
