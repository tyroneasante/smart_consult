<?php

use Typo3Api\Builder\TableBuilder;

use Typo3Api\Tca\Field\InputField;

TableBuilder::create('tx_smartconsult_domain_model_question')
    ->configure(new InputField('question'))
;
