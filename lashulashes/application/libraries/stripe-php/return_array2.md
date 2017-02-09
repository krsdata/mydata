Stripe\Charge Object
(
    [_opts:protected] => Stripe\Util\RequestOptions Object
        (
            [headers] => Array
                (
                )

            [apiKey] => sk_test_kqhSOGciGCjlWKuVj81HQgj7
        )

    [_values:protected] => Array
        (
            [id] => ch_17NLcvBc37nOPWMpqSqUs2oO
            [object] => charge
            [amount] => 8800
            [amount_refunded] => 0
            [application_fee] => 
            [balance_transaction] => txn_17NLcvBc37nOPWMpO1PwxwnP
            [captured] => 1
            [created] => 1451388413
            [currency] => usd
            [customer] => 
            [description] => Silver Membership Plan
            [destination] => 
            [dispute] => 
            [failure_code] => 
            [failure_message] => 
            [fraud_details] => Array
                (
                )

            [invoice] => 
            [livemode] => 
            [metadata] => Stripe\AttachedObject Object
                (
                    [_opts:protected] => Stripe\Util\RequestOptions Object
                        (
                            [headers] => Array
                                (
                                )

                            [apiKey] => sk_test_kqhSOGciGCjlWKuVj81HQgj7
                        )

                    [_values:protected] => Array
                        (
                        )

                    [_unsavedValues:protected] => Stripe\Util\Set Object
                        (
                            [_elts:Stripe\Util\Set:private] => Array
                                (
                                )

                        )

                    [_transientValues:protected] => Stripe\Util\Set Object
                        (
                            [_elts:Stripe\Util\Set:private] => Array
                                (
                                )

                        )

                    [_retrieveOptions:protected] => Array
                        (
                        )

                    [_lastResponse:protected] => 
                )

            [paid] => 1
            [receipt_email] => 
            [receipt_number] => 
            [refunded] => 
            [refunds] => Stripe\Collection Object
                (
                    [_opts:protected] => Stripe\Util\RequestOptions Object
                        (
                            [headers] => Array
                                (
                                )

                            [apiKey] => sk_test_kqhSOGciGCjlWKuVj81HQgj7
                        )

                    [_values:protected] => Array
                        (
                            [object] => list
                            [data] => Array
                                (
                                )

                            [has_more] => 
                            [total_count] => 0
                            [url] => /v1/charges/ch_17NLcvBc37nOPWMpqSqUs2oO/refunds
                        )

                    [_unsavedValues:protected] => Stripe\Util\Set Object
                        (
                            [_elts:Stripe\Util\Set:private] => Array
                                (
                                )

                        )

                    [_transientValues:protected] => Stripe\Util\Set Object
                        (
                            [_elts:Stripe\Util\Set:private] => Array
                                (
                                )

                        )

                    [_retrieveOptions:protected] => Array
                        (
                        )

                    [_lastResponse:protected] => 
                )

            [shipping] => 
            [source] => Stripe\Card Object
                (
                    [_opts:protected] => Stripe\Util\RequestOptions Object
                        (
                            [headers] => Array
                                (
                                )

                            [apiKey] => sk_test_kqhSOGciGCjlWKuVj81HQgj7
                        )

                    [_values:protected] => Array
                        (
                            [id] => card_17NLcvBc37nOPWMpFTBvomh5
                            [object] => card
                            [address_city] => 
                            [address_country] => 
                            [address_line1] => 
                            [address_line1_check] => 
                            [address_line2] => 
                            [address_state] => 
                            [address_zip] => 
                            [address_zip_check] => 
                            [brand] => Visa
                            [country] => US
                            [customer] => 
                            [cvc_check] => 
                            [dynamic_last4] => 
                            [exp_month] => 5
                            [exp_year] => 2022
                            [fingerprint] => SGjOv6fryijzJc0k
                            [funding] => credit
                            [last4] => 4242
                            [metadata] => Stripe\AttachedObject Object
                                (
                                    [_opts:protected] => Stripe\Util\RequestOptions Object
                                        (
                                            [headers] => Array
                                                (
                                                )

                                            [apiKey] => sk_test_kqhSOGciGCjlWKuVj81HQgj7
                                        )

                                    [_values:protected] => Array
                                        (
                                        )

                                    [_unsavedValues:protected] => Stripe\Util\Set Object
                                        (
                                            [_elts:Stripe\Util\Set:private] => Array
                                                (
                                                )

                                        )

                                    [_transientValues:protected] => Stripe\Util\Set Object
                                        (
                                            [_elts:Stripe\Util\Set:private] => Array
                                                (
                                                )

                                        )

                                    [_retrieveOptions:protected] => Array
                                        (
                                        )

                                    [_lastResponse:protected] => 
                                )

                            [name] => 
                            [tokenization_method] => 
                        )

                    [_unsavedValues:protected] => Stripe\Util\Set Object
                        (
                            [_elts:Stripe\Util\Set:private] => Array
                                (
                                )

                        )

                    [_transientValues:protected] => Stripe\Util\Set Object
                        (
                            [_elts:Stripe\Util\Set:private] => Array
                                (
                                )

                        )

                    [_retrieveOptions:protected] => Array
                        (
                        )

                    [_lastResponse:protected] => 
                )

            [statement_descriptor] => 
            [status] => succeeded
        )

    [_unsavedValues:protected] => Stripe\Util\Set Object
        (
            [_elts:Stripe\Util\Set:private] => Array
                (
                )

        )

    [_transientValues:protected] => Stripe\Util\Set Object
        (
            [_elts:Stripe\Util\Set:private] => Array
                (
                )

        )

    [_retrieveOptions:protected] => Array
        (
        )

    [_lastResponse:protected] => Stripe\ApiResponse Object
        (
            [headers] => Array
            (
                [Server] => nginx
                [Date] => Tue, 29 Dec 2015 11:26:53 GMT
                [Content-Type] => application/json
                [Content-Length] => 1442
                [Connection] => keep-alive
                [Access-Control-Allow-Credentials] => true
                [Access-Control-Allow-Methods] => GET, POST, HEAD, OPTIONS, DELETE
                [Access-Control-Allow-Origin] => *
                [Access-Control-Max-Age] => 300
                [Cache-Control] => no-cache, no-store
                [Request-Id] => req_7cao1V6yu4hPpw
                [Stripe-Version] => 2015-04-07
                [Strict-Transport-Security] => max-age=31556926; includeSubDomains
            )

            [body] => 
            {
              "id": "ch_17NLcvBc37nOPWMpqSqUs2oO",
              "object": "charge",
              "amount": 8800,
              "amount_refunded": 0,
              "application_fee": null,
              "balance_transaction": "txn_17NLcvBc37nOPWMpO1PwxwnP",
              "captured": true,
              "created": 1451388413,
              "currency": "usd",
              "customer": null,
              "description": "Silver Membership Plan",
              "destination": null,
              "dispute": null,
              "failure_code": null,
              "failure_message": null,
              "fraud_details": {},
              "invoice": null,
              "livemode": false,
              "metadata": {},
              "paid": true,
              "receipt_email": null,
              "receipt_number": null,
              "refunded": false,
              "refunds": {
                            "object": "list",
                            "data": [],
                            "has_more": false,
                            "total_count": 0,
                            "url": "/v1/charges/ch_17NLcvBc37nOPWMpqSqUs2oO/refunds"
                         },
              "shipping": null,
              "source": {
                        "id": "card_17NLcvBc37nOPWMpFTBvomh5",
                        "object": "card",
                        "address_city": null,
                        "address_country": null,
                        "address_line1": null,
                        "address_line1_check": null,
                        "address_line2": null,
                        "address_state": null,
                        "address_zip": null,
                        "address_zip_check": null,
                        "brand": "Visa",
                        "country": "US",
                        "customer": null,
                        "cvc_check": null,
                        "dynamic_last4": null,
                        "exp_month": 5,
                        "exp_year": 2022,
                        "fingerprint": "SGjOv6fryijzJc0k",
                        "funding": "credit",
                        "last4": "4242",
                        "metadata": {},
                        "name": null,
                        "tokenization_method": null
                      },
              "statement_descriptor": null,
              "status": "succeeded"
            }

            [json] => Array
            (
                [id] => ch_17NLcvBc37nOPWMpqSqUs2oO
                [object] => charge
                [amount] => 8800
                [amount_refunded] => 0
                [application_fee] => 
                [balance_transaction] => txn_17NLcvBc37nOPWMpO1PwxwnP
                [captured] => 1
                [created] => 1451388413
                [currency] => usd
                [customer] => 
                [description] => Silver Membership Plan
                [destination] => 
                [dispute] => 
                [failure_code] => 
                [failure_message] => 
                [fraud_details] => Array
                    (
                    )

                [invoice] => 
                [livemode] => 
                [metadata] => Array
                    (
                    )

                [paid] => 1
                [receipt_email] => 
                [receipt_number] => 
                [refunded] => 
                [refunds] => Array
                    (
                        [object] => list
                        [data] => Array
                            (
                            )

                        [has_more] => 
                        [total_count] => 0
                        [url] => /v1/charges/ch_17NLcvBc37nOPWMpqSqUs2oO/refunds
                    )

                [shipping] => 
                [source] => Array
                    (
                        [id] => card_17NLcvBc37nOPWMpFTBvomh5
                        [object] => card
                        [address_city] => 
                        [address_country] => 
                        [address_line1] => 
                        [address_line1_check] => 
                        [address_line2] => 
                        [address_state] => 
                        [address_zip] => 
                        [address_zip_check] => 
                        [brand] => Visa
                        [country] => US
                        [customer] => 
                        [cvc_check] => 
                        [dynamic_last4] => 
                        [exp_month] => 5
                        [exp_year] => 2022
                        [fingerprint] => SGjOv6fryijzJc0k
                        [funding] => credit
                        [last4] => 4242
                        [metadata] => Array
                            (
                            )

                        [name] => 
                        [tokenization_method] => 
                    )

                [statement_descriptor] => 
                [status] => succeeded
            )

            [code] => 200
        )

)
