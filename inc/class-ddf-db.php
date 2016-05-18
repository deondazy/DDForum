<?php
/**
* This file connects to database
* and holds all database function
* Database INSERT, SELECT, UPDATE, DELETE
*/

// Can't be accessed directly
if ( !defined( 'DDFPATH' ) ) {
	die( 'Direct access denied' );
}

class ddf_db {
	/**
	 * MySQL Database host
	 *
	 * @access protected
	 * @var string
	 */
	protected $db_host;

	/**
	 * MySQL Database user
	 *
	 * @access protected
	 * @var string
	 */
	protected $db_user;

	/**
	 * MySQL Database password
	 *
	 * @access protected
	 * @var string
	 */
	protected $db_pass;

	/**
	 * MySQL Database name
	 *
	 * @access protected
	 * @var string
	 */
	protected $db_name;

	/**
	* Stores database connection
	*/
	public $db_connect;

	/**
	 * Database tables
	 */
	public $tables = array( 'forums', 'users', 'topics', 'replies', 'pms', 'options', 'files', 'ads', 'attachments', 'notifications', 'likes', 'badwords', 'reports', 'credit_transfer' );

	/**
	 * DDForum Forums table
	 *
	 * @access public
	 * @var string
	 */
	public $forums;

	/**
	 * DDForum Users table
	 *
	 * @access public
	 * @var string
	 */
	public $users;

	/**
	 * DDForum Topics table
	 *
	 * @access public
	 * @var string
	 */
	public $topics;

	/**
	 * DDForum Replies table
	 *
	 * @access public
	 * @var string
	 */
	public $replies;

	/**
	 * DDForum PMs table
	 *
	 * @access public
	 * @var string
	 */
	public $pms;

	/**
	 * DDForum Options table
	 *
	 * @access public
	 * @var string
	 */
	public $options;

	/**
	 * DDForum Files table
	 *
	 * @access public
	 * @var string
	 */
	public $files;

	/**
	 * DDForum Ads table
	 *
	 * @access public
	 * @var string
	 */
	public $ads;

	/**
	 * DDForum Attachments table
	 *
	 * @access public
	 * @var string
	 */
	public $attachments;

	/**
	 * DDForum Notifications table
	 *
	 * @access public
	 * @var string
	 */
	public $notifications;

	/**
	 * DDForum Likes table
	 *
	 * @access public
	 * @var string
	 */
	public $likes;

	/**
	 * DDForum Badwords table
	 *
	 * @access public
	 * @var string
	 */
	public $badwords;

	/**
	 * DDForum Reports table
	 *
	 * @access public
	 * @var string
	 */
	public $reports;

	/**
	 * DDForum Credit Transfer table
	 *
	 * @access public
	 * @var string
	 */
	public $credit_transfer;

	/**
	 * is there any connection error?
	 */
	public $error = false;

	/**
	* Stores error message
	*/
	public $error_msg;

	/**
	* Stores database query
	*/
	private $db_query;

	/**
	* Stores database query id
	*/
	private $query_id = 0;

	/**
	* Number of rows affected by SQL query
	*/
	public $affected_rows = 0;

	public $row_count = 0;

	/**
	* Connect to the MySQL Database server
	*
	* Sets up the class properties with credentials from config.php
	* and connects to the database server
	*/
	public function __construct( $db_user, $db_pass, $db_name, $db_host ) {
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_name = $db_name;
		$this->db_host = $db_host;

		// Create the mysqli connection object
		$this->db_connect = /*@*/new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

		// Show error and exit if unable to connect to database
		if ( $this->db_connect->connect_errno ) {
			$this->error = true;
			$this->error_msg = $this->db_connect->connect_error;
		}

		// Unset Database credentials so it cannot be dumped
		unset($this->db_host);
		unset($this->db_user);
		unset($this->db_pass);
		unset($this->db_name);

		// Set tables
		$this->tables();

		return $this->db_connect;
	}

	/**
	 * Close connection to the database
	 *
	 */
	public function __destruct() {
		// Check if there is an active connection, then close it
		if ( $this->db_connect ) {
			$close = /*@*/$this->db_connect->close();

			if ( ! $close ) {
				return false;
			}
			else {
				return true;
			}
		}
	}

	/**
	 * Runs an SQL query on connected database
	 *
	 * @param string $sql The SQL query statement to execute
	 *
	 * @return int query ID
	 */
	public function query( $sql ) {
		$query_id = $this->db_connect->query($sql );

		if ( !$query_id )
			return false;

		$this->query_id = $query_id;
		$this->row_count = $this->query_id->num_rows;
		return $query_id;
	}

	public function fetch_object( $query_id ) {
		if ( $this->query_id )
			return $this->query_id->fetch_object();
		return false;
	}

	/**
	 * Select data from Database table and return all result rows
	 *
	 * @param string $query the query to run
	 *
	 * @return object|bool returns rows as array of objects,
	 * false on failure
	 */
	public function fetch_all( $table, $row = '*', $where = '', $order = '', $limit = '', $offset = 1 ) {
		$query = 'SELECT ' . $row . ' FROM ' . $table;
		if ( ! empty($where) )
			$query .= ' WHERE ' . $where;
		if ( ! empty($order) )
			$query .= ' ORDER BY ' . $order;
		if ( ! empty($limit) )
			$query .= ' LIMIT ' . $offset  . ', ' . $limit;

		if ( $result = $this->db_connect->query($query) ) {
			$this->db_query = $result;

			if ( $this->db_query->num_rows > 0 ) {
				$this->row_count = $this->db_query->num_rows;
				while ( $row = $this->db_query->fetch_object()){
					$out[] = $row;
				}

				// Free memory associated with the result
				$this->db_query->free_result();

				return $out;
			}
			return false;
		}
		return false;
	}

	/**
	 * Insert record to specified table in Database
	 *
	 * Takes an array of data ( $data ) and inserts a new
	 * record using the array keys as column names and array
	 * value as column values
	 *
	 * @param string $table Table name to insert data in
	 * @param array $data Array of data to insert in $table
	 *
	 * @return int|bool Return last insert id or false on failure
	 */
	public function insert_data( $table, $data ) {
		$this->db_query = 'INSERT INTO `' . $table . '` ';

		$columns = '';
		$values = '';

		foreach ($data as $c => $v) {
			$columns .= "`$c`, ";

			if ( strtolower($v) == 'now()' )
				$values .= "NOW(), ";
			else
				$values .= "'" . $this->db_connect->real_escape_string($v) . "', ";
		}

		$this->db_query .= "(" . rtrim($columns, ', ') . ") VALUES (" . rtrim($values, ', ') . ");";

		if ( $this->db_connect->query($this->db_query) ) {
			$this->affected_rows = $this->db_connect->affected_rows;

			if ( $this->affected_rows > 0 ) {
				return $this->db_connect->insert_id;
			}

			return false;
		}

		return false;
	}

	/**
	 * Update record to specified table in Database
	 *
	 * Takes an array of data ( $data ) and updates
	 * record(s) using the array keys as column names and array
	 * value as column values
	 *
	 * @param 	string 	$table 	Table name to insert data in
	 * @param 	array 	$data 	Array of data to insert in $table
	 * @param 	string 	$where 	The WHERE clause specify which record to update
	 *
	 * @return bool true on success or false on failure
	 */
	public function update_data( $table, array $data, $where = '' ) {
		$this->db_query = 'UPDATE `' . $table . '` SET ';

		foreach ($data as $c => $v) {
			if ( strtolower($v) == 'now()' )
				$this->db_query .= "`$c` = NOW(), ";

			elseif( preg_match("/^increment\((\-?\d+)\)$/i", $v, $m) )
				$this->db_query .= "`$c` = `$c` + $m[1], ";

			else
				$this->db_query .= "`$c`='" . $this->db_connect->real_escape_string($v) . "', ";
		}

		if ( !empty($where) )
			$this->db_query = rtrim($this->db_query, ', ') . ' WHERE ' . $where .';';
		else
			$this->db_query = rtrim($this->db_query, ', ') . ';';

		if ( $this->db_connect->query($this->db_query) ) {
			$this->affected_rows = $this->db_connect->affected_rows;

			if ( $this->affected_rows > 0 ) {
				return $this->db_connect->affected_rows;
			}

			return false;
		}

		return false;
	}

	/**
	 * Delete record from specified table in Database
	 *
	 * Takes an array of data ( $data ) and updates
	 * record(s) using the array keys as column names and array
	 * value as column values
	 *
	 * @param 	string 	$table 	Table name to insert data in
	 * @param 	array 	$data 	Array of data to insert in $table
	 * @param 	string 	$where 	The WHERE clause specify which record to update
	 *
	 * @return bool true on success or false on failure
	 */
	public function delete_data( $table, $where = '' ) {
		$this->db_query = 'DELETE FROM ' . $table;

		if ( !empty($where) )
			$this->db_query .= ' WHERE ' . $where;
		else
			$this->db_query .= '';

		if ( $this->db_connect->query($this->db_query) ) {
			$this->affected_rows = $this->db_connect->affected_rows;

			if ( $this->affected_rows > 0 ) {
				return $this->db_connect->affected_rows;
			}

			return false;
		}

		return false;
	}

	function tables() {
		global $table_prefix;

		$ddf_tables = $this->tables;

		foreach ($ddf_tables as $table) {
			$this->$table = $table_prefix . $table;
			$tables[ $table ] = $table_prefix . $table;
		}

		return $tables;
	}

	function get_option( $option_name ) {
		$this->db_query = $this->query( "SELECT option_value FROM $this->options WHERE option_name = '$option_name'" );

		$result = $this->fetch_object( $this->db_query );

		if ( $result ) {
			$result = $result->option_value;
			return $result;
		}
		return '';
	}

	function set_option( $option_name, $option_value ) {
		$this->db_query = $this->db_connect->query("UPDATE $this->options SET `option_value` = '$option_value' WHERE option_name = '$option_name'");

		if ( $this->db_query ) {

			return true;

		}

		return false;
	}

	/**
	 * Get a Forum detail.
	 *
	 * Forum ID, Name, Description, ...
	 *
	 * @return mixed
	 */
	public function get_forum( $field, $forum_id) {
		$this->db_query = $this->query("SELECT * FROM $this->forums WHERE forumID = '$forum_id'");

		if (!empty($this->db_query)) {
			$forum_obj = $this->fetch_object($this->db_query);

			return @$forum_obj->$field;
		}
		return '';
	}

	/**
	 * Get Topic detail.
	 *
	 * Forum ID, Name, Description, ...
	 *
	 * @return mixed
	 */
	public function get_topic( $field, $topic_id, $today = false, $count = false ) {
		$this->db_query = $this->query("SELECT * FROM $this->topics WHERE topicID = '$topic_id'");

		if (!empty($this->db_query)) {
			$topic_obj = $this->fetch_object($this->db_query);

			return $topic_obj->$field;

			if ( $today ) {
				$topics_today = $this->db_query = $this->query("SELECT `topic_date` FROM $ddf_db->topics WHERE topicID = '$topic_id'");

				$topics_today = timestamp( $topics_today );

				if ( $topics_today < strtotime('+1 day', time()) ) {
					//var_dump($topics_today);
				}
			}
		}
		return '';
	}

	/**
	 * Get Reply detail.
	 *
	 * Forum ID, Name, Description, ...
	 *
	 * @return mixed
	 */
	public function get_reply( $field, $reply_id ) {
		$this->db_query = $this->query("SELECT * FROM {$this->replies} WHERE replyID = '{$reply_id}'");

		if (!empty($this->db_query)) {
			$reply_obj = $this->fetch_object($this->db_query);

			return /*@*/$reply_obj->$field;
		}
		return '';
	}
}
