<?php

namespace App\Forms;

use App\UserFonction;
use Kris\LaravelFormBuilder\Fields\EntityType;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class UserDetailsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('matricule', 'text', [
                'label' => 'Matricule'
            ])
            ->add('date_embauche', 'date', [
                'label' => 'Date embauche',
                'value' => function ($value) {
                    // This format is required for the browser, more tests are needed tho
                    return (new \DateTime($value))->format('m/d/Y');
                }
            ])
            ->add('situation', 'text', [
                'label' => 'Situation'
            ])
            ->add('nbr_enfants', 'number', [
                'label' => 'Nombre des enfants'
            ])
            ->add('user_fonctions', 'collection', [
                'type' => 'form',
                'property' => 'name',
                'prototype_name' => '__NAME__',
                'empty_row' => false,
                'label' => false,
                'options' => [
                    'class' => UserFonctionForm::class,
                    'label' => false,
                ]
            ]);
    }
}
