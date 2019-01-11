<?php

class User extends Password
{
	private $db;
	const ADMIN_ID = 1;
	//const LOGO_PATH = 'images/users/'; ---- pateka za sliki
	function __construct($db)
	{
		$this->_db = $db;
	}

	public function is_logged()
	{
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
		{
			return true;
		}
	}

	public function get_user_info($userEmail)
	{
		try
		{
			$selUser = $this->_db->prepare('SELECT userID, userEmail, userPassword FROM users WHERE userEmail = :userEmail');
			$selUser->execute(array('userEmail' => $userEmail));

			return $selUser->fetch();
		}
		catch(PDOException $e)
		{
			echo '<p class="error">' . $e->getMessage() . '</p>';
		}
	}

	public function login($userEmail, $userPassword)
	{
		$user = $this->get_user_info($userEmail);

		if($this->password_verify($userPassword, $user['userPassword']) == 1)
		{
			$_SESSION['loggedin'] = true;
			$_SESSION['userID'] = $user['userID'];
			$_SESSION['userEmail'] = $user['userEmail'];
			return true;
		}
	}
	public function logout()
	{
		session_destroy();
	}
}

//User::LOGO_PATH.$pdo->logo; ---- povikuvanje pateka za sliki