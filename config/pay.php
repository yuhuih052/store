<?php

return [
    'alipay' => [
        'app_id'         => '2016101500689197',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmrbazmQ84SfVKavRKkRvwDVC/zOpJkTC2KPVXM7ownEZYn4b0e1/l6NCTVjYJQfim5yStR2zn8FQgwdyToZkTPWXFvcBY95fUlcbBAFZncvzJVRc5kig0F6kPV1ZsFIWWU7zMET5YSGzY+Xmsd6hu2sXbZ5h2DwIJpfIJPYD8j4TaktHZJL33pWOZba7vPAPtN4J8xGLf9KOBTB2xfTZ9C/Kt9/zzU02a/qUF1eTIzFZXnrRbaMrNAcHC5Y1dal1qC86DHbv9yZ/whQKz+/BNDWeZc40qe5nMZSOsXD+BbGmoFAifvsTDRRlzmMu+yzp3QJgLbmv7NeYkFyNfMxabQIDAQAB',
        'private_key'    => 'MIIEpAIBAAKCAQEAlNhSiwyuZUgfWRQB83uqh034ewCns+x9TQBIIESTUHF9nCZMa7/O4S3TgoWUWsICtON8xaYgCkHjEKKpKq23VuzaBQrg68lkqVvMRDJfWdc1WyRHdwi8NdDsn7QItcl6ayQgJyuBy7YIQcYVZ3Hw7V75fuKu7LBRMVd2nojJzltoI77LqYESgwrTvMqZG6h6cJx4yWlVoQ7KWV5lDYXFYkiDYpCO1XPy7Wqf/zq4ZQGS8J3w0MebLY+rkRdbmwhw/msxyoKaiRdgLSuI2e2/GXsN+COOeENlvR04Y+m8pN6XR6ERQKcbRuwjFgbV/XOa1Qr47mXGMhrnWcpmir9TOwIDAQABAoIBAGmord+bHukyq14Wf9QRg1oNFUhrjKCCTegtPQX66AAAsEP6Q+FxBTB/0Vcj784FTtqNafL8HF5rqv4SGbf8HNuNwq41rLhz/Ark6Tm38EvcIzoRpNFw1/nz1yT/LfetkEMiH9juX3L2QyI9tM/76CT4eG+EBtxpxRkbl06ul2LuFCDWtr/Y3MNDRSskN4ehL73yrU71uL4jaCiqdI1p66eF1OYTZX7HY9HJEuW1fY8Xj8Xus2vbc5sQpyQTsRT0QDuz5iCAAv6++lzo/jF31QHw9NIK/OYVocxr6jX0AcSRQqZl6IgcbwmFrM2pdzSm5+gudKnm187UoPBYrITtNtECgYEA4UJWW6APCgoYhumT2kQZccXhAjvZ64jNhr7bhdreKQznY5ySyKE71DvUbnnN2vgI+X6IxqXJQLnCI6+SuEQPMZe2uVDli766dGvps1UoqRc7hdIhI102yWtSxXdxcCdM2u9mSLxNHOnaKUoSPsvpIszRSb3wYV09KhMog4n+8ccCgYEAqShgyoKppAj/ddn5gcXps3SrtQ4yyEq/X/9aBgmDbfhf1YqgMknZ644y7kBA1fXwoGo42/hwtwRkbTuEUtHSOfnISBIKICGMjs185Q5RKXTyux7j0VovZlkWzUp9NXPml8DKTS2AX+fsW2XEeDZWtOt6Eriy7W8jtsFYqX16ku0CgYEAlIg3hWc/Q3FwxtUSJyQsWvcN7XklssecLjN/cP3m686UbPx7VUvrtYBWDRrIAJD46frjmYkL8WALgZht+I74Lc1KMVwEYGc9bzMRAK0wiH7HQvBR5Y27aIkaJRcjd76SUPL20RNJDb2tmvg6m6m9arL/dc6GyMzAXhQP7Nx7fVUCgYBnfpXhsRnbi8nIsClw1ccLjel0aBB37Quzz0akBPQNt3Xi7+LdgcO71A+jJ1rDzaqAax0IsLM9tok/L7fg+BEYeZOpTKg3Sm91+5Fbj2vm4m+UPu0B7JytkPpbdiSvLI8776+Wkq1FgF9i+BvBtPVN0fipNan7jREbwqXdZTE2bQKBgQDHoPxtqiGP1ht8hXCpjxhNeZp65JBoZmwL4CF23rjHf7dTGPpLndkD4X2Xmri1ClFfJUEHYT97TQwQv6D8Q7rSRWSIFEZAebAbWsXtqW/ZIc3Ku+G6jPbvqn0FVf0PtEyFadZi26ZQfpPGCCWkmZM6U4uMT+w+g8Q5Mb9lHKPRag==',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];