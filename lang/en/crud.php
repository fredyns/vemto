<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'user_activity_logs' => [
        'name' => 'User Activity Logs',
        'index_title' => 'User Activity Logs List',
        'new_title' => 'New User Activity Log',
        'create_title' => 'Create User Activity Log',
        'edit_title' => 'Edit User Activity Log',
        'show_title' => 'Show User Activity Log',
        'inputs' => [
            'at' => 'At',
            'user_id' => 'User',
            'title' => 'Title',
            'link' => 'Link',
            'message' => 'Message',
            'i_p_address' => 'I P Address',
        ],
    ],

    'records' => [
        'name' => 'Records',
        'index_title' => 'Records List',
        'new_title' => 'New Record',
        'create_title' => 'Create Record',
        'edit_title' => 'Edit Record',
        'show_title' => 'Show Record',
        'inputs' => [
            'user_id' => 'User',
            'string' => 'String',
            'email' => 'Email',
            'integer' => 'Integer',
            'decimal' => 'Decimal',
            'n_p_w_p' => 'N P W P',
            'datetime' => 'Datetime',
            'date' => 'Date',
            'time' => 'Time',
            'i_p_address' => 'I P Address',
            'bool' => 'Bool',
            'enum' => 'Enum',
            'text' => 'Text',
            'file' => 'File',
            'image' => 'Image',
            'markdown_text' => 'Markdown Text',
            'w_y_s_i_w_y_g' => 'W Y S I W Y G',
            'j_s_o_n_list' => 'J S O N List',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ],
    ],

    'user_uploads' => [
        'name' => 'User Uploads',
        'index_title' => 'UserUploads List',
        'new_title' => 'New User Upload',
        'create_title' => 'Create User Upload',
        'edit_title' => 'Edit User Upload',
        'show_title' => 'Show User Upload',
        'inputs' => [
            'user_id' => 'User',
            'at' => 'At',
            'file' => 'File',
            'name' => 'Name',
            'description' => 'Description',
            'type' => 'Type',
            'metadata' => 'Metadata',
        ],
    ],

    'user_galleries' => [
        'name' => 'User Galleries',
        'index_title' => 'User Galleries List',
        'new_title' => 'New User Gallery',
        'create_title' => 'Create User Gallery',
        'edit_title' => 'Edit User Gallery',
        'show_title' => 'Show User Gallery',
        'inputs' => [
            'user_id' => 'User',
            'at' => 'At',
            'file' => 'File',
            'name' => 'Name',
            'description' => 'Description',
            'type' => 'Type',
            'metadata' => 'Metadata',
            'thumbnail' => 'Thumbnail',
        ],
    ],

    'record_subrecords' => [
        'name' => 'Record Subrecords',
        'index_title' => 'Subrecords List',
        'new_title' => 'New Subrecord',
        'create_title' => 'Create Subrecord',
        'edit_title' => 'Edit Subrecord',
        'show_title' => 'Show Subrecord',
        'inputs' => [
            'datetime' => 'Datetime',
            'date' => 'Date',
            'time' => 'Time',
            'n_p_w_p' => 'N P W P',
            'markdown_text' => 'Markdown Text',
            'w_y_s_i_w_y_g' => 'W Y S I W Y G',
            'file' => 'File',
            'image' => 'Image',
            'i_p_address' => 'I P Address',
            'j_s_o_n_list' => 'J S O N List',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ],
    ],
];
