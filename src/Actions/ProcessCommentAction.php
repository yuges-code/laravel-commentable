<?php

namespace Yuges\Commentable\Actions;

use Yuges\Commentable\Models\Comment;
use Yuges\Commentable\Sanitizers\Sanitizer;
use Yuges\Commentable\Transformers\Transformer;
use Yuges\Commentable\Sanitizers\SanitizerFactory;
use Yuges\Commentable\Transformers\TransformerFactory;

class ProcessCommentAction
{
    public function __construct(
        public Comment $comment
    ) {
    }

    public static function create(Comment $comment): self
    {
        return new static($comment);
    }

    public function execute(): void
    {
        $this->comment->text = $this->comment->original;

        $this
            ->transform()
            ->sanitize();
    }

    protected function sanitize(): self
    {
        SanitizerFactory::createAll($this->comment)
            ->each(fn (Sanitizer $sanitizer) => $sanitizer->sanitize());

        return $this;
    }

    protected function transform(): self
    {
        TransformerFactory::createAll($this->comment)
            ->each(fn (Transformer $transformer) => $transformer->transform());

        return $this;
    }
}
