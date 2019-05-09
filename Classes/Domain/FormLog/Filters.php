<?php
declare(strict_types = 1);

namespace Pagemachine\Formlog\Domain\FormLog;

/*
 * This file is part of the Pagemachine TYPO3 Formlog project.
 */

/**
 * Collection of form log filters
 */
class Filters implements \IteratorAggregate, \Countable
{
    /**
     * @var ValueFilter
     */
    protected $pageTitle;

    /**
     * @var ValueFilter
     */
    protected $identifier;

    /**
     * @var DateRangeFilter
     */
    protected $submissionDate;

    /**
     * @param ValueFilter|null $pageTitle
     * @param ValueFilter|null $identifier
     * @param DateRangeFilter|null $submissionDate
     */
    public function __construct(ValueFilter $pageTitle = null, ValueFilter $identifier = null, DateRangeFilter $submissionDate = null)
    {
        $this->pageTitle = $pageTitle ?: new ValueFilter();
        $this->identifier = $identifier ?: new ValueFilter();
        $this->submissionDate = $submissionDate ?: new DateRangeFilter();
    }

    /**
     * @return ValueFilter
     */
    public function getPageTitle(): ValueFilter
    {
        return $this->pageTitle;
    }

    /**
     * @return ValueFilter
     */
    public function getIdentifier(): ValueFilter
    {
        return $this->identifier;
    }

    /**
     * @return DateRangeFilter
     */
    public function getSubmissionDate(): DateRangeFilter
    {
        return $this->submissionDate;
    }

    /**
     * Returns whether no filter is set
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return count($this) === 0;
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        if (!$this->pageTitle->isEmpty()) {
            yield 'page.title' => $this->pageTitle;
        }

        if (!$this->identifier->isEmpty()) {
            yield 'identifier' => $this->identifier;
        }

        if (!$this->submissionDate->isEmpty()) {
            yield 'submissionDate' => $this->submissionDate;
        }

        yield from [];
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count(iterator_to_array($this));
    }
}
