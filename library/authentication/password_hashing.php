<?php


define("SALT_PREFIX_SHA1", '$SHA1$');

/**
 *
 * Generate a salt to be used with the password_hash() function.
 *
 * <pre>
 * This function checks for the availability of the preferred hashing algorithm (BLOWFISH)
 * on the system.  If it is available the salt returned is prefixed to indicate it is for BLOWFISH.
 * If it is not available, then SHA1 will be used instead.
 *
 * See php documentation on crypt() for more details.
 * </pre>
 *
 *
 * @return type     The algorithm prefix + random data for salt.
 */
function oemr_password_salt()
{
    $Allowed_Chars ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
    $Chars_Len = 63;

    $Salt_Length = 22;

    $salt = "";

    for ($i=0; $i<$Salt_Length; $i++) {
        $salt .= $Allowed_Chars[mt_rand(0, $Chars_Len)];
    }

    // This is the preferred hashing mechanism
    if (CRYPT_BLOWFISH===1) {
        $rounds='05';
        //This string tells crypt to apply blowfish $rounds times.
        $Blowfish_Pre = '$2a$'.$rounds.'$';
        $Blowfish_End = '$';

        return $Blowfish_Pre.$salt.$Blowfish_End;
    }

    error_log("Blowfish hashing algorithm not available.  Upgrading to PHP 5.3.x or newer is strongly recommended");

    return SALT_PREFIX_SHA1.$salt;
}

/**
 * Hash a plaintext password for comparison or initial storage.
 *
 * <pre>
 * This function either uses the built in PHP crypt() function, or sha1() depending
 * on a prefix in the salt.  This on systems without a strong enough built in algorithm
 * for crypt(), sha1() can be used as a fallback.
 * If the crypt function returns an error or illegal hash, then will die.
 * </pre>
 *
 * @param type $plaintext
 * @param type $salt
 * @return type
 */
function oemr_password_hash($plaintext, $salt)
{
    // if this is a SHA1 salt, the use prepended salt
    if (strpos($salt, SALT_PREFIX_SHA1)===0) {
        return SALT_PREFIX_SHA1 . sha1($salt.$plaintext);
    } else { // Otherwise use PHP crypt()
        $crypt_return = crypt($plaintext, $salt);
        if (($crypt_return == '*0') || ($crypt_return == '*1') || (strlen($crypt_return) < 6)) {
            // Error code returned by crypt or not hash, so die
            error_log("FATAL ERROR: crypt() function is not working correctly in OpenEMR");
            die("FATAL ERROR: crypt() function is not working correctly in OpenEMR");
        } else {
            // Hash confirmed, so return the hash.
            return $crypt_return;
        }
    }
}
