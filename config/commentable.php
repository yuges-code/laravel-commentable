<?php

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for comments
     */
    'models' => [
        'comment' => Yuges\Commentable\Models\Comment::class,
        'commentator' => [
            'default' => \App\Models\User::class,
            'allowed' => [
                \App\Models\User::class,
            ],
        ],
    ],

    'permissions' => [
        'anonymous' => false,
    ],

    'sanitizers' => [
        Yuges\Commentable\Sanitizers\CommentSanitizer::class
    ],

    'transformers' => [
        Yuges\Commentable\Transformers\CommentTransformer::class
    ],
];
