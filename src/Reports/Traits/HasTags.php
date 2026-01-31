<?php

namespace Sourceboat\LaravelClockifyApi\Reports\Traits;

trait HasTags
{

    protected ?array $tagIds = null;

    protected string $tagsContainedInTimeentry = 'CONTAINS';

    public function containsTags(array $tagIds): self
    {
        $this->tagIds = $tagIds;
        $this->tagsContainedInTimeentry = 'CONTAINS';
        return $this;
    }

    public function containsOnlyTags(array $tagIds): self
    {
        $this->tagIds = $tagIds;
        $this->tagsContainedInTimeentry = 'CONTAINS_ONLY';
        return $this;
    }

    public function doesNotContainTags(array $tagIds): self
    {
        $this->tagIds = $tagIds;
        $this->tagsContainedInTimeentry = 'DOES_NOT_CONTAIN';
        return $this;
    }

}
