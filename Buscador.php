<?php

namespace Alura\BuscadorDeCustos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpCliente;
    private $crawler;

    public function __construct(ClientInterface $httpCliente, Crawler $crawler)
    {
        $this->httpCliente = $httpCliente;
        $this->crawler = $crawler;
    }

    public function buscador (string $url): array
    {
        $resposta = $this->httpCliente->request('GET', $url);

        $html = $resposta->getBody();
        $this->crawler->addHtmlContent($html);

        $elementosCursos = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach($elementosCursos as $elemento)
        {
            $curso[] = $elementosCursos->textContent;
        }

        return $cursos;
    }
}
