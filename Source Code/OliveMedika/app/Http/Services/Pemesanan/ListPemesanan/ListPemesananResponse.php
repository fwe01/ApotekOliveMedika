<?php

namespace App\Http\Services\Pemesanan\ListPemesanan;

use App\Models\StatusPemesanan;
use Carbon\Carbon;

class ListPemesananResponse
{
    private ?int $id;
    private int $id_user;
    private float $total;
    private Carbon $created_at;
    private string $name;
    private StatusPemesanan $status;

    /**
     * @param int|null $id
     * @param int $id_user
     * @param string $name
     * @param float $total
     * @param Carbon $created_at
     * @param StatusPemesanan $status
     */
    public function __construct(
        ?int            $id,
        int             $id_user,
        string          $name,
        float           $total,
        Carbon          $created_at,
        StatusPemesanan $status)
    {
        $this->id = $id;
        $this->id_user = $id_user;
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
     * @return int|null
     */
    public function getId(): ?int
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
