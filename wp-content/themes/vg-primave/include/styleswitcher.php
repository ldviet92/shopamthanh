<?php
$primave_options  = primave_get_global_variables(); 

//Style Switcher
function primave_style_switcher() { ?>
    <div class="style-switcher hidden-xs hidden-sm hidden-md">
		<div class="stoggler"><i class="fa fa-cog"></i></div>
		<div class="spanel">
			<h2><?php esc_html_e('Style Switcher', 'vg-primave'); ?></h2>
			<form name="styleswitcher" action="<?php echo esc_url(home_url('/')); ?>" method="post">
				<div class="layout">
					<select name="slayout" class="slayout">
						<option value=""><?php esc_html_e('-- Select Layout --', 'vg-primave'); ?></option>
						<option value="full"><?php esc_html_e('Full Width', 'vg-primave'); ?></option>
						<option value="box"><?php esc_html_e('Box', 'vg-primave'); ?></option>
					</select>
				</div>
				<div class="bg-color">
					<h3><?php esc_html_e('Background Color', 'vg-primave'); ?></h3>
					<ul id="bgsolid" class="colors bgsolid">
						<li><a title="Green" class="green-bg" href="#"></a></li>
						<li><a title="Blue" class="blue-bg" href="#"></a></li>
						<li><a title="Orange" class="orange-bg" href="#"></a></li>
						<li><a title="Navy" class="navy-bg" href="#"></a></li>
						<li><a title="Yellow" class="yellow-bg" href="#"></a></li>
						<li><a title="Peach" class="peach-bg" href="#"></a></li>
						<li><a title="Beige" class="beige-bg" href="#"></a></li>
						<li><a title="Purple" class="purple-bg" href="#"></a></li>
						<li><a title="Red" class="red-bg" href="#"></a></li>
						<li><a title="Pink" class="pink-bg" href="#"></a></li>
						<li><a title="Celadon" class="celadon-bg" href="#"></a></li>
						<li><a title="Brown" class="brown-bg" href="#"></a></li>
						<li><a title="Cherry" class="cherry-bg" href="#"></a></li>
						<li><a title="Cyan" class="cyan-bg" href="#"></a></li>
						<li><a title="Gray" class="gray-bg" href="#"></a></li>
						<li><a title="Dark" class="dark-bg" href="#"></a></li>
					</ul>
				</div>
				<div class="bg-image">
					<h3><?php esc_html_e('Background Image', 'vg-primave'); ?></h3>
					<ul id="bg" class="colors bg">
						<li><a class="bg0" href="#"></a></li>
						<li><a class="bg1" href="#"></a></li>
						<li><a class="bg2" href="#"></a></li>
						<li><a class="bg3" href="#"></a></li>
						<li><a class="bg4" href="#"></a></li>
						<li><a class="bg5" href="#"></a></li>
						<li><a class="bg6" href="#"></a></li>
						<li><a class="bg7" href="#"></a></li>
						<li><a class="bg8" href="#"></a></li>
						<li><a class="bg9" href="#"></a></li>
						<li><a class="bg10" href="#"></a></li>
						<li><a class="bg11" href="#"></a></li>
						<li><a class="bg12" href="#"></a></li>
						<li><a class="bg13" href="#"></a></li>
						<li><a class="bg14" href="#"></a></li>
						<li><a class="bg15" href="#"></a></li>
						<li><a class="bg16" href="#"></a></li>
						<li><a class="bg17" href="#"></a></li>
						<li><a class="bg18" href="#"></a></li>
						<li><a class="bg19" href="#"></a></li>
						<li><a class="bg20" href="#"></a></li>
						<li><a class="bg21" href="#"></a></li>
						<li><a class="bg22" href="#"></a></li>
						<li><a class="bg23" href="#"></a></li>
						<li><a class="bg24" href="#"></a></li>
						<li><a class="bg25" href="#"></a></li>
						<li><a class="bg26" href="#"></a></li>
						<li><a class="bg27" href="#"></a></li>
						<li><a class="bg28" href="#"></a></li>
						<li><a class="bg29" href="#"></a></li>
						<li><a class="bg30" href="#"></a></li>
					</ul>
				</div>
				<button type="button" id="resetpreview" class="btn btn-primary"><?php esc_html_e('Reset', 'vg-primave'); ?></button>
			</form>
		</div>
	</div>
<?php
}
if(isset($primave_options['enable_sswitcher'])) {
	if($primave_options['enable_sswitcher']) {
		add_action('wp_footer', 'primave_style_switcher');
	}
}
?>