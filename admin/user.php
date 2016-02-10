<?php

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$user_id = isset( $_GET['id'] ) ? (int) $_GET['id'] : 0;
$current_user_id = $ddf_user->current_userID();
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ( ! defined('CURRENT_PROFILE') )
	define( 'CURRENT_PROFILE', ( $user_id == $current_user_id ) );

if ( ! $user_id && CURRENT_PROFILE ) {
	$user_id = $current_user_id;
	$action = 'edit';
}
elseif ( ! $user_id && ! CURRENT_PROFILE )
	kill_script('Invalid User ID');
elseif ( ! user_exist( $user_id ) )
	kill_script('Invalid User ID');

$title = CURRENT_PROFILE ? "Profile" : "Edit User";
$parent = 'user-edit.php';
$file = CURRENT_PROFILE ? 'profile.php' : 'user-edit.php';

switch ($action) {
	case 'edit':

		if ( !CURRENT_PROFILE && !is_admin() ) {
			kill_script( 'You do not have the rights to edit users' );
		}

		define( 'EDIT_PROFILE', true );

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			$data = array();

			$data['first_name']     =  clean_input( $_POST['fname'] );
			$data['last_name']     =  clean_input( $_POST['lname'] );
			$data['display_name']     =  clean_input( $_POST['dname'] );
			$data['country']   =  clean_input( $_POST['country'] );
			$data['state']     =  clean_input( $_POST['state'] );
			$data['city']      =  clean_input( $_POST['city'] );
			$data['mobile']    =  clean_input( $_POST['mobile'] );
			$data['website_title'] =  clean_input( $_POST['website-title'] );
			$data['website_url']   =  clean_input( $_POST['website-url'] );
			$data['facebook']  =  clean_input( $_POST['facebook'] );
			$data['twitter']   =  clean_input( $_POST['twitter'] );
			$data['gender']    =  clean_input( $_POST['gender'] );
			$data['birth_day']      =  clean_input( $_POST['day'] );
			$data['birth_month']    =  clean_input( $_POST['month'] );
			$data['birth_year']    =  clean_input( $_POST['year'] );
			$data['age']    =  date('Y') - clean_input( $_POST['year'] );
			$data['biography']     =  clean_input( $_POST['bio'] );
			$data['use_pm']    =  clean_input( $_POST['use-pm'] );

			// Admin set
			if ( !CURRENT_PROFILE ) {
				$data['status']    =  clean_input( $_POST['status'] );
				$data['level']     =  clean_input( $_POST['level'] );
			}
			if ( is_admin() ) {
				$data['credit']    =  clean_input( $_POST['credit'] );

			}

			if ( !empty($_POST['email']) ) {
				$email = clean_input($_POST['email']);

				if ( preg_match('/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/', $email) ) {
					$data['email'] = $email;
				}
				else {
					$msg = 'Email is invalid';
				}
			}
			else {
				$msg = 'Email cannot be empty';
			}

			if ( !empty($_POST['pass']) ) {
				if ( !empty($_POST['cpass'])) {
					$pass = clean_input( $_POST['pass'] );
					$cpass = clean_input( $_POST['cpass'] );
					if ( $pass == $cpass ) {
						$pass = md5($pass);
						$data['password'] = $pass;
					}
					else {
						$msg = 'Error: Password mismatch.';
					}
				}
				else {
					$msg = "Confirm password is empty";
				}
			}

			// Avatar
			$upload_time 	= 	date('YmdHis') . '_';
			$upload_dir 	= 	ABSPATH . 'inc/avatar/';
			$upload_file 	= 	$upload_dir . basename($upload_time . $_FILES['avatar']['name']);

			if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
				$data['avatar'] = home_url() . '/inc/avatar/' . $upload_time . $_FILES['avatar']['name'];
		  }

	  	if ( empty( $msg ) ) {
	  		$update_user = $ddf_db->update_data($ddf_db->users, $data, "userID='$user_id'");

	  		if ( $ddf_db->affected_rows == -1 ) {
	  			$message = CURRENT_PROFILE ? 'Unable to update profile, try again' : 'Unable to update user, try again';
	  		}
	  		else if ( $ddf_db->affected_rows == 0 ) {
					$message = 'No changes';
				}
				else if ( $ddf_db->affected_rows > 0 ) {
					$message = CURRENT_PROFILE ? 'Profile Updated' : 'User Updated';
				}
			}
		}
						
		break;

	case 'delete':
		$topic_forum_id = $ddf_db->get_topic($ddf_db->forums, $topic_id);
		$delete_topic = $ddf_db->delete_data( $ddf_db->topics, "topicID='$topic_id'");

		if ( $ddf_db->affected_rows > 0 ) {
			$count_forum_topics = $ddf_db->query("SELECT `topicID` FROM " . $ddf_db->topics . " WHERE `forumID` = '$topic_forum_id'" );

			$ddf_db->update_data( $ddf_db->forums, array('forum_topics' => $ddf_db->row_count), "forumID='$topic_forum_id'" );

			$count_forum_replies = $ddf_db->query("SELECT `topic_replies` FROM " . $ddf_db->topics . " WHERE `forumID` = '$topic_forum_id'" );

			$ddf_db->update_data( $ddf_db->forums, array('forum_topics' => $ddf_db->row_count), "forumID='$topic_forum_id'" );
				
				redirect("topic-edit.php?message=Topic Deleted");
			}
			else {
				redirect("topic-edit.php?message=Unable to delete topic, try again");
			}
		break;
				
	default:
		kill_script( 'Unknown action' );
		
		break;
}

include( ABSPATH . 'admin/inc/user-form.php' );
include( ABSPATH . 'admin/admin-footer.php' );
