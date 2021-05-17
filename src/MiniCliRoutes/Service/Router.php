<?php

declare(strict_types=1);

namespace MiniCliRoutes\Service;

use Ds\Map;
use MiniCliRoutes\Exception\CommandNotDefinedException;

/**
 * Class Router
 * @package MiniCliRoutes\Service
 */
class Router
{
    /**
     * @var \Ds\Map
     */
    protected Map $routes;
    /**
     * @var array
     */
    protected array $commandList;

    /**
     * Router constructor.
     *
     */
    public function __construct()
    {
        $this->routes = new Map();
    }

    /**
     * @param string $path
     * @param array $pipeline
     * @param string $name
     */
    public function add(string $path, array $pipeline, string $name): void
    {
        $this->routes->put($path, $pipeline);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return $this->routes->hasKey($key);
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function get(string $key): array
    {
        return $this->routes->get($key);
    }

    /**
     * @throws \MiniCliRoutes\Exception\CommandNotDefinedException
     */
    public function handle(): array
    {
        $this->createCommandList();
        if (!$this->has($this->commandList[0])) {
            throw CommandNotDefinedException::unknownCommand($this->commandList[0]);
        }
        return $this->get($this->commandList[0]);
    }

    protected function createCommandList(): void
    {
        // Holen der Liste aus dem CLI Befehl
        $args = $_SERVER['argv'];
        // Punkt 1 muss index.php sein, wir löschen diesen
        unset($args[0]);
        // wir erzeugen aus allem anderen einen langen string für die weitere Verarbeitung
        $cleanedArgs = implode(' ', $args);
        // Wir holen uns erst alle Befehle die mit -- anfangen
        $bigCommands = explode('--', $cleanedArgs);
        // Der erste Eintrag ist 'der Rest'. Große Befehle müssen daher am Ende stehen! dürfen hier aber eine Liste
        // bilden
        $smallCommandList = $bigCommands[0];
        // Wir löschen den 1. Eintrag und haben somit ein arrays von #Big commands
        unset($bigCommands[0]);
        // Wir teilen jetzt alle kleinen befehle auf und mergen alle ergebnisse
        $this->commandList = array_merge(
            explode('-', $smallCommandList),
            $bigCommands
        );
        /*
         * Wir haben jetzt eine Liste:
         * Deren 0. Eintrag der Grundbefehl ist
         * Die dann weitere Einträge haben kann, wobei die ersten die kleinen commands sind, gefolgt von den großen
         */
    }
}
