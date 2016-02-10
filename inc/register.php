<?php
/**
 * regg in.
 */

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}

// Check if form is submitted
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	// Clean user's input
	$firstname = clean_input( $_POST['fname'] );
	$lastname = clean_input( $_POST['lname'] );
	$username = clean_input( $_POST['uname'] );
	$password = clean_input( $_POST['pass'] );
	$cpassword = clean_input( $_POST['cpass'] );
	$email = clean_input( $_POST['email'] );
	$gender = clean_input( $_POST['gender'] );
	$birthday = clean_input( $_POST['birthday'] );
	$country = clean_input( $_POST['country'] );

	$user->register( $firstname, $lastname, $username, $password, $cpassword, $email, $gender = '', $birthday, $country );
}

require_once( ABSPATH . 'header.php' );
?>
<div class="container" >

	<?php if ( is_logged() ) { show_message('You are already logged in, logout then click Register.', true); } ?>

	<form action="" method="post" class="action-form">
		<p class="form-control">
			<label for="reg-fname">First name</label>
			<input id="reg-fname" class="box-input" type="text" name="fname">
		</p>
		<p class="form-control">
			<label for="reg-lname">Last name</label>
			<input id="reg-lname" class="box-input" type="text" name="lname">
		</p>
		<p class="form-control">
			<label for="reg-uname">Username</label>
			<input id="reg-uname" class="box-input" type="text" name="uname">
		</p>
		<p class="form-control">
			<label for="reg-pass">Password</label>
			<input id="reg-pass" class="box-input" type="password" name="pass">
		</p>
		<p class="form-control">
			<label for="reg-cpass">Confirm password</label>
			<input id="reg-cpass" class="box-input" type="password" name="cpass">
		</p>
		<p class="form-control">
			<label for="reg-email">Email</label>
			<input id="reg-email" class="box-input" type="text" name="email">
		</p>
		<p class="form-control">
			<label for="reg-gender">Gender</label>
			<select id="reg-gender" class="box-select" name="gender">
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>
		</p>
		<p class="form-control">
			<label for="reg-dob">Birthday</label>
			<input id="reg-birthday" class="box-input" type="date" name="birthday">
		</p>
		<p class="form-control">
			<label for="reg-country">Country</label>
			<select id="reg-country" class="box-select"name="country">
	    <option>Afghanistan</option>
	    <option>Albania</option>
	    <option>Algeria</option>
	    <option>Andorra</option>
	    <option>Angola</option>
	    <option>Antigua and Barbuda</option>
	    <option>Argentina</option>
	    <option>Armenia</option>
	    <option>Australia</option>
	    <option>Austria</option>
	    <option>Azerbaijan</option>
	    <optgroup>B</optgroup>
	
	    <option>Bahrain</option>
	    <option>Bangladesh</option>
	    <option>Barbados</option>
	    <option>Belarus</option>
	    <option>Belgium</option>
	    <option>Belize</option>
	    <option>Benin</option>
	    <option>Bhutan</option>
	    <option>Bolivia</option>
	    <option>Bosnia and Herzegovina</option>
	    <option>Botswana</option>
	    <option>Brazil</option>
	    <option>Brunei</option>
	    <option>Bulgaria</option>
	    <option>Burkina Faso</option>
	    <option>Burundi</option>
	    <option>Cabo Verde</option>
	    <option>Cambodia</option>
	    <option>Cameroon</option>
	    <option>Canada</option>
	    <option>Central African Republic</option>
	    <option>Chad</option>
	    <option>Chile</option>
	    <option>China</option>
	    <option>Colombia</option>
	    <option>Comoros</option>
	    <option>Congo, Republic of the</option>
	    <option>Congo, Democratic Republic of the</option>
	    <option>Costa Rica</option>
	    <option>Cote d'Ivoire</option>
	    <option>Croatia</option>
	    <option>Cuba</option>
	    <option>Cyprus</option>
	    <option>Czech Republic</option>
	    <option>Denmark</option>
	    <option>Djibouti</option>
	    <option>Dominica</option>
	    <option>Dominican Republic</option>
	    <option>Ecuador</option>
	    <option>Egypt</option>
	    <option>El Salvador</option>
	    <option>Equatorial Guinea</option>
	    <option>Eritrea</option>
	    <option>Estonia</option>
	    <option>Ethiopia</option>
	    <option>Fiji</option>
	    <option>Finland</option>
	    <option>France</option>
	    <option>Gabon</option>
	    <option>Gambia</option>
	    <option>Georgia</option>
	    <option>Germany</option>
	    <option>Ghana</option>
	    <option>Greece</option>
	    <option>Grenada</option>
	    <option>Guatemala</option>
	    <option>Guinea</option>
	    <option>Guinea-Bissau</option>
	    <option>Guyana</option>

	    <option>Haiti</option>
	    <option>Honduras</option>
	    <option>Hungary</option>
	    <option>Iceland</option>
	    <option>India</option>
	    <option>Indonesia</option>
	    <option>Iran</option>
	    <option>Iraq</option>
	    <option>Ireland</option>
	    <option>Israel</option>
	    <option>Italy</option>
	    <option>Jamaica</option>
	    <option>Japan</option>
	    <option>Jordan</option>
	    <option>Kazakhstan</option>
	    <option>Kenya</option>
	    <option>Kiribati</option>
	    <option>Kosovo</option>
	    <option>Kuwait</option>
	    <option>Kyrgyzstan</option>
	    <option>Laos</option>
	    <option>Latvia</option>
	    <option>Lebanon</option>
	    <option>Lesotho</option>
	    <option>Liberia</option>
	    <option>Libya</option>
	    <option>Liechtenstein</option>
	    <option>Lithuania</option>
	    <option>Luxembourg</option>
	    <option>Macedonia</option>
	    <option>Madagascar</option>
	    <option>Malawi</option>
	    <option>Malaysia</option>
	    <option>Maldives</option>
	    <option>Mali</option>
	    <option>Malta</option>
	    <option>Marshall Islands</option>
	    <option>Mauritania</option>
	    <option>Mauritius</option>
	    <option>Mexico</option>
	    <option>Micronesia</option>
	    <option>Moldova</option>
	    <option>Monaco</option>
	    <option>Mongolia</option>
	    <option>Montenegro</option>
	    <option>Morocco</option>
	    <option>Mozambique</option>
	    <option>Myanmar (Burma)</option>
	    <option>Namibia</option>
	    <option>Nauru</option>
	    <option>Nepal</option>
	    <option>Netherlands</option>
	    <option>New Zealand</option>
	    <option>Nicaragua</option>
	    <option>Niger</option>
	    <option>Nigeria</option>
	    <option>North Korea</option>
	    <option>Norway</option>
	    <option>Oman</option>
	    <option>Pakistan</option>
	    <option>Palau</option>
	    <option>Palestine</option>
	    <option>Panama</option>
	    <option>Papua New Guinea</option>
	    <option>Paraguay</option>
	    <option>Peru</option>
	    <option>Philippines</option>
	    <option>Poland</option>
	    <option>Portugal</option>

	    <option>Qatar</option>
	    <option>Romania</option>
	    <option>Russia</option>
	    <option>Rwanda</option>
	    <option>St. Kitts and Nevis</option>
	    <option>St. Lucia</option>
	    <option>St. Vincent and The Grenadines</option>
	    <option>Samoa</option>
	    <option>San Marino</option>
	    <option>Sao Tome and Principe</option>
	    <option>Saudi Arabia</option>
	    <option>Senegal</option>
	    <option>Serbia</option>
	    <option>Seychelles</option>
	    <option>Sierra Leone</option>
	    <option>Singapore</option>
	    <option>Slovakia</option>
	    <option>Slovenia</option>
	    <option>Solomon Islands</option>
	    <option>Somalia</option>
	    <option>South Africa</option>
	    <option>South Korea</option>
	    <option>South Sudan</option>
	    <option>Spain</option>
	    <option>Sri Lanka</option>
	    <option>Sudan</option>
	    <option>Suriname</option>
	    <option>Swaziland</option>
	    <option>Sweden</option>
	    <option>Switzerland</option>
	    <option>Syria</option>
	    <option>Taiwan</option>
	    <option>Tajikistan</option>
	    <option>Tanzania</option>
	    <option>Thailand</option>
	    <option>Timor-Leste</option>
	    <option>Togo</option>
	    <option>Tonga</option>
	    <option>Trinidad and Tobago</option>
	    <option>Tunisia</option>
	    <option>Turkey</option>
	    <option>Turkmenistan</option>
	    <option>Tuvalu</option>
	    <option>Uganda</option>
	    <option>Ukraine</option>
	    <option>United Arab Emirates</option>
	    <option>UK (United Kingdom)</option>
	    <option>USA (United States of America)</option>
	    <option>Uruguay</option>
	    <option>Uzbekistan</option>
	    <optgroup>V</optgroup>
	    <option>Vanuatu</option>
	    <option>Vatican City (Holy See)</option>
	    <option>Venezuela</option>
	    <option>Vietnam</option>
	    <option>Yemen</option>
	    <option>Zambia</option>
	    <option>Zimbabwe</option>
			</select>
		</p>
		<p class="form-control">
			<input id="reg-submit" class="action-button" type="submit" value="Register">
		</p>
	</form>
</div>