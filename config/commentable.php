<?php

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for comments
     */
    'models' => [
        'comment' => Yuges\Commentable\Models\Comment::class,
        'commentators' => [
            \App\Models\User::class,
        ],
    ],
];
