<?php

namespace Baza;

class DB {

	const MYSQL_SET_NAMES_VALUE = 'SET NAMES utf8';
	const ENCODING_FROM = 'ASCII, UTF-8, ISO-8859-1, ISO-8859-15';
	const ENCODING_TO = 'UTF-8';
	const ENCODE_ALL_DATA = true;

	protected $name;
	protected $config;
	protected $log;

	protected $pdo = null;

	public function __construct() {
        $db_config = parse_ini_file(__DIR__ . '/baza.ini', true);

		$this->config = !empty($db_config) ? $db_config : array();
	}
	public function get($new = false) {
		if (!empty($this->pdo) && !$new) {
			return $this->pdo;
		}
		try {
			$this->pdo = new \PDO(
				sprintf('mysql:dbname=%s',
					$this->config['name']
				),
				$this->config['username'],
				$this->config['password'],
				array(
					\PDO::ATTR_PERSISTENT => false,
					\PDO::MYSQL_ATTR_INIT_COMMAND => self::MYSQL_SET_NAMES_VALUE,
					\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				)
			);
		} catch (\PDOException $e) {
			var_dump($e->getMessage());die;
		} catch (\Exception $e) {
            var_dump($e->getMessage());
			$this->pdo = null;
			die;
		}
		return $this->pdo;
	}

	public function setAttribute($attribute, $value) {
		if ($this->get()) {
			try {
				$result = $this->pdo->setAttribute($attribute, $value);
				return $result;
			} catch (\PDOException $e) {
			} catch (\Exception $e) {
			}
		} else {
			throw new \Exception('Not connected to database');
		}
		return false;
	}

	public function exec($sql) {
		if ($this->get()) {
			try {
				$result = $this->pdo->exec($sql);
				return $result;
			} catch (\PDOException $e) {
			} catch (\Exception $e) {
			}
		} else {
            throw new \Exception('Not connected to database');
		}
		return null;
	}

	public function query($sql) {
		if ($this->get()) {
			try {
				$result = $this->pdo->query($sql);
				return $result;
			} catch (\PDOException $e) {
			} catch (\Exception $e) {
			}
		} else {
            throw new \Exception('Not connected to database');
		}
		return null;
	}

	public function fetch($sql) {
		$result = $this->query($sql);
		return empty($result) ? null : $result->fetch(\PDO::FETCH_ASSOC);
	}

	public function fetchAll($sql, $safe = true) {
		$result = $this->query($sql);
		return empty($result) ? ($safe ? array() : null) : $result->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function lastInsertId() {
		return $this->pdo->lastInsertId();
	}

	public function prepareString($string, $encode = self::ENCODE_ALL_DATA, $from = self::ENCODING_FROM, $to = self::ENCODING_TO) {
		//NOTE: We have to convert \uXXXX encoded Unicode characters to html character entities
		$string = preg_replace('/\\\u([0-9ABCDEFabcdef]{4})/', '&#x${1};', $string);
		//NOTE: We have to convert html character entities to to_encoding characters
		$string = preg_replace_callback('/&#x[0-9ABCDEFabcdef]+;/', function ($matches) {
			//TODO: When to_encoding is not 'UTF-8'
			return mb_convert_encoding($matches[0], 'UTF-8', 'HTML-ENTITIES');
		}, $string);

		$string = addslashes(stripslashes(stripslashes(stripslashes(trim(html_entity_decode($string))))));
		if ($encode) {
			$enc = mb_detect_encoding($string, $from, false);
			if ($enc === 'ASCII' && $to === 'UTF-8') {
				$string = utf8_encode($string);
			} else {
				$string = mb_convert_encoding($string, $to, mb_detect_encoding($string, $from, false));
			}
		}
		return $string;
	}
}
