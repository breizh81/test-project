<?php

namespace App\Command;

use App\Document\Article;
use App\Repository\ArticleRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-article',
    description: 'Add an article to db.',
)]
class AddArticleCommand extends Command
{
    public const EXAMPLE_ARTICLE_TITLE = 'Article1.xml';
    public const EXAMPLE_ARTICLE_XML =
        [
           'Article1.xml' => '<Article id="a5147990-9191-4fdf-968b-6ae5f562cef3">
<CreationDate>2020-05-19T13:17:11+02:00</CreationDate>
                <Type>standard</Type>
                <Title>Article1</Title>
                <URL>/France/Article1</URL>
                <Intro/>
                <Picture/>
                </Article>',
             'Article2.xml' => '<Article id="c201871e-ef6c-11ed-a05b-0242ac120003">
<CreationDate>2020-05-19T13:17:11+02:00</CreationDate>
                <Type>standard</Type>
                <Title>Article1</Title>
                <URL/>
                <Intro/>
                <Picture/>
                </Article>',
        ];

    public function __construct(private readonly ArticleRepositoryInterface $articleRepository)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add an article to the MongoDB database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach (self::EXAMPLE_ARTICLE_XML as $title => $xml) {
            $article = new Article($xml, $title);
            $this->articleRepository->save($article);
            $output->writeln(sprintf('Article "%s" added to the database.', $title));
        }

        return Command::SUCCESS;
    }
}
