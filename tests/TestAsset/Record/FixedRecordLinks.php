<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Record;

use Contenir\Navigation\Laminas\Mvc\RecordLink;
use Contenir\Navigation\Laminas\Mvc\RecordLinkResolverInterface;
use Contenir\Navigation\Laminas\Mvc\RecordLinks;
use Contenir\Navigation\Link\RecordTarget;
use Override;

/**
 * A resolver with a fixed link for each record it was given, by section and id, that notes each
 * list of records it was asked for.
 */
final class FixedRecordLinks implements RecordLinkResolverInterface
{
    /** @var list<list<RecordTarget>> */
    public array $asked = [];

    /**
     * @param array<string, RecordLink> $links
     */
    public function __construct(
        private readonly array $links = [],
    ) {}

    #[Override]
    public function resolve(array $records): RecordLinks
    {
        $this->asked[] = $records;

        return RecordLinks::of($this->links);
    }
}
