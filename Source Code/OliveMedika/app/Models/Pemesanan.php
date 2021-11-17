<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;


    private ?int $id;
    private int $id_user;
    /** @var BarangPemesanan[] $barangs */
    private array $barangs;
    private StatusPemesanan $status;
    private float $total;
    private Carbon $created_at;

    /**
     * @param int|null $id
     * @param int $id_user
     * @param BarangPemesanan[] $barangs
     * @param float $total
     * @param Carbon $created_at
     * @param StatusPemesanan|null $status
     */
    public function __construct(
        ?int             $id,
        int              $id_user,
        array            $barangs,
        float            $total,
        Carbon           $created_at,
        ?StatusPemesanan $status)
    {
        parent::__construct();
        $this->id = $id;
        $this->id_user = $id_user;
        $this->barangs = $barangs;
        $this->total = $total;
        $this->created_at = $created_at;

        if (!$status)
            $this->status = new StatusPemesanan(StatusPemesanan::SEDANG_DIPROSES);
        else
            $this->status = $status;
    }

    public static function create(
        int   $id_user,
        array $barangs
    ): Pemesanan
    {
        $total = Pemesanan::calculateTotal($barangs);
        return new self(
            null,
            $id_user,
            $barangs,
            $total,
            Carbon::now(),
            null //ini pasti null soalnya baru
        );
    }

    /**
     * @param BarangPemesanan[] $barangs
     */
    private static function calculateTotal(array $barangs)
    {
        $total = 0;
        foreach ($barangs as $barang) {
            $total += $barang->getHarga() * $barang->getQuantity();
        }
        return $total;
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
