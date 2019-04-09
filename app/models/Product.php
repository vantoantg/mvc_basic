<?php
/**
 * Created by PhpStorm.
 * User: HP570
 * Date: 4/9/2019
 * Time: 12:32 PM
 */

namespace app\models;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity() @Table(name="products")
 **/
class Product
{
    /** @ORM\Id() @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @ORM\Column(type="string") **/
    protected $name;
}