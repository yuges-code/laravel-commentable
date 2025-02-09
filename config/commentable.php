<?php

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for comments
     */
    'models' => [
        'comment' => Yuges\Commentable\Models\Comment::class,
        'commentator' => [
            'allowed' => [
                \App\Models\User::class,
            ],
            'default' => \App\Models\User::class,
        ],
    ],

    'sanitizers' => [
        Yuges\Commentable\Sanitizers\CommentSanitizer::class
    ],

    'transformers' => [
        Yuges\Commentable\Transformers\CommentTransformer::class
    ],
];
