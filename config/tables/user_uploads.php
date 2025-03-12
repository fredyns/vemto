<?php

return [
    "name" => "user_uploads",
    "columns" => [
        [
            "name" => "id",
            "type" => "BIGINT",
            "nullable" => false,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
            ]
        ],
        [
            "name" => "user_id",
            "type" => "BIGINT",
            "nullable" => false,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
            ]
        ],
        [
            "name" => "at",
            "type" => "TIMESTAMP",
            "nullable" => false
        ],
        [
            "name" => "file",
            "type" => "TEXT",
            "nullable" => false,
            "comment" => "#file",
            "config" => [
                "file" => true
            ]
        ],
        [
            "name" => "name",
            "type" => "VARCHAR",
            "nullable" => true,
            "length" => 255
        ],
        [
            "name" => "description",
            "type" => "TEXT",
            "nullable" => true
        ],
        [
            "name" => "type",
            "type" => "VARCHAR",
            "nullable" => true,
            "length" => 255
        ],
        [
            "name" => "metadata",
            "type" => "JSON",
            "nullable" => true
        ]
    ],
    "foreignKeys" => [
        [
            "name" => "fk_user_uploads_user",
            "column" => "user_id",
            "referenced_table" => "users",
            "referenced_column" => "id"
        ]
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
            "name" => "fk_user_uploads_user_idx",
            "columns" => [
                "user_id"
            ],
            "unique" => 0
        ]
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => [
            "id"
        ]
    ]
];
