# OpenSSL Codec

- [OpenSSL Codec](#openssl-codec)
  - [Installation](#installation)
  - [Usage](#usage)
    - [Encoding](#encoding)
    - [Decoding](#decoding)

***

## Installation

Install *openssl-codec* via Composer:

```bash
composer require ali-eltaweel/openssl-codec
```

## Usage

### Encoding

```php
use Codecs\OpenSSLCodec;

// store this in a secure place
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-gcm'));

$codec = new OpenSSLCodec('aes-128-gcm', 'MySuperDuperSecretPassphrase', $iv);

$code = $codec->encode('Super Secret Data');
```

### Decoding

```php
use Codecs\OpenSSLCodec;

// load the same IV used for encoding
$iv = '';

$codec = new OpenSSLCodec('aes-128-gcm', 'MySuperDuperSecretPassphrase', $iv);

$superSecretData = $codec->decode($code);
```
