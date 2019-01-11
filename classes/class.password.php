<?php

	class Password
	{
		function password_hash($userPassword)
		{
			$hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
		}

		function password_verify($userPassword, $hash)
		{
			$ret = crypt($userPassword, $hash);
			if(!is_string($ret) || strlen($ret) != strlen($hash) || strlen($ret) <= 10)
			{
				return false;
			}
			$status = 0;
			for($i=0; $i < strlen($ret); $i++)
			{
				$status |= (ord($ret[$i]) ^ ord($hash[$i]));
			}
			return $status === 0;
		}
	}

?>