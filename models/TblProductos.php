<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_productos".
 *
 * @property int $id_producto
 * @property int $id_categoria
 * @property string $nombre
 * @property string|null $descripcion
 * @property float $precio
 * @property string|null $imagen
 * @property int $id_usuario
 * @property string $fecha_ing
 * @property string $fecha_mod
 * @property int $estado
 *
 * @property TblCategorias $categoria
 * @property TblUsuarios $usuario
 */
class TblProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'nombre', 'precio', 'id_usuario', 'fecha_ing', 'fecha_mod', 'estado'], 'required'],
            [['id_categoria', 'id_usuario', 'estado'], 'integer'],
            [['precio'], 'number'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['nombre', 'descripcion', 'imagen'], 'string', 'max' => 255],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategorias::class, 'targetAttribute' => ['id_categoria' => 'id_categoria']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsuarios::class, 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id Producto',
            'id_categoria' => 'Categoria',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'precio' => 'Precio',
            'imagen' => 'Imagen',
            'id_usuario' => 'Id Usuario',
            'fecha_ing' => 'Fecha Ing',
            'fecha_mod' => 'Fecha Mod',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(TblCategorias::class, ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(TblUsuarios::class, ['id_usuario' => 'id_usuario']);
    }
}
