<?php

namespace TurFramework\Database;

use PDO;

use InvalidArgumentException;
use TurFramework\Database\Managers\MySQLManager;
use TurFramework\Support\Arr;
use TurFramework\Database\Connectors\MySQLConnector;

class DatabaseManager
{
    /**
     * @var array $connections
     */
    protected static $connections = [];

    /**
     * make database connection
     * @return \TurFramework\Database\Contracts\DatabaseManagerInterface
     */
    public function makeConnection($name)
    {
        $name = $name ?: $this->getDefaultConnection();

        //  get the configuration settings for the specified connection name from the config/database.php file.
        $config = $this->getConfiguration($name);

        // Check if the connection is already stored in the connections array
        if (!isset(self::$connections[$name])) {
            // If not, create a new connection using the retrieved configuration
            self::$connections[$name] = $this->createConnection($config);
        }

        // we will return database manager based on the connection driver
        return $this->getDatabaseManager(self::$connections[$name], $config);
    }

    protected function createConnection($config)
    {
        return  $this->getConnector($config)->connect($config);
    }
    /**
     * Get the configuration for a connection.
     *
     * @param  string  $name
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    protected function getConfiguration($name)
    {
        $config = Arr::get(config('database.connections'), $name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Database connection [{$name}] not configured.");
        }

        return $config;
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultConnection()
    {
        return config('database.default');
    }

    /**
     * get a connector instance based on the configuration.
     *
     * @param  array  $config
     * @return \TurFramework\Database\Contracts\ConnectorInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getConnector(array $config)
    {
        if (!isset($config['driver'])) {
            throw new InvalidArgumentException('A driver must be specified.');
        }
        return match ($config['driver']) {
            'mysql' => new MySqlConnector,
            default => throw new InvalidArgumentException("Unsupported driver [{$config['driver']}]."),
        };
    }

    /**
     * Create a new connection instance.
     * 
     * @param  \PDO|\Closure  $connection
     * @param  string  $database 
     * @param  array  $config
     * @return \TurFramework\Database\Contracts\DatabaseManagerInterface;
     *
     * @throws \InvalidArgumentException
     */
    protected function getDatabaseManager($connection, array $config = [])
    {
        $driver = $config['driver'];

        return match ($driver) {
            'mysql' => new MySQLManager($connection, $config),
            default => throw new InvalidArgumentException("Unsupported driver [{$driver}]."),
        };
    }
}
