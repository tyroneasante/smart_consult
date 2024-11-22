<?php

use Typo3Api\Builder\TableBuilder;

TableBuilder::create('tx_smartconsult_consulttool')
    ->configure(new \Typo3Api\Tca\Field\InlineRelationField('answers', [
        'foreign_table' => \Typo3Api\Builder\TableBuilder::create('tx_smartconsult_consulttool_transitions')
            ->configure(new \Typo3Api\Tca\NamedPalette('Antwortmöglichkeit', [
                new \Typo3Api\Tca\Field\SelectRelationField('from', [
                    'label' => 'Startfrage',
                    'foreign_table' => 'tx_smartconsult_domain_model_question'
                ]),
                new \Typo3Api\Tca\Field\InputField('option', ['label' => 'Label']),
                new \Typo3Api\Tca\Field\SelectRelationField('to', [
                    'label' => 'Leiten zu',
                    'foreign_table' => 'tx_smartconsult_domain_model_question'
                ]),
                new \Typo3Api\Tca\Field\CheckboxField('initial', ['label' => 'Starter Frage'])
            ]))
    ]))
;
