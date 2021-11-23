<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *  title="Cidade",
 *  @OA\Xml(
 *      name="Cidade"
 *  )
 * )
 */
class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'uf', 'pais'];

    /**
     * @OA\Property(
     *  description="ID da cidade"
     * )
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *  description="Nome da cidade"
     * )
     * @var string
     */
    private $nome;

    /**
     * @OA\Property(
     *  description="UF da cidade"
     * )
     * @var string
     */
    private $uf;

    /**
     * @OA\Property(
     *  description="Pais da cidade"
     * )
     * @var string
     */
    private $pais;
}
