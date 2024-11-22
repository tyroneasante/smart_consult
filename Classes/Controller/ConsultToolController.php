<?php

namespace Tyrone\SmartConsult\Controller;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ConsultToolController extends ActionController
{
    public function __construct(
        private ConnectionPool $connectionPool,
    ) {}

    public function showAction()
    {
        $pluginUid = $this->configurationManager->getContentObject()->data['uid'];

        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('tx_smartconsult_consulttool_transitions');
        $transitions = $queryBuilder->select('*')
            ->from('tx_smartconsult_consulttool_transitions')
            ->where($queryBuilder->expr()->eq('parent_uid', $pluginUid))
            ->executeQuery()->fetchAllAssociative();

        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('tx_smartconsult_domain_model_question');
        $questions = $queryBuilder->select('*')
            ->from('tx_smartconsult_domain_model_question')
            ->executeQuery()->fetchAllAssociative();




        $this->view->assign('transitions', $transitions);
        $this->view->assign('questions', $questions);
        $this->view->assign('initial', $this->findInitial($transitions, $questions));
        return $this->htmlResponse();
    }

    protected function findInitial($transitions, $questions)
    {
        $initial = array_filter($transitions, function ($transition) {
            return $transition['initial'] === 1;
        });

        $initialQuestion = array_filter($questions, function ($question) use ($initial) {
            return $question['uid'] === $initial[0]['from'];
        });

        $initialAnswers = array_filter($transitions, function ($transition) use ($initial) {
            return $transition['from'] === $initial[0]['from'];
        });

        return [
            'question' => $initialQuestion[0],
            'answers' => $initialAnswers
        ];
    }
}
