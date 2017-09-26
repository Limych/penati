<?php
/**
 * Copyright (c) 2017 Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 20.09.2017
 * Time: 23:05
 */

namespace Penati\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Foundation\Application;
use Penati\Console\Commands\FeedImporters\FeedImporter;

class ImportFeed extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:feed {feed_url* : URL of real estate offers feed to import. Specify "=cfg" to import urls from configs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import real estate offers from feeds to database';

    /**
     * Available importer classes of real estate offer feeds
     *
     * @var array
     */
    protected $importers = [];

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $dir = __DIR__ . '/FeedImporters';
        $files = @scandir($dir);
        if ($files) {
            foreach ($files as $file) {
                $fpath = "$dir/$file";
                if (is_file($fpath) && is_readable($fpath) && (false !== $res = file_get_contents($fpath))
                    && preg_match("/\bclass\s+(\w+FeedImporter)\b/", $res, $matches)
                ) {
                    $class = $matches[1];
                    preg_match("/\bnamespace\s+([^;\s]+)/", $res, $matches);
                    $this->importers[] = $matches[1] . '\\' . $class;
                }
            }
        }

        if (empty($this->importers)) {
            throw new \RuntimeException('There are no available importers');
        }
    }

    /**
     * Execute the console command.
     *
     * @param Application $app
     * @return mixed
     * @throws \Exception
     */
    public function handle(Application $app)
    {
        $feeds = $this->argument('feed_url');
        if ($feeds === ['=cfg']) {
            $feeds = config('import.feed');
        }
        if (empty($feeds)) {
            throw new \Exception('There are no feed URLs specified.');
        }

        $this->info('Importing real estate offers feeds...');
        foreach ($feeds as $feed) {
            $reader = new \XMLReader();
            $reader->open($feed);
            do {} while ($reader->read() && $reader->nodeType != \XMLReader::ELEMENT);

            if ($reader->nodeType != \XMLReader::ELEMENT) {
                $this->comment('There are empty feed ' . $feed);
            } else {
                foreach ($this->importers as $importer) {
                    $importer = $app->make($importer, ['context' => $this, 'feed' => $feed]);
                    if ($app->call([$importer, 'canImport'], ['context' => $this, 'reader' => $reader])) {
                        $this->info('Importing feed ' . $feed);
                        try {
                            $app->call([$importer, 'import'], ['reader' => $reader, 'feed' => $feed, 'context' => $this]);
                        } catch (\Exception $ex) {
                            if ($app->environment() !== 'production') {
                                throw $ex;
                            }
                        }
                        continue 2;
                    }
                }
                $this->error('There are no importer for feed ' . $feed);
            }
            $reader->close();
        }

        return 0;
    }

}
