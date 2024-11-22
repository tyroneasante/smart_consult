<?php

namespace Tyrone\SmartConsult\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Question extends AbstractEntity
{
    protected string $question;

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }


}
