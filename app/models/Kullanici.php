<?php

class Kullanici extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=false)
     */
    public $kAdi;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    public $pass;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $tarih;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("megdb");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'kullanici';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Kullanici[]|Kullanici|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Kullanici|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
