<?php

class StructureMaterial extends EActiveRecord
{
    public function behaviors()
    {
        return array(
            'structure' => array(
                'class' => 'application.behaviors.StructureBehavior',
            ),
        );
    }
}