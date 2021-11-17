<?php

namespace App\Http\Services\Pemesanan\FindPemesanan;

use App\Models\StatusPemesanan;
use Carbon\Carbon;

class FindPemesananResponse
{
    private int $id;
    private int $id_user;
    /** @var BarangPemesanan[] $barangs */
    private array $barangs;
    private float $total;
    private Carbon $created_at;
    private string $name;
    private StatusPemesanan $status;

    /**
     * @param int $id
     * @param int $id_user
     * @param BarangPemesanan[] $barangs
     * @param float $total
     * @param Carbon $created_at
     * @param string $name
     * @param StatusPemesanan $status
     */
    public function __construct(
        int             $id,
        int             $id_user,
        array           $barangs,
        float           $total,
        Carbon          $created_at,
        string          $name,
        StatusPemesanan $status
    )
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->barangs = $barangs;
        $this->total = $total;
        $this->created_at = $created_at;
        $this->name = $name;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @return BarangPemesanan[]
     */
    public function getBarangs(): array
    {
        return $this->barangs;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @return StatusPemesanan
     */
    public function getStatus(): StatusPemesanan
    {
        return $this->status;
    }
}
