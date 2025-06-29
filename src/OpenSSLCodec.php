<?php

namespace Codecs;

use Codecs\ICodec;

/**
 * OpenSSL Codec.
 * 
 * @api
 * @final
 * @since 1.0.0
 * @version 1.0.0
 * @package openssl-codec
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class OpenSSLCodec implements ICodec {

    /**
     * Creates a new instance of OpenSSLCodec.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param string $cipher        The cipher algorithm to use (e.g., 'aes-128-gcm').
     * @param string $passphrase    The passphrase for encryption/decryption.
     * @param string $iv            The initialization vector (IV) for the cipher.
     */
    public final function __construct(

        public readonly string $cipher,
        public readonly string $passphrase,
        public readonly string $iv
    ) {}

    /**
     * Encodes a value into a string representation.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param mixed $value
     * @return string
     */
    public final function encode(mixed $value): string {

        $code = openssl_encrypt(
            data: $value,
            cipher_algo: $this->cipher,
            passphrase: $this->passphrase,
            options: 0,
            iv: $this->iv,
            tag: $tag
        );

        return base64_encode($tag) . "\n" . $code;
    }

    /**
     * Decodes a string representation back into its original value.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param string $code
     * @return mixed
     */
    public final function decode(string $code): mixed {

        [$tag, $code] = explode("\n", $code, 2);

        return openssl_decrypt(
            data: $code,
            cipher_algo: $this->cipher,
            passphrase: $this->passphrase,
            options: 0,
            iv: $this->iv,
            tag: base64_decode($tag)
        );
    }
}
