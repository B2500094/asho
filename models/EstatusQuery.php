<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Estatus]].
 *
 * @see Estatus
 */
class EstatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Estatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Estatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
