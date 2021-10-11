<?php


namespace App\Http\Mechanism;


use Illuminate\Database\ConnectionInterface;

class UnitOfWork
{
	private ConnectionInterface $db;

	/**
	 * @param ConnectionInterface $db
	 */
	public function __construct(ConnectionInterface $db)
	{
		$this->db = $db;
	}

	public static function newInstance(ConnectionInterface $db): UnitOfWork
	{
		return new UnitOfWork($db);
	}

	public function begin(): void
	{
		$this->db->beginTransaction();
	}

	public function commit(): void
	{
		$this->db->commit();
	}

	public function rollbackAllTransaction(): void
	{
		while ($this->transactionExists()) {
			$this->rollback();
		}
	}

	public function transactionExists(): bool
	{
		return (bool)$this->transactionLevel();
	}

	public function transactionLevel(): int
	{
		return $this->db->transactionLevel();
	}

	public function rollback(): void
	{
		$this->db->rollBack();
	}
}
