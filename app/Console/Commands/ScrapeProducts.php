<?php

namespace App\Console\Commands;

use App\Models\Product;
use Goutte\Client;
use Illuminate\Console\Command;

class ScrapeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape products from an e-commerce';

    /**
     * Execute the console command.
     *
     * @return int
     */

    protected $client;
    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    public function handle()
    {
        $url = 'https://lista.mercadolivre.com.br/notebooks#D[A:notebooks]';
        $crawler = $this->client->request('GET', $url);

        $products = [];

        $links = $crawler->filter('.ui-search-result__wrapper a')->extract(['href']);

        foreach ($links as $link) {

            $productCrawler = $this->client->request('GET', $link);
            $name = $productCrawler->filter('.ui-pdp-title')->count()
                ? $productCrawler->filter('.ui-pdp-title')->text()
                : '';

            $price = $productCrawler->filter('.ui-pdp-price--size-large .ui-pdp-price__second-line .andes-money-amount__fraction')->count()
                ? $productCrawler->filter('.ui-pdp-price--size-large .ui-pdp-price__second-line .andes-money-amount__fraction')->text()
                : '';

            $description = $productCrawler->filter('.ui-pdp-description__content')->count()
                ? $productCrawler->filter('.ui-pdp-description__content')->text()
                : '';

            $imageUrl = $productCrawler->filter('.ui-pdp-gallery__figure__image')->count()
                ? $productCrawler->filter('.ui-pdp-gallery__figure__image')->first()->attr('src')
                : '';

            Product::create([
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'image' => $imageUrl,
            ]);

            $this->info("Scraped: $name");
        }

        $this->info('Scraping completed.');
    }
}
