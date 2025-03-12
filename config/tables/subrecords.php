<?php

return [
    "name" => "subrecords",
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
            "name" => "records_id",
            "type" => "BIGINT",
            "nullable" => false,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
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
            "name" => "n_p_w_p",
            "type" => "BIGINT",
            "nullable" => true,
            "comment" => "#npwp",
            "config" => [
                "npwp" => true
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
            "name" => "fk_subrecords_records1",
            "column" => "records_id",
            "referenced_table" => "records",
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
            "name" => "fk_subrecords_records1_idx",
            "columns" => [
                "records_id"
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
