<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class UserFonctionForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('label', 'text', [
                'label' => 'Label'
            ])
            ->add('id', 'text', [
                'wrapper' => [
                    'class' => 'hidden'
                ]
            ])
        ;
    }
}
