## How to install SSL certificate

```
% sudo certbot certonly --manual \
--preferred-challenges http \
--email hurims@gmail.com \
--agree-tos \
-d jyhur.com \
--key-type rsa
Password:
Saving debug log to /var/log/letsencrypt/letsencrypt.log

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
An ECDSA certificate named jyhur.com already exists. Do you want to update its
key type to RSA?
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
(U)pdate key type/(K)eep existing key type: U
Renewing an existing certificate for jyhur.com

Successfully received certificate.
Certificate is saved at: /etc/letsencrypt/live/jyhur.com/fullchain.pem
Key is saved at:         /etc/letsencrypt/live/jyhur.com/privkey.pem
This certificate expires on 2024-07-29.
These files will be updated when the certificate renews.

NEXT STEPS:
- This certificate will not be renewed automatically. Autorenewal of --manual certificates requires the use of an authentication hook script (--manual-auth-hook) but one was not provided. To renew this certificate, repeat this same certbot command before the certificate's expiry date.
An unexpected error occurred:
requests.exceptions.ReadTimeout: HTTPSConnectionPool(host='supporters.eff.org', port=443): Read timed out. (read timeout=60)
Ask for help or search for solutions at https://community.letsencrypt.org. See the logfile /var/log/letsencrypt/letsencrypt.log or re-run Certbot with -v for more details.

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
If you like Certbot, please consider supporting our work by:
 * Donating to ISRG / Let's Encrypt:   https://letsencrypt.org/donate
 * Donating to EFF:                    https://eff.org/donate-le
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

```

/etc/letsencrypt/live/jyhur.com/fullchain.pem 을 `인증서(SSL CRT)`에 복붙
/etc/letsencrypt/live/jyhur.com/privkey.pem 을 `개인키(Private Key)`에 복붙
