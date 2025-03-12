<?php

return [
    "name" => "image_resizing_queues",
    "columns" => [
        [
            "name" => "id",
            "type" => "BIGINT",
            "nullable" => false
        ],
        [
            "name" => "source",
            "type" => "TEXT",
            "nullable" => false,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png"
            ]
        ],
        [
            "name" => "save_as",
            "type" => "TEXT",
            "nullable" => false,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png"
            ]
        ],
        [
            "name" => "width",
            "type" => "INT",
            "nullable" => true,
            "comment" => "#min:64",
            "config" => [
                "min" => 64
            ]
        ],
        [
            "name" => "height",
            "type" => "INT",
            "nullable" => true,
            "comment" => "#min:64",
            "config" => [
                "min" => 64
            ]
        ],
        [
            "name" => "remark",
            "type" => "TEXT",
            "nullable" => true
        ],
        [
            "name" => "metadata",
            "type" => "JSON",
            "nullable" => true
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
        ]
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => [
            "id"
        ]
    ]
];
