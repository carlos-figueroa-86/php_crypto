# Encrypt messages

Function to encrypt and decrypt text messages.
An ```api_key``` must be added, so that the message is much more secure

To encrypt the message, a string must be passed to the static `encrypterMessage` function.

A base64 string will be returned, which can be decrypted with the `decrypterMessage` function.

## Create ApiKey
To create an `api_key`, just call the `createApiKey` function and you can optionally pass a parameter as a `SECRET`, this function will return an *API KEY*

## Example
clone the repository and run: `php -S localhost:8080`

