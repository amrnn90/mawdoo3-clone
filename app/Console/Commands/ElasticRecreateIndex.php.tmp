<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch\Client as Elastic;

class ElasticRecreateIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recreate ElasticSearch index, with mapping, and reindex';

    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Elastic $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $index = config('scout.elasticsearch.index');

        if ($this->client->indices()->exists(['index' => $index])) {
            $this->client->indices()->delete(['index' => $index]);
        }

        $params = [
            'index' => $index,
            'body' => [
                'settings' => $this->getIndexSettings(),
                'mappings' => $this->getIndexMappings()
            ]
        ];
        $this->client->indices()->create($params);

        \Artisan::call('scout:import', ['model' => \App\Post::class]);
    }

    protected function getIndexSettings()
    {
        return [
            'number_of_shards' => 1,
            'number_of_replicas' => 0,
            "analysis" => [
                "filter" => [
                    "trigrams_filter" => [
                        "type" => "ngram",
                        "min_gram" => 3,
                        "max_gram" => 10
                    ],
                    "arabic_stop" => [
                        "type" => "stop",
                        "stopwords" => "_arabic_"
                    ],
                    "arabic_stemmer" => [
                        "type" => "stemmer",
                        "language" => "arabic"
                    ]
                ],
                "analyzer" => [
                    "arabic_trigrams" => [
                        "type" => "custom",
                        "tokenizer" => "standard",
                        "filter" => [
                            "lowercase",
                            "decimal_digit",
                            "arabic_stop",
                            "arabic_normalization",
                            "trigrams_filter"
                        ]
                    ],
                    "arabic_stemmed" => [
                        "tokenizer" => "standard",
                        "filter" => [
                            "lowercase",
                            "decimal_digit",
                            "arabic_stop",
                            "arabic_normalization",
                            "arabic_stemmer"
                        ]
                    ],
                    "arabic_non_stemmed" => [
                        "tokenizer" => "standard",
                        "filter" => [
                            "lowercase",
                            "decimal_digit",
                            "arabic_stop",
                            "arabic_normalization",
                        ]
                    ]
                ]
            ]
        ];
    }

    protected function getIndexMappings()
    {
        return [
            'posts' => [
                'properties' => [
                    // 'title' => [
                    //     'type' => 'text',
                    //     'analyzer' => 'arabic_stemmed',
                    //     'fields' => [
                    //         'nsa' => [
                    //             'type' => 'text',
                    //             'analyzer' => 'arabic_non_stemmed',
                    //         ]
                    //     ]
                    // ],
                    // 'content' => [
                    //     'type' => 'text',
                    //     'analyzer' => 'arabic_stemmed',
                    //     'fields' => [
                    //         'nsa' => [
                    //             'type' => 'text',
                    //             'analyzer' => 'arabic_non_stemmed',
                    //         ]
                    //     ]
                    // ],
                    
                    'title' => [
                        'type' => 'text',
                        'analyzer' => 'arabic_trigrams',
                        'search_analyzer' => 'arabic_non_stemmed'
                    ],
                    'content' => [
                        'type' => 'text',
                        'analyzer' => 'arabic_trigrams',
                        'search_analyzer' => 'arabic_non_stemmed'
                    ],
                ]
            ]
        ];
    }
}
