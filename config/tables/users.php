<?php

return [
    "name" => "users",
    "columns" => [
        [
            "name" => "id",
            "type" => "BIGINT",
            "nullable" => false,
            "default" => null,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
            ]
        ],
        [
            "name" => "name",
            "type" => "VARCHAR",
            "nullable" => true,
            "default" => null,
            "length" => 255
        ],
        [
            "name" => "email",
            "type" => "VARCHAR",
            "nullable" => true,
            "default" => null,
            "length" => 255,
            "comment" => "#email",
            "config" => [
                "email" => true
            ]
        ],
        [
            "name" => "email_verified_at",
            "type" => "TIMESTAMP",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "password",
            "type" => "VARCHAR",
            "nullable" => true,
            "default" => null,
            "length" => 255,
            "comment" => "#secret",
            "config" => [
                "secret" => true
            ]
        ],
        [
            "name" => "remember_token",
            "type" => "VARCHAR",
            "nullable" => true,
            "default" => null,
            "length" => 255
        ],
        [
            "name" => "two_factor_secret",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "two_factor_recovery_codes",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "two_factor_confirmed_at",
            "type" => "TIMESTAMP",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "current_team_id",
            "type" => "BIGINT",
            "nullable" => true,
            "default" => null,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
            ]
        ],
        [
            "name" => "profile_photo_path",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png"
            ]
        ]
    ],
    "foreignKeys" => [

    ],
    "indices" => [
        [
            "name" => "PRIMARY",
            "columns" => [
                "id"
            ],
            "unique" => 0
        ],
        [
            "name" => "email_UNIQUE",
            "columns" => [
                "email"
            ],
            "unique" => 1
        ]
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => [
            "id"
        ]
    ]
];
