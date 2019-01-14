<?php

			$salt = '4543k098hg34jb5k344b542b3bk35j6h568j8908kjb09b7b894b6';
			$crypt = hash_hmac('sha256', 'karol92', $salt);
echo $crypt;


?>