<?php

return [
    "name" => "records",
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
            "name" => "created_by",
            "type" => "BIGINT",
            "nullable" => true,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
            ]
        ],
        [
            "name" => "updated_by",
            "type" => "BIGINT",
            "nullable" => true,
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
            "name" => "string",
            "type" => "VARCHAR",
            "nullable" => true,
            "length" => 255
        ],
        [
            "name" => "email",
            "type" => "VARCHAR",
            "nullable" => true,
            "length" => 255,
            "comment" => "#email",
            "config" => [
                "email" => true
            ]
        ],
        [
            "name" => "integer",
            "type" => "INT",
            "nullable" => true,
            "comment" => "#slider #min:1 #max:100",
            "config" => [
                "slider" => true,
                "min" => 1,
                "max" => 100
            ]
        ],
        [
            "name" => "decimal",
            "type" => "DECIMAL",
            "nullable" => true
        ],
        [
            "name" => "n_p_w_p",
            "type" => "BIGINT",
            "nullable" => true,
            "comment" => "#npwp",
            "config" => [
                "npwp" => true
            ]
        ],
        [
            "name" => "datetime",
            "type" => "DATETIME",
            "nullable" => true
        ],
        [
            "name" => "date",
            "type" => "DATE",
            "nullable" => true
        ],
        [
            "name" => "time",
            "type" => "TIME",
            "nullable" => true
        ],
        [
            "name" => "i_p_address",
            "type" => "VARCHAR",
            "nullable" => true,
            "length" => 255,
            "comment" => "#ipaddress",
            "config" => [
                "ipaddress" => true
            ]
        ],
        [
            "name" => "boolean",
            "type" => "TINYINT",
            "nullable" => true,
            "comment" => "#boolean",
            "config" => [
                "boolean" => true
            ]
        ],
        [
            "name" => "enumerate",
            "type" => "ENUM",
            "nullable" => true,
            "options" => [
                "enable",
                "disable"
            ]
        ],
        [
            "name" => "text",
            "type" => "TEXT",
            "nullable" => true
        ],
        [
            "name" => "file",
            "type" => "TEXT",
            "nullable" => true,
            "comment" => "#file",
            "config" => [
                "file" => true
            ]
        ],
        [
            "name" => "image",
            "type" => "TEXT",
            "nullable" => true,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png"
            ]
        ],
        [
            "name" => "markdown_text",
            "type" => "TEXT",
            "nullable" => true,
            "comment" => "#markdown",
            "config" => [
                "markdown" => true
            ]
        ],
        [
            "name" => "w_y_s_i_w_y_g",
            "type" => "TEXT",
            "nullable" => true,
            "comment" => "#wysiwyg",
            "config" => [
                "wysiwyg" => true
            ]
        ],
        [
            "name" => "latitude",
            "type" => "DECIMAL",
            "nullable" => true
        ],
        [
            "name" => "longitude",
            "type" => "DECIMAL",
            "nullable" => true
        ]
    ],
    "foreignKeys" => [
        [
            "name" => "fk_records_user",
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
            "name" => "fk_records_user",
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
