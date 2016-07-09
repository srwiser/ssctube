<style type="text/css">

#privy-widget {
  width: 100%;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
}

#privy-widget #logo {
  text-align: center;
  padding: 25px 0;
}

#privy-widget #logo img {
  width: 200px;
}

#privy-widget form {
  margin: 25px 0;
}

#privy-widget form input {
  width: 250px;
}

#privy-widget .submit {
  margin: 0;
  margin-left: 10px;
  display: inline-block;
}

#privy-widget .submit input {
  width: 150px;
}

#privy-widget h3 {
  font-size: 18px;
}

#privy-widget .help h4 {
  margin-top: 25px;
  margin-bottom: 5px;
  font-size: 15px;
}
</style>

<div id="privy-widget">

<div class="wrap">
  <div id="logo">
    <a href="http://privy.com/" target="_blank">
      <img src="<?php echo plugins_url('assets/images/privy-logo-gray.png', dirname(__FILE__)) ?>">
    </a>
  </div>
	<h2>Privy Widget WordPress Plugin</h2>
	<form method="post" action="options.php">
  	<?php
  		settings_fields( 'privy-settings-group' );
  		do_settings_fields('Privy Website Widget Settings', 'privy-settings-group' );
  	?>
    <label>Enter your account identifier:</label><br/>
    <input type="text" name="account_identifier" value="<?php echo get_option('account_identifier'); ?>" />
  	<?php submit_button(); ?>
	</form>
  <hr/>
  <div class="help">
    <h3>Need Help? Confused?</h3>
    <div>
      <h4>I have an account but don't have a clue what you're talking about</h4> 
      Your account identifier can be found in your Privy Dashboard under <em>Account Settings > Widget Installation</em>.
      <a href="http://dashboard.privy.com/settings/widget#wordpress" target="_blank">Click here to go there now</a>
    </div>
    <div>
      <h4>I don't have a Privy account</h4> 
      <a href="http://dashboard.privy.com/users/sign_up" target="_blank">Click here to sign up</a> 
      <br/><span>Once you've signed up, grab your account identifier under <em>Account Settings > Widget Installation</em> and come back here to finish.</span>
    </div>
    <div>
      <h4>I am just really lost and need some help</h4>
      <a href="mailto:support@privy.com?subject=Help Installing Privy Widget WordPress Plugin" target="_blank">Email us</a>
      <br/> 
      We can help you get everything setup.
    </div>
  </div>
</div>

</div>