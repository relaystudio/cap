<?php
/**
 * The template for displaying search forms in Gentle
 *
 * @package WordPress
 * @subpackage Gentle
 * @since Gentle 1.0
 */
 
 $search = "Type something and hit enter";
?>

	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field gentle-search" name="s" id="s" value="<?php echo $search;?>" onfocus="if(this.value=='Type something and hit enter')this.value='';" onblur="if(this.value=='')this.value='Type something and hit enter';"/>
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'gentle' ); ?>"/>
	</form>
