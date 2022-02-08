<?php

namespace controller;

use Utils\Crypto;
use Utils\ApiKey;

class Exampled
{
  use Crypto, ApiKey;

  public function __construct()
  {
    printf("Initialize the class");
  }

  public function setEncrypterMessage(String $textoEncrypt = "")
  {
    return Crypto::encrypterMessage($textoEncrypt);
  }

  public function getMessageEncrypted()
  {
    return $this->message;
  }

  public function getDescrypterMessage($textoEncryptToNormal = null)
  {
    return Crypto::decrypterMessage($textoEncryptToNormal);
  }

  public function createApiKey(String $text = '')
  {
    return ApiKey::generateApiKeyUUI($text);
  }
}
