<?php

declare(strict_types=1);

namespace App\Model\Article;

use DateTime;
use Shopsys\FrameworkBundle\Model\Article\Article as BaseArticle;
use Shopsys\FrameworkBundle\Model\Article\ArticleData as BaseArticleData;
use Shopsys\FrameworkBundle\Model\Article\ArticleDataFactory as BaseArticleDataFactory;

class ArticleDataFactory extends BaseArticleDataFactory
{
    /**
     * @param \App\Model\Article\Article $article
     * @return \App\Model\Article\ArticleData
     */
    public function createFromArticle(BaseArticle $article): BaseArticleData
    {
        $articleData = $this->create();
        $this->fillFromArticle($articleData, $article);

        $articleData->createdAt = $article->getCreatedAt() ?? new DateTime();

        return $articleData;
    }

    /**
     * @return \App\Model\Article\ArticleData
     */
    public function create(): BaseArticleData
    {
        $articleData = new ArticleData();
        $this->fillNew($articleData);

        return $articleData;
    }
}
