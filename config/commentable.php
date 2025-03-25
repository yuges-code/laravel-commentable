<?php

// Config for yuges/commentable

use Yuges\Package\Enums\KeyType;

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for comments
     */
    'models' => [
        'comment' => [
            'key' => KeyType::Ulid,
            'class' => Yuges\Commentable\Models\Comment::class,
        ],
        'commentator' => [
            'key' => KeyType::Ulid,
            'default' => [
                'class' => \App\Models\User::class,
            ],
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ]
            ],
        ],
        'commentable' => [
            'key' => KeyType::Ulid,
            'default' => [
                'class' => \App\Models\User::class,
            ],
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ],
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

    'actions' => [
        'create' => Yuges\Commentable\Actions\CreateCommentAction::class,
        'process' => Yuges\Commentable\Actions\ProcessCommentAction::class,
    ],
];
