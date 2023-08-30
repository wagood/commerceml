<?php
namespace CommerceMLParser\Model\Interfaces;

interface HasChild
{
    public function addChild($object);
    public function getChildren();
}