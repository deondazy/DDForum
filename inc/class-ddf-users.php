<?php
/**
 * Users Handling and Management class.
 *
 * @access private
 * @package Deonic
 * @subpackage Users
 */

// Can't be accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( 'Direct access denied' );
}

class DDForum_Users {

	/**
	 * Holds the IDs for users.
	 *
	 * @access public
	 * @var int
	 */
	public $user_ID;

	/**
	 * User username
	 *
	 * @access public
	 * @var string
	 */
	public $username;

	/**
	 * User password
	 *
	 * @access private
	 * @var string
	 */
	public $password;

	/**
	 * User first name
	 *
	 * @access public
	 * @var string
	 */
	public $first_name;

	/**
	 * User last name
	 *
	 * @access public
	 * @var string
	 */
	public $last_name;

	/**
	 * User display name
	 *
	 * @access public
	 * @var string
	 */
	public $display_name;

	/**
	 * User Role
	 *
	 * @access public
	 * @var string
	 */
	public $user_role;

	/**
	 * User email
	 *
	 * @access public
	 * @var string
	 */
	public $email;

	/**
	 * User website
	 *
	 * @access public
	 * @var string
	 */
	public $website;

	/**
	 * User Biography
	 *
	 * @access public
	 * @var string
	 */
	public $bio;

	/**
	 * Time user registered
	 *
	 * @access public
	 * @var string
	 */
	public $reg_time;

	/**
	 * User display picture
	 *
	 * @access public
	 * @var string
	 */
	public $display_picture;

	/**
	 * Holds the database object
	 *
	 * @access public
	 * @var string
	 */
	private $db_obj;

	public function __construct() {
		$this->db_obj = new ddf_db( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );
		return $this->db_obj;
	} 

	/**
	 * Get current user ID.
	 *
	 * Get the ID of the currently logged user.
	 *
	 * @return int|bool user ID for current user, or false on failure.
	 */
	public function current_userID() {
		/** Check if cookie is set **/ 
		if ( isset($_COOKIE['ddforum_logged']) ) {
			$this->username = $_COOKIE['ddforum_logged'];

			/** Get user ID of the user with current username **/
			$query = $this->db_obj->query("SELECT `userID` FROM " . $this->db_obj->users . " WHERE `username` = '$this->username'");

			if ( !empty($query) ) {
				
				if ( $query->num_rows > 0 ) {
					$result = $this->db_obj->fetch_object($query);
					$this->user_ID = $result->userID;

					return $this->user_ID;
				}
				
				return false;

			}

			return false;
		}
		
		return false;
	}

	/**
	 * Get all user details.
	 *
	 * User ID, Username, First Name, Last Name, Display Name, Email,
	 * Role, Biography, Registration Date, Last Seen.
	 *
	 * @param string  $data     Data to get for the user.
	 * @param int 		$user_id	User ID of user to get data for.
	 *
	 * @return mixed
	 */
	public function get_user( $field, $user_id ) {
		if ( 'current_user' == $user_id )
			$user_id = $this->current_userID();

		if ( $field == 'password' )
			return;

		$query = $this->db_obj->query("SELECT * FROM " . $this->db_obj->users . " WHERE userID = '$user_id'");

		if ( $query->num_rows > 0 ) {
			$user_obj = $this->db_obj->fetch_object($query);
			
			return $user_obj->$field;
		}
		
		return false;
	}

	public function user_posts( $user_id ) {
		$user_topics = $this->get_user( 'topic_count', $user_id );

		$user_replies = $this->get_user( 'reply_count', $user_id );

		$user_posts = (int) $user_topics + (int) $user_replies;

		return $user_posts;
	}

	/**
	 * Get user display picture.
	 */
	public function get_dp($user_id, $width = 100, $height = 100) {
		if ( $user_id == 'current_user' )
			$user_id = $this->current_userID();

		$user_data = $this->db_obj->query("SELECT avatar, username FROM " . $this->db_obj->users . " WHERE userID='$user_id'");

		if ( !empty($user_data) ) {
			$user_obj = $this->db_obj->fetch_object($user_data);

			foreach ($user_obj as $user) {
				$username = $user_obj->username;
				$user_dp = $user_obj->avatar;

				return  '<img src="' . $user_dp . '" class="ddf-user-dp" alt="' . $username . ' profile picture"' . 'width="' . $width . '" height="' . $height . '">';
			}
		}
		return '';
	}

	/**
	 * Check if username and email are not taken and supplied details are valid
	 * then register user, else return error message
	 *
	 * @param string $firstname User supplied firstname.
	 * @param string $lastname User supplied lastname.
	 * @param string $username User supplied username.
	 * @param string $password User supplied password.
	 * @param string $cpassword User supplied confirm password.
	 * @param string $email User supplied email.
	 * @param string $birthday User supplied birthday.
	 * @param string $country User supplied country.
	 */
	function register( $firstname = '', $lastname = '', $username, $password, $cpassword, $email, $gender = '', $birthday, $country, $send_mail = false ) {

		// Define error array
		$error = array();

		// Sanitize username
		if ( !empty($username) ) {

			// Username must be between 3-16 characters long
			if ( strlen($username) >= 3 && strlen($username) <= 16 ) {

				// Allow only alphanumeric characters, underscores and hyphen
				if ( preg_match("/^[a-zA-Z0-9-_]+$/", $username) ) {

					// Check if username is registered
					$this->db_obj->query("SELECT `username` FROM " . $this->db_obj->users . " WHERE username = '$username'");
		
					if ( $this->db_obj->row_count > 0 ) {
						$username_taken = true;
						$error[] = "This username $username is already registered. Try another";
					}
					else {
						$username_taken = false;
					}
				}
				else {
					$error[] = "Username can only contain alphanumeric characters, hyphen and underscore";
				}
			}
			else {
				$error[] = "Username must be between 3-16 characters";
			}
		}
		else {
			$error[] = "Username is required and cannot be empty";
		}

		// Sanitize email
		if ( !empty($email) ) {

			// Check if the string matches an email
			if (  preg_match("/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/", $email) ) {

				// Check if email is registered
				$this->db_obj->query("SELECT `email` FROM " . $this->db_obj->users . " WHERE email = '$email'");
		
				if ( $this->db_obj->row_count > 0 ) {
					$email_taken = true;
					$error[] = "Email you entered is already taken. Try another";
				}
				else {
					$email_taken = false;
				}
			}
			else {
				$error[] = "The email you entered is invalid";
			}
		}
		else {
			$error[] = "Email is required and cannot be empty";
		}

		// Sanitize password
		if ( !empty($password) ) {

			// Password must be at least 7 characters long
			if ( strlen($password) >= 7 ) {

				// Password and confirm password must match
				if ( $password == $cpassword ) {

					// Hash password
					$password = md5($password);
				}
				else {
					$error[] = "Password and Confirm password does not match";
				}
			}
			else {
				$error[] = "Password must be at least 7 characters";
			}
		}
		else {
			$error[] = "Enter a password";
		}

		// Birthday is required
		if ( empty($birthday) ) {
			$error[] = "You need to enter your birthday";
		}

		// Country is required
		if ( empty($country) ) {
			$error[] = "Country is required";
		}

		// If all went well and no errors, proceed.
		if ( empty($error) ) {
			$data = array(
				'first_name' => $firstname,
				'last_name'  => $lastname,
				'username'   => $username,
				'email'      => $email,
				'country'    => $country,
				'age'        => date('Y') - substr($birthday, 0, 4),
				'gender'     => $gender,
				'birthday'   => $birthday,
				'register_date' => 'now()',
				'level'  => 'user',
				'status' => 1,
				'password' => $password,
			);

			$register_user = $this->db_obj->insert_data($this->db_obj->users, $data);

			if ( $this->db_obj->affected_rows > 0 ) {
				show_message('Registeration succesful');
			}
			else {
				show_message('Registeration failed, try again');
			}
		}
		else {
			echo "There seems to be a problem with your registeration";
			foreach ($error as $e) {
				show_message( 'Error: ' . $e );
			}
		}
	}

	/**
	 * Check if supplied Username and Password match then login user else return error message
	 *
	 * @param string $username User supplied username.
	 * @param string $password User supplied password.
	 * @param bool $remember whether to keep user logged in after session. Default to false. 
	 */
	public function login( $username, $password, $remember = false ) {
		if ( !empty($username) ) {
			if ( !empty($password) ) {

				$query = "SELECT `userID`, `username`, `password`, `level` FROM " . $this->db_obj->users . " WHERE username = '$username'";
				
				$get_user = $this->db_obj->query( $query );

				if ( $this->db_obj->row_count > 0 ) {
					
					$user_data = $this->db_obj->fetch_object($get_user);

					$user_id = $user_data->userID;
					$pass   = 	$user_data->password;
					$level  =		$user_data->level;

					if ( md5($password) == $pass ) {
						if ( !$remember ) {
							setcookie('ddforum_logged', $username, 0);
						}
						else {
							setcookie('ddforum_logged', $username, time()+60*60*24*30);
						}

						$this->db_obj->update_data( $this->db_obj->users, array( 'online_status' => 1 ), "userID = '$user_id'");
						
						$this->login_redirect($user_id);
					}
					else {
						echo "Password you entered is incorrect";
					}
				}
				else {
					echo "The username $username is not registered";
				}
			}
			else {
				echo "FAIL: Enter your password";
			}
		}
		else {
			return;
		}
	}
	
	private function login_redirect( $user_id ) {
		$level = $this->get_user( 'level', $user_id );

		if ( $level == 1 || $level == 2 || $level == 3 ) {
			if ( isset( $_SERVER['HTTP_REFERER'] ) && strpos( $_SERVER['HTTP_REFERER'], 'auth.php' ) === false ) {
				$redirect = $_SERVER['HTTP_REFERER'];
			}
			else {
				$redirect = admin_url();
			}
		}
		else if ( $level == 0 ) {
			if ( isset( $_SERVER['HTTP_REFERER'] ) && strpos( $_SERVER['HTTP_REFERER'], 'auth.php' ) === false ) {
				$redirect = $_SERVER['HTTP_REFERER'];
			}
			else {
				$redirect = home_url();
			}
		}

		header('Location: ' . $redirect);
	}

	public function logout() {
		if ( isset( $_COOKIE['ddforum_logged'] ) ) {
			setcookie('ddforum_logged', '', time()-60*60*24*30);

			$user_id = $this->current_userID();

			$this->db_obj->update_data( $this->db_obj->users, array( 'online_status' => 0, 'last_seen' => 'now()' ), "userID = '$user_id'");
		}

		return false;
	}
}

$ddf_user = new DDForum_Users;

$user = new DDForum_Users; // TODO: remove this object
