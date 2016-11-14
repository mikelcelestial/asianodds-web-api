<?php
/**
 * Class login
 * handles the user login and logout process
 */
class Login
{
    /**
     * @var object $db_connection database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors error messages
     */
    public $errors = array();
    /**
     * @var array $messages messages list
     */
    public $messages = array();
	
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // logout action
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via form
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * login via form
     */
    private function dologinWithPostData()
    {
        // login form messages
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create db connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // check db connection errors
            if (!$this->db_connection->connect_errno) {

                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                // database query for login
                $sql = "SELECT user_id, user_name, user_password_hash, user_email
                        FROM ao_users
                        WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // check if user exists
                if ($result_of_login_check->num_rows == 1) {

                    $result_row = $result_of_login_check->fetch_object();

                    // verifies that a password matches a hash
                    if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {

                        // write user data into PHP SESSION
                        $_SESSION['user_id'] = $result_row->user_id;
                        $_SESSION['user_name'] = $result_row->user_name;
                        $_SESSION['user_email'] = $result_row->user_email;
						$_SESSION['user_login_status'] = 1;

                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    /**
     * logout action
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";

    }

    /**
     * return user login status
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }

        return false;
    }
}