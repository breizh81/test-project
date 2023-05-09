<?php

namespace App\Command;

use App\Document\Article;
use App\Repository\ArticleRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-article',
    description: 'Add an article to db.',
)]
class AddArticleCommand extends Command
{
    const EXAMPLE_ARTICLE_TITLE = 'Article1.xml';
    const EXAMPLE_ARTICLE_XML = '<Article id="a5147990-9191-4fdf-968b-6ae5f562cef3"><CreationDate>2020-05-19T13:17:11+02:00</CreationDate>
                <Type>standard</Type>
                <Title>Article1</Title>
                <URL>/France/Article1</URL>
                <Intro/>
                <Picture/>
                </Article>';

    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add an article to the MongoDB database')
            ->addArgument('title', InputArgument::OPTIONAL, 'Title of the article')
            ->addArgument('xml', InputArgument::OPTIONAL, 'Xml of the article')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $title = $input->getArgument('title') ?? $this->generateTitle();
        $xml   = $input->getArgument('xml') ?? $this->generateXml();

        $article = new Article($xml, $title);

        $this->articleRepository->save($article);

        $output->writeln(sprintf('Article "%s" added to the database.', $title));

        return Command::SUCCESS;
    }

    private function generateTitle(): string
    {
        return self::EXAMPLE_ARTICLE_TITLE;
    }

    private function generateXml(): string
    {
        return self::EXAMPLE_ARTICLE_XML;
    }
}