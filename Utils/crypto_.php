<?php

namespace Utils;

trait Crypto
{
  // Metodo de encriptación
  public static $encrypt_method = 'AES-256-CBC';

  // API KEY para encriptar y desencriptar los mensajes
  public static $key = '{api_key}';

  public static function encrypterMessage($message)
  {
    $data = base64_encode($message);
    $key  = base64_decode(self::$key);
    $iv   = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$encrypt_method));
    $tmp  = openssl_encrypt($data, self::$encrypt_method, $key, OPENSSL_RAW_DATA, $iv);

    // Return message encrpted in base64_encode
    return base64_encode($iv . $tmp);
  }

  public static function decrypterMessage($message)
  {
    $bufferIDF = base64_decode($message);
    $key = base64_decode(self::$key);
    $iv = substr($bufferIDF, 0, 16);
    $encrypted = substr($bufferIDF, 16);

    return base64_decode(@openssl_decrypt($encrypted, self::$encrypt_method, $key, OPENSSL_RAW_DATA, $iv));
  }
}

trait ApiKey
{

  private static $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  private static $special = '@\-+_.$!%*#?&';

  public static function generateApiKeyUUI($code = 'random')
  {
    $arraySpecial = str_split(self::$special);
    shuffle($arraySpecial);
    $code = ($code == 'random') ? bin2hex(mt_rand()) : $code;
    $hash = hash('haval160,4', (time() . $code . substr(str_shuffle(self::$permitted_chars), 0, 20) . rand()));
    $hash = substr($hash, 0, 20);

    return sprintf(
      "%04x%04x$arraySpecial[0]%04x$arraySpecial[1]%04x%04x$arraySpecial[2]%04x$arraySpecial[3]%04x%04x",

      // 32 bits for "time_low"
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),

      // 16 bits for "time_mid"
      mt_rand(0, 0xfffff),
      mt_rand(0, 0xffff),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 4
      mt_rand(0, 0x0FFF) | 0x4000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      mt_rand(0, 0x3fff) | 0x8000,

      // 48 bits for "node"
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff)
    ) . '_' . $hash;
  }
}
